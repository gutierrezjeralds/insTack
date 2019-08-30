<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Post;


class GetPhotoController extends Controller
{
    public function getSharedPhoto($user_id, $filename){
        $file = Storage::disk('public')->get($user_id . '/images/photo/' . $filename);
        return new Response($file, 200);
    }
    
    public function getSharedAvatar($user_id, $filename){
        $file = Storage::disk('public')->get($user_id . '/images/avatar/' . $filename);
        return new Response($file, 200);
    }
    
    public function getSharedAvatarCrop($user_id, $filename){
        $file = Storage::disk('public')->get($user_id . '/images/avatar/crop/' . $filename);
        return new Response($file, 200);
    }
    
    public function getSharedCover($user_id, $filename){
        $file = Storage::disk('public')->get($user_id . '/images/cover/' . $filename);
        return new Response($file, 200);
    }

    public function getSharedAudio($user_id, $filename){
        $file = Storage::disk('public')->get($user_id . '/audio/' . $filename);
        return new Response($file, 200);
    }

    public function getSharedVideo($user_id, $filename){
        $file = Storage::disk('public')->get($user_id . '/video/' . $filename);
        return new Response($file, 200);
    }
}
