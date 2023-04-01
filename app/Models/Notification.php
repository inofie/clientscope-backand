<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Libraries\Notification\Notification AS PushNotification;
use Illuminate\Support\Facades\URL;

class Notification extends Model
{
    protected $table = "notification";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unique_id','identifier','actor_id','target_id','reference_id','reference_module','type','title',
        'description','is_notify', 'is_read', 'is_viewed', 'created_at','updated_at','deleted_at'];

    public function actor()
    {
        $base_url = URL::to('/');
        return $this->belongsTo('App\Models\User','actor_id','id')
            ->select('users.*')
            ->selectRaw("IF(image_url IS NOT NULL AND image_url != '', CONCAT('$base_url',image_url), 
                                CONCAT('$base_url','/images/user-placeholder.png') ) AS image_url");
    }

    public function target()
    {
        $base_url = URL::to('/');
        return $this->belongsTo('App\Models\User','target_id','id')
            ->select('users.*')
            ->selectRaw("IF(image_url IS NOT NULL AND image_url != '', CONCAT('$base_url',image_url), 
                                CONCAT('$base_url','/images/user-placeholder.png') ) AS image_url");
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getById($id){

        $query = self::select();
        return $query->where('id', $id)
            ->first();
    }

    /**
     *
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function getNotifications($params)
    {
        $limit = !empty($params['limit']) ? $params['limit'] : config('constants.PAGINATION_LIMIT');
        $query = self::with('actor','target')
                        ->select('notification.*')
                        ->join('users AS actor','actor.id','=','notification.actor_id')
                        ->join('users AS target','target.id','=','notification.target_id')
                        ->where('notification.target_id',$params['user']->id)
                        //->whereRaw("notification.id NOT IN (SELECT id FROM notification WHERE reference_module='chat' AND is_read = 1  )")
                        ->orderBy('notification.id','desc')
                        ->paginate($limit);
        //update notification
        Notification::where('notification.target_id',$params['user']->id)->update([
            'is_read'   => 1
        ]);

        return $query;
    }

    /**
     * @param $params
     * @param $unique_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public static function updateNotification($params,$unique_id)
    {
        if(!empty($params['is_read'])){
            $data['is_read'] = 1;
        }
        if(!empty($params['is_viewed'])){
            $data['is_viewed'] = 1;
        }
        if( !empty($data) ){
            $data = [
                'is_read'   => 1,
                'is_viewed' => 1,
            ];
        }
        self::where('unique_id',$unique_id)->update($data);

        $query = self::with('actor','target')
                        ->select('notification.*','ni.identifier','paf.module','paf.module_id','paf.trip_id')
                        ->join('notification_identifier AS ni','ni.id','=','notification.notification_identifier_id')
                        ->join('users AS actor','actor.id','=','notification.actor_id')
                        ->join('users AS target','target.id','=','notification.target_id')
                        ->leftJoin('place_an_offer AS paf','paf.id','=','notification.reference_id')
                        ->whereRaw("notification.id NOT IN (SELECT id FROM notification WHERE reference_module='chat' AND is_read = 1  )")
                        ->where('notification.target_id',$params['user']->id)
                        ->orderBy('notification.id','desc')
                        ->paginate(config('constants.PAGINATION_LIMIT'));

        return $query;
    }

    /**
     * @param $params
     * @return array
     */
    public static function saveUserNotificationSetting($params)
    {
        $user = $params['user'];
        unset($params['user']);
        if( !empty($params) )
        {
            $current_date = Carbon::now();
            foreach($params as $key => $value)
            {
                UserMeta::where('user_id',$user->id)->where('meta_key',$key)->forceDelete();

                $data[] = [
                    'user_id'    => $user->id,
                    'meta_key'   => $key,
                    'meta_value' => $value,
                    'created_at' => $current_date,
                ];
            }
            UserMeta::insert($data);
        }
        return self::getUserNotificationSetting($user->id);
    }

    /**
     * @param $user_id
     * @return array
     */
    public static function getUserNotificationSetting($user_id)
    {
        $data   = [];
        $record = UserMeta::where('user_id',$user_id)->get();
        if( count($record) )
        {
            foreach ( $record as $result )
            {
                $data[$result->meta_key] = (int)$result->meta_value;
            }
        }
        return $data;
    }

    /**
     * @param $identifier
     * @param $data
     * @param array $customData
     * @param bool $bulk_notification
     */
    public static function sendPushNotification($identifier,$notification_data,$customData = [], $bulk_notification = false)
    {
        //device token
        if($bulk_notification == false){
            $notifyUser   = $notification_data['target'];
            $device_token = $notifyUser->device_token;
        }else{
            $notifyUsers   = $notification_data['target'];
            foreach($notifyUsers as $notifyUser)
            {
                $device_token[] =  $notifyUser->device_token;
            }
        }
        $unique_id         = uniqid();
        $customData['unique_id'] = $unique_id;
        if( !empty($device_token) )
        {
            $registrations_ids_key = is_array($device_token) ? 'registration_ids' : 'to';
            if($notifyUser->device_type == 'android'){
                $push_notification_data = [
                    $registrations_ids_key => $device_token,
                    'notification' => [
                        'title'    => $notification_data['title'],
                        'body'     => $notification_data['message'],
                        'sound'    => 'default',
                        'badge'    => $bulk_notification ? 0 : self::countUnreadNotification($notification_data['target']->id),
                        'priority' => 'high'
                    ],
                    'data' => [
                        'message'   => [
                            'body'  => $notification_data['message'],
                            'sound' => 'default',
                            'title'    => $notification_data['title'],
                        ],
                        'custom_data' => $customData,
                        'identifier'  => $identifier,
                        'user_badge'  => $bulk_notification ? 0 : self::countUnreadNotification($notification_data['target']->id),
                        'priority'    => 'high',
                    ],
                ];
            }else if($notifyUser->device_type == 'web'){
              $push_notification_data = [
                    $registrations_ids_key => $device_token,
                    'data' => [
                        'message'   => [
                            'body'  => $notification_data['message'],
                            'sound' => 'default',
                            'title'    => $notification_data['title'],
                            'badge'    => $bulk_notification ? 0 : self::countUnreadNotification($notification_data['target']->id),
                        ],
                        'custom_data'   => $customData,
                        'identifier'    => $identifier,
                        'user_badge'    => $bulk_notification ? 0 : self::countUnreadNotification($notification_data['target']->id),
                        'priority'      => 'high',
                        'redirect_link' => $notification_data['redirect_link']
                    ],
                ];
            }else{
                $push_notification_data = [
                    $registrations_ids_key => $device_token,
                    'notification' => [
                        'title'       => $notification_data['title'],
                        'text'        => $notification_data['message'],
                        'body'        => $notification_data['message'],
                        'sound'       => 'default',
                        'badge'       => $bulk_notification ? 0 : self::countUnreadNotification($notification_data['target']->id),
                        'custom_data' => $customData,
                        'identifier'  => $identifier,
                        'user_badge'  => $bulk_notification ? 0 : self::countUnreadNotification($notification_data['target']->id),
                    ],
                    'priority' => 'high'
                ];
            }
            $notification = new PushNotification;
            $notification->pushNotification($notifyUser->device_type,$push_notification_data);
        }
        //save notification data
        if($bulk_notification == true) {
            $notifyUsers   = $notification_data['target'];
            foreach($notifyUsers as $notifyUser)
            {
                $notification_buld_data[] = [
                    'unique_id'                  => $unique_id,
                    'identifier'                 => $identifier,
                    'actor_id'                   => $notification_data['actor']->id,
                    'target_id'                  => $notifyUser->id,
                    'reference_id'               => $notification_data['reference_id'],
                    'reference_module'           => $notification_data['reference_module'],
                    'type'                       => 'push',
                    'title'                      => $notification_data['title'],
                    'description'                => $notification_data['message'],
                    'created_at'                 => Carbon::now()
                ];
            }
            self::insert($notification_buld_data);
        }else{

            //save notification data
            self::create([
                'unique_id'                  => $unique_id,
                'identifier'                 => $identifier,
                'actor_id'                   => $notification_data['actor']->id,
                'target_id'                  => $notifyUser->id,
                'reference_id'               => $notification_data['reference_id'],
                'reference_module'           => $notification_data['reference_module'],
                'type'                       => 'push',
                'title'                      => $notification_data['title'],
                'description'                => $notification_data['message'],
                'created_at'                 => Carbon::now()
            ]);
        }
    }

    public static function countUnreadNotification($user_id)
    {
        $query = self::where('target_id',$user_id)->where('is_read',0)->count();
        return $query;
    }

    public static function deleteNotification($notification_id,$user_id)
    {
        self::where('id',$notification_id)->where('target_id',$user_id)->delete();
    }
}
