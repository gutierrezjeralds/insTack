<?php

namespace App\Http\Controllers;

use ChristofferOK\LaravelEmojiOne\LaravelEmojiOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\ErrorPageTraits;
use App\Avatar;
use App\Cover;
use App\Photo;
use App\Audio;
use App\Video;
use App\Post;
use App\User;
use App\Like;

class PostController extends Controller
{
    use ErrorPageTraits;

    public function postSharePost(Request $request){
        //Validation
        $this->validate($request, [
           'caption' => 'required',
        ]);

        $user = Auth::user();

        // $input = $request -> all();
        $post =  new Post;
        //$post -> caption = LaravelEmojiOne::toShort($request -> caption);
        $post -> caption = $request -> caption;
        $post -> caption_bg = $request -> caption_bg;
        $post -> user_id = $user -> id;
        $post -> username = $user -> username;

        $post -> save();
        return redirect()->back();
    }

    public function postSharePhoto(Request $request){
        //Validation
        $this->validate($request, [
           //'photo' => 'required',
        ]);

        $user = Auth::user();

        // $input = $request -> all();
        $post =  new Post;
        $post -> caption = $request -> caption;
        $post -> user_id = $user -> id;
        $post -> username = $user -> username;

        // $post_find = Post::withTrashed() -> get() -> last();
        // $post_find = Post::all() -> last();

        if ($request -> input("photoFile")){
            foreach ($request -> photoFile as $photo){
                // $filename = '1609141608152015' . time() . uniqid() . '.png';

                $filename = $photo;

                //Storage::disk('public')->put($user->id . '/images/post/' . $filename, File::get($photo));
                $old_photo_path = storage_path() . '\\app\public\\' . $user->id . '\\upload\temp\photo\\' . $filename;
                $new_photo_path = storage_path() . '\\app\public\\' . $user->id . '\\images\photo\\' . $filename;

                $move = File::move($old_photo_path, $new_photo_path);

                $photo =  new Photo;
                $photo -> photo = $filename;
                $photo -> user_id = $user -> id;
                // $photo -> post_id = $post_find -> id + 1;
                $photo -> post_id = 0;
                $photo -> save();

                // $input['photo_id'] = $photo -> id;
                $post -> photo_id = $photo -> id;
            }
        }
        // $user->posts()->create($input);
        $post -> save();
        Photo::where('user_id', $user->id) -> where('post_id', 0) -> update(['post_id' => $post->id]);
        return redirect()->back();

        // return $request -> all();
    }

    public function postSharePhotoAuto(Request $request){
        $user = Auth::user();

        $photo = $request -> file('photo');
        // $filename = '1609141608152015' . time() . uniqid() . '.png';
        $filename = $photo -> getClientOriginalName();

        $storagePhotoPath = storage_path() . '\\app\public\\' . $user->id . '\\images\photo\\';
        File::makeDirectory($storagePhotoPath, 0775, true, true);

        Storage::disk('public')->put($user->id . '/upload/temp/photo/' . $filename, File::get($photo));
    }

    public function postShareAudio(Request $request){
        //Validation
        $this->validate($request, [
           'audio' => 'required',
        ]);

        $user = Auth::user();

        // $input = $request -> all();
        $post =  new Post;
        $post -> caption = $request -> caption;
        $post -> user_id = $user -> id;
        $post -> username = $user -> username;

        // $post_find = Post::withTrashed() -> get() -> last();
        // $post_find = Post::all() -> last();

        if ($request -> hasFile('audio')){
            foreach ($request -> audio as $audio){
                $realfilename = $audio -> getClientOriginalName();
                $filename = '1609140121040915' . time() . uniqid() . '.mp3';
                Storage::disk('public')->put($user->id . '/audio/' . $filename, File::get($audio));

                $audio =  new Audio;
                $audio -> audio = $filename;
                $audio -> audio_name = $realfilename;
                $audio -> user_id = $user -> id;
                // $photo -> post_id = $post_find -> id + 1;
                $audio -> post_id = 0;
                $audio -> save();

                // $input['photo_id'] = $photo -> id;
                $post -> audio_id = $audio -> id;
            }
        }
        // $user->posts()->create($input);
        $post -> save();
        Audio::where('user_id', $user->id) -> where('post_id', 0) -> update(['post_id' => $post->id]);
        return redirect()->back();

    }

    public function postShareVideo(Request $request){
        //Validation
        $this->validate($request, [
           'video' => 'required',
        ]);

        $user = Auth::user();

        // $input = $request -> all();
        $post =  new Post;
        $post -> caption = $request -> caption;
        $post -> user_id = $user -> id;
        $post -> username = $user -> username;

        // $post_find = Post::withTrashed() -> get() -> last();
        // $post_find = Post::all() -> last();

        if ($request -> hasFile('video')){
            foreach ($request -> video as $video){
                $realfilename = $video -> getClientOriginalName();
                $filename = '1609142209040515' . time() . uniqid() . '.mp4';
                Storage::disk('public')->put($user->id . '/video/' . $filename, File::get($video));

                $video =  new Video;
                $video -> video = $filename;
                $video -> video_name = $realfilename;
                $video -> user_id = $user -> id;
                // $photo -> post_id = $post_find -> id + 1;
                $video -> post_id = 0;
                $video -> save();

                // $input['photo_id'] = $photo -> id;
                $post -> video_id = $video -> id;
            }
        }
        // $user->posts()->create($input);
        $post -> save();
        Video::where('user_id', $user->id) -> where('post_id', 0) -> update(['post_id' => $post->id]);
        return redirect()->back();

    }

    public function postLikePost(Request $request){
        $is_like = $request['isLike'] === 'true';
        $post_id = $request['postId'];
        $update = false;
        $post = Post::find($post_id);

        if (!$post){
            return null;
        }

        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();

        if ($like){
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like){
                $like->delete();
                return null;
            }
        } else{
            $like = new Like();
        }

        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;

        if ($update){
            $like->update();
        } else{
            $like->save();
        }

        return null;
    }

    public function postEditPost(Request $request){
        $post = Post::find($request['postId']);
        $post->caption = $request['caption'];
        $post->update();
        return response()->json(['new_caption' => $post->caption], 200);
    }

    public function postEnableCommentPost(Request $request){
        $post = Post::find($request['postId']);
        $post->comment_hide = $request['comment_hide_value'];
        $post->update();
        return response()->json(['new_comment_hide' => $post->comment_hide], 200);
    }

    public function getDeletePost($user_id, $post_id){
        $post = Post::findOrFail($post_id);

        $photo = Photo::where('post_id', $post_id);
        $files = Photo::where('post_id', $post_id) -> get();

        $avatar = Avatar::where('post_id', $post_id);
        $images = Avatar::where('post_id', $post_id) -> get();

        $cover = Cover::where('post_id', $post_id);
        $uploads = Cover::where('post_id', $post_id) -> get();

        $audio = Audio::where('post_id', $post_id);
        $musics = Audio::where('post_id', $post_id) -> get();

        $video = Video::where('post_id', $post_id);
        $movies = Audio::where('post_id', $post_id) -> get();

        if (Auth::user() != $post->user){
            return redirect()->back();
        }

        $post -> delete();
        $photo -> delete();
        $avatar -> delete();
        $cover -> delete();
        $audio -> delete();
        $video -> delete();

        foreach ($files as $file) {
            Storage::disk('public')->delete($user_id . '/images/post/' . $file -> photo);
        }
        foreach ($images as $image) {
            Storage::disk('public')->delete($user_id . '/images//avatar/' . $image -> avatar);
        }
        foreach ($uploads as $upload) {
            Storage::disk('public')->delete($user_id . '/images//cover/' . $upload -> cover_photo);
        }
        foreach ($musics as $music) {
            Storage::disk('public')->delete($user_id . '/audio/' . $music -> audio);
        }
        foreach ($movies as $movie) {
            Storage::disk('public')->delete($user_id . '/video/' . $movie -> video);
        }

        //return redirect()->back();
    }

    public function getDeleteAllFileFromListUpload(){
        $user = Auth::user();

        $delete_all_from_list = storage_path() . '\\app\public\\' . $user->id . '\\upload\temp\\';
        $delete_all = File::deleteDirectory($delete_all_from_list);
    }

    public function getDeleteFileFromListUploadPhoto($filename){
        $user = Auth::user();

        $delete_photo_from_list = storage_path() . '\\app\public\\' . $user->id . '\\upload\temp\photo\\' . $filename;
        $delete = File::delete($delete_photo_from_list);
    }

    public function postView($username, $post_id){
//        $posts = Post::find($post_id) -> where('user_id', $user_id) -> get();
        $auth = Auth::user();
        $users = User::where('username', $username) -> get();
        $posts = Post::where('id', $post_id) -> get();
        $post = Post::findOrFail($post_id);
        foreach ($users as $user) {
            if (!Auth::guest()) {
                $authAvatars = Avatar::select('avatar', 'avatar_crop', 'post_id', 'deleted_at') -> withTrashed() -> where('user_id', $auth -> id) -> get();
                $avatars = Avatar::select('avatar', 'avatar_crop', 'post_id', 'deleted_at') -> withTrashed() -> where('user_id', $auth -> id) -> get();
            }
            if ($post -> username == $username){
                return view('contents.view', compact('user', 'posts', 'avatars', 'authAvatars'));
            }
            if ($post != $post_id) {
                return $this -> errorNotFound();
            }
        }
        return $this -> errorNotFound();
    }

}
