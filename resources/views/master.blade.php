<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
@yield('title', config('adminlte.title', 'AdminLTE 3'))
@yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    @links('font-awesome')
    <!-- Ionicons -->
    @links('ionicons')
@yield('adminlte_css')
<!-- Theme style -->
    @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar")
        @links('adminlte_rtl')
        @else
        @links('adminlte_ltr')
    @endif
    <!-- iCheck -->
    @links('iCheck_blue')
    <!-- Morris chart -->
    @links('morris')
    <!-- jvectormap -->
    @links('jvectormap')
    <!-- Date Picker -->
    @links('datepicker')
    <!-- Daterange picker -->
    @links('daterangepicker')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar")
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/bootstrap-rtl.min.css') }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/custom-style.css') }}">
    @endif
</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<!-- jQuery -->
<script src="{{ asset('vendor/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
@scripts('bootstrap')
<!-- Morris.js charts -->
@scripts('raphael')
@scripts('morris')
<!-- Sparkline -->
@scripts('sparkline')
<!-- jvectormap -->
@scripts('jvectormap')
<script src="{{ asset('vendor/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('vendor/adminlte/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('vendor/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('vendor/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('vendor/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('vendor/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('vendor/adminlte/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('vendor/adminlte/dist/js/pages/dashboard.js') }}"></script>
@if(app ()->getLocale ()=="fa" || app ()->getLocale ()=="ar")
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('vendor/adminlte/dist/js/demo.js') }}"></script>
@else
    <script src="{{ asset('vendor/adminlte/ltr/dist/js/demo.js') }}"></script>
@endif
<script>
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
@yield('adminlte_js')

</body>
</html>
