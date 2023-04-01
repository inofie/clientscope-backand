<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module','module_id','user_id','gateway_transaction_id','gateway_type','gateway_request','gateway_response',
        'transaction_type','amount','created_at','updated_at','deleted_at'
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
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function packages()
    {
        return $this->hasOne(SubscriptionPackage::class, 'id', 'module_id');
    }
    public static function getTransaction($params){
        $query = Transaction::with('user','packages')->get();
        $query = \DB::table('transactions AS t')
        ->select('t.*','u.name','u.mobile_no','u.email','sp.title')
        ->leftJoin('users AS u','t.user_id','=','u.id')
        ->leftJoin('subscription_packages AS sp','sp.id','=','t.module_id')
        ->whereNull('u.deleted_at');
        if( !empty($params['keyword']) ){
            $keyword = $params['keyword'];
            $query->where( function($where) use ($keyword){
                $where->orWhere('u.name','like',"%$keyword%");
                $where->orWhere('t.gateway_type','like',"%$keyword%");
                $where->orWhere('t.module','like',"%$keyword%");
                $where->orWhere('t.amount','like',"%$keyword%");
                $where->orWhere('sp.title','like',"%$keyword%");
            });
        }
        $query = $query->orderBy('t.id','desc')
        ->paginate(config('constants.DATATABLE_RECORD_LIMIT'));   
        return $query;
    }
}