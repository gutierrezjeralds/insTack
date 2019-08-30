@extends('layouts.app')

@section('content')
    <div id="signin-signup" class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div id="wrapper">
                    <div id="login" class="animated fadeInDown">
                        <div class="flex-center position-ref full-height">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h1 class="text-center">Login</h1>
                                </div>
                                <div class="panel-body">
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    {!! Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'E-Mail Address', 'required']) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Password', 'required']) !!}
                                                </div>
                                            </div>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" name="login" class="btn btn-custom-body form-control">
                                                    <i class="fa fa-sign-in fa-fw font-icon-header header-dropdown-icon"></i><span>Login</span>
                                                </button>
                                                {{--{!! Form::submit('Login', ['class'=>'btn btn-primary form-control']) !!}--}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    Forgot Your Password?
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="panel-footer">
                                    <div class="form-group">
                                        <div class="btn-holder-footer">
                                            <h3 class="text-center">Don't have an Account?</h3>
                                            <a href="{{ route('register')}}" class="to_register">
                                                <button class="btn btn-custom-header form-control">
                                                    <i class="fa fa-user fa-fw font-icon-body header-dropdown-icon"></i><span>Create Account Now</span>
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
