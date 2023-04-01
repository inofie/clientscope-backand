<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomField extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'custom_field';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_user_id', 'creator_id', 'label', 'field_type', 'field_option',
        'created_at', 'updated_at', 'deleted_at', 'field_name'
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
        $user = $request['user']->toArray();
        $query->select('custom_field.*');
        $query->selectRaw("upcf.value AS default_value");
        $query->leftJoin('user_pin_custom_field AS upcf',function($leftJoin) use ($request){
            $leftJoin->on('upcf.custom_field_id','=','custom_field.id');
            $leftJoin->where('upcf.user_pin_id','=',$request->input('user_pin_id',0));
        });
        $query->where('custom_field.company_user_id',$user['user_company']['company_user_id']);

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

    public static function getCustomFields($company_user_id)
    {
        $query = self::where('company_user_id',$company_user_id)->get();
        return $query;
    }

    public static function addCustomFields($params)
    {
        $field_types = $params['field_type'];
        $label = $params['label'];
        for($i=0; $i < count($field_types); $i++ )
        {
            $data[] = [
                'company_user_id' => get_user()->userCompany->id,
                'creator_id'      => get_user()->id,
                'label'           => $label[$i],
                'field_name'      => str_slug($label[$i],'_'),
                'field_type'      => $field_types[$i],
                'created_at'      => Carbon::now(),
            ];
        }
        self::insert($data);
        return true;
    }

    public static function checkRecord($company_user_id,$record_id)
    {
        $query = self::where('company_user_id',$company_user_id)
                        ->where('id',$record_id)
                        ->first();
        return $query;
    }
}