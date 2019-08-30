<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Http\Traits\ErrorPageTraits;
use App\Photo;
use App\Avatar;
use App\Cover;
use App\Post;
use App\User;
use App\Like;

class ProfileController extends Controller
{
    use ErrorPageTraits;

    public function profile(Request $request, $username)
    {
        $auth = Auth::user();
        $users = User::where('username', $username) -> get();
        $posts = Post::OrderBy('created_at', 'desc') -> where('username', $username) -> paginate(20);
        if(!Auth::guest()){
            $authAvatars = Avatar::select('avatar', 'avatar_crop', 'post_id', 'deleted_at') -> withTrashed() -> where('user_id', $auth -> id) -> get();
        }
        foreach ($users as $user) {
            $avatars = Avatar::select('avatar', 'avatar_crop', 'post_id', 'deleted_at') -> withTrashed() -> where('user_id', $user -> id) -> get();
            $covers = Cover::select('cover_photo', 'cover_position', 'post_id', 'deleted_at') -> withTrashed() -> where('user_id', $user -> id) -> get();

            if ($request->ajax()) {
                $view = view('contents.includes.postView',compact('posts'))->render();
                return response()->json(['html'=>$view]);
            }

            return view('contents.profile', compact('user', 'posts', 'avatars', 'covers', 'authAvatars'));
        }
        return $this -> errorNotFound();
    }

    public function uploadAvatar(Request $request){

        $user = Auth::user();

        // $input = $request -> all();
        $post =  new Post;
        $post -> caption = $request -> caption;
        $post -> username = $user -> username;
        $post -> user_id = $user -> id;

        if ($request -> hasFile('avatar')){
            foreach ($request -> avatar as $avatar){

                $filename = time() . '012201200118' . time() . uniqid() . '.png';
                $filenameCrop = time() . '01220120011803181516' . time() . uniqid() . '.png';

                $avatarCrop = $request -> avatarCrop;

                list($type, $avatarCrop) = explode(';', $avatarCrop);
                list(, $avatarCrop)      = explode(',', $avatarCrop);
                $avatarCrop = base64_decode($avatarCrop);

                $storageAvatarCropPath = storage_path() . '\\app\public\\' . $user->id . '\\images\avatar\crop\\';
                File::makeDirectory($storageAvatarCropPath, 0775, true, true);

                Storage::disk('public')->put($user->id . '/images/avatar/' . $filename, File::get($avatar));

                $avatarCropPathName = $storageAvatarCropPath . $filenameCrop;

                file_put_contents($avatarCropPathName, $avatarCrop);

                $avatar =  new Avatar;
                $avatar -> avatar = $filename;
                $avatar -> avatar_crop = $filenameCrop;
                $avatar -> user_id = $user -> id;
                // $photo -> post_id = $post_find -> id + 1;
                $avatar -> post_id = 0;
                $avatar -> save();

                // $input['photo_id'] = $photo -> id;
                $post -> avatar_id = $avatar -> id;
            }
        }

        // $user->posts()->create($input);
        $post -> save();
        Avatar::where('user_id', $user->id) -> where('post_id', 0) -> update(['post_id' => $post->id]);
        return redirect()->back();
        return redirect()->route('profile', ['username' => $user -> username]);
    }

    public function uploadCoverPhoto(Request $request){

        $user = Auth::user();

        // $input = $request -> all();
        $post =  new Post;
        $post -> caption = $request -> caption;
        $post -> username = $user -> username;
        $post -> user_id = $user -> id;

        if ($request -> hasFile('cover')){
            foreach ($request -> cover as $cover){
                $filename = time() . '03152205181608152015' . time() . uniqid() . '.png';
                Storage::disk('public')->put($user->id . '/images/cover/' . $filename, File::get($cover));

                $cover =  new Cover;
                $cover -> cover_photo = $filename;
                $cover -> cover_position = $request -> cover_position;
                $cover -> user_id = $user -> id;
                // $photo -> post_id = $post_find -> id + 1;
                $cover -> post_id = 0;
                $cover -> save();

                // $input['photo_id'] = $photo -> id;
                $post -> cover_id = $cover -> id;
            }
        }

        // $user->posts()->create($input);
        $post -> save();
        Cover::where('user_id', $user->id) -> where('post_id', 0) -> update(['post_id' => $post->id]);
        return redirect()->back();
        // return redirect()->route('profile', ['username' => $user -> username]);
    }
}
