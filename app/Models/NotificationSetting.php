<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationSetting extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'notification_setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'meta_key', 'meta_value', 'created_at', 'updated_at', 'deleted_at'
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

    public static function saveNotificationSetting($params)
    {
        //delete old setting
        self::where('user_id',$params['user']->id)->forceDelete();
        //save new setting
        $data = [
            [
                'user_id'    => $params['user']->id,
                'meta_key'   => 'add_user_pin',
                'meta_value' => $params['add_user_pin']
            ],
            [
                'user_id'    => $params['user']->id,
                'meta_key'   => 'add_territory',
                'meta_value' => $params['add_territory']
            ],
            [
                'user_id'    => $params['user']->id,
                'meta_key'   => 'send_chat_message',
                'meta_value' => $params['send_chat_message']
            ]
        ];
        self::insert($data);
        return self::getNotificationSetting($params['user']->id);
    }

    public static function getNotificationSetting($user_id)
    {
        $query = self::where('user_id',$user_id)->get();
        if( count($query) ) {
            foreach($query as $result){
                $data[$result->meta_key] = (int)$result->meta_value;
            }
        }else{
            $data['add_user_pin'] = 1;
            $data['add_territory'] = 1;
            $data['send_chat_message'] = 1;
        }
        return $data;
    }
}
