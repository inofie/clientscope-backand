<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscriber extends Model
{
    use SoftDeletes;

    /**
     * The attributes is used for define database table.
     *
     * @var string
     */
    protected $table = 'subscriber';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'status', 'ip_address', 'created_at', 'updated_at', 'deleted_at'
    ];


}