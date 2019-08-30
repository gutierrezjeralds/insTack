<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Post;
use App\Photo;
use App\Avatar;
use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::guest()){
            return view('auth.login');
        }else{
            $auth = Auth::user();
            $posts = Post::OrderBy('created_at', 'desc') -> paginate(2);
            // $posts = Post::latest();
            $authAvatars = Avatar::select('avatar', 'avatar_crop', 'post_id', 'deleted_at') -> withTrashed() -> where('user_id', $auth -> id) -> get();
            $avatars = Avatar::select('avatar', 'avatar_crop', 'post_id', 'deleted_at') -> withTrashed() -> where('user_id', $auth -> id) -> get();

            if ($request->ajax()) {
                $view = view('contents.includes.postView',compact('posts'))->render();
                return response()->json(['html'=>$view]);
            }

            return view('contents.home', compact('posts', 'avatars', 'authAvatars'));
        }
    }
}
