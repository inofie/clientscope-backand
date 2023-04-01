<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class User extends Authenticatable
{
    use SoftDeletes, RestModel;
    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'parent_id', 'crm_id', 'first_name', 'last_name', 'name', 'username', 'email', 'mobile_no', 'password', 'image_url', 'country_id', 'state_id', 'city_id',
         'address', 'zipcode', 'gender', 'latitude', 'longitude', 'platform_type', 'platform_id', 'device_type', 'device_token', 'is_mobile_verify',
         'is_email_verify', 'status_id', 'is_login', 'is_active', 'online_status', 'token', 'remember_token', 'created_at','show_count','show_territory',
         'updated_at', 'deleted_at', 'num_of_sale_reps', 'description', 'gateway_customer_id', 'gateway_default_card_id', 'gateway_default_card_json'
    ];

    public function userMeta()
    {
        return $this->hasMany('App\Models\UserMeta','user_id','id');
    }

    public function userTeam()
    {
        return $this->hasOne('App\Models\UserTeam','user_id','id')
                    ->select('user_team.*')
                    ->selectRaw('t.title, t.slug')
                    ->join('team AS t','t.id','=','user_team.team_id');
    }

    public function userRole()
    {
        return $this->hasOne('App\Models\UserRole','user_id','id')
                    ->select('user_role.*')
                    ->selectRaw('r.title, r.slug')
                    ->join('roles AS r','r.id','=','user_role.role_id');
    }


    public function parentUser()
    {
        $base_url = URL::to('/');
        $default_image_url = '/images/user-placeholder.png';
        return $this->belongsTo('App\Models\User','parent_id','id')
                    ->select('id','parent_id','name','username','email','mobile_no','created_at')
                    ->selectRaw("CONCAT('$base_url',IFNULL(image_url,'$default_image_url')) AS image_url");
    }

    public function userCompany()
    {
        return $this->hasOne('App\Models\UserCompanyMapping', 'employee_user_id', 'id')
            ->select('user_company_mapping.employee_user_id', 'user_company_mapping.company_user_id')
            ->selectRaw('u.id, u.name, u.email, u.mobile_no, u.image_url, u.created_at')
            ->join('users AS u', 'u.id', 'user_company_mapping.company_user_id');
    }

    public function reportToUser()
    {
        $default_image_url = URL::to('images/user-placeholder.png');
        return $this->hasOne('App\Models\UserReporting','user_id','id')
                    ->select('user_reporting.user_id')
                    ->selectRaw("u.id, name, username, email, mobile_no, status_id, s.title AS status, is_login, is_active, 
                    IFNULL(u.image_url,'$default_image_url') AS image_url, u.created_at")
                    ->join('users AS u','u.id','=','user_reporting.reporting_user_id')
                    ->join('status AS s','s.id','=','u.status_id');
    }

    public function child()
    {
        $default_image_url = URL::to('images/user-placeholder.png');
        return $this->hasMany('App\Models\UserReporting','reporting_user_id','id')
                    ->select('user_reporting.user_id','user_reporting.reporting_user_id')
                    ->selectRaw("u.id, parent_id, name, username, email, mobile_no, platform_type, 
                    IFNULL(u.image_url,'$default_image_url') AS image_url, platform_id, device_type, device_token, 
                    is_login, is_active, u.status_id, s.title AS status, u.created_at")
                    ->join('users AS u','u.id','=','user_reporting.user_id')
                    ->join('status AS s','s.id','=','u.status_id');
    }

    public function userSalesPlan()
    {
        return $this->hasOne('App\Models\UserSalesPlan','user_id','id');
    }

    public function userMetric()
    {
        return $this->hasMany('App\Models\UserMetricTarget','user_id','id')
                    ->select('user_metric_target.*')
                    ->selectRaw('m.slug AS metric_slug')
                    ->join('metrices AS m','m.id','=','user_metric_target.metric_id');
    }

    /*
   | ----------------------------------------------------------------------
   | Hook for manipulate query of index result
   | ----------------------------------------------------------------------
   | @query   = current sql query
   | @request = laravel http request class
   |
   */
    public function hook_query_index(&$query,$request,$id = '') {
        //Your code here
        $params = $request->all();
        $default_image_url = URL::to('images/user-placeholder.png');
        $query->with(['userMeta','parentUser','userTeam','UserRole','userCompany','reportToUser'])
              //->with(['userTeam','userRole','userCompany','reportToUser','userSalesPlan','userMetric'])
              ->select('users.*')
              ->selectRaw("IFNULL(users.image_url,'$default_image_url') AS image_url, s.title AS status")
              ->join('status AS s','s.id','=','users.status_id')
              ->join('user_role AS ur','ur.user_id','=','users.id')
              ->join('roles AS r','r.id','=','ur.role_id');

        if( !empty($params['user_type']) ){
            $query->join('user_meta AS um',function($join){
                $join->on('um.user_id','=','users.id')
                     ->where('um.meta_key','=','is_administrator');
            })
            ->where('um.meta_value','1');
        }
        if( $id == '' ){
            $query->join('user_company_mapping AS ucm','ucm.employee_user_id','=','users.id');
            $query->where('ucm.company_user_id',$request['company_user_id']);
//            $query->where('users.id','!=',$request['user']->id);
        }
        if( !empty($params['user-role']) )
        {
            $query->whereIn('r.slug',explode(',',$params['user-role']));
        }
        if( !empty($params['except_user_id']) ){
            $query->whereNotIn('users.id',explode(',',$params['except_user_id']));
        }
        $query->groupBy('users.id');
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
        if( empty( $postdata['password'] ) ){
            $password = str_random(12);
            \Request::merge(['password' => $password]);
        }
        $created_at                 = Carbon::now();
        $postdata['password']       = !empty($postdata['password']) ? $postdata['password'] : $password;
        $postdata['parent_id']      = $postdata['user']->id;
        $postdata['username']       = self::generateUserName($postdata['name']);
        $postdata['password']       = Hash::make($postdata['password']);
        $device_type                = !empty($postdata['device_type']) ? $postdata['device_type'] : 'web';
        $device_token               = !empty($postdata['device_token']) ? $postdata['device_token'] : str_random(20);
        $postdata['token']          = self::generateApiToken($postdata['email'],\Request::ip(),$device_type,$device_token,$created_at);
        $postdata['status_id']      = get_status_id('active');
        $postdata['created_at']     = $created_at;
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
        $params = \Request::all();
        //insert user role data
        $role = Role::getRoleBySlug(\Request::input('user_role'));
        UserRole::insert([
            'user_id'    => $record->id,
            'role_id'    => $role->id,
            'created_at' => Carbon::now(),
        ]);
        //insert user team data
        if( !empty($params['team_id']) ){
            UserTeam::insert([
                'team_id' => $params['team_id'],
                'user_id' => $record->id,
            ]);
        }
        //user reporting
        if( !empty($params['user_report']) )
        {
            UserReporting::insert([
                'user_id'           => $record->id,
                'reporting_user_id' => $params['user_report'],
                'created_at'        => Carbon::now(),
            ]);
        }
        //user id & company user id mapping
        if( $role->slug != 'company') {
            $userRole = UserRole::getUserRoleByUserId($record->parent_id);
            if( $userRole->slug == 'company' ){
                UserCompanyMapping::insert([
                    'company_user_id'  => $record->parent_id,
                    'employee_user_id' => $record->id,
                    'created_at'       => Carbon::now(),
                ]);
            }else{
                $userCompany = UserCompanyMapping::getCompanyByEmployeeID($record->parent_id);
                UserCompanyMapping::insert([
                    'company_user_id'  => $userCompany->id,
                    'employee_user_id' => $record->id,
                    'created_at'       => Carbon::now(),
                ]);
            }
        } else {
            UserCompanyMapping::insert([
                'company_user_id'  => $record->id,
                'employee_user_id' => $record->id,
                'created_at'       => Carbon::now(),
            ]);
        }

        //add user meta
        if( $role->slug != 'company' ){
            if( !empty($params['user_meta']) ){
                foreach($params['user_meta'] as $meta_key => $meta_value){
                    $user_meta[] = [
                        'user_id'    => $record->id,
                        'meta_key'   => $meta_key,
                        'meta_value' => $meta_value
                    ];
                }
                UserMeta::insert($user_meta);
            }
        } else {
            $meta_keys = ['is_administrator','manage_user','can_import_pin','share_report'];
            foreach($meta_keys as $meta_key){
                $meta_data[] = [
                    'user_id'    => $record->id,
                    'meta_key'   => $meta_key,
                    'meta_value' => 1
                ];
            }
            UserMeta::insert($meta_data);
        }
        //company subscription data
        if( !empty($params['subscription_packages_id']) ){
            UserSubscription::insert([
                'user_id'    => $record->id,
                'subscription_package_id'    => $params['subscription_packages_id'],
                'expire_date'    => $params['expire_date'],
                'status'         => $params['subscription_status'],
                'created_at'     => Carbon::now(),
            ]);
        }

        //save user sales plan
        if( !empty($params['revenue_per_sale_amount']) && $params['user_annual_income_target'] )
        {
            UserSalesPlan::addUserSalesPlan($record->id,$params);
        }

        //send welcome email
        $mail_params['NAME']       = $record->name;
        $mail_params['APP_NAME']   = config('constants.APP_NAME');
        $mail_params['EMAIL']      = $record->email;
        $mail_params['PASSWORD']   = \Request::input('password');
        $mail_params['LINK']       = base_url(route('verify-email', [ 'tablename' => encrypt('users'), 'email' => encrypt($record->email) ],false ));
        $mail_params['ADMIN_LINK'] = base_url() . '/admin/login';
        sendMail($record->email,'registration',$mail_params);

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
    public function hook_before_edit($request, $id, &$postData) {
        //Your code here
        unset($postData['email']);
        unset($postData['parent_id'],$postData['email'],$postData['password'],$postData['token']);
        if( !empty($postData['image_url']) ){
            $postData['image_url'] =  '/storage/' . uploadMedia('team',$postData['image_url']);
        }
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
        $params = \Request::all();
        //insert user team data
        if( !empty($params['team_id']) ){
            UserTeam::where('user_id',$record->id)
                ->update([
                    'team_id'    => $params['team_id'],
                    'updated_at' => Carbon::now()
                ]);
        }
        //user reporting
        if( !empty($params['user_report']) )
        {
            UserReporting::where('user_id',$record->id)
                        ->update([
                            'reporting_user_id' => $params['user_report'],
                            'updated_at'        => Carbon::now(),
                        ]);
        }
        //add user meta
        if( !empty($params['user_meta']) ){
            //delete old meta
            UserMeta::where('user_id',$record->id)->forceDelete();
            foreach($params['user_meta'] as $meta_key => $meta_value){
                $user_meta[] = [
                    'user_id'    => $record->id,
                    'meta_key'   => $meta_key,
                    'meta_value' => $meta_value
                ];
            }
            UserMeta::insert($user_meta);
        }
        if( !empty($params['revenue_per_sale_amount']) && $params['user_annual_income_target'] )
        {
            //remove old user sales plan
            UserSalesPlan::removeUserSalePlan($record->id);
            //save user sales plan
            UserSalesPlan::addUserSalesPlan($record->id,$params);
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

    }

    /**
     * This function is used for generate username by name
     * @param {string} $name
     * @return {string} $username
     */
    public static  function generateUserName($name)
    {
        $record = self::where('username',str_slug($name))->count();
        if( $record ){
            $username = str_slug($name) . $record . rand(1,99);
        }else{
            $username = str_slug($name);
        }
        return $username;
    }

    /**
     * This function is used for get user by email
     * @param {string} email
     * @return {object} $user
     */
    public static function getUserByEmail($email)
    {
        $query = self::where('email',$email)->first();
        return $query;
    }

    /**
     * This function is used for get user by token
     * @param {string} $token
     * @return {object} $user
     */
    public static  function getUserByToken($token)
    {
        $query = self::where('token',$token)->first();
        return $query;
    }

    /**
     * This function is used generate reset password link
     * @param {object} Illuminate\Http\Request $request
     * @return boolean
     */
    public static function forgotPassword($request)
    {
        $record = self::where('email',$request['email'])->first();
        $mail_params['USERNAME']  = $record->first_name . ' ' .$record->last_name;
        $mail_params['LINK']      = route('user-password-reset', [ 'tablename' => encrypt('User'), 'email' => encrypt($record->email) ] );
        $mail_params['APP_URL']   = URL::to('/');
        $mail_params['APP_NAME']  = env('APP_NAME');
        sendMail($record->email,'forgot-password',$mail_params);

        UserPasswordReset::create([
            'email'      => $record->email,
            'token'      => md5(rand()),
            'created_at' => Carbon::now(),
        ]);
        return true;
    }

    /**
     * This function is used for get user by ID
     * @param {int} $user_id
     * @return {object} $user
     */
    public static function getUserByID($user_id)
    {
        $default_image_url = URL::to('images/user-placeholder.png');
        $query = self::with(['userMeta','parentUser','userTeam','UserRole','userCompany','reportToUser'])
                    ->select('users.*')
                    ->selectRaw("IFNULL(image_url,'$default_image_url') AS image_url")
                    ->where('id',$user_id)
                    ->first();
        if( isset($query->id) ){
            $userMeta = self::userMetaKeyMapping($query->userMeta);
            unset($query->userMeta);
            $query->user_meta = $userMeta;
        }
        return $query;
    }

    public static function userMetaKeyMapping($userMeta)
    {
        $data = [
            'pin_view_permission'         => 'own_subordinate',
            'pin_edit_permission'         => 'own_subordinate',
            'manager_pin_view_permission' => '',
            'manager_edit_permission'     => '',
            'is_administrator'            => '0',
            'manage_user'                 => '0',
            'can_import_pin'              => '0',
            'share_report'                => '0',
            'title'                       => '',
        ];
        if( count($userMeta) )
        {
            foreach ( $userMeta as $meta ){
                $data[$meta->meta_key] = $meta->meta_value;
            }
        }
        return $data;
    }

    /**
     * This function is used for get user by roles
     * @param {Array} $roles
     * @return {object} $users
     */
    public static function getUserByRoles($roles)
    {
        $users = self::select('users.*')
                    ->join('user_role AS ur','ur.user_id','=','users.id')
                    ->join('roles AS r','r.id','=','ur.role_id')
                    //->where('users.status_id',get_status_id('active'))
                    ->whereIn('r.slug',$roles)
                    ->orderBy('users.id','desc')
                    ->paginate(config('constants.DATATABLE_RECORD_LIMIT'));
        return $users;
    }

    public static function getCompanyUsers($user_id)
    {
        $userRole = UserRole::getUserRoleByUserId($user_id);
        if( $userRole->slug == 'company' ){
            $company_id = $user_id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($user_id);
            $company_id  = $userCompany->id;
        }
        $default_image_url = URL::to('images/user-placeholder.png');
        $query = self::select('users.*')
                      ->selectRaw("IFNULL(image_url,'$default_image_url') AS image_url")
                      ->join('user_company_mapping AS ucm','ucm.employee_user_id','=','users.id')
                      ->where('ucm.company_user_id',$company_id)
                      ->get();
        return $query;
    }

    public static function userSuggestion($string)
    {
        $user = get_user();
        $query = self::where('name','like',"$string%")
                        ->where('id','!=',$user->id)
                        ->limit(20)
                        ->get();
        return $query;
    }

    public static function getLeaderBoard($user_id,$limit = '',$params = [])
    {
        if( empty($params['user']) )
            $user = get_user()->toArray();
        else
            $user = $params['user']->toArray();

        $company_id = $user['user_company']['id'];
        $query = UserCompanyMapping::join('users AS u','u.id','=','user_company_mapping.employee_user_id')
                                    ->selectRaw("u.id, u.name, u.email, u.mobile_no, u.image_url, COUNT(ups.id) as total_sale")
                                    ->join('user_pin_update_history AS updu','updu.user_id','=','u.id')
                                    ->join('user_pin_status AS ups','ups.id','=','updu.user_pin_status_id')
                                    ->join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','ups.id')
                                    ->where('user_company_mapping.company_user_id',$company_id);
        if( !empty($params['time_frame']) )
        {
            if( $params['time_frame'] == 'today' ){
                $current_date = date('Y-m-d');
                $query->whereRaw("DATE(updu.created_at) = '$current_date' ");
            }
            if( $params['time_frame'] == 'yesterday' ){
                $yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
                $query->whereRaw("DATE(updu.created_at) = '$yesterday' ");
            }
            if( $params['time_frame'] == 'this_week' ){
                $query->whereRaw("YEARWEEK(updu.created_at) = YEARWEEK(NOW())");
            }
            if( $params['time_frame'] == 'last_week' ){
                $query->whereRaw("DATE(updu.created_at) between DATE(date_sub(now(),INTERVAL 2 WEEK)) and DATE(date_sub(now(),INTERVAL 1 WEEK))");
            }
            if( $params['time_frame'] == 'this_month' ){
                $current_month = date('m');
                $query->whereRaw("MONTH(updu.created_at) = '$current_month' ");
            }
            if( $params['time_frame'] == 'last_month' ){
                $last_month = Carbon::now()->subMonth(1)->format('Y-m');
                $query->whereRaw("DATE_FORMAT(updu.created_at, '%Y-%m') = '$last_month' ");
            }
            if( $params['time_frame'] == 'this_year' ){
                $current_year = date('Y');
                $query->whereRaw("YEAR(updu.created_at) = '$current_year' ");
            }
            if( $params['time_frame'] == 'last_year' ){
                $last_year = Carbon::now()->subYears(1)->format('Y');
                $query->whereRaw("YEAR(updu.created_at) = '$last_year' ");
            }
        }
        if( !empty( $params['kpi_group_id'] ) ){
            $kpi_group_id = $params['kpi_group_id'];
        } else {
            $kpi_group_id = 6; //kpi group sale id
        }
        $query = $query->where('upskg.kpi_group_id',$kpi_group_id) //kpi sales id
                        ->orderBy('total_sale','desc')
                        ->groupBy('u.id');
        if( !empty($limit) ){
            $query = $query->take($limit)->get();
        } else {
            $query = $query->paginate(config('constants.PAGINATION_LIMIT'));
        }
        return $query;
    }

    public static function getReportingUsers($user_id)
    {
        $base_url = URL::to('/'); 
        $default_image_url = '/images/user-placeholder.png';
        $user_company = UserCompanyMapping::where('employee_user_id',$user_id)->first();
        $users        = self::select('users.id','users.name','users.email','users.created_at')
                            ->selectRaw("CONCAT('$base_url',IFNULL(users.image_url,'$default_image_url')) AS image_url, 
                             s.title AS status, users.status_id, IFNULL(ur.reporting_user_id,0) AS reporting_user_id")
                            ->join('user_company_mapping AS ucm','ucm.employee_user_id','=','users.id')
                            ->join('status AS s','s.id','=','users.status_id')
                            ->leftJoin('user_reporting AS ur','ur.user_id','=','users.id')
                            ->where('ucm.company_user_id',$user_company->company_user_id)
                            ->groupBy('users.id')
                            ->orderBy('users.id','asc')
                            ->get();
        return $users;
    }

    /**
     * @param $device_type
     */
    public static function getAllRoomUsers($actor_id,$chat_room_id,$device_type)
    {
        $query = \DB::table('chat_room_users AS cru')
                    ->select('u.*')
                    ->selectRaw('cr.title AS chat_room_title, cr.type AS chat_room_type')
                    ->join('chat_rooms AS cr','cr.id','=','cru.chat_room_id')
                    ->join('users AS u','u.id','=','cru.user_id')
                    ->where('cru.user_id','!=',$actor_id)
                    ->where('cru.chat_room_id',$chat_room_id)
                    ->where('u.status_id',1)
                    ->where('u.device_type',$device_type)
                    ->whereNotNull('u.device_token')
                    ->get();
        return $query;
    }

    public static function getUserMetricByUserPin($user_id)
    {
        $user = get_user()->toArray();
        $company_id = $user['user_company']['id'];
        if( $user['user_role']['slug'] == 'sales-representative' || $user['user_role']['slug'] == 'team-lead' ){
            // $query = \DB::table('user_metric_target AS umt')
            //             ->select('umt.value','m.title','ups.custom_metric_title AS custom_metric_title')
            //             ->selectRaw('count(upuh.id) AS total_pin')
            //             ->join('metrices AS m','m.id','=','umt.metric_id')
            //             ->leftJoin('user_pin_status AS ups', function($leftJoin) use ($company_id){
            //                 $leftJoin->on('ups.metric_id','=','m.id')
            //                          ->where('ups.company_user_id','=',$company_id);    
            //             })
            //             ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) {
            //                 $leftJoin->on('upuh.user_pin_status_id','=','ups.id');        
            //             })
            //             ->where('umt.user_id',$user_id)
            //             ->groupBy('m.id')    
            //             ->get();

            $query = \DB::table('kpi_groups AS kg')
                        ->select('kg.slug')
                        ->selectRaw('IFNULL(count(ups.id),0) AS total_pin')
                        ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                        ->leftJoin('user_pin_status AS ups','ups.id','=','upskg.user_pin_status_id')
                        ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($user_id) {
                            $leftJoin->on('upuh.user_pin_status_id','=','ups.id')
                                     ->where('upuh.user_id','=',$user_id);
                        }) 
                        ->groupBy('kg.id')
                        ->get();

        } else {
            // $query = \DB::table('company_metric_target AS cmt')
            //             ->select('cmt.value','m.title')
            //             ->selectRaw('count(upuh.id) AS total_pin')
            //             ->join('metrices AS m','m.id','=','cmt.metric_id')
            //             ->leftJoin('user_pin_status AS ups', function($leftJoin) use ($company_id){
            //                 $leftJoin->on('ups.metric_id','=','m.id')
            //                         ->where('ups.company_user_id','=',$company_id);    
            //             })
            //             ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) {
            //                 $leftJoin->on('upuh.user_pin_status_id','=','ups.id');        
            //             })
            //             ->where('cmt.user_company_id',$user['user_company']['id'])
            //             ->groupBy('m.id')
            //             ->get();

            $query = \DB::table('kpi_groups AS kg')
                            ->select('kg.slug')
                            ->selectRaw('IFNULL(count(ups.id),0) AS total_pin')
                            ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                            ->leftJoin('user_pin_status AS ups',function($leftJoin) use ($company_id) {
                                $leftJoin->on('ups.id','=','upskg.user_pin_status_id')
                                         ->where('ups.company_user_id','=',$company_id);
                            })    
                            ->groupBy('kg.id')
                            ->get();

        }
        foreach( $query as $results )
        {
            $data[$results->slug] =  $results->total_pin;  
        } 
        return $data;
    }

    public static function getUserMetric($user_id, $territory_id = 0)
    {
        $user = get_user()->toArray();
        $company_id = $user['user_company']['id'];
        if( $user['user_role']['slug'] == 'sales-representative' || $user['user_role']['slug'] == 'team-lead' ){
            $query = \DB::table('user_metric_target AS umt')
                        ->select('umt.value','m.title','ups.custom_metric_title AS custom_metric_title')
                        ->join('metrices AS m','m.id','=','umt.metric_id')
                        ->leftJoin('user_pin_status AS ups', function($leftJoin) use ($company_id){
                            $leftJoin->on('ups.metric_id','=','m.id')
                                     ->where('ups.company_user_id','=',$company_id);    
                        })
                        // ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($company_id){
                        //     $leftJoin->on('upuh.user_pin_status_id','=','ups.id');        
                        // })
                        // ->leftJoin('user_pin AS up', function($leftJoin) use ($territory_id){
                        //     $leftJoin->on('up.id','=','upuh.user_pin_id')
                        //              ->where('up.territory_id','=',$territory_id);        
                        // })
                        ->where('umt.user_id',$user_id)
                        ->groupBy('m.id')    
                        ->get();
        } else {
            $query = \DB::table('company_metric_target AS cmt')
                        ->select('cmt.value','m.title')
                        ->join('metrices AS m','m.id','=','cmt.metric_id')
                        ->leftJoin('user_pin_status AS ups', function($leftJoin) use ($company_id){
                            $leftJoin->on('ups.metric_id','=','m.id')
                                     ->where('ups.company_user_id','=',$company_id);    
                        })
                        ->where('cmt.user_company_id',$user['user_company']['id'])
                        ->get();
        }
        return $query;
    }

    public static function generateApiToken($email,$ip_address,$device_type,$device_token,$datetime)
    {
        $secret_key = config('constants.SECRET_KEY');
        $token = "$email|$ip_address|$device_type|$device_token|$datetime";
        $token = hash_hmac('sha256', $token, $secret_key);
        return $token;
    }

    public static function getAllCompany($params)
    {
        $query = \DB::table('users AS u')
                    ->select('u.*','s.title AS status')
                    ->leftJoin('user_role AS ur','ur.user_id','=','u.id')
                    ->leftJoin('roles AS r','r.id','=','ur.role_id')
                    ->leftJoin('status AS s','s.id','=','u.status_id')
                    ->where('r.slug','company')
                    ->whereNull('u.deleted_at');
        if( !empty($params['keyword']) ){
            $keyword = $params['keyword'];
            $query->where( function($where) use ($keyword){
                $where->orWhere('u.name','like',"%$keyword%");
                $where->orWhere('u.email','like',"%$keyword%");
                $where->orWhere('u.mobile_no','like',"%$keyword%");
                $where->orWhere('s.title','like',"%$keyword%");
                $where->orWhere('u.created_at','like',"%$keyword%");
            });
        }
        $query = $query->orderBy('u.id','desc')
                       ->paginate(config('constants.DATATABLE_RECORD_LIMIT'));   
        return $query;                
    }

    public static function getAllTeamLeads($params)
    {
        $query = \DB::table('users AS u')
                    ->select('u.*','s.title AS status','c.name AS company')
                    ->leftJoin('user_role AS ur','ur.user_id','=','u.id')
                    ->leftJoin('roles AS r','r.id','=','ur.role_id')
                    ->leftJoin('status AS s','s.id','=','u.status_id')
                    ->leftJoin('user_company_mapping AS ucm','ucm.employee_user_id','=','u.id')
                    ->leftJoin('users AS c','c.id','=','ucm.company_user_id')
                    ->where('r.slug','team-lead')
                    ->whereNull('u.deleted_at');
        if( !empty($params['keyword']) ){
            $keyword = $params['keyword'];
            $query->where( function($where) use ($keyword){
                $where->orWhere('u.name','like',"%$keyword%");
                $where->orWhere('u.email','like',"%$keyword%");
                $where->orWhere('u.mobile_no','like',"%$keyword%");
                $where->orWhere('s.title','like',"%$keyword%");
                $where->orWhere('u.created_at','like',"%$keyword%");
                $where->orWhere('c.name','like',"%$keyword%");
            });
        }
        $query = $query->orderBy('u.id','desc')
                       ->paginate(config('constants.DATATABLE_RECORD_LIMIT'));   
        return $query; 
    }

    public static function getAllSalesReps($params)
    {
        $query = \DB::table('users AS u')
                    ->select('u.*','s.title AS status','c.name AS company')
                    ->leftJoin('user_role AS ur','ur.user_id','=','u.id')
                    ->leftJoin('roles AS r','r.id','=','ur.role_id')
                    ->leftJoin('status AS s','s.id','=','u.status_id')
                    ->leftJoin('user_company_mapping AS ucm','ucm.employee_user_id','=','u.id')
                    ->leftJoin('users AS c','c.id','=','ucm.company_user_id')
                    ->where('r.slug','sales-representative')
                    ->whereNull('u.deleted_at');
        if( !empty($params['keyword']) ){
            $keyword = $params['keyword'];
            $query->where( function($where) use ($keyword){
                $where->orWhere('u.name','like',"%$keyword%");
                $where->orWhere('u.email','like',"%$keyword%");
                $where->orWhere('u.mobile_no','like',"%$keyword%");
                $where->orWhere('s.title','like',"%$keyword%");
                $where->orWhere('u.created_at','like',"%$keyword%");
                $where->orWhere('c.name','like',"%$keyword%");
            });
        }
        $query = $query->orderBy('u.id','desc')
                       ->paginate(config('constants.DATATABLE_RECORD_LIMIT'));   
        return $query;
    }

    public static function createCompany($params)
    {
        $password   = str_random(12);
        $created_at = Carbon::now();
        $data = [
            'first_name' => $params['first_name'],
            'last_name'  => $params['last_name'],
            'name'       => $params['company_name'],
            'mobile_no'  => $params['mobile_no'],
            'email'      => $params['email'],
            'num_of_sale_reps'          => $params['num_of_sale_reps'],
            'description'               => $params['description'],
            'gateway_customer_id'       => $params['gateway_customer_id'],
            'gateway_default_card_id'   => $params['gateway_default_card_id'],
            'gateway_default_card_json' => $params['gateway_default_card_json'],
            'password' => Hash::make($password),
            'username' => self::generateUserName($params['company_name']),
            'device_type' => 'web',
            'device_type' => '1234567890',
            'token' => self::generateApiToken($params['email'],\Request::ip(),'web','1234567890',$created_at),
            'status_id' => get_status_id('active'),
            'created_at' => $created_at,
        ];
        $record = self::create($data);
        
        //insert user role data
        $role = Role::getRoleBySlug('company ');
        UserRole::insert([
            'user_id'    => $record->id,
            'role_id'    => $role->id,
            'created_at' => Carbon::now(),
        ]);

        //user id & company user id mapping
        UserCompanyMapping::insert([
            'company_user_id'  => $record->id,
            'employee_user_id' => $record->id,
            'created_at'       => Carbon::now(),
        ]);
        //add user meta
        $meta_keys = ['is_administrator','manage_user','can_import_pin','share_report'];
        foreach($meta_keys as $meta_key){
            $meta_data[] = [
                'user_id'    => $record->id,
                'meta_key'   => $meta_key,
                'meta_value' => 1
            ];
        }
        UserMeta::insert($meta_data);
        //company subscription data
        $package = \DB::table('subscription_packages')->where('slug',$params['package_slug'])->first();
        UserSubscription::insert([
            'company_user_id' => $record->id,
            'user_id'    => 0,
            'subscription_package_id'    => $package->id,
            'expire_date'    =>  Carbon::now()->addDays($package->trial_period),
            'status'         => 'active',
            'created_at'     => Carbon::now(),
        ]);
        
        //send welcome email
        $mail_params['NAME']       = $record->name;
        $mail_params['APP_NAME']   = config('constants.APP_NAME');
        $mail_params['EMAIL']      = $record->email;
        $mail_params['PASSWORD']   = $password;
        $mail_params['LINK']       = base_url(route('verify-email', [ 'tablename' => encrypt('users'), 'email' => encrypt($record->email) ],false ));
        $mail_params['ADMIN_LINK'] = base_url() . '/admin/login';
        sendMail($record->email,'registration',$mail_params);
        
        return $record;
    }
}
