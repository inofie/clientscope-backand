<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPin extends Model
{
    use SoftDeletes, RestModel;

    protected $table = 'user_pin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'creator_user_id', 'assignee_user_id', 'pin_status_id', 'territory_id', 'updated_by', 'house_number', 'house_address', 'unit', 'country',
        'state', 'city', 'zipcode', 'latitude', 'longitude', 'name', 'phone', 'email', 'first_name', 'last_name', 'insurance_co', 'company_name',
        'notes', 'status_id', 'location_is_verified', 'pin_note', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function creatorUser()
    {
        $default_image_url = \URL::to('images/user-placeholder.png');
        return $this->belongsTo('App\Models\User','creator_user_id','id')
                    ->select('*')
                    ->selectRaw("IFNULL(image_url,'$default_image_url') AS image_url");
    }

    public function assigneeUser()
    {
        $default_image_url = \URL::to('images/user-placeholder.png');
        return $this->belongsTo('App\Models\User','assignee_user_id','id')
                    ->select('*')
                    ->selectRaw("IFNULL(image_url,'$default_image_url') AS image_url");;
    }

    public function pinStatus()
    {
        $image_url = \URL::to('images/ColorPin.png');
        return $this->belongsTo('App\Models\UserPinStatus','pin_status_id','id')
                    ->select('*')
                    ->selectRaw("IF(image_url IS NULL OR image_url = '','$image_url',image_url ) AS image_url");
    }

    public function pinStatusHistory()
    {
        $default_image_url = \URL::to('images/user-placeholder.png');
        return $this->hasMany('App\Models\UserPinUpdateHistory','user_pin_id','id')
                    ->select('user_pin_update_history.*')
                    ->selectRaw("s.title, s.slug, s.image_url AS status_image_url, u.id AS user_id, u.name AS username, IFNULL(u.image_url,'$default_image_url') AS user_image_url")
                    ->join('user_pin_status AS s','s.id','=','user_pin_update_history.user_pin_status_id')
                    ->join('users AS u','u.id','=','user_pin_update_history.user_id');
    }

    public function appointment()
    {
        return $this->hasOne('App\Models\Appointment','user_pin_id','id');
    }

    public function territory()
    {
        return $this->belongsTo('App\Models\Territory','territory_id','id');
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
        $params   = $request->all();
        $userRole = UserRole::getUserRoleByUserId($request['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $request['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($request['user']->id);
            $company_id  = $userCompany->id;
        }
        $query->with(['pinStatus','pinStatusHistory','creatorUser','assigneeUser','appointment.assigneeUser','territory'])
                ->select('user_pin.*')
                ->selectRaw("creator.name AS creator_name, assignee.name AS assignee_name, ups.title AS status_title, 
                updated_user.name AS updated_by_user,t.title AS territory_title, a.title AS appointment_title, a.notes AS appointment_notes, count('upuh.id') AS num_of_status_changes, DATE(upuh.created_at) AS status_modified_date")
                ->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','user_pin.id')
                ->join('users AS creator','creator.id','=','user_pin.creator_user_id')
                ->join('users AS assignee','assignee.id','=','user_pin.assignee_user_id')
                ->join('user_pin_status AS ups','ups.id','=','user_pin.pin_status_id')
                ->leftJoin('territory AS t','t.id','=','user_pin.territory_id')
                ->leftJoin('users AS updated_user','updated_user.id','=','user_pin.updated_by')
                ->leftJoin('appointment AS a','a.user_pin_id','=','user_pin.id')
                ->leftJoin('user_pin_update_history AS upuh','upuh.user_pin_id','=','user_pin.id')
                ->where('user_pin.status_id',get_status_id('active'))
                ->where('ucpm.company_user_id',$company_id)
                ->groupBy('user_pin.id');

//        if( $params['user']->userRole->slug != 'company' && $params['user']->user_meta['is_administrator'] != 1 )
//        {
//            // get own pin
//            if( $params['user']->user_meta['pin_view_permission'] == 'own_subordinate' ){
//                $query->where('user_pin.creator_user_id',$params['user']->id);
//            }
//            // get own and sale reps pin
//            if( $params['user']->user_meta['pin_view_permission'] == 'own_subordinate_peer' ){
//                $query->whereRaw("user_pin.creator_user_id IN (SELECT user_id FROM user_role where role_id = 4) ");
//            }
//        }

        if( !empty($params['assignee_user_id']) ){
            $assignee_user_id = explode(',',$params['assignee_user_id']);
            $query->whereIn('user_pin.assignee_user_id',$assignee_user_id);
        }

        if( !empty($params['pin_status_id']) ){
            $query->whereIn('user_pin.pin_status_id',explode(',',$params['pin_status_id']));
        }

        if(!empty($params['keyword'])){
            $keyword = $params['keyword'];
            $query->where(function($where) use ($keyword){
                $where->orWhere('user_pin.house_number', 'like', "%$keyword%");
                $where->orWhere('user_pin.house_address', 'like', "%$keyword%");
                $where->orWhere('user_pin.unit', 'like', "%$keyword%");
                $where->orWhere('user_pin.country', 'like', "%$keyword%");
                $where->orWhere('user_pin.state', 'like', "%$keyword%");
                $where->orWhere('user_pin.city', 'like', "%$keyword%");
                $where->orWhere('user_pin.zipcode', 'like', "%$keyword%");
                $where->orWhere('user_pin.name', 'like', "%$keyword%");
                $where->orWhere('user_pin.phone', 'like', "%$keyword%");
                $where->orWhere('user_pin.email', 'like', "%$keyword%");
                $where->orWhere('user_pin.created_at', 'like', "%$keyword%");
                $where->orWhere('creator.name','like',"%$keyword%");
                $where->orWhere('assignee.name','like',"%$keyword%");
            });
        }

        if( !empty($params['territory']) ){
            if( is_array($params['territory']) ){
                $query->whereIn('t.id',$params['territory']);
            } else {
                $territory_title = $params['territory'];
                $query->where('t.title','like',"%$territory_title%");
            }
        }
        
        if( !empty($params['territory_id']) ){
            $query->where('user_pin.territory_id',$params['territory_id']);
        } 
        
        if( !empty($params['updated_at']) ){
            $updated_at = date('Y-m-d',strtotime($params['updated_at']));
            $query->whereRaw("DATE(user_pin.updated_at) = '$updated_at'");
        }

        if( !empty($params['search_latitude']) && !empty($params['search_longitude']) )
        {
            $current_latitude  = $params['search_latitude'];
            $current_longitude = $params['search_longitude'];
            $radius            = config('constants.RADIUS');
            $query->whereRaw("IFNULL(3959 * acos(cos(radians('$current_latitude')) * cos(radians(user_pin.latitude)) * cos(radians(user_pin.longitude) - radians('$current_longitude')) + sin(radians('$current_latitude')) * sin(radians(user_pin.latitude))),0) <= {$radius} ");
        }

        if( !empty($params['date_filter']) && $params['date_filter'] != 'custom') {

            if( $params['date_filter'] == 'today' ){
                $current_date = date('Y-m-d');
                $query->whereRaw("DATE(user_pin.created_at) = '$current_date' ");
            }
            if( $params['date_filter'] == 'yesterday' ){
                $yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
                $query->whereRaw("DATE(user_pin.created_at) = '$yesterday' ");
            }
            if( $params['date_filter'] == 'this_week' ){
                $query->whereRaw("YEARWEEK(user_pin.created_at) = YEARWEEK(NOW())");
            }
            if( $params['date_filter'] == 'last_week' ){
                $query->whereRaw("DATE(user_pin.created_at) between DATE(date_sub(now(),INTERVAL 2 WEEK)) and DATE(date_sub(now(),INTERVAL 1 WEEK))");
            }
            if( $params['date_filter'] == 'this_month' ){
                $current_month = date('m');
                $query->whereRaw("MONTH(user_pin.created_at) = '$current_month' ");
            }
            if( $params['date_filter'] == 'last_month' ){
                $last_month = Carbon::now()->subMonth(1)->format('Y-m');
                $query->whereRaw("DATE_FORMAT(user_pin.created_at, '%Y-%m') = '$last_month' ");
            }
            if( $params['date_filter'] == 'this_year' ){
                $current_year = date('Y');
                $query->whereRaw("YEAR(user_pin.created_at) = '$current_year' ");
            }
            if( $params['date_filter'] == 'last_year' ){
                $last_year = Carbon::now()->subYears(1)->format('Y');
                $query->whereRaw("YEAR(user_pin.created_at) = '$last_year' ");
            }
        }
        if( !empty($params['from_date']) && !empty($params['to_date']) )
        {
            $from_date = date('Y-m-d',strtotime($params['from_date']));
            $to_date   = date('Y-m-d',strtotime($params['to_date']));

            $query->whereRaw("DATE(user_pin.created_at) BETWEEN '$from_date' AND '$to_date' ");
        }
        if( !empty($params['status_modified_date']) ){
            $status_modified_date = date('Y-m-d',strtotime($params['status_modified_date']));
            $query->whereRaw("DATE(upuh.created_at) = '$status_modified_date' ");
        }
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
        $user = $postdata['user']->toArray();
        $latitude                         = round($postdata['latitude'],7);
        $longitude                        = round($postdata['longitude'],7);
        $postdata['creator_user_id']      = $postdata['user']->id;
        $postdata['latitude']             = $latitude;
        $postdata['longitude']            = $longitude;
        $postdata['creator_user_id']      = $postdata['user']->id;
        $postdata['status_id']            = get_status_id('active');
        $postdata['location_is_verified'] = 0;
        $postdata['created_at']           = Carbon::now();
        $postdata['territory_id']         = Territory::getTerritoryIdByLatLong($user['user_company']['id'],$latitude,$longitude);

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
        $params                = \Request::all();
        $params['user_pin_id'] = $record->id;
        $params['updated_by']  = $params['user']->id;
        //user pin and company mapping
        $userRole = UserRole::getUserRoleByUserId($record->creator_user_id);
        if( $userRole->slug == 'company' ){
            UserCompanyPinMapping::insert([
                'company_user_id'  => $record->creator_user_id,
                'user_pin_id'      => $record->id,
                'created_at'       => Carbon::now(),
            ]);
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($record->creator_user_id);
            UserCompanyPinMapping::insert([
                'company_user_id'  => $userCompany->id,
                'user_pin_id'      => $record->id,
                'created_at'       => Carbon::now(),
            ]);
        }
        //add custom fields
        if( !empty($params['custom_fields']) ){
            UserPinCustomField::addCustomFieldValues($record->id,$params['custom_fields']);
        }
        //pin status history
        UserPinUpdateHistory::addPinStatusHistory($params);
        //appointment
        if( !empty($params['appointment_title']) ){
            Appointment::createAppointment($params);
        }
        //send push notification
        if( $record->assignee_user_id != $params['user']->id ){
            $target_user = User::where('id',$record->assignee_user_id)->first();
            //get notification setting
            $notificationSetting = NotificationSetting::getNotificationSetting($target_user->id);
            if( !empty($notificationSetting) || $notificationSetting->add_user_pin == 1 )
            {
                if( isset($target_user->id) ){
                    $pin_name =  !empty($record->name) ? $record->name . ' ' : '';
                    $message  = 'The Pin ' .  $pin_name . 'has been created for '. date('F j',strtotime($record->created_at)) .'  '. date('h:i A',strtotime($record->created_at)) .' at '. $record->house_address;
                    $notification_data = [
                        'actor'            => $params['user'],
                        'target'           => $target_user,
                        'title'            => config('constants.APP_NAME'),
                        'message'          => $message,
                        'reference_id'     => $record->id,
                        'reference_module' => 'user_pin',
                        'redirect_link'    => \URL::to('admin/map?user_pin_id=' .$record->id),
                    ];
                    $custom_data = [
                        'user_pin_id' => $record->id
                    ];
                    Notification::sendPushNotification('add_user_pin',$notification_data,$custom_data);
                }
            }
        }
        

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
        $latitude               = round($postData['latitude'],7);
        $longitude              = round($postData['longitude'],7);
        $postData['latitude']   = $latitude;
        $postData['longitude']  = $longitude;
        $postData['updated_at'] = Carbon::now();
        $postData['updated_by'] = $request['user']->id;
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for execute command after edit public static function called
    | ----------------------------------------------------------------------
    | @request      = Http request object
    | @$record      = update record
    |
    */
    public function hook_after_edit($request, $record)
    {
        $params                = \Request::all();
        $params['user_pin_id'] = $record->id;
        $params['updated_at']  = Carbon::now();
        //pin status history
        if( !empty($params['pin_status_id']) ){
            UserPinUpdateHistory::addPinStatusHistory($params);
        }
        //update custom fields
        if( !empty($params['custom_fields']) ){
            //delete old custom field values
            UserPinCustomField::where('user_pin_id',$record->id)->forceDelete();
            //add new custom field values
            UserPinCustomField::addCustomFieldValues($record->id,$params['custom_fields']);
        }
        //appointment
        if( !empty($params['appointment_title']) ){
            Appointment::createAppointment($params);
        }
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
        UserCompanyPinMapping::where('user_pin_id',$id)->delete();
        UserPinUpdateHistory::where('user_pin_id',$id)->delete();
        Appointment::where('user_pin_id',$id)->delete();
    }

    public static function checkUserPinAddress($user_id,$latitude,$longitude)
    {
        $userRole = UserRole::getUserRoleByUserId($user_id);
        if( $userRole->slug == 'company' ){
            $company_id = $user_id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($user_id);
            $company_id  = $userCompany->id;
        }
        $query = self::join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','user_pin.id')
                    ->where('user_pin.latitude',round($latitude,7))
                    ->where('user_pin.longitude',round($longitude,7))
                    ->where('ucpm.company_user_id',$company_id)
                    ->count();
        return $query;
    }
  
    public static function getAllCompanyPins()
    {
        $company_user_id = get_user()->userCompany->id;
        $query = self::join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','user_pin.id')
                      ->where('ucpm.company_user_id',$company_user_id)
                      ->get();
        return $query;
    }

    public static function getUserPinCountByHours($user_id,$company_user_id)
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('DAY(up.created_at) AS day, HOUR(up.created_at) AS hour, COUNT(up.id) AS total, up.`created_at`')
                    ->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','up.id')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id');
        if( $user['user_role']['slug'] == 'sales-representative' ){
            $query->where('upuh.user_id',$user_id);
        }
        $query = $query->where('ucpm.company_user_id',$company_user_id)
                        ->where('upskg.kpi_group_id',4) //contact id
                        ->groupBy(\DB::raw('DAY(up.created_at), HOUR(up.created_at)'))
                        ->orderBy('hour')
                        ->get();
        return $query;
    }

    public static function getUserPinCountByDayName($user_id,$company_user_id)
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('DAYNAME(up.created_at) AS day_name, COUNT(up.id) AS total')
                    ->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','up.id')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id');
        if( $user['user_role']['slug'] == 'sales-representative' ){
            $query->where('upuh.user_id',$user_id);
        }
        $query = $query->where('ucpm.company_user_id',$company_user_id)
                        ->where('upskg.kpi_group_id',4) //contact id
                        ->groupBy(\DB::raw('DAYNAME(up.created_at)'))
                        ->orderBy(\DB::raw('DAYOFWEEK(up.created_at)'))
                        ->get();
        return $query;
    }

    public static function getTerritoryByLatLong($user_company_id,$lat,$long)
    {
        $territory_id = 0;
        $territories  = Territory::getTerritories($user_company_id);
        if( count($territories) )
        {
            foreach( $territories as $territory )
            {
                $geofence_detail = json_decode($territory->geofence_detail);
                foreach( $geofence_detail as $gd ){
                    $latitudes[]  = $gd->latitude;
                    $longitudes[] = $gd->longitude;
                }
                $points_polygon = count($latitudes) - 1;
                $is_in_polygon  = self::is_in_polygon($points_polygon,$latitudes,$longitudes,$lat,$long);
                if( $is_in_polygon ){
                    $territory_id = $territory->id;
                }
            }
        }
        return $territory_id;
    }

    public static function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y)
    {
        $i = $j = $c = 0;
        for ($i = 0, $j = $points_polygon; $i < $points_polygon; $j = $i++) {
            if ( (($vertices_y[$i]  >  $latitude_y != ($vertices_y[$j] > $latitude_y)) &&
                ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]) ) )
                $c = !$c;
        }
        return $c;
    }

    public static function getUserPinByKpiGroup($user_id, $params = [])
    {         
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('COUNT(up.id) AS total_pin, ups.image_url, kg.title')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                    ->join('kpi_groups AS kg','kg.id','=','upskg.kpi_group_id')
                    ->whereRaw("(up.`creator_user_id` = {$user_id} OR up.`assignee_user_id` = {$user_id})");
        if( !empty($params['date_from']) && !empty($params['date_to']) ){
            $from_date = $params['date_from'];
            $to_date   = $params['date_to'];
            $query->whereRaw("DATE(up.created_at) BETWEEN '$from_date' AND '$to_date' ");
        }            
        if( !empty($params['territory']) ){
            $territory = $params['territory'];
            $query->join('territory AS t','t.id','=','up.territory_id');
            $query->whereIn('t.title',$territory);
        }
        $query = $query->groupBy('kg.id')->get();
        return $query;
    }

    public static function userPinTeamPerformance($company_user_id,$params = [])
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('
                        kg.`title` AS kpi_group,
                        ups.`image_url`, 
                        t.`title` AS team_name,
                        COUNT(upuh.`user_pin_id`) AS total,
                        ROUND( ( COUNT(upuh.id) * 100 ) / ckts.target_value ) AS kpi_percent,
                        (
                            SELECT 
                                SUM(tt.universe) 
                            FROM 
                                territory tt
                                    INNER JOIN territory_company_maping tcm
                                        ON tcm.territory_id = tt.id     
                                    WHERE 
                                        tcm.employee_user_id IN (GROUP_CONCAT(DISTINCT u.id))
                                    GROUP BY t.id    
                        ) AS universe  
                    ');
        $query = $query->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('users AS u','u.id','=','upuh.user_id')
                    ->join('user_company_mapping AS ucm','ucm.employee_user_id','=','u.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                    ->join('kpi_groups AS kg','kg.id','=','upskg.kpi_group_id')
                    ->join('user_team AS ut','ut.user_id','=','u.id')
                    ->join('team AS t','t.id','=','ut.team_id')
                    ->join('territory AS te','te.creator_user_id','=','ucm.company_user_id')
                    ->join('company_kpi_target_sale AS ckts','ckts.user_company_id','=','ucm.company_user_id')
                    ->where('ucm.company_user_id',$company_user_id);

        if( !empty($params['date_from']) && !empty($params['date_to']) ){
            $from_date = $params['date_from'];
            $to_date   = $params['date_to'];
            $query->whereRaw("DATE(up.created_at) BETWEEN '$from_date' AND '$to_date' ");
        }                    
        if( !empty($params['territory']) ){
            $territory = $params['territory'];        
            $query->whereIn('te.title',$territory);
        }
        $query = $query->groupBy(\DB::raw('t.id, kg.id'))
                        ->orderBy('total','desc')
                        ->get();
        return $query;
    }
  
    public static function getTeamMetricChart($company_user_id,$params = [])
    {
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('
                        m.`title` AS metric_title,
                        umt.value,
                        ups.`image_url`, 
                        t.`title` AS team_name,
                        COUNT(upuh.`user_pin_id`) AS total,
                        (
                            SELECT 
                                SUM(tt.universe) 
                            FROM 
                                territory tt
                                    INNER JOIN territory_company_maping tcm
                                        ON tcm.territory_id = tt.id     
                                    WHERE 
                                        tcm.employee_user_id IN (GROUP_CONCAT(DISTINCT u.id))
                                    GROUP BY t.id    
                        ) AS universe  
                    ');
        $query = $query->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                        ->join('users AS u','u.id','=','upuh.user_id')
                        ->join('user_company_mapping AS ucm','ucm.employee_user_id','=','u.id')
                        ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                        ->join('territory AS te','te.creator_user_id','=','ucm.company_user_id')
                        ->join('metrices AS m','m.id','=','ups.metric_id')
                        ->join('user_metric_target AS umt',function($join){
                            $join->on('umt.user_id','=','u.id');
                        })
                        ->join('user_team AS ut','ut.user_id','=','u.id')
                        ->join('team AS t','t.id','=','ut.team_id')
                        ->where('ucm.company_user_id',$company_user_id);

        if( !empty($params['date_from']) && !empty($params['date_to']) ){
            $from_date = $params['date_from'];
            $to_date   = $params['date_to'];
            $query->whereRaw("DATE(up.created_at) BETWEEN '$from_date' AND '$to_date' ");
        }                    
        if( !empty($params['territory']) ){
            $territory = $params['territory'];        
            $query->whereIn('te.title',$territory);
        }
        $query = $query->groupBy(\DB::raw('t.id, m.id'))
                        ->orderBy('total','desc')
                        ->get();
        return $query;
    }
  
    public static function getCompanyUsers($company_user_id)
    {
        $user_ids = [];
        $getCompanyUsers = Team::join('user_team','user_team.team_id','=','team.id')
                                ->where('team.user_company_id',$company_user_id)
                                ->get();
        if( count($getCompanyUsers) ) {
            foreach( $getCompanyUsers as $record ){
                $user_ids[] = $record->user_id;
            }
        }                        
        array_push($user_ids,$company_user_id);
        return $user_ids;
    }

    public static function getTotalAttempts($user_id)
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('COUNT(up.id) AS total')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                    ->where('upskg.kpi_group_id',1);
        if( $user['user_role']['slug'] == 'sales-representative' ){
            $query->where('up.assignee_user_id',$user_id);
        } else {
            $query->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','up.id');
            $query->where('ucpm.company_user_id',$user['user_company']['id']);
        }

        $query = $query->first();
        return isset($query->total) ? $query->total : 0;
    }

    public static function getTotalContacts($user_id)
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('COUNT(up.id) AS total')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                    ->where('upskg.kpi_group_id',4);
        if( $user['user_role']['slug'] == 'sales-representative' ){
            $query->where('up.assignee_user_id',$user_id);
        } else {
            $query->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','up.id');
            $query->where('ucpm.company_user_id',$user['user_company']['id']);
        }
        $query = $query->first();
        return isset($query->total) ? $query->total : 0;
    }

    public static function getTotalLeads($user_id)
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('COUNT(up.id) AS total')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                    ->where('upskg.kpi_group_id',7);

        if( $user['user_role']['slug'] == 'sales-representative' ){
            $query->where('up.assignee_user_id',$user_id);
        } else {
            $query->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','up.id');
            $query->where('ucpm.company_user_id',$user['user_company']['id']);
        }
        $query = $query->first();
        return isset($query->total) ? $query->total : 0;
    }

    public static function getTotalSales($user_id)
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('COUNT(up.id) AS total')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                    ->where('upskg.kpi_group_id',6);
        if( $user['user_role']['slug'] == 'sales-representative' ){
            $query->where('up.assignee_user_id',$user_id);
        } else {
            $query->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','up.id');
            $query->where('ucpm.company_user_id',$user['user_company']['id']);
        }
        $query = $query->first();
        return isset($query->total) ? $query->total : 0;
    }

    public static function getReknock($user_id)
    {
        $user = get_user()->toArray();
        $query = \DB::table('user_pin AS up')
                    ->selectRaw('COUNT(up.id) AS total');
        if( $user['user_role']['slug'] == 'sales-representative' ){
            $query->where('up.assignee_user_id',$user_id);
        } else {
            $query->join('user_company_pin_mapping AS ucpm','ucpm.user_pin_id','=','up.id');
            $query->where('ucpm.company_user_id',$user['user_company']['id']);
        }
        $query = $query->first();
        return $query;
    }

    
    public static function userTerritoryPerformance($user_id,$params = [])
    {
        $user = get_user()->toArray();
        $query = \DB::table('territory AS t')
                    ->selectRaw('COUNT(up.id) AS total_pin,
                                  kg.`title` AS kpi_group,
                                  kg.`slug` AS kpi_group_slug,
                                  ups.`image_url`,
                                  t.`universe`,
                                  t.id,
                                  t.`title`')
                    ->join('territory_company_maping AS tcm','tcm.territory_id','=','t.id')
                    ->join('user_pin AS up','up.territory_id','=','t.id')
                    ->join('user_pin_update_history AS upuh','upuh.user_pin_id','=','up.id')
                    ->join('user_pin_status  AS ups','ups.id','=','upuh.user_pin_status_id')
                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                    ->join('kpi_groups  AS kg','kg.id','=','upskg.kpi_group_id');

        if( $user['user_role']['slug'] == 'sales-representative' || $user['user_role']['slug'] == 'team-lead' ){
            $query->where('tcm.employee_user_id',$user_id);
        } else {
            $query->where('tcm.company_user_id',$user['user_company']['id']);
        }
        if( !empty($params['date_from']) && $params['date_to'] ){
            $from_date = $params['date_from'];
            $to_date   = $params['date_to'];
            $query->whereRaw("DATE(up.created_at) BETWEEN '$from_date' AND '$to_date' ");
        }
        if( !empty($params['territory']) ){
            $territory = $params['territory'];
            $query->whereIn('t.title',$territory);
        }
        $query = $query->groupBy(\DB::raw('t.id,kg.id'))
                        ->orderBy('total_pin','desc')
                        ->get();
        return $query;
    }

    public static function exportData($request)
    {
        $request['user'] = get_user();
        $self = new self;
        $query = self::select();
        $self->hook_query_index($query,$request);
        $records = [];
        foreach( $query->orderBy('user_pin.id','desc')->cursor() as $record ){
            $data = $record->toArray();
            $records[] = [
                'address'      => $data['house_address'],
                'created_by'   => $data['creator_name'],
                'assigned_to'  => $data['assignee_name'],
                'status'       => $data['status_title'],
                'territory'    => $data['territory_title'],
                'updated_by'   => $data['updated_by'],
                'house_number' => $data['house_number'],
                'unit'         => $data['unit'],
                'state'        => $data['state'],
                'city'         => $data['city'],
                'zip_code'     => $data['zipcode'],
                'latitude'     => $data['latitude'],
                'longitude'    => $data['longitude'],
                'name'         => $data['name'],
                'phone'        => $data['phone'],
                'email'        => $data['email'],
                'created_date' => $data['created_at'],
                'updated_date' => $data['updated_at'],
                'appointment_title' => $data['appointment_title'],
                'notes' => $data['appointment_notes'],
            ];
        }
        return $records;
    }
}