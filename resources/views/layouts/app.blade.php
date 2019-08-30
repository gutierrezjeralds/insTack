<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/instack.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/emojione/sprites/emojione-sprite-{{ config('emojione.spriteSize') }}.min.css"/>
</head>
<body>
    <div id="{{ \Request::is('login') || \Request::is('register') ? 'body-signin-signup' : 'app' }}">

        @if( \Request::is('login') || \Request::is('register') )
            {{--No header footer--}}
        @else
            <div class="wrapper-header">
                @include('headerFooter.headerContent')
            </div>
        @endif

        <div class="wrapper-content">

            @yield('content')

            <div class="wrapper-modals">
                <!-- Modals -->
                @if(!Auth::guest())
                    @include('headerFooter.includes.modals')
                @endif
            </div>

        </div>

        <div class="wrapper-footer">
            @include('headerFooter.footer')
        </div>

    </div>

    <div id="hidden-dom"></div>

    <!-- Scripts -->
    @include('headerFooter.includes.global-scripts')
    <script src="{{ asset('js/instack.js') }}"></script>
    <script src="{{ asset('js/exif.js') }}"></script>
    @include('headerFooter.includes.inline-scripts')

</body>
</html>
