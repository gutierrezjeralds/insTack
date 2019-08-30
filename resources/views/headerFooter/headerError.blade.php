<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle nav-button-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand nav-title" href="{{ url('/') }}">
                {{ config('app.name') }}
            </a>
            @if (!Auth::guest())
            <div class="sidebar-search col-md-6 col-md-offset-1">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search" style="padding: 4px;"></i>
                        </button>
                    </span>
                </div>
            </div>
            @endif
        </div>

        <ul class="nav {{ Auth::guest() ? 'navbar-nav' : 'navbar-top-links' }} navbar-right">
            @if (Auth::guest())
                <!-- Authentication Links -->
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
            <li class="dropdown pull-right">
                <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="#">
                    <div class="avatar-header-img-holder">
                        <span style="display: none;">{{$authAvatars = DB::table('avatars')->where('user_id', Auth::user() ->id)->pluck('avatar')->last()}}</span>
                        @if($authAvatars != null)
                            <img class="avatar_header_img" src="{{route('shared.avatar', ['user_id' => Auth::user()->id, 'filename' => $authAvatars])}}" onError="this.onerror=null;this.src='/images/avatar_default.svg';" /> {{ Auth::user()->first_name }} <i class="fa fa-caret-down"></i>
                        @else 
                            <img class="avatar_header_img" src="/images/avatar_default.svg" class="media-object avatar-content-img"/> {{ Auth::user()->first_name }} <i class="fa fa-caret-down"></i>
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="/"><i class="fa fa-home fa-fw"></i> Home</a></li>
                    <li><a href="/{{ Auth::user()->username }}"><i class="fa fa-user fa-fw"></i> Profile</a></li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out fa-fw">Logout</i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</nav>