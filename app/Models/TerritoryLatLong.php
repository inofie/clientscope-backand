<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TerritoryLatLong extends Model
{
    use SoftDeletes;

    protected $table = 'territory_latlong';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'territory_id', 'latitude', 'longitude', 'created_at', 'updated_at', 'deleted_at'
    ];

    public static function addTerritoryLatLong($tarritory_id,$data)
    {
        if( !empty($data) ){
            //delete old data
            self::where('territory_id',$tarritory_id)->forceDelete();
            foreach($data as $latlong){
                $latlong_data[] = [
                    'territory_id' => $tarritory_id,
                    'latitude'     => $latlong->latitude,
                    'longitude'    => $latlong->longitude,
                ];
            }
            self::insert($latlong_data);
        }
    }
}