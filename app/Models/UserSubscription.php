<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscription extends Model
{
    use SoftDeletes, RestModel;

    protected $table = 'user_subscription';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_user_id','user_id', 'subscription_package_id', 'expire_date', 'status', 'gateway_type', 'gateway_transaction_id', 
        'amount', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function subscriptionPackage()
    {
        return $this->belongsTo('App\Models\SubscriptionPackage','subscription_package_id','id');
    }

    /*
    | ----------------------------------------------------------------------
    | Hook for manipulate query of index result
    | ----------------------------------------------------------------------
    | @query   = current sql query
    | @request = laravel http request class
    |
    */
    public function hook_query_index(&$query, $request, $id = '')
    {
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
    public function hook_after_edit($request, $record)
    {
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
    public function hook_before_delete($request, $id)
    {
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
    public function hook_after_delete($id, $record)
    {
        //Your code here

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function subscriptionPackages(){
        return $this->belongsTo(SubscriptionPackage::class, 'subscription_package_id', 'id');
    }

    public static function getUserSubscription($params){
        $query = \DB::table('user_subscription AS us')
        ->select('us.*','u.name','u.mobile_no','sp.title')
        ->leftJoin('users AS u','us.user_id','=','u.id')
        ->leftJoin('subscription_packages AS sp','sp.id','=','us.subscription_package_id')
        ->whereNull('u.deleted_at');
        if( !empty($params['keyword']) ){
            $keyword = $params['keyword'];
            $query->where( function($where) use ($keyword){
                $where->orWhere('u.name','like',"%$keyword%");
                $where->orWhere('u.email','like',"%$keyword%");
                $where->orWhere('u.mobile_no','like',"%$keyword%");
                $where->orWhere('us.status','like',"%$keyword%");
                $where->orWhere('us.expire_date','like',"%$keyword%");
                $where->orWhere('us.created_at','like',"%$keyword%");
                $where->orWhere('sp.title','like',"%$keyword%");
            });
        }
        $query = $query->orderBy('us.id','desc')
        ->paginate(config('constants.DATATABLE_RECORD_LIMIT'));   
        return $query;
    }

    public static function checkUserSubscription($user_company_id)
    {
        $record = self::with('subscriptionPackage')
                        ->where('company_user_id',$user_company_id)
                        ->orderBy('id','desc')
                        ->first();
        return $record;
    }

    public static function upgradePackage($params)
    {

    }
}
