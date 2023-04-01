<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserKpiTargetSale extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'user_kpi_target_sale';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_sales_plan_id', 'kpi_target_sale_type', 'kpi_group_id', 'target_value', 'created_at',
        'updated_at', 'deleted_at'
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


    public static function getUserAnnualKpiTarget($user_id, $territory_ids=[])
    {
        $user  = get_user()->toArray();
        if( $user['user_role']['slug'] == 'sales-representative' || $user['user_role']['slug'] == 'team-lead' )
        {
            $query = \DB::table('user_kpi_target_sale AS ukts')
                            ->select('kg.*');
            if( count($territory_ids) > 0 ){
                $query->selectRaw('IFNULL(ukts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                                COUNT(up.id) AS total_pin, ROUND( ( COUNT(up.id) * 100 ) / ukts.target_value ) AS kpi_percent');
            } else {
                $query->selectRaw('IFNULL(ukts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                                COUNT(upuh.id) AS total_pin, ROUND( ( COUNT(upuh.id) * 100 ) / ukts.target_value ) AS kpi_percent');
            }                
            $query = $query ->join('user_sales_plan AS usp','usp.id','=','ukts.user_sales_plan_id')
                            ->join('kpi_groups AS kg','kg.id','=','ukts.kpi_group_id')
                            ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                            ->leftJoin('user_pin_status AS ups','ups.id','=','upskg.user_pin_status_id')
                            ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($user_id){
                                $leftJoin->on('upuh.user_pin_status_id','=','ups.id')
                                         ->where('upuh.user_id','=',$user_id);        
                            });
            if( count($territory_ids) > 0 )
            {
                $query->leftJoin('user_pin AS up',function($leftJoin) use ($territory_ids){
                    $leftJoin->on('up.id','=','upuh.user_pin_id')
                             ->whereIn('up.territory_id',$territory_ids);
                });
            }
                            
            $query = $query->where('usp.user_id',$user_id)
                            ->where('ukts.kpi_target_sale_type','kpi_annual_target')
                            ->groupBy('kg.id')
                            ->get();
        } else {
            $query = \DB::table('company_kpi_target_sale AS ckts')
                            ->select('kg.*');

            if( count($territory_ids) > 0 ){
                $query->selectRaw('IFNULL(ckts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                                COUNT(up.id) AS total_pin, ROUND( ( COUNT(up.id) * 100 ) / ckts.target_value ) AS kpi_percent');
            } else {
                $query->selectRaw('IFNULL(ckts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                                COUNT(upuh.id) AS total_pin, ROUND( ( COUNT(upuh.id) * 100 ) / ckts.target_value ) AS kpi_percent');
            }                 
            $query = $query->join('kpi_groups AS kg','kg.id','=','ckts.kpi_group_id')
                            ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                            ->leftJoin('user_pin_status AS ups','ups.id','=','upskg.user_pin_status_id')
                            ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($user_id){
                                $leftJoin->on('upuh.user_pin_status_id','=','ups.id')
                                         ->where('upuh.user_id','=',$user_id);        
                            });
            if( count($territory_ids) > 0 )
            {
                $query->leftJoin('user_pin AS up',function($leftJoin) use ($territory_ids){
                    $leftJoin->on('up.id','=','upuh.user_pin_id')
                                ->whereIn('up.territory_id',$territory_ids);
                });
            }                

            $query = $query->where('ckts.user_company_id',$user['user_company']['id'])
                            ->where('ckts.kpi_target_sale_type','kpi_annual_target')
                            ->groupBy('kg.id')
                            ->get();
        }
        return $query;
    }

    public static function getUserMonthlyKpiTarget($user_id)
    {
        $user  = get_user()->toArray();
        if( $user['user_role']['slug'] == 'sales-representative' || $user['user_role']['slug'] == 'team-lead' ){
            $query = \DB::table('user_kpi_target_sale AS ukts')
                        ->select('kg.*')
                        ->selectRaw('IFNULL(ukts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                        COUNT(upuh.id) AS total_pin, ROUND( ( COUNT(upuh.id) * 100 ) / ukts.target_value ) AS kpi_percent')
                        ->join('user_sales_plan AS usp','usp.id','=','ukts.user_sales_plan_id')
                        ->join('kpi_groups AS kg','kg.id','=','ukts.kpi_group_id')
                        ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                        ->leftJoin('user_pin_status AS ups','ups.id','=','upskg.user_pin_status_id')
                        ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($user_id){
                            $leftJoin->on('upuh.user_pin_status_id','=','ups.id')
                                     ->where('upuh.user_id','=',$user_id);        
                        })
                        ->where('usp.user_id',$user_id)
                        ->where('ukts.kpi_target_sale_type','kpi_monthly_target')
                        ->groupBy('kg.id')
                        ->get();
        } else {
            $query = \DB::table('company_kpi_target_sale AS ckts')
                ->select('kg.*')
                ->selectRaw('IFNULL(ckts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                COUNT(upuh.id) AS total_pin, ROUND( ( COUNT(upuh.id) * 100 ) / ckts.target_value ) AS kpi_percent')
                ->join('kpi_groups AS kg','kg.id','=','ckts.kpi_group_id')
                ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                ->leftJoin('user_pin_status AS ups','ups.id','=','upskg.user_pin_status_id')
                ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($user_id){
                    $leftJoin->on('upuh.user_pin_status_id','=','ups.id')
                             ->where('upuh.user_id','=',$user_id);        
                })
                ->where('ckts.user_company_id',$user['user_company']['id'])
                ->where('ckts.kpi_target_sale_type','kpi_monthly_target')
                ->groupBy('kg.id')
                ->get();
        }
        return $query;
    }

    public static function getUserWeeklyKpiTarget($user_id)
    {
        $user  = get_user()->toArray();
        if( $user['user_role']['slug'] == 'sales-representative' || $user['user_role']['slug'] == 'team-lead'  ){
            $query = \DB::table('user_kpi_target_sale AS ukts')
                        ->select('kg.*')
                        ->selectRaw('IFNULL(ukts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                        COUNT(upuh.id) AS total_pin, ROUND( ( COUNT(upuh.id) * 100 ) / ukts.target_value ) AS kpi_percent')
                        ->join('user_sales_plan AS usp','usp.id','=','ukts.user_sales_plan_id')
                        ->join('kpi_groups AS kg','kg.id','=','ukts.kpi_group_id')
                        ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                        ->leftJoin('user_pin_status AS ups','ups.id','=','upskg.user_pin_status_id')
                        ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($user_id){
                            $leftJoin->on('upuh.user_pin_status_id','=','ups.id')
                                     ->where('upuh.user_id','=',$user_id);        
                        })
                        ->where('usp.user_id',$user_id)
                        ->where('ukts.kpi_target_sale_type','kpi_weekly_target')
                        ->groupBy('kg.id')
                        ->get();
        } else {
            $query = \DB::table('company_kpi_target_sale AS ckts')
                        ->select('kg.*')
                        ->selectRaw('IFNULL(ckts.target_value,0) AS target_value, ups.image_url AS status_image_url,
                        COUNT(upuh.id) AS total_pin, ROUND( ( COUNT(upuh.id) * 100 ) / ckts.target_value ) AS kpi_percent')
                        ->join('kpi_groups AS kg','kg.id','=','ckts.kpi_group_id')
                        ->leftJoin('user_pin_status_kpi_group AS upskg','upskg.kpi_group_id','=','kg.id')
                        ->leftJoin('user_pin_status AS ups','ups.id','=','upskg.user_pin_status_id')
                        ->leftJoin('user_pin_update_history AS upuh', function($leftJoin) use ($user_id){
                            $leftJoin->on('upuh.user_pin_status_id','=','ups.id')
                                     ->where('upuh.user_id','=',$user_id);        
                        })
                        ->where('ckts.user_company_id',$user['user_company']['id'])
                        ->where('ckts.kpi_target_sale_type','kpi_weekly_target')
                        ->groupBy('kg.id')
                        ->get();
        }
        return $query;
    }
}