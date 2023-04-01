<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Setting;

class AppSetting
{
    static function getAppSetting($identifier,$meta_key)
    {
        $query = Cache::get($identifier, function () use ($identifier) {
            return Setting::where('identifier',$identifier)->get();
        });
        if( count($query) ) {
            foreach($query as $row){
                if( $row->meta_key == $meta_key)
                    return $row->meta_value;
            }
        }
        return false;
    }
}