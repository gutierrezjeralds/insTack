@extends('layouts.app')

@section('content')
<div id="signin-signup" class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div id="wrapper">
                <div id="register" class="animated fadeInDown">
                    <div class="flex-center position-ref full-height">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h1 class="text-center">Register</h1>
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <div class="col-md-6 reg-first-name">
                                            {!! Form::text('first_name', null, ['class'=>'form-control', 'placeholder'=>'First Name', 'required']) !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::text('last_name', null, ['class'=>'form-control', 'placeholder'=>'Last Name', 'required']) !!}
                                        </div>
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            {!! Form::text('username', null, ['class'=>'form-control', 'placeholder'=>'Username', 'required']) !!}
                                            @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'E-Mail Address', 'required']) !!}
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            {!! Form::select('gender', array(1 => 'Male', 2 => 'Female'), null, ['placeholder' => 'Select Gender', 'class'=>'selectpicker form-control', 'required']) !!}
                                            @if ($errors->has('gender'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('birthdayInput') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            {!! Form::label('birthday', 'Birthday:') !!}
                                            {!! Form::text('birthdayInput', null, ['class'=>'birthday-field', 'id'=>'row-col', 'required']) !!}
                                            @if ($errors->has('birthdayInput'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('birthdayInput') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <div class="col-md-12">
                                            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password', 'required']) !!}
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" name="register" class="btn btn-custom-body form-control">
                                                <i class="fa fa-user fa-fw font-icon-header header-dropdown-icon"></i><span>Register</span>
                                            </button>
                                            {{--{!! Form::submit('Register', ['class'=>'btn btn-success form-control']) !!}--}}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">
                                <div class="form-group">
                                    <div class="btn-holder-footer">
                                        <h3 class="text-center">Already have an Account?</h3>
                                        <a href="/" class="to_login">
                                            <button class="btn btn-custom-header form-control">
                                                <i class="fa fa-sign-in fa-fw font-icon-body header-dropdown-icon"></i><span>Login to your existing Account</span>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
