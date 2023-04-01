<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPinStatus extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'user_pin_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_user_id', 'creator_user_id', 'metric_id', 'custom_metric_title', 'title', 'slug', 'image_url', 'description',
        'color', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function kpiGroup()
    {
        return $this->hasMany('App\Models\UserPinStatusKpiGroup','user_pin_status_id','id')
                    ->select('user_pin_status_kpi_group.*','kg.title','kg.slug')
                    ->join('kpi_groups AS kg','kg.id','=','user_pin_status_kpi_group.kpi_group_id');
    }

    public function metric()
    {
        return $this->belongsTo('App\Models\Metric','metric_id','id');
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
        $userRole = UserRole::getUserRoleByUserId($request['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $request['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($request['user']->id);
            $company_id  = $userCompany->id;
        }
        $query->select('user_pin_status.*')
              ->with(['kpiGroup','metric'])
              ->selectRaw("count(up.id) AS status_count")
              ->leftJoin('user_company_pin_mapping AS ucpm','ucpm.company_user_id','=','user_pin_status.company_user_id')
              ->leftJoin('user_pin AS up',function($leftJoin){
                $leftJoin->on('up.id','=','ucpm.user_pin_id');
                $leftJoin->on('user_pin_status.id','=','up.pin_status_id')
                         ->whereNull('up.deleted_at');
              })
              ->where('user_pin_status.company_user_id',$company_id)
              ->groupby('user_pin_status.id');
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
        $userRole = UserRole::getUserRoleByUserId($postdata['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $postdata['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($postdata['user']->id);
            $company_id  = $userCompany->id;
        }
        $postdata['company_user_id'] = $company_id;
        $postdata['creator_user_id'] = $postdata['user']->id;
        $postdata['slug']            = str_slug($postdata['title']);
        $postdata['created_at']      = Carbon::now();
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
        //kpi group
        $params = \Request::all();
        if( !empty($params['kpi_group_id']) ){
            foreach( $params['kpi_group_id'] as $kpi_group ){
                $kpi_group_data[] = [
                    'user_pin_status_id' => $record->id,
                    'kpi_group_id' => $kpi_group,
                    'created_at' => $record->created_at
                ];
            }        
            \DB::table('user_pin_status_kpi_group')->insert($kpi_group_data);
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
        $postData['slug']            = str_slug($postData['title']);
        $postData['updated_at']      = Carbon::now();
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
        
        //delete old kpi group
        \DB::table('user_pin_status_kpi_group')
            ->where('user_pin_status_id',$record->id)
            ->delete();
        //insert new kpi group
        $params = \Request::all();
        if( !empty($params['kpi_group_id']) ){
            foreach( $params['kpi_group_id'] as $kpi_group ){
                $kpi_group_data[] = [
                    'user_pin_status_id' => $record->id,
                    'kpi_group_id' => $kpi_group,
                    'created_at' => $record->created_at
                ];
            }        
            \DB::table('user_pin_status_kpi_group')->insert($kpi_group_data);
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

    public static function checkMetricKpiGroup($company_id,$user_id,$params)
    {
        $query = self::join('user_pin_status_kpi_group AS upskg','upskg.user_pin_status_id','=','user_pin_status.id')
                        ->whereIn('upskg.kpi_group_id',$params['kpi_group_id'])
                        ->where('user_pin_status.metric_id',$params['metric_id'])    
                        ->where('user_pin_status.company_user_id',$company_id)
                        ->count();
        return $query;
    }

    public static function CheckCustomMetricTitle($company_id,$params)
    {
        $query = self::where('custom_metric_title',$params['custom_metric_title'])
                        ->where('company_user_id',$company_id)
                        ->count();
        return $query;
    }

    public static function getCompanyStatuses($user_id)
    {
        $userRole = UserRole::getUserRoleByUserId($user_id);
        if( $userRole->slug == 'company' ){
            $company_id = $user_id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($user_id);
            $company_id  = $userCompany->id;
        }
        $query = self::where('company_user_id',$company_id)->orderBy('title','asc')->get();
        return $query;
    }

    public static function getCompanyMatrics()
    {
        $user = get_user()->toArray();
        $company_id = $user['user_company']['id'];
        $query = \DB::table('metrices AS m')
                    ->select('m.*','ups.custom_metric_title')
                    ->leftJoin('user_pin_status AS ups', function($leftJoin) use ($company_id){
                        $leftJoin->on('ups.metric_id','=','m.id')
                                 ->where('ups.company_user_id',$company_id);
                    })
                    ->groupBy('m.id')    
                    ->get();
        return $query;                
    }
}