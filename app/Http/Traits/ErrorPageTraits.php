<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Avatar;

trait ErrorPageTraits {
    public function errorNotFound(){
    	$auth = Auth::user();
    	if(!Auth::guest()){
        	$authAvatars = Avatar::select('avatar', 'deleted_at') -> withTrashed() -> where('user_id', $auth -> id) -> get();
		}
        return view('errors.404', compact('authAvatars'));
    }
}