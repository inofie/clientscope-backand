<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailTemplate extends Model
{

    use SoftDeletes;

    protected $table = 'mail_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identifier', 'subject', 'body', 'wildcard', 'created_at', 'updated_at','deleted_at'
    ];


}