@extends('layouts.app')

@section('content')
<section class="wrapper-profile">
    <div class="container">
        <div class="row">

            @include('contents.includes.coverPhoto')

            <div class="col-md-4 col-md-offset-4 text-center">
                @include('contents.includes.avatar')
            </div>
                
            <div class="col-md-6 col-md-offset-3 m-top-20">
                @if(!Auth::guest())
                    @include('contents.includes.postCreate')
                @endif

                @include('contents.includes.postView')

                @include('contents.includes.postEmpty')

                @include('contents.includes.postLoadMore')

            </div>
        </div>
    </div>
</section>
@endsection
