<div class="wrapper-cover-photo">
	<div class="col-md-12 cover-photo-holder" id="coverPreview">
		<a href="">
			<span class="cover-photo-default">
				@if(!$covers->isEmpty())
				    @foreach($covers as $cover)
				        @if($loop -> last)
							@if($cover -> deleted_at == null)
			                	<img class="cover-photo-img cover-photo-{{$cover->post_id}}" src="{{route('shared.cover', ['user_id' => $user -> id, 'filename' => $cover -> cover_photo])}}" onError="this.onerror=null;this.src='/images/background/background-3.jpg';"/ style="{{$cover->cover_position}}">
				            @else
				                <img class="cover-photo-img" src="/images/background/background-3.jpg" />
				            @endif
				        @endif
				    @endforeach
				@else 
					<img class="cover-photo-img" src="/images/background/background-3.jpg" />
				@endif
			</span>
        </a>

        @if(!Auth::guest())
            @if(Auth::user()->username == $user -> username)
				<span class="a-cover-photo change-profile btn-upload-cover" onclick="event.preventDefault(); document.getElementById('postCoverPhoto').click();" style="display: none;">
		            <i class="fa fa-camera fa-fw fa-1x font-icon-profile"></i> Change cover photo
		        </span>

		        <div class="cover-position-text flex-center" style="visibility: hidden;">
			        <span>
			        	<i class="fa fa-arrows fa-fw fa-1x font-icon-body"></i><span>Reposition cover photo upload</span>
			        </span>
		        </div>

				<span class="a-cover-photo btn-save-cover" style="display: none;">
	        	 	<button class="btn btn-custom-body form-control" onclick="event.preventDefault(); document.getElementById('cover-photo-form').submit();">
                        <i class="fa fa-thumb-tack fa-fw fa-1x font-icon-header"></i><span>Save changes</span>
                    </button>
		        </span>

				<span class="a-cover-photo btn-cancel-cover" style="display: none;">
	        	 	<button class="btn btn-custom-header btn-pin-post-close form-control">
                        <i class="fa fa-times fa-fw fa-1x font-icon-body"></i><span>Cancel</span>
                    </button>
		        </span>
            @endif
        @endif
	</div>

        {!! Form::open(['id'=>'cover-photo-form', 'method'=>'POST', 'action'=>'ProfileController@uploadCoverPhoto', 'files'=>true, 'style'=>'display:none']) !!}
        	{!! Form::file('cover[]', ['class'=>'form-control upload-file-input', 'id'=>'postCoverPhoto', 'style'=>'display:none', 'accept'=>'image/*']) !!}
        	{!! Form::text('cover_position', null, ['class'=>'form-control cover-photo-position-field', 'style'=>'display:none']) !!}
        {!! Form::close() !!}
</div>
