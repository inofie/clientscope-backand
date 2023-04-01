<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Territory extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'territory';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_user_id', 'title', 'slug', 'description', 'color', 'geofence_detail', 'status_id',
        'center_point', 'universe', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function creatorUser()
    {
        return $this->belongsTo('App\Models\User','creator_user_id','id')
                    ->select('id','parent_id','name','username','email','mobile_no','image_url','created_at');
    }

    public function assigneeUser()
    {
        return $this->hasMany('App\Models\TerritoryCompanyMapping','territory_id','id')
                    ->select('territory_company_maping.territory_id')
                    ->selectRaw('u.id, u.name, u.username, u.email, u.mobile_no, u.image_url, u.created_at')
                    ->join('users AS u','u.id','=','territory_company_maping.employee_user_id');
    }

    public function pinStatus()
    {
        return $this->hasMany('App\Models\UserPin','territory_id','id')
                    ->select('user_pin.territory_id','ups.*')
                    ->selectRaw("COUNT(user_pin.id) AS total_pin")
                    ->join('user_pin_status AS ups','ups.id','=','user_pin.pin_status_id')
                    ->groupBy('ups.id');
    }

    /*
   | ----------------------------------------------------------------------
   | Hook for manipulate query of index result
   | ----------------------------------------------------------------------
   | @query   = current sql query
   | @request = laravel http request class
   |
   */
    public function hook_query_index(&$query,$request, $id = '') {
        //Your code here
        $userRole = UserRole::getUserRoleByUserId($request['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $request['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($request['user']->id);
            $company_id  = $userCompany->id;
        }
        $query->with(['creatorUser','assigneeUser'])
            ->select('territory.*')
            ->join('territory_company_maping AS tcm','tcm.territory_id','=','territory.id')
            ->join('users AS u','u.id','=','tcm.employee_user_id')
            ->where('territory.status_id',get_status_id('active'))
            ->where('tcm.company_user_id',$company_id);

        if( !empty($request['keyword']) ){
            $keyword = $request['keyword'];
            $query->where(function($where) use ($keyword){
                $where->orWhere('territory.title','like',"%$keyword%");
                $where->orWhere('u.name','like',"%$keyword%");
            });
        }
        if( isset($request['territory_ids']) ){
            $query->whereIn('territory.id',$request['territory_ids']);
        }

        $query->groupBy('territory.id');
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before add data is execute
    | ----------------------------------------------------------------------
    | @arr
    |
    */
    public function hook_before_add(&$postdata)
    {
        $postdata['creator_user_id'] = $postdata['user']->id;
        $postdata['slug']            = str_slug($postdata['title']);
        $postdata['status_id']       = get_status_id('active');
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after add public static function called
    | ----------------------------------------------------------------------
    | @record
    |
    */
    public function hook_after_add($record)
    {
        //user territory and company mapping
        $params = \Request::all();
        TerritoryCompanyMapping::addRecord($params,$record);
        //territory latlong
        TerritoryLatLong::addTerritoryLatLong($record->id, json_decode($record->geofence_detail));

        //send push notification
        $target_user_ids = explode(',',$params['assignee_user_id']);
        $target_users    = User::select('users.*')
                                    ->selectRaw('IFNULL(ns.meta_value,1) AS meta_value')
                                    ->leftJoin('notification_setting AS ns',function($leftJoin){
                                        $leftJoin->on('ns.user_id','=','users.id')
                                                 ->where('ns.meta_key','=','add_territory');
                                    })
                                    ->whereIn('users.id',$target_user_ids)
                                    ->having('meta_value','=',1)
                                    ->get();
        if( count($target_users) )
        {
            //android user
            $android_users = [];
            foreach($target_users as $target_user) {
                if( $target_user->device_type == 'android' ){
                    $android_users[] = $target_user;
                }
            }
            if( count($android_users) ){
                self::sendTerritoryNotification($params['user'],$android_users,$record->id);
            }
            //ios user
            $ios_users = [];
            foreach($target_users as $target_user){
                if( $target_user->device_type == 'ios' ){
                    $ios_users[] = $target_user;
                }
            }
            if( count($ios_users) ){
                self::sendTerritoryNotification($params['user'],$ios_users,$record->id);
            }
            //web users
            $web_users = [];
            foreach($target_users as $target_user){
                if( $target_user->device_type == 'web' ){
                    $web_users[] = $target_user;
                }
            }
            if( count($web_users) ){
                self::sendTerritoryNotification($params['user'],$web_users,$record->id);
            }
        }
    }

    public static function sendTerritoryNotification($actor,$target,$territory_id)
    {
        $notification_data = [
            'actor'            => $actor,
            'target'           => $target,
            'title'            => config('constants.APP_NAME'),
            'message'          => 'Territory has been assigned to you',
            'reference_id'     => $territory_id,
            'reference_module' => 'territory',
            'redirect_link'    => \URL::to('admin/map'),
        ];
        $custom_data = [
            'territory_id' => $territory_id
        ];
        Notification::sendPushNotification('add_territory',$notification_data,$custom_data,true);
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate data input before update data is execute
    | ----------------------------------------------------------------------
    | @request  = http request object
    | @postdata = input post data
    | @id       = current id
    |
    */
    public function hook_before_edit($request, $id, &$postData)
    {
        $postData['slug'] = str_slug($postData['title']);
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @request      = Http request object
    | @$record      = update record
    |
    */
    public function hook_after_edit($request, $record) {
        //Your code here
         $params = $request->all();
         TerritoryCompanyMapping::addRecord($params,$record);
        //territory latlong
        TerritoryLatLong::addTerritoryLatLong($record->id, json_decode($record->geofence_detail));
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command before delete public static function called
    | ----------------------------------------------------------------------
    | @request  = Http request object
    | @id       = current id
    |
    */
    public function hook_before_delete($request, $id) {
        //Your code here

    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after delete public static function called
    | ----------------------------------------------------------------------
    | @$request       = Http request object
    | @record         = Current record
    |
    */
    public function hook_after_delete($id,$record) {
        //Your code here
        TerritoryCompanyMapping::where('territory_id',$id)->forceDelete();
    }

    public static function getTerritories($user_company_id)
    {
        $territories = \DB::table('territory AS t')
                            ->select('t.*')
                            ->join('territory_company_maping AS tcm','tcm.territory_id','=','t.id')
                            ->where('tcm.company_user_id',$user_company_id)
                            ->get();
        return $territories;
    }

    public static function getTerritoryUniverseByUserId($user_id)
    {
        $query = \DB::table('territory AS t')
                    ->selectRaw('SUM(t.`universe`) AS universe')
                    ->join('territory_company_maping AS tcm','tcm.territory_id','=','t.id')
                    ->where('tcm.employee_user_id',$user_id)
                    ->first();
        return $query;
    }

    public static function getTerritoryIdByLatLong($company_user_id,$lat,$long)
    {
        $query = self::selectRaw("tl.territory_id, 
            (ACOS(COS(RADIANS('$lat')) * COS(RADIANS(tl.latitude)) * COS(RADIANS(tl.longitude) - RADIANS('$long')) + SIN(RADIANS($lat)) * SIN(RADIANS(tl.latitude)))) AS distance
        ")
                    ->join('territory_company_maping AS tcm','tcm.territory_id','=','territory.id')
                    ->join('territory_latlong AS tl','tl.territory_id','=','tcm.territory_id')
                    ->where('tcm.company_user_id',$company_user_id)
                    ->orderBy('distance','asc')
                    ->first();
        return isset($query->territory_id) ? $query->territory_id : 0;
    }
}