@extends('layouts.app')

@section('content')
{{--<div class="album text-muted">
        <div class="container">

            <div class="row">
                <h1>Welcome to the Secure Portal!</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas dolor vulputate quam convallis consequat.
                    Quisque eu lorem eget magna lacinia suscipit. Maecenas condimentum vehicula eros. Fusce massa lacus, blandit et leo sed,
                    accumsan commodo sem. Sed eget pulvinar tellus. Praesent ex diam, sodales at consequat id, viverra ut dolor.
                    In eget orci sit amet magna sagittis mattis sit amet sed augue. Vivamus facilisis libero ligula, vel sodales ipsum sollicitudin id.
                    Duis vitae urna rutrum, dignissim arcu ac, elementum augue. Quisque id interdum ligula. Donec tincidunt feugiat massa sed aliquam.
                    Duis eu vehicula turpis.
                </p>
            </div>
        </div>
    </div>--}}
    <section class="jumbotron text-center">
        <div class="container">
            {{--<h1 class="jumbotron-heading">Welcome to the Secure Portal!</h1>
            <p class="lead text-muted">
                XThe Safe Haven Network provides dedicated housing options for domestic violence victims and their pets by placing the pets in shelters and foster homes while the victims stay in domestic violence shelters.
            </p>--}}
            {{--<p>
                By providing a dedicated service for domestic violence victims to escape abuse with their pets, The Safe Haven Network offers the safety options, support and the peace of mind that your pet is free from abuse as well.
            </p>--}}
            <div class="row">
                <div class="col-lg-4 col-md-3">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    @if ($errors->any())
                        <div>
                            <p>invalid credentials</p>
                        </div>
                    @endif
                    <form   class="form-signin"
                            method="post"
                            action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h2 class="form-signin-heading">Please sign in</h2>
                        <label  for="inputEmail" class="sr-only">Email address</label>
                        <input  type="email" 
                                id="inputEmail" 
                                class="form-control" 
                                placeholder="Email address"
                                name="email"
                                value="{{ old('email') }}"
                                required autofocus>
                        <label  for="inputPassword" 
                                class="sr-only">Password</label>
                        <input  type="password" 
                                id="inputPassword" 
                                class="form-control" 
                                placeholder="Password"
                                name="password" 
                                required>
                        <button class="btn btn-lg btn-primary btn-block" 
                                type="submit">Sign in</button>
                        <div class="forgot_pass">
                        <label>
                            <input  type="checkbox" 
                                    name="remember" 
                                    {{ old('remember') ? 'checked' : '' }}
                                    > Remember me
                        </label>
                            <a href="{{ route('password.request') }}" class="badge badge-light">Forgot your password?</a>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-3">
                </div>
            </div>




        </div>
    </section>











<?php  /*
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
*/ ?>
@endsection
