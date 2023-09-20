@extends('layouts.app')
@section('content')

        <div class="login-box"  >
            <div class="login-logo mt-5">

            </div>
            <!-- /.login-logo -->
            <div class="card">
                @include('layouts.flash-message')
                <div class="card-body login-card-body">

                    <div>
                        {{--                    <img src="{{ URL::to('/') }}/assets/mbm.png" style="--}}
                        {{--                                               display: block;--}}
                        {{--                                               margin-left: auto;--}}
                        {{--                                              margin-right: auto;--}}
                        {{--                                                width: 70%;--}}
                        {{--"/>--}}
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group mb-4 mt-4">
                            {{--                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
                            <input id="username" type="username"
                                   class="form-control @error('username') is-invalid @enderror form-control-lg " name="username"
                                   value="{{ old('username') }}" required autofocus placeholder="username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-4">
                            <input id="password" type="password"
                                   class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password" placeholder="password">

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                        {{--                        <div class="col-8">--}}
                        {{--                            <div class="icheck-primary">--}}
                        {{--                                <input type="checkbox" id="remember">--}}
                        {{--                                <label for="remember">--}}
                        {{--                                    Remember Me--}}
                        {{--                                </label>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <!-- /.col -->
                            <div class="col-12 mb-4">
                                <button type="submit" class="btn btn-info bg-gradient-info btn-block btn-lg" >Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <!-- /.social-auth-links -->

                </div>
                <!-- /.login-card-body -->
            </div>
        </div>


    <!-- /.login-box -->
    {{--   <div class="login-box">--}}
    {{--            <div class="login-logo">--}}

    {{--            </div>--}}
    {{--            <!-- /.login-logo -->--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body login-card-body">--}}
    {{--                    <div style="height: 40px;">--}}
    {{--                        <img src="{{ URL::to('/') }}/assets/mbm.png" class="float-left position-relative mt-5" style="--}}
    {{--                          height: 138px;--}}
    {{--                            width: 300px;--}}
    {{--                            margin-bottom: -20px;--}}
    {{--                            margin-left: 9px;" />--}}
    {{--                    </div>--}}

    {{--                    <form method="POST" action="{{ route('login') }}">--}}
    {{--                        @csrf--}}

    {{--                        <div class="input-group mb-3">--}}
    {{--                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
    {{--                            <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required  autofocus>--}}
    {{--                            <div class="input-group-append">--}}
    {{--                                <div class="input-group-text">--}}
    {{--                                    <span class="fas fa-envelope"></span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="input-group mb-3">--}}
    {{--                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

    {{--                            <div class="input-group-append">--}}
    {{--                                <div class="input-group-text">--}}
    {{--                                    <span class="fas fa-lock"></span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="row">--}}
    {{--                            <div class="col-8">--}}
    {{--                                <div class="icheck-primary">--}}
    {{--                                    <input type="checkbox" id="remember">--}}
    {{--                                    <label for="remember">--}}
    {{--                                        Remember Me--}}
    {{--                                    </label>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <!-- /.col -->--}}
    {{--                            <div class="col-4">--}}
    {{--                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>--}}
    {{--                            </div>--}}
    {{--                            <!-- /.col -->--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--                <!-- /.login-card-body -->--}}
    {{--            </div>--}}
    {{--        </div>--}}
@endsection
