@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">

            <!-- Left navbar links -->
            <ul class="navbar-nav @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar") ml-auto @else mr-auto @endif">
                <!-- Authentication Links -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>

            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar") ml-3 @else mr-3 @endif">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar") mr-auto @else ml-auto @endif">
                <!-- Messages Dropdown Menu -->
            @yield('Messages')
            <!-- Notifications Dropdown Menu -->
                @yield('Notifications')
            </ul>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
            <li class="navbar-nav">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ Auth::user()->avatar }}" class="brand-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-block float-right">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-@if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar"){{'left'}}@else{{'right'}}@endif card-body box-profile">
                    <!-- User image -->
                    <li class="card-header bg-primary text-center">
                        <img src="{{ Auth::user()->avatar_original }}" class="profile-user-img img-fluid img-circle elevation-2" alt="User Image">
                        <p class="text-center"> {{ Auth::user()->name }} </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="card-body">
                        <div class="row ">
                            <div class="col-5 text-center">
                                <span>{{ trans('adminlte::adminlte.last_login') }}:</span>
                            </div>
                            <div class="col-7 text-center">
                                <span>{{ Auth::user()->lastLoginAt()->diffForHumans() }}</span>
                            </div>
                            <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="card-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" class="btn btn-default btn-flat">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                <a href="#" class="dropdown-item bg-danger btn btn-default btn-flat"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </div>
                    </li>
                </ul>
            </li>
            @endguest
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-language"></i>{{language()->getName()}}
                    </a>
                    <div class="dropdown-menu pre-scrollable dropdown-menu-lg dropdown-menu-@if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar"){{'left'}}@else{{'right'}}@endif">
                        @foreach (language()->all() as $code => $name)
                            <a href="{{ language()->back($code) }}" class="dropdown-item">
                                <img src="{{ asset('vendor/akaunting/language/src/Resources/assets/img/flags/'. language()->country($code) .'.png') }}" alt="{{ $name }}" width="{{ config('language.flags.width') }}" /> &nbsp; {{ $name }}
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <!-- Left side column. contains the logo and sidebar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="brand-link">
                <img src="{{asset (config ('adminlte.logo'))}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light" href="{{ url(config('adminlte.dashboard_url', 'home')) }}">
                    {!! config('adminlte.logo_text', 'Laravel')  !!}
                </span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </a>

            <!-- Sidebar -->
            <div class="sidebar" style="direction: @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar") ltr @else rtl @endif">
                <div style="direction: @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar") rtl @else ltr @endif">

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @yield('content_header')
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <main class="py-4">
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                        @include('layouts.errors')
                    </div>
                </section>
            </main>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>CopyLeft &copy; {{date ('Y')}} <a href="http://github.com/acharsoft/">مبین پورسلامی</a>.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar")
        <!-- AdminLTE App -->
        <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ asset('vendor/adminlte/ltr/dist/js/adminlte.min.js') }}"></script>
    @endif
    @stack('js')
    @yield('js')
@stop
