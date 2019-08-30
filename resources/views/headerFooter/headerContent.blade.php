<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;">
    <div class="container">
        <div class="navbar-header">
            <button style="visibility: hidden;" type="button" class="navbar-toggle btn-search-custom-header btn-custom-header nav-button-toggle" data-toggle="collapse" data-target=".navbar-collapse">
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
                            <button class="btn btn-search-custom-header btn-custom-header" type="button">
                                <i class="fa fa-search font-icon-body" style="padding: 4px;"></i>
                            </button>
                        </span>
                    </div>
                </div>
            @endif
        </div>

        @if (Auth::guest())
            <ul class="nav {{ Auth::guest() ? 'navbar-nav' : 'navbar-top-links' }} navbar-right not-signin">
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
        @else
            <ul class="nav {{ Auth::guest() ? 'navbar-nav' : 'navbar-top-links' }} navbar-right nav-header-menu">
                <li class="dropdown pull-right">
                    <a class="dropdown-toggle opacity-hover" data-toggle="dropdown" role="button" aria-expanded="false" href="#">
                        <div class="avatar-header-img-holder">
                            @if(!$authAvatars->isEmpty())
                                @foreach($authAvatars as $authAvatar)
                                    @if($loop -> last)
                                        @if($authAvatar -> deleted_at == null)
                                            <img class="avatar-img-style avatar-header-img avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar.crop', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar_crop])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                        @else
                                            <img class="avatar-img-style avatar-header-img" src="{{auth()->user()->avatar}}"/>
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <img class="avatar-img-style avatar-header-img" src="{{auth()->user()->avatar}}"/>
                            @endif
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <div class="media">
                            <div class="media-left">
                                @if(!$authAvatars->isEmpty())
                                    @foreach($authAvatars as $authAvatar)
                                        @if($loop -> last)
                                            @if($authAvatar -> deleted_at == null)
                                                <img class="avatar-img-style d-flex align-self-center mr-3 avatar-header-dropdown-img avatar-photo-{{$authAvatar->post_id}}" src="{{route('shared.avatar', ['user_id' => Auth::user()->id, 'filename' => $authAvatar -> avatar])}}" onError="this.onerror=null;this.src='{{auth()->user()->avatar}}';" />
                                            @else
                                                <img class="avatar-img-style d-flex align-self-center mr-3 avatar-header-dropdown-img" src="{{auth()->user()->avatar}}"/>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <img class="avatar-img-style d-flex align-self-center mr-3 avatar-header-dropdown-img" src="{{auth()->user()->avatar}}"/>
                                @endif
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h4>
                                <p><span>@</span>{{Auth::user()->username}}</p>
                                <a href="/{{Auth::user()->username}}">
                                    <button class="btn btn-custom-body form-control">
                                        <i class="fa fa-user fa-fw font-icon-header header-dropdown-icon"></i><span>Profile</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="media-bottom-aaditional">
                            <a href="/">
                                <button class="btn btn-custom-header">
                                    <i class="fa fa-gear fa-fw font-icon-body header-dropdown-icon"></i><span>Setting</span>
                                </button>
                            </a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <button class="btn btn-custom-header">
                                    <i class="fa fa-sign-out fa-fw font-icon-body header-dropdown-icon"></i><span>Logout</span>
                                </button>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </ul>
                </li>
                <li class="pull-right">
                    <a href="/" class="opacity-hover" title="Notifications"><i class="fa fa-bell fa-fw font-icon-header header-icon"></i></a>
                </li>
                <li class="pull-right">
                    <a href="/" class="opacity-hover" title="Messages"><i class="fa fa-envelope fa-fw font-icon-header header-icon"></i></a>
                </li>
                <li class="pull-right">
                    <a href="/" class="opacity-hover" title="Friends"><i class="fa fa-user-plus fa-fw font-icon-header header-icon"></i></a>
                </li>
                <li class="pull-right">
                    <a href="/" class="opacity-hover" title="Home"><i class="fa fa-home fa-fw font-icon-header header-icon"></i></a>
                </li>
            </ul>
        @endif
    </div>
</nav>