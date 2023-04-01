<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KpiGroups extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'kpi_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_user_id', 'company_user_id', 'title', 'slug', 'image_url', 'description', 'status',
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

    public static function getKpiGroup($user_pin_status_id = 0)
    {
        $query = self::select('kpi_groups.*')
                    ->selectRaw('IF(upskg.id IS NOT NULL, 1,0) AS is_selected')
                    ->leftJoin('user_pin_status_kpi_group AS upskg', function($leftJoin) use ($user_pin_status_id){
                        $leftJoin->on('upskg.kpi_group_id','=','kpi_groups.id')
                                 ->where('upskg.user_pin_status_id','=',$user_pin_status_id);        
                    })
                    ->orderBy('kpi_groups.id','asc')
                    ->get();
        return $query;
    }
}