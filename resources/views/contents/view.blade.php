@extends('layouts.app')

@section('content')
<section class="wrapper-view">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                
                @include('contents.includes.postView')
                
            </div>
        </div>
    </div>
</section>
@endsection
