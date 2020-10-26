<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('messages.js') }}"></script>
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="/plugins/images/logo2.svg">
    <title>Autobus - სამართავი პანელი</title>
    <!-- Bootstrap Core CSS -->
    <link href="/admin_assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- morris CSS -->
    <link href="/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <!-- animation CSS -->
    <link href="/admin_assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/admin_assets/css/style.css" rel="stylesheet">
    <link href="/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">
    @yield('header')
<!-- color CSS -->
    <link href="/admin_assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>`
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var LANG = '{{ localization()->getCurrentLocale() }}';
        var URL = '{{ env('APP_URL') }}';
    </script>

</head>
<body>
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    @include('admin_layouts.navbar_top')
    <!-- End Top Navigation -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    @include('admin_layouts.sidebar')
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
@yield('content')
</div>



<!-- jQuery -->
<script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="/admin_assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

<!--slimscroll JavaScript -->
<script src="/admin_assets/js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="/admin_assets/js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<!-- Custom Theme JavaScript -->
<script src="/admin_assets/js/custom.min.js"></script>
<script src="/admin_assets/js/plugins.js"></script>
<script src="/admin_assets/js/admin.min.js"></script>
<script src="/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
<!-- Sweet-Alert  -->
<script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
<script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<!--Style Switcher -->
@yield('footer')
</body>
</html>

