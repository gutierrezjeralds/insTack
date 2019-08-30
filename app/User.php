<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use YoHang88\LetterAvatar\LetterAvatar;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id', 'first_name', 'last_name', 'email', 'username', 'gender', 'birthday', 'password',
    ];
    
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }
    
    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function getAvatarAttribute(){
        $full_name = $this->first_name . ' ' . $this->last_name;
        return new LetterAvatar($full_name, 'circle', 64);
    }
}
