<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class UserTracking extends Model
{
    use SoftDeletes, RestModel;
    
    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'user_tracking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_user_id', 'tracking_user_id', 'latitude', 'longitude', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function user()
    {
        $base_url = URL::to('/');
        $default_image_url = URL::to('images/user-placeholder.png');
        return $this->belongsTo('App\Models\User','tracking_user_id','id')
                    ->select('id','name','email','mobile_no')
                    ->selectRaw("IF(image_url IS NOT NULL,CONCAT('$base_url',image_url), '$default_image_url') AS image_url");
    }

    /*
   | ----------------------------------------------------------------------
   | Hook for manipulate query of index result
   | ----------------------------------------------------------------------
   | @query   = current sql query
   | @request = laravel http request class
   |
   */
    public function hook_query_index(&$query,$request, $id = '') 
    {
        $this->__is_paginate = false;
        $query->with('user');    
        if( !empty($request['user_id']) ){
            $query->whereIn('tracking_user_id',explode(',',$request['user_id']));
        }
        if( !empty($request['date']) ){
            $date = date('Y-m-d',strtotime($request['date']));
            $query->whereRaw("DATE(created_at) = '$date' ");
        }
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
        $user = $postdata['user']->toArray();
        $postdata['company_user_id']  = $user['user_company']['id'];  
        $postdata['tracking_user_id'] = $user['id'];
        $postdata['created_at']       = Carbon::now();     
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

    public static function getTrackingDates($params)
    {
        $query = self::selectRaw('DATE(created_at) AS tracking_date')
                    ->where('tracking_user_id',$params['user_id'])
                    ->groupBy(\DB::raw('DATE(created_at)'))
                    ->get();
        return $query;            
    }
}