<div class="wrapper-avatar">
	<div class="avatar-holder">
		<a href="" class="avatar-holder-img">
			@if(!$avatars->isEmpty())
			    @foreach($avatars as $avatar)
			        @if($loop -> last)
						@if($avatar -> deleted_at == null)
			                <img class="avatar-img-style avatar-profile-img mx-auto d-block avatar-photo-{{$avatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => $user -> id, 'filename' => $avatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{$user->avatar}}';"/>  </br>
			            @else
			                <img src="{{$user->avatar}}" class="avatar-img-style avatar-profile-img mx-auto d-block"/>
			            @endif
			        @endif
			    @endforeach
			@else 
			    <img src="{{$user->avatar}}" class="avatar-img-style avatar-profile-img mx-auto d-block"/>
			@endif

			@if(!Auth::guest())
                @if(Auth::user()->username == $user -> username)
					<span class="a-avatar-change change-profile" onclick="event.preventDefault(); document.getElementById('postAvatar').click();" style="display: none;">
			            <i class="fa fa-camera fa-fw fa-2x font-icon-profile"></i>
			        </span>
                @endif
            @endif
        </a>
	</div>
</div>
