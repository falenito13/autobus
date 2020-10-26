<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="{{ asset('messages.js') }}"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="/plugins/images/logo2.svg">
    <title>Autobus - სამართავი პანელი</title>
    <!-- Bootstrap Core CSS -->
    <link href="/admin_assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="/admin_assets/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/admin_assets/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="/admin_assets/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="new-login-register">
    <div class="lg-info-panel">
        <div class="inner-panel">
            <a href="javascript:void(0)" class="p-20 di"><img src="/plugins/images/logo2.svg"></a>
            <div class="lg-content">

                <h2>{{ Lang::get('LoginPage.promo1')}}</h2>
                <p class="text-muted">{{ Lang::get('LoginPage.promo2')}}</p>
                <a href="https://cgroup.ge" class="btn btn-rounded btn-danger p-l-20 p-r-20">CGROUP</a>
            </div>
        </div>
    </div>
    <div class="new-login-box">
        <div class="white-box">
            <h3 class="box-title m-b-0">{{ Lang::get('LoginPage.logininto')}}</h3>
            <small>{{ Lang::get('LoginPage.enter_details')}}</small>
            <form class="form-horizontal new-lg-form" id="loginform" method="POST" action="{{ route('loguser') }}">
                @csrf
                <div class="form-group  m-t-20">
                    <div class="col-xs-12">
                        <label>{{ Lang::get('LoginPage.username')}}</label>
                        <input type="email" class="form-control @error('username') is-invalid @enderror" id="username"  name="username" placeholder="{{ Lang::get('LoginPage.username')}}" required autocomplete="email" autofocus>
                        @error('username')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>{{ Lang::get('LoginPage.password')}}</label>
                        <input class="form-control @error('password') is-invalid @enderror" id="password"  type="password" name="password" required="" placeholder="{{ Lang::get('LoginPage.password')}}">
                        @error('password')
                        <div class="alert alert-danger">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block btn-rounded text-uppercase waves-effect waves-light" type="submit">{{ Lang::get('LoginPage.login')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</section>
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
<script src="/admin_assets/js/custom.min.js"></script>
<!--Style Switcher -->
<script src="/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
