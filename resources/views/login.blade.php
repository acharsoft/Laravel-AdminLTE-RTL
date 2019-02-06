@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <b>@langs('ورود به سایت')</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">@langs('فرم زیر را تکمیل کنید و ورود بزنید')</p>

                <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="@langs('ایمیل')">
                        <div class="input-group-append">
                            <span class="fa fa-envelope input-group-text"></span>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="@langs('رمز عبور')">
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7 offset-md-1">
                            <div class="form-check">
                                <label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> @langs('یاد آوری من')
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">@langs('ورود')</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mb-3">
                    <p>- @langs('یا') -</p>
                    <a href="{{route ('google')}}" class="btn btn-block btn-danger">
                        <i class="fa fa-google-plus mr-2"></i>@langs('ورود با اکانت گوگل')
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            @langs('رمز عبورم را فراموش کرده ام.')
                        </a>
                    @endif
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">@langs('ثبت نام')</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    @yield('js')
@stop
