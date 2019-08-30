@if(!$avatars->isEmpty())
    @foreach($avatars as $avatar)
        @if($loop -> last)
			@if($avatar -> deleted_at == null)
	            <div class="avatar-profile-img-holder">
	                <img class="img-avatar img-thumbnail" src="{{route('shared.avatar', ['user_id' => $user -> id, 'filename' => $avatar -> avatar])}}" onError="this.onerror=null;this.src='/images/avatar/default-avatar_{{$user->gender == 1 ? 'man' : 'woman'}}.png';"/>  </br>
	            </div>
            @else
                <img src="/images/avatar/default-avatar_{{$user->gender == 1 ? 'man' : 'woman'}}.png" class="img-avatar img-thumbnail"/>
            @endif
        @endif
    @endforeach
@else 
    <img src="/images/avatar/default-avatar_{{$user->gender == 1 ? 'man' : 'woman'}}.png" class="img-avatar img-thumbnail"/>
@endif