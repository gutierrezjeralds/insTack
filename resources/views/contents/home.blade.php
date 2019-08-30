@extends('layouts.app')

@section('content')
<section class="wrapper-home">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('contents.includes.postCreate')

                @include('contents.includes.postView')

                @include('contents.includes.postEmpty')

                @include('contents.includes.postLoadMore')
            </div>
        </div>
    </div>
</section>
@endsection
