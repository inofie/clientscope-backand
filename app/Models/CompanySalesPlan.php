<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanySalesPlan extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'company_sales_plan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_user_id', 'company_annual_sales_target', 'company_year_to_date_sold', 'left_to_sell', 'company_average_revenue_per_sale',
        'work_week_left_for_the_year', 'work_month_left_for_the_year', 'company_sales_needed_per_week', 'company_sales_needed_per_month',
        'active_company_sales_rep', 'average_annual_sales_per_sales_reps', 'new_hire_rentention_rate', 'total_sales_reps_needed', 'new_hire_needed',
        'created_at','updated_at','deleted_at'
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

    public static function saveCompanyPlan($params)
    {
        //get current user
        $current_user = get_user();
        //delete old company sale plan data
        self::where('company_user_id',$current_user->userCompany->id)->forceDelete();
        CompanyMetricTarget::where('user_company_id',$current_user->userCompany->id)->forceDelete();
        CompanyKpiTargetSale::where('user_company_id',$current_user->userCompany->id)->forceDelete();

        //save new company plan
        $record = self::create([
            'company_user_id' => $current_user->userCompany->id,
            'company_annual_sales_target' => $params['company_annual_sales_target'],
            'company_year_to_date_sold' => $params['company_year_to_date_sold'],
            'left_to_sell' => $params['left_to_sell'],
            'company_average_revenue_per_sale' => $params['company_average_revenue_per_sale'],
            'work_week_left_for_the_year' => $params['work_week_left_for_the_year'],
            'work_month_left_for_the_year' => $params['work_month_left_for_the_year'],
            'company_sales_needed_per_week' => $params['company_sales_needed_per_week'],
            'company_sales_needed_per_month' => $params['company_sales_needed_per_month'],
            'active_company_sales_rep' => $params['active_company_sales_rep'],
            'average_annual_sales_per_sales_reps' => $params['average_annual_sales_per_sales_reps'],
            'new_hire_rentention_rate' => $params['new_hire_rentention_rate'],
            'total_sales_reps_needed' => $params['total_sales_reps_needed'],
            'new_hire_needed' => $params['new_hire_needed'],
            'created_at' => Carbon::now(),
        ]);
        //company metric target
        $companyMetrices = self::getCompanyMetrices();
        if( count($params['metric']) ){
            foreach( $params['metric'] as $metric_slug => $value ){
                $metric_data[] = [
                    'user_company_id'       => $current_user->userCompany->id,
                    'company_sales_plan_id' => $record->id,
                    'metric_id'             => $companyMetrices[$metric_slug],
                    'value'                 => $value,
                    'created_at'            => Carbon::now()
                ];
            }
            CompanyMetricTarget::insert($metric_data);
        }

        //company kpi target sale
        if( !empty($params['kpi_target_sale']) )
        {
            foreach( $params['kpi_target_sale'] as $kpi_target_sale_type => $values )
            {
                foreach($values as $kpi_group_id => $value)
                {
                    $kpi_target_data[] = [
                        'user_company_id'      => $current_user->userCompany->id,
                        'company_sale_plan_id' => $record->id,
                        'kpi_target_sale_type' => $kpi_target_sale_type,
                        'kpi_group_id'         => $kpi_group_id,
                        'target_value'         => $value,
                        'created_at'           => Carbon::now(),
                    ];
                }
            }
            CompanyKpiTargetSale::insert($kpi_target_data);
        }
        return $record;
    }

    public static function getCompanySalePlan()
    {
        $current_user = get_user();
        $query = self::where('company_user_id',$current_user->userCompany->id)->first();
        return $query;
    }

    public static function getCompanyMetrices()
    {
        $data = [];
        $metrices = Metric::getMetrices();
        if( count($metrices) ) {
            foreach ($metrices as $metrice) {
                $data[$metrice->slug]= $metrice->id;
            }
        }
        return $data;
    }
}