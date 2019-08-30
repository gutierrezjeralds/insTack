<?php

use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Photo;
use App\Avatar;
use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/read', function () {
    $user = Auth::user() -> id;
    return $user;
});

Auth::routes();

Route::get('/{username}', [
    'uses' => 'ProfileController@profile',
    'as' => 'profile'
]);

Route::get('/{username}/post/{post_id}', [
    'uses' => 'PostController@postView',
    'as' => 'view'
]);

Route::get('sharedphoto/{userid}/{filename}', [
    'uses' => 'GetPhotoController@getSharedPhoto',
    'as' => 'shared.photo'
]);

Route::get('sharedavatar/{userid}/{filename}', [
    'uses' => 'GetPhotoController@getSharedAvatar',
    'as' => 'shared.avatar'
]);

Route::get('sharedavatarcrop/{userid}/{filename}', [
    'uses' => 'GetPhotoController@getSharedAvatarCrop',
    'as' => 'shared.avatar.crop'
]);

Route::get('sharedacover/{userid}/{filename}', [
    'uses' => 'GetPhotoController@getSharedCover',
    'as' => 'shared.cover'
]);

Route::get('sharedaaudio/{userid}/{filename}', [
    'uses' => 'GetPhotoController@getSharedAudio',
    'as' => 'shared.audio'
]);

Route::get('sharedavideo/{userid}/{filename}', [
    'uses' => 'GetPhotoController@getSharedVideo',
    'as' => 'shared.video'
]);


Route::group(['middleware'=>'auth'], function(){

    Route::get('/',[
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    Route::post('/postsharepost',[
        'uses' => 'PostController@postSharePost',
        'as' => 'post.share.post'
    ]);

    Route::post('/postsharephoto',[
        'uses' => 'PostController@postSharePhoto',
        'as' => 'post.share.photo'
    ]);

    Route::post('/postsharephotoauto',[
        'uses' => 'PostController@postSharePhotoAuto',
        'as' => 'post.share.photo.auto'
    ]);

    Route::post('/postshareaudio',[
        'uses' => 'PostController@postShareAudio',
        'as' => 'post.share.audio'
    ]);

    Route::post('/postsharevideo',[
        'uses' => 'PostController@postShareVideo',
        'as' => 'post.share.video'
    ]);

    Route::post('/like',[
        'uses' => 'PostController@postLikePost',
        'as' => 'like'
    ]);

    Route::post('/edit',[
        'uses' => 'PostController@postEditPost',
        'as' => 'edit'
    ]);

    Route::get('/deletepost/{user_id}/{post_id}', [
       'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete'
    ]);

    Route::get('/deleteallfilefromlistupload', [
       'uses' => 'PostController@getDeleteAllFileFromListUpload',
        'as' => 'post.delete.list.upload.photo'
    ]);

    Route::get('/deletefilefromlistuploadphoto/{filename}', [
       'uses' => 'PostController@getDeleteFileFromListUploadPhoto',
        'as' => 'post.delete.list.upload.all'
    ]);

    Route::post('/postenablecommentpost', [
       'uses' => 'PostController@postEnableCommentPost',
        'as' => 'post.comment.enable'
    ]);

    Route::post('/uploadavatar', [
        'uses' => 'ProfileController@uploadAvatar',
        'as' => 'upload.avatar'
    ]);

    Route::post('/uploadcoverphoto', [
        'uses' => 'ProfileController@uploadCoverPhoto',
        'as' => 'upload.cover'
    ]);

});
