<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class TerritoryCompanyMapping extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'territory_company_maping';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_user_id', 'employee_user_id', 'territory_id', 'created_at', 'updated_at', 'deleted_at'
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
  
    public static function addRecord($params,$record)
    {
        //delete old data
        self::where('territory_id',$record->id)->forceDelete();
        //add new data
        $params       = \Request::all();
        $employee_ids = explode(',',$params['assignee_user_id']); 
        $userRole = UserRole::getUserRoleByUserId($record->creator_user_id);
        if( $userRole->slug == 'company' ){          
            foreach($employee_ids as $employee_id){
                $data[] = [
                  'company_user_id'  => $record->creator_user_id,
                  'employee_user_id' => $employee_id,
                  'territory_id'     => $record->id,
                  'created_at'       => Carbon::now(),
                ];
            }
            self::insert($data);
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($record->creator_user_id);
            foreach($employee_ids as $employee_id){
                $data[] = [
                   'company_user_id'   => $userCompany->id,
                   'employee_user_id'  => $employee_id,
                   'territory_id'      => $record->id,
                   'created_at'        => Carbon::now(),
                ];
            }
            self::insert($data);
        }
    }
}