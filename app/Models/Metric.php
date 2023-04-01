<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Metric extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'metrices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'description', 'status', 'sort_order', 'created_at', 'updated_at', 'deleted_at'
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

    public static function getMetrices($user_company_id = 0)
    {
        $query = self::select('metrices.*')
                        ->selectRaw('IFNULL(cmt.value,0) AS value, ups.custom_metric_title')
                        ->leftJoin('company_metric_target AS cmt',function($leftJoin) use ($user_company_id){
                            $leftJoin->on('cmt.metric_id','=','metrices.id')
                                     ->where('cmt.user_company_id','=',$user_company_id);
                        })
                        ->leftJoin('user_pin_status AS ups',function($leftJoin) use ($user_company_id){
                            $leftJoin->on('ups.metric_id','=','metrices.id')
                                ->where('ups.company_user_id','=',$user_company_id);
                        })
                        ->where('metrices.status',1)
                        ->groupBy('metrices.id')
                        ->orderBy('metrices.sort_order','asc')
                        ->get();
        return $query;
    }

    public static function getUserMetrices($user_id = 0,$user_company_id = 0)
    {
        $query = self::select('metrices.*')
            ->selectRaw('IFNULL(umt.value,0) AS value, IFNULL(cmt.value,0) AS company_metric_value,
            ups.custom_metric_title')
            ->leftJoin('user_metric_target AS umt',function($leftJoin) use ($user_id){
                $leftJoin->on('umt.metric_id','=','metrices.id')
                    ->where('umt.user_id','=',$user_id);
            })
            ->leftJoin('company_metric_target AS cmt',function($leftJoin) use ($user_company_id){
                $leftJoin->on('cmt.metric_id','=','metrices.id')
                         ->where('cmt.user_company_id','=',$user_company_id);
            })
            ->leftJoin('user_pin_status AS ups',function($leftJoin) use ($user_company_id){
                $leftJoin->on('ups.metric_id','=','metrices.id')
                    ->where('ups.company_user_id','=',$user_company_id);
            })
            ->where('metrices.status',1)
            ->groupBy('metrices.id')
            ->orderBy('metrices.sort_order','asc')
            ->get();
        return $query;
    }
}