<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    use SoftDeletes;

    public $table = "audios";
    protected $fillable = [
        'audio', 'user_id', 'post_id'
    ];

    protected $dates = ['deleted_at'];
}
