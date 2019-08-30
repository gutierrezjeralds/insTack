<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Avatar extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'avatar', 'avatar_crop', 'username', 'photo_id'
    ];

    protected $dates = ['deleted_at'];
}
