<div class="wrapper-create">
	<div class="panel panel-default share-a-photo">
		<div class="panel-heading">
			<i class="fa fa-pencil fa-fw font-icon-body"></i> Write a post |
			<i class="fa fa-upload fa-fw font-icon-body"></i> Upload media
		</div>
		<div class="panel-body text-center">
			<div class="btn-post-create" style="display: none;">
				<button class="btn btn-custom-header btn-for-post" id="btnWritePost" type="button" title="Write a post">
					<i class="fa fa-pencil-square font-icon-body fa-3x v-align-middle" aria-hidden="true"></i>  <span class="text-btn-for-post">Write</span>
				</button>
				<button class="btn btn-custom-header btn-for-post" id="btnUploadPhoto" type="button" title="Upload photo" onclick="event.preventDefault(); document.getElementById('ajax-upload-id-photo').click();">
					<i class="fa fa-camera-retro font-icon-body fa-3x v-align-middle" aria-hidden="true"></i> <span class="text-btn-for-post">Photo</span>
				</button>
				<button class="btn btn-custom-header btn-for-post" id="btnUploadAudio" type="button" title="Upload audio" onclick="event.preventDefault(); document.getElementById('postAudio').click();">
					<i class="fa fa-headphones font-icon-body fa-3x v-align-middle" aria-hidden="true"></i> <span class="text-btn-for-post">Audio</span>
				</button>
				<button class="btn btn-custom-header btn-for-post" id="btnUploadVideo" type="button" title="Upload video" onclick="event.preventDefault(); document.getElementById('postVideo').click();">
					<i class="fa fa-video-camera font-icon-body fa-3x v-align-middle" aria-hidden="true"></i> <span class="text-btn-for-post">Video</span>
				</button>
			</div>
			<div class="btn-post-create-load">
				<i class="fa fa-spinner faa-spin animated fa-2x fa-fw v-align-middle"></i>
			</div>
		</div>
	</div>

	<div class="pannel-post-create-open" id="pannelPost" style="display: block">
	    <div class="panel panel-default animated fadeIn" id="uploadWritePost" style="display: none">
        	{!! Form::open(['method'=>'POST', 'action'=>'PostController@postSharePost']) !!}
			<div class="panel-body">
				<div class="media">
                    <div class="media-left">
                        @if(!$authAvatars->isEmpty())
                            @foreach($authAvatars as $authAvatar)
                                @if($loop -> last)
                                    @if($authAvatar -> deleted_at == null)
                                        <img class="media-object avatar-content-img avatar-img-style avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                    @else
                                        <img class="media-object avatar-content-img avatar-img-style" src="{{auth()->user()->avatar}}"/>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <img src="{{auth()->user()->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                        @endif
                    </div>
                    <div class="media-body write-post-holder">
                        <div class="form-group {{ $errors->has('caption') ? ' has-error' : '' }}">
                            {!! Form::textarea('caption', null, ['class'=>'form-control hidden', 'id' => 'caption', 'rows' => '3', 'placeholder' => 'Pin your taughts.' , '']) !!}
                            @if ($errors->has('caption'))
                                <span class="help-block">
		                            <strong>{{ $errors->first('caption') }}</strong>
		                        </span>
                            @endif
                            <div class="caption caption-write-post-here" contenteditable="true" placeholder="Pin your taughts."></div>
                        </div>
                        <div class="form-group caption-bg-list">
                            <ul class="list-inline text-center">
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                                <li class="list-inline-item"> &nbsp; </li>
                            </ul>
                        </div>
                        <div class="form-group" style="display: none;">
                            {!! Form::text('caption_bg', null, ['class'=>'form-control', 'id' => 'captionBg']) !!}
                        </div>
                    </div>
                </div>
			</div>
			<div class="panel-footer">
                {!! Form::button('<i class="fa fa-times fa-1x font-icon-body" aria-hidden="true"></i> <span> Close</span>', ['data-dismiss' => 'modal', 'class'=>'btn btn-custom-header btn-pin-post-close']) !!}
                {!! Form::button('<i class="fa fa-thumb-tack fa-1x font-icon-header" aria-hidden="true"></i> <span> Pin</span>', ['type'=>'submit', 'class'=>'btn btn-custom-body pull-right btn-pin-post btn-pin-write-post', 'disabled']) !!}
			</div>
            {!! Form::close() !!}
		</div>

	    <div class="panel panel-default animated fadeIn" id="uploadMediaPhoto" style="display: none;">
        	{!! Form::open(['method'=>'POST', 'action'=>'PostController@postSharePhoto', 'files'=>true]) !!}
			<div class="panel-body">
				<div class="media">
                    <div class="media-left">
                        @if(!$authAvatars->isEmpty())
                            @foreach($authAvatars as $authAvatar)
                                @if($loop -> last)
                                    @if($authAvatar -> deleted_at == null)
                                        <img class="media-object avatar-content-img avatar-img-style avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                    @else
                                        <img class="media-object avatar-content-img avatar-img-style" src="{{auth()->user()->avatar}}"/>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <img src="{{auth()->user()->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                        @endif
                    </div>
                    <div class="media-body upload-photo-holder">
                        <div class="upload-file-holder">
                            <div class="form-group upload-file-caption upload-file-photo-caption {{ $errors->has('caption') ? ' has-error' : '' }}" style="display: block">
                                {!! Form::textarea('caption', null, ['class'=>'form-control hidden', 'id' => 'caption', 'rows' => '3', 'placeholder' => 'Pin your moments.' , '']) !!}
                                @if ($errors->has('caption'))
                                    <span class="help-block">
											<strong>{{ $errors->first('caption') }}</strong>
										</span>
                                @endif
                                <div class="caption caption-write-post-here" contenteditable="true" placeholder="Pin your moments."></div>
                            </div>
                        </div>
                    </div>
                </div>
            	<div class="media">
                    <div class="media-body upload-photo-holder">
                        <div class="upload-file-holder">
                            <!-- <div class="form-group {{ $errors->has('photo') ? ' has-error' : '' }}">
                                {!! Form::file('photo[]', ['class'=>'form-control upload-file-input', 'id'=>'postPhoto', 'style'=>'display:none', 'multiple'=>true, 'accept'=>'image/*']) !!}
                                @if ($errors->has('photo'))
                                    <span class="help-block">
										<strong>{{ $errors->first('photo') }}</strong>
									</span>
                                @endif
                            </div> -->
                            <div class="form-group" id="photoPreview">
            					<hr class="divider-custom">

                                <div id="file-uploader-photo" style="display: none;">Add photos</div>
                                <input type="hidden" value="0" class="hidden-config-file-uploader-photo">

                                <ul class="list-inline text-center">
                					<hr class="divider-custom">
                                    <li class="list-inline-item list-inline-item-post">
                                        <button class="btn btn-custom-body btn-add-post-photo form-control" type="button" onclick="event.preventDefault(); document.getElementById('ajax-upload-id-photo[]').click();">
                                            <i class="fa fa-camera-retro font-icon-header fa-2x v-align-middle" aria-hidden="true"></i> <span class="upload-file-text"> Add photos</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="panel-footer">
                {!! Form::button('<i class="fa fa-times fa-1x font-icon-body" aria-hidden="true"></i> <span> Close</span>', ['data-dismiss' => 'modal', 'class'=>'btn btn-custom-header btn-pin-post-close']) !!}
                {!! Form::button('<i class="fa fa-thumb-tack fa-1x font-icon-header" aria-hidden="true"></i><span> Pin</span>', ['type'=>'submit', 'class'=>'btn btn-custom-body pull-right btn-pin-post btn-pin-upload-photo-post', 'disabled']) !!}
			</div>
            {!! Form::close() !!}
		</div>
		
	    <div class="panel panel-default animated fadeIn" id="uploadMediaAudio" style="display: none">
        	{!! Form::open(['method'=>'POST', 'action'=>'PostController@postShareAudio', 'files'=>true]) !!}
			<div class="panel-body">
				<div class="media">
                    <div class="media-left">
                        @if(!$authAvatars->isEmpty())
                            @foreach($authAvatars as $authAvatar)
                                @if($loop -> last)
                                    @if($authAvatar -> deleted_at == null)
                                        <img class="media-object avatar-content-img avatar-img-style avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                    @else
                                        <img class="media-object avatar-content-img avatar-img-style" src="{{auth()->user()->avatar}}"/>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <img src="{{auth()->user()->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                        @endif
                    </div>
                 	<div class="media-body upload-audio-holder">
                        <div class="upload-file-holder">
                            <div class="form-group upload-file-caption upload-file-audio-caption {{ $errors->has('caption') ? ' has-error' : '' }}" style="display: none">
                                {!! Form::textarea('caption', null, ['class'=>'form-control hidden', 'id' => 'caption', 'rows' => '3', 'placeholder' => 'Pin your moments.' , '']) !!}
                                @if ($errors->has('caption'))
                                    <span class="help-block">
											<strong>{{ $errors->first('caption') }}</strong>
										</span>
                                @endif
                                <div class="caption caption-write-post-here" contenteditable="true" placeholder="Pin your moments."></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="media">
                	<div class="media-body upload-audio-holder">
                        <div class="upload-file-holder">
                            <div class="form-group {{ $errors->has('audio') ? ' has-error' : '' }}">
                                {!! Form::file('audio[]', ['class'=>'form-control upload-file-input', 'id'=>'postAudio', 'style'=>'display:none', 'multiple'=>true, 'accept'=>'audio/*']) !!}
                                @if ($errors->has('audio'))
                                    <span class="help-block">
											<strong>{{ $errors->first('audio') }}</strong>
										</span>
                                @endif
                            </div>
                            <div class="form-group file-upload" id="audioPreview">
                            	<hr class="divider-custom">
                                <ul class="list-inline text-center">
                                	<hr class="divider-custom">
                                    <li class="list-inline-item list-inline-item-post">
                                        <button class="btn btn-custom-body btn-add-post-audio" type="button" onclick="event.preventDefault(); document.getElementById('postAudio').click();">
                                            <i class="fa fa-headphones font-icon-header fa-2x v-align-middle" aria-hidden="true"></i> <span class="upload-file-text"> Upload audio</span>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
			<div class="panel-footer">
                {!! Form::button('<i class="fa fa-times fa-1x font-icon-body" aria-hidden="true"></i> <span> Close</span>', ['data-dismiss' => 'modal', 'class'=>'btn btn-custom-header btn-pin-post-close']) !!}
                {!! Form::button('<i class="fa fa-thumb-tack fa-1x font-icon-header" aria-hidden="true"></i><span> Pin</span>', ['type'=>'submit', 'class'=>'btn btn-custom-body pull-right btn-pin-post btn-pin-upload-audio-post', 'disabled']) !!}
			</div>
            {!! Form::close() !!}
		</div>
		
	    <div class="panel panel-default animated fadeIn" id="uploadMediaVideo" style="display: none">
        	{!! Form::open(['method'=>'POST', 'action'=>'PostController@postShareVideo', 'files'=>true]) !!}
			<div class="panel-body">
				<div class="media">
                    <div class="media-left">
                        @if(!$authAvatars->isEmpty())
                            @foreach($authAvatars as $authAvatar)
                                @if($loop -> last)
                                    @if($authAvatar -> deleted_at == null)
                                        <img class="media-object avatar-content-img avatar-img-style avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                    @else
                                        <img class="media-object avatar-content-img avatar-img-style" src="{{auth()->user()->avatar}}"/>
                                    @endif
                                @endif
                            @endforeach
                        @else
                            <img src="{{auth()->user()->avatar}}" class="media-object avatar-content-img avatar-img-style"/>
                        @endif
                    </div>
                 	<div class="media-body upload-video-holder">
                        <div class="upload-file-holder">
                            <div class="form-group upload-file-caption upload-file-video-caption {{ $errors->has('caption') ? ' has-error' : '' }}" style="display: none">
                                {!! Form::textarea('caption', null, ['class'=>'form-control hidden', 'id' => 'caption', 'rows' => '3', 'placeholder' => 'Pin your moments.' , '']) !!}
                                @if ($errors->has('caption'))
                                    <span class="help-block">
											<strong>{{ $errors->first('caption') }}</strong>
										</span>
                                @endif
                                <div class="caption caption-write-post-here" contenteditable="true" placeholder="Pin your moments."></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="media">
                 	<div class="media-body upload-video-holder">
                        <div class="upload-file-holder">
                            <div class="form-group {{ $errors->has('video') ? ' has-error' : '' }}">
                                {!! Form::file('video[]', ['class'=>'form-control upload-file-input', 'id'=>'postVideo', 'style'=>'display:none', 'accept'=>'video/*']) !!}
                                @if ($errors->has('video'))
                                    <span class="help-block">
											<strong>{{ $errors->first('video') }}</strong>
										</span>
                                @endif
                            </div>
                            <div class="form-group file-upload" id="videoPreview">
                            	<hr class="divider-custom">
                                <ul class="list-inline text-center">

                                </ul>
                            </div>
                        </div>
            	 	</div>
                </div>
			</div>
			<div class="panel-footer">
                {!! Form::button('<i class="fa fa-times fa-1x font-icon-body" aria-hidden="true"></i> <span> Close</span>', ['data-dismiss' => 'modal', 'class'=>'btn btn-custom-header btn-pin-post-close']) !!}
                {!! Form::button('<i class="fa fa-thumb-tack fa-1x font-icon-header" aria-hidden="true"></i><span> Pin</span>', ['type'=>'submit', 'class'=>'btn btn-custom-body pull-right btn-pin-post btn-pin-upload-video-post', 'disabled']) !!}
			</div>
            {!! Form::close() !!}
		</div>
	</div>
</div>