<?php

/**
 * Mail helper
 * @param {string} $email
 * @param {array} $params
 * return send mail
 */
if (! function_exists('sendMail')) {
    function sendMail($to, $identifier, $params)
    {
        return \App\Helpers\MailHelper::sendMail($to, $identifier, $params);
    }
}

/**
 * Upload Media
 * @param {string} $path
 * @param {array} $file
 * @param {string} $resize
 * return filename
 */
if (! function_exists('uploadMedia')) {
    function uploadMedia($path,$file,$resize = '')
    {
        return \App\Helpers\UploadMedia::uploadMedia($path,$file,$resize);
    }
}

if (! function_exists('optimizeImage')) {
    function optimizeImage($source_path,$destination_path,$quality =50)
    {
        return \App\Helpers\UploadMedia::optimizeImage($source_path,$destination_path,$quality =50);
    }
}

/**
 * Upload Media
 * @param {string} $path
 * @param {array} $file
 * @param {string} $resize
 * return filename
 */
if (! function_exists('uploadMediaByPath')) {
    function uploadMediaByPath($path,$file,$resize = '')
    {
        return \App\Helpers\UploadMedia::uploadMediaByPath($path,$file,$resize);
    }
}

/**
 * App Setting
 * @param {string} $identifier
 * @param {string} $meta_key
 */
if(!function_exists('appSetting')){
    function appSetting($identifier,$meta_key)
    {
        return \App\Helpers\AppSetting::getAppSetting($identifier,$meta_key);
    }
}

/**
 * User Meta
 * @param {array} usermeta
 * @param {string} $meta_key
 */
if(!function_exists('userMeta')){
    function userMeta($metaKey)
    {
        return \App\Helpers\UserMeta::userMeta($metaKey);
    }
}

/**
 * Base url
 * $param {string} $path
 * @return {string} url
 */
if(!function_exists('base_url')){
    function base_url($path = '')
    {
        return !empty($path) ? env('APP_URL') . $path : env('APP_URL');
    }
}

/**
 * Get record By Slug
 * $param {string} $slug
 * @return {int} id
 */
if(!function_exists('get_status')){
    function get_status_id($slug)
    {
        $record = \DB::table('status')->where('slug',$slug)->first();
        return isset($record->id) ? $record->id : 0;
    }
}
if( !function_exists('get_user') ){
    function get_user(){
        $user   =  \Illuminate\Support\Facades\Auth::user();
        $record = \App\Models\User::getUserByID($user->id);
        $record->gateway_default_card_json = json_decode($record->gateway_default_card_json);
        return $record;
    }
}
if( !function_exists('check_user_session') ){
    function check_user_session(){
        return \Illuminate\Support\Facades\Auth::check();
    }
}
if( !function_exists('user_logout') ){
    function user_logout()
    {
        \Illuminate\Support\Facades\Auth::logout();
    }
}
