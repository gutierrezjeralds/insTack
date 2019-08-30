<div id="post-data" class="wrapper-post-data">
    @if($posts)
        @foreach($posts as $post)
        <div class="panel panel-default view-post-data" data-unknown="{{$post -> user_id}}" data-tack="{{$post -> id}}">
            <div class="panel-heading">
                <div class="btn-group btn-dropdown-menu-post pull-right">
                    <a href="#" class="toggle-dropdown opacity-hover" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-caret-down fa-fw fa-2x font-icon-body"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right a-href-div">
                    @if (Auth::user() == $post->user)
                      <li>
                        <a href="#" class="edit-post"><i class="fa fa-pencil font-icon-body"></i> Edit</a>
                      </li>
                      <li>
                        <a href="#" class="delete-post"><i class="fa fa-trash font-icon-body"></i> Delete</a>
                      </li>
                      <li>
                        <a href="#" class="comment-post"><i class="fa {{ $post->comment_hide == 0 ? 'fa-ban' : 'fa-check' }} font-icon-body"></i><span> {{ $post->comment_hide == 0 ? 'Disable comment' : 'Enable comment' }}</span></a>
                        <input type="text" name="comment_hide" class="comment_hide_field" value="{{$post->comment_hide}}" style="display: none;">
                      </li>
                    @endif
                        <li>
                            <a href="#" class="copyButtonURL"><i class="fa fa-clone font-icon-body"></i> Copy link address</a>
                            <input type="text" id="copyTargetURL-{{$post -> id}}" value="http://instack.com/{{$post -> username}}/post/{{$post -> id}}" style="display: none;">
                        </li>
                    </ul>
                </div>
                <div class="media">
                    <div class="media-left">
                        <a href="/{{$post->username}}">
                            <span style="display: none;">{{$postsAvatars = DB::table('avatars')->select('avatar', 'avatar_crop', 'post_id', 'deleted_at')->where('user_id', $post->user_id)->get()}}</span>
                            @if(!$postsAvatars->isEmpty())
                                @foreach($postsAvatars as $postsAvatar)
                                    @if($loop -> last)
                                        @if($postsAvatar -> deleted_at == null)
                                            <img class="media-object avatar-content-img avatar-img-style avatar-photo-{{$postsAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => $post -> user_id, 'filename' => $postsAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{$post->user->avatar}}';"/>
                                        @else
                                            <img src="{{$post->user->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                                        @endif
                                    @endif
                                @endforeach
                            @else 
                                <img src="{{$post->user->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                            @endif
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <a href="/{{$post->username}}">
                                {{$post -> user -> first_name}} {{$post -> user -> last_name}}
                            </a>

                            @if($post -> photo_id != 0)
                                <span class="text-for-after-name-info"> pin {{$post->user->gender == 1 ? ' his' : 'her' }} moment.</span>
                            @elseif($post -> avatar_id != 0)
                                <span class="text-for-after-name-info"> change {{$post->user->gender == 1 ? ' his' : 'her' }} profile picture.</span>
                            @elseif($post -> cover_id != 0)
                                <span class="text-for-after-name-info"> change {{$post->user->gender == 1 ? ' his' : 'her' }} cover photo.</span>
                            @elseif($post -> audio_id != 0)
                                <span class="text-for-after-name-info"> pin {{$post->user->gender == 1 ? ' his' : 'her' }} audio.</span>
                            @elseif($post -> video_id != 0)
                                <span class="text-for-after-name-info"> pin {{$post->user->gender == 1 ? ' his' : 'her' }} video.</span>
                            @else
                                <span class="text-for-after-name-info"> pin {{$post->user->gender == 1 ? ' his' : 'her' }} taught.</span>
                            @endif
                            
                        </h4>
                        <p>
                            @if( $post -> created_at -> diffInHours() >= "24" )
                                {{$post -> created_at -> format('j F Y')}} at 
                                {{$post -> created_at -> format('H')}}:{{$post -> created_at -> format('i')}} 
                                {{$post -> created_at != $post -> updated_at ? '(Edited)' : '' }}
                            @else
                                {{ $post -> created_at -> diffforHumans() }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body" id="panelPost">
                <center><img class="pin-post-img" src="/images/pin-img/pin-blue.png"></center>
                @if( $post -> avatar_id != 0 || $post -> cover_id != 0 || $post -> photo_id != 0 || $post -> caption_bg != null )
                    <div class="outer div-pin-post div-pin-post-with-rotate" style="background: {{$post -> caption_bg}}">
                @else
                    <div class="outer div-pin-post" style="background: {{$post -> caption_bg}}">
                @endif

                    @if($post -> caption != null)
                        @if( $post -> caption_bg != null )
                            <div class="caption-parent">
                                <div class="caption-child">
                                    <div class="post-caption caption-style">{!! $post->caption !!}</div>
                                </div>
                            </div>
                        @else
                            <div class="post-caption">{!! $post->caption !!}</div>
                        @endif
                    @endif

                    @if( $post -> avatar_id != 0 || $post -> cover_id != 0 || $post -> photo_id != 0 )
                        <span style="display: none;">{{$sharedPhotos = DB::table('photos')->select('photo')->where('post_id', $post->id)->get()}}</span>
                        <span style="display: none;">{{$sharedAvatars = DB::table('avatars')->select('avatar')->where('post_id', $post->id)->get()}}</span>
                        <span style="display: none;">{{$sharedCovers = DB::table('covers')->select('cover_photo')->where('post_id', $post->id)->get()}}</span>
                        
                        <div class="form-group div-image div-image-carousel">
                            <div id="sharedPhotos-{{$post->id}}" class="carousel slide" data-ride="carousel">
                                <!-- Number of Carousel Items -->
                                @foreach($sharedPhotos as $sharePhoto)
                                    @if($loop->count > 1)
                                        @if($loop->first)
                                            <div class="num-carousel-items"></div>
                                        @endif
                                    @endif
                                @endforeach
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    @foreach($sharedPhotos as $sharePhoto)
                                        @if($loop->count > 1)
                                            <li data-target="#sharedPhotos-{{$post->id}}" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                        @endif
                                    @endforeach
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    @foreach($sharedPhotos as $sharePhoto)
                                        <div class="item {{ $loop->first ? ' active' : '' }}" >
                                            <img src="{{route('shared.photo', ['user_id' => $post -> user_id, 'filename' => $sharePhoto -> photo])}}" id='img-post' class="img-responsive" onError="this.onerror=null;this.src='/images/not-found/file-not-found.png';"/>
                                        </div>
                                    @endforeach
                                    @foreach($sharedAvatars as $sharedAvatar)
                                        <div class="item {{ $loop->first ? ' active' : '' }}" >
                                            <img src="{{route('shared.avatar', ['user_id' => $post -> user_id, 'filename' => $sharedAvatar -> avatar])}}" id='img-post' class="img-responsive" onError="this.onerror=null;this.src='/images/not-found/file-not-found.png';"/>
                                        </div>
                                    @endforeach
                                    @foreach($sharedCovers as $sharedCover)
                                        <div class="item {{ $loop->first ? ' active' : '' }}" >
                                            <img src="{{route('shared.cover', ['user_id' => $post -> user_id, 'filename' => $sharedCover -> cover_photo])}}" id='img-post' class="img-responsive" onError="this.onerror=null;this.src='/images/avatar/not-found/file-not-found.png';"/>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Controls -->
                                @foreach($sharedPhotos as $sharePhoto)
                                    @if($loop->count > 1)
                                        @if($loop->first)
                                            <a class="left carousel-control" href="#sharedPhotos-{{$post->id}}" role="button" data-slide="prev">
                                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="right carousel-control" href="#sharedPhotos-{{$post->id}}" role="button" data-slide="next">
                                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                         @endif
                                     @endif
                                 @endforeach
                            </div>
                        </div>
                    @elseif( $post -> audio_id != 0 )
                        <span style="display: none;">{{$sharedAudios = DB::table('audios')->select('audio')->where('post_id', $post->id)->get()}}</span>
                        @foreach($sharedAudios as $sharedAudio)
                            <audio controls style="width: 100%">
                                <source src="{{route('shared.audio', ['user_id' => $post -> user_id, 'filename' => $sharedAudio -> audio])}}" type="audio/mp3" onError="this.onerror=null;this.src='/images/avatar/not-found/file-not-found.png';">
                                Your browser does not support the audio element.
                            </audio>
                        @endforeach
                    @elseif( $post -> video_id != 0 )
                        <span style="display: none;">{{$sharedVideos = DB::table('videos')->select('video')->where('post_id', $post->id)->get()}}</span>
                        @foreach($sharedVideos as $sharedVideo)
                            <video  controls style="width: 100%">
                                <source src="{{route('shared.video', ['user_id' => $post -> user_id, 'filename' => $sharedVideo -> video ])}}" type="video/mp4" onError="this.onerror=null;this.src='/images/avatar/not-found/file-not-found.png';">
                                Your browser does not support the video  element.
                            </video >
                        @endforeach
                    @endif
                </div>

            </div>
            @if (Auth::guest())
                <div class="interaction">
                    <a class="like-count" href="#" data-toggle="modal" data-target="#likeCountModal" style="margin-left:10px;">{{$post->likes()->where(['like' => '1'])->count()}} Like</a>
                    <span class="pull-right">
                        <a href="#"><i class="fa fa-comment-o fa-fw"></i> Comment</a>
                    </span>
                </div>
            @else
                <div class="interaction">
                    <a href="#" class="like {{Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'faa-parent animated-hover likeThis' : 'unlikeThis' : 'unlikeThis'}}">
                        <span class="fa fa-fw fa-2x {{Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? ' fa-thumbs-up faa-bounce' : ' fa-thumbs-o-up' : ' fa-thumbs-o-up'}}"></span> Like
                    </a>
                    <a class="like-count {{$post->likes()->where(['like' => '1'])->count() == 0 ? ' like-count-zero' : '' }}" href="#" data-toggle="modal" data-target="#likeCountModal" style="margin-left:10px;">{{$post->likes()->where(['like' => '1'])->count()}}</a>
                    <span class="pull-right comment-box" style="display: {{ $post->comment_hide == 0 ? 'block' : 'none' }}">
                        <a href=""><i class="fa fa-comment fa-fw fa-2x"></i> Comment</a>
                    </span>
                </div>
            @endif
        </div>
        @endforeach
    @endif
</div>
