<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserMeta
{
    static function userMeta($meta_key)
    {
        $user_id = Auth::check() ? Auth::user()->id : 0;
        $userMeta = DB::table('user_meta')->where('user_id',$user_id)->get();
        if(count($userMeta)){
            foreach($userMeta as $meta){
                if($meta->meta_key == $meta_key){
                    return $meta->meta_value;
                }
            }
        }
        return NULL;
    }
}