<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="Cgroup.ge">
    <meta name="robots" content="all" />
    <meta name="copyright" content="&copy;2020 tbilicity.ge" />
    <link rel="icon" href="/front_assets/img/logo.png" type="image/png" sizes="16x16">
    <meta property="og:url" content="@yield('ogurl')" />
    <meta property="og:title" content="@yield('ogtitle')" />
    <meta property="og:image" content="@yield('ogimage')"/>
    <meta property="og:image:width" content="500"/>
    <meta property="og:image:height" content="500"/>
    <meta property="og:site_name" content="autobus.ge"/>
    <meta property="og:description" content="@yield('ogdescription')"/>
    <meta property="og:type" content="website"/>
    @yield('header')
    <link rel="stylesheet" href="/front_assets/css/style.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/front_assets/css/owl.carousel.min.css">
</head>
<body>
<div id="fb-root"></div>
<header>
    <span id="LangLocal" class="hidden hide d-none">{{ localization()->getCurrentLocale() }}</span>
        <div class="container">
            <div class="wrapper">
                <a href="{{route('home')}}" class="main-logo">
                    <img src="/front_assets/img/Logo.png" alt="">
                </a>
                <div class="menu-wrap">
                    <button class="close-btn">
                        <img src="/front_assets/img/close.svg" alt="">
                    </button>
                    <ul class="menu">
                        <li><a href="{{route('front.about')}}">{{Lang::get('global.about_us')}}</a></li>
                        <li><a href="{{route('front.services')}}">{{Lang::get('global.services')}}</a></li>
                        <li><a href="{{route('front.someofus')}}">{{Lang::get('global.some_of_us')}}</a></li>
                        <li><a href="{{route('front.blog')}}">{{Lang::get('global.blog')}}</a></li>
                        <li><a href="{{route('front.contact')}}">{{Lang::get('global.contact')}}</a></li>
                    </ul>
                </div>
                <div class="log-in">
                    <button class="open">
                        <img src="/front_assets/img/open-menu.svg" alt="">
                    </button>
                    @if (Auth::check())
                        <a href="{{route('user.home')}}" class="item btn">
                            {{Lang::Get('global.user_profile')}}
                            <img src="/front_assets/img/enter.png" alt="">
                        </a>
                    @else
                        <a href="#" class="item log-in-btn">
                            {{Lang::Get('global.login')}}
                            <img src="/front_assets/img/enter.png" alt="">
                        </a>
                    @endif

                    <div class="langs">

                        <img src="/front_assets/img/enebi.png" alt="">
                        <span>{{ localization()->getCurrentLocale() }}</span>
                        <img src="/front_assets/img/down-arrow.png" alt="">
                        <ul>
                            @foreach($supportedLocales as $key => $locale)
                                <li class="{{ localization()->getCurrentLocale() == $key ? 'd-none' : '' }}">
                                    <a href="{{ localization()->getLocalizedURL($key) }}" rel="alternate" hreflang="{{ $key }}">
                                        {{ $locale->key() }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </header>



    @yield('content')
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <span class="footer-title">AutoBus LLC</span>
                    <ul class="list contact-list">
                        <li><a href="#"><img src="/front_assets/img/gps.png" alt="">{{$Contact->address}}</a></li>
                        <li><a href="tel:"><img src="/front_assets/img/phone1.png" alt=""> {{$Contact->phone}}</a></li>
                        <li><a href="tel:"><img src="/front_assets/img/phone1.png" alt=""> {{$Contact->phone1}}</a></li>
                        <li><a href="mailto:"><img src="/front_assets/img/mail1.png" alt=""> {{$Contact->email}}</a></li>
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <span class="footer-title">{{Lang::get('global.services')}}</span>
                    <ul class="list">
                        @foreach($ServicesF as $item)
                        <li><a href="{{route('front.services')}}">{{$item->title}}</a></li>
                        @endforeach
                        <li><a href="{{route('front.services')}}">{{Lang::get('global.see_more')}}</a></li>
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <span class="footer-title">{{Lang::get('global.sitemap')}}</span>
                    <ul class="list">
                        <li><a href="{{route('home')}}">{{Lang::get('global.Main')}}</a></li>
                        <li><a href="{{route('front.about')}}">{{Lang::get('global.about_us')}}</a></li>
                        <li><a href="{{route('front.services')}}">{{Lang::get('global.services')}}</a></li>
                        <li><a href="{{route('front.someofus')}}">{{Lang::get('global.autopark')}}</a></li>
                        <li><a href="{{route('front.blog')}}">{{Lang::get('global.blog')}}</a></li>
                        <li><a href="{{route('front.contact')}}">{{Lang::get('global.contact')}}</a></li>
{{--                        <li><a href="{{route('front.privacy')}}">{{Lang::get('global.privacy')}}</a></li>--}}
{{--                        <li><a href="{{route('front.terms')}}">{{Lang::get('global.terms')}}</a></li>--}}
                    </ul>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <span class="footer-title">{{Lang::get('global.Popular_Tours')}}</span>
                    <ul class="list">
                        @foreach($ToursF as $item)
                        <li><a href="#">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="wrapper">
                    <p>{{Lang::get('global.all_rigths_reserved')}} © 2020 <a href="https://www.cgroup.ge/" target="_blank"><img src="/front_assets/img/cgroup-logo.svg" alt=""></a></p>
                    <ul class="col-3">
                        <li><a href="{{$Contact->fb_link}}" target="_blank"><img src="/front_assets/img/facebook.png" alt=""></a></li>
                        <li><a href="{{$Contact->ins_link}}" target="_blank"><img src="/front_assets/img/instagram.png" alt=""></a></li>
                        <li><a href="{{$Contact->trp_link}}" target="_blank"><img src="/front_assets/img/tripadvisor.png" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="/front_assets/js/jquery.min.js"></script>
    <script src="/front_assets/js/bootstrap.min.js"></script>
    <script src="/front_assets/js/moment.min.js"></script>
    <script src="/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
    <script src="/front_assets/js/datepicker.min.js"></script>
    <script src="/front_assets/js/owl.carousel.min.js"></script>
@yield('footer')
    <script src="/front_assets/js/script.js"></script>

</body>
</html>
