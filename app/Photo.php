<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
    	'photo', 'user_id', 'post_id'
    ];
    
    protected $dates = ['deleted_at'];
}
