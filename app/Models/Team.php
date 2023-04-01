<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'team';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_company_id', 'user_id', 'title', 'slug', 'image_url', 'description', 'total_member', 'status_id', 'created_at', 'updated_at', 'deleted_at'
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
        $userRole = UserRole::getUserRoleByUserId($request['user']->id);
        if( $userRole->slug == 'company' ){
            $company_id = $request['user']->id;
        }else{
            $userCompany = UserCompanyMapping::getCompanyByEmployeeID($request['user']->id);
            $company_id  = $userCompany->id;
        }
        $query->where('user_id',$company_id);
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
        $postdata['user_company_id'] = $user['user_company']['id'];
        $postdata['user_id']         = $postdata['user']->id;
        $postdata['slug']            = str_slug($postdata['title']);
        $postdata['created_at']      = Carbon::now();
        if( !empty($postdata['image_url']) ){
            $postdata['image_url'] = \Storage::url(uploadMedia('team',$postdata['image_url']));
        }
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
        $postData['slug'] = str_slug($postData['title']);
        if( !empty($postData['image_url']) ){
            $postData['image_url'] = \Storage::url(uploadMedia('team',$postData['image_url']));
        }
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
}