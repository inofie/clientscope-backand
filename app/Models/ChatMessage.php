<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;

class ChatMessage extends Model
{
    use SoftDeletes, RestModel;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'chat_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'chat_room_id', 'message', 'file_url', 'message_type', 'ip_address', 'created_at',
        'updated_at', 'deleted_at'
    ];

    public function user()
    {
        $default_image_url = URL::to('images/user-placeholder.png');
        return $this->belongsTo('App\Models\User', 'user_id', 'id')
                    ->select('id','name','email','mobile_no','status_id','is_login','is_active','created_at')
                    ->selectRaw("IFNULL(image_url,'$default_image_url') AS image_url");
    }

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

    public static function getRoomChat($room_id,$user_id = 0)
    {
        $query = self::with('user')
                ->select('chat_messages.*')
                ->selectRaw("IF( cms.id IS NOT NULL, 1, 0 ) AS is_read")
                ->leftJoin('chat_message_status AS cms',function($leftJoin) use ($user_id){
                    $leftJoin->on('cms.chat_message_id','=','chat_messages.id')
                             ->where('cms.user_id','=',$user_id);
                })
                ->where('chat_messages.chat_room_id',$room_id)
                ->whereRaw("chat_messages.id NOT IN ( SELECT chat_message_id FROM chat_message_delete WHERE user_id = {$user_id} ) ")
                ->orderBy('chat_messages.id','desc')
                ->paginate(config('constants.PAGINATION_LIMIT'));
        return $query;
    }
}