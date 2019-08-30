<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'caption', 'username', 'photo_id'
    ];
    
    protected $dates = ['deleted_at'];

    public static function scopeLatest($query){
        return $query -> orderBy('created_at', 'desc') -> get();
    }

    public static function getNotFoundAttribute(){
        return view('errors.404');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function avatar(){
        return $this->belongsTo('App\Photo');
    }

    public function cover(){
        return $this->belongsTo('App\Photo');
    }

    public function audio(){
        return $this->belongsTo('App\Audio');
    }

    public function video(){
        return $this->belongsTo('App\Video');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }
}
