<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cover extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cover_photo', 'cover_position', 'username', 'photo_id'
    ];

    protected $dates = ['deleted_at'];
}
