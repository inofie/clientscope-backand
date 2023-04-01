<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSalesPlan extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'user_sales_plan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'revenue_per_sale_amount', 'user_annual_income_target', 'total_annual_sales_needed', 'total_work_week_left_to_sell',
        'average_commission_per_sale', 'total_contracts_needed', 'total_work_month_left_to_sell',
        'created_at', 'updated_at', 'deleted_at'
    ];

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
        //Your code here
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
        //Your code here
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

    public static function addUserSalesPlan($user_id,$params)
    {
        if( !empty($params['revenue_per_sale_amount']) && $params['user_annual_income_target'] )
        {
            $record = self::create([
                'user_id'                      => $user_id,
                'revenue_per_sale_amount'      => $params['revenue_per_sale_amount'],
                'user_annual_income_target'    => $params['user_annual_income_target'],
                'total_annual_sales_needed'    => $params['total_annual_sales_needed'],
                'total_work_week_left_to_sell' => $params['total_work_week_left_to_sell'],
                'average_commission_per_sale'  => $params['average_commission_per_sale'],
                'total_contracts_needed'       => $params['total_contracts_needed'],
                'total_work_month_left_to_sell'=> $params['total_work_month_left_to_sell'],
                'created_at'                   => Carbon::now(),
            ]);
            //matrics
            $getMetrics = self::getMetrics();
            if( count($params['metric']) )
            {
                foreach ( $params['metric'] as $metric_slug => $value )
                {
                    $user_metric_data[] = [
                        'user_id'            => $user_id,
                        'user_sales_plan_id' => $record->id,
                        'metric_id'          => $getMetrics[$metric_slug],
                        'value'              => $value,
                        'created_at'         => Carbon::now(),
                    ];
                }
                UserMetricTarget::insert($user_metric_data);
            }

            //get kpi group
            $getKpiGroup = KpiGroups::getKpiGroup();
            foreach($getKpiGroup as $kpi_groups){
                $kpi_group[$kpi_groups->slug] = $kpi_groups->id;
            }

            if( count($params['kpi_target_sale']) )
            {
                foreach( $params['kpi_target_sale'] as $kpi_target_sale_type => $values )
                {
                    foreach($values as $kpi_group_slug => $value)
                    {
                        $kpi_target_data[] = [
                            'user_sales_plan_id'   => $record->id,
                            'kpi_target_sale_type' => $kpi_target_sale_type,
                            'kpi_group_id'         => $kpi_group[$kpi_group_slug],
                            'target_value'         => $value,
                            'created_at'           => Carbon::now(),
                        ];
                    }
                }
                UserKpiTargetSale::insert($kpi_target_data);
            }
            return $record;
        }
    }

    public static function removeUserSalePlan($user_id)
    {
        $user_sales_plan = self::where('user_id',$user_id)->first();
        if( isset($user_sales_plan->id) )
        {
            //delete user metric
            UserMetricTarget::where('user_id',$user_id)->forceDelete();
            //delete kpi target
            UserKpiTargetSale::where('user_sales_plan_id',$user_sales_plan->id)->forceDelete();
            //delete user sales plan
            self::where('user_id',$user_id)->forceDelete();
        }
    }

    public static function getUserSalePlan($user_id)
    {
        $query = self::where('user_id',$user_id)->first();
        return $query;
    }

    public static function getMetrics()
    {
        $data = [];
        $query = Metric::getUserMetrices();
        if( count($query) ){
            foreach($query as $result){
                $data[$result->slug] = $result->id;
            }
        }
        return $data;
    }
}