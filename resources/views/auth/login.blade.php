@extends('layouts.admin2')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{config('app.name')}}</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="POST" action="{{ route('login') }}">
                        <fieldset>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div> -->
                            <!-- Change this to a button or input when using this as a form -->
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-lg btn-success btn-block">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>

                                    {{-- <a class="btn btn-link" href="{{ route('register') }}">
                                        Register
                                    </a> --}}
                                </div>
                            </div>
                        </fieldset>
                        {{ csrf_field() }}
                    </form>
                    @if(Session::has('flash_message'))
                        <div class="alert-box success">
                            <h2>{{ Session::get('flash_message') }}</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
