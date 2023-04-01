<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class ChatRoom extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'chat_rooms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier', 'created_by', 'title', 'slug', 'image_url', 'description', 'status',
        'type', 'member_limit', 'last_message_id', 'created_at', 'updated_at', 'deleted_at'
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

    public static function getRecentChatUser($user_id)
    {
        $default_image_url = URL::to('images/user-placeholder.png');
        $query = ChatRoomUser::select('cr.id AS chat_room_id','u.id AS user_id','u.name','u.email','u.mobile_no','is_login',
                            'is_active','cm.message AS last_message','cm.created_at AS last_message_datetime')
                            ->selectRaw("IFNULL(u.image_url,'$default_image_url') AS image_url")
                            ->join('chat_rooms AS cr','cr.id','=','chat_room_users.chat_room_id')
                            ->join('chat_messages AS cm','cm.id','=','cr.last_chat_message_id')
                            ->join('users AS u','u.id','=','chat_room_users.user_id')
                            ->whereRaw("chat_room_users.chat_room_id in (SELECT chat_room_id FROM client_scope.chat_room_users 
                                where user_id = {$user_id})")
                            ->where('chat_room_users.user_id','!=',$user_id)
                            ->where('cr.last_chat_message_id','>',0)
                            ->paginate(config('constants.PAGINATION_LIMIT'));
        return $query;
    }
}