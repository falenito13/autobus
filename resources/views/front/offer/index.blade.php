@extends('layouts.front')
@section('title'){{Lang::get('global.order')}}@endsection
@section('description'){{ Str::limit(strip_tags(Lang::get('global.order_descr')), 100, '...') }}@endsection
@section('ogurl'){{URL::current()}}@endsection
@section('ogtitle'){{Lang::get('global.order')}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags(Lang::get('global.order_descr')), 100, '...') }}@endsection
@section('header')
    <link rel="stylesheet" href="/front_assets/css/datepicker.min.css">
    <link rel="stylesheet" href="/front_assets/css/bootstrap3.min.css">
    <link rel="stylesheet" href="/front_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front_assets/css/owl.carousel.min.css">
@endsection
@section('content')
    <section class="offer-page">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <form action="{{Route('Order')}}" onsubmit="return sandPayment(this);" method="POST">
            @csrf
            <div class="container">
                <div class="row find">
                    <div class="col-xl-6 col-lg-6">
                        <div class="intro">
                            <div class="search">
                                <div class="btn-wrapper">
                                    <button type="button" data-id="1" class="{{$rec->type=='Route'? 'active': ''}}">{{Lang::get('global.route')}} <img src="/front_assets/img/tracking.svg" alt=""></button>
                                    <button type="button" data-id="2" class="{{$rec->type=='Tour'? 'active': ''}}">{{Lang::get('global.tours')}} <img src="/front_assets/img/trekking.svg" alt=""></button>
                                    <input type="hidden" name="Active" value="{{$rec->type=='Route'?1:2}}" id="" class="catch-ID">
                                </div>
                                <div class="display-none {{$rec->type=='Route'? 'active':''}}" data-id="1">
                                    <div class="input-wrapper input-data">
                                        <div class="inner first">
                                            <label for="">{{Lang::get('global.from')}}</label>
                                            <img src="/front_assets/img/right-arrow-(1).png" alt="">
                                            <input type="text" name="from" placeholder="Tbilisi,georgia" class="search-input from" autocomplete="off">
                                            <input type="hidden" name="fromvalue" class="search-from" value="{{$from->id?:0}}">
                                            <ul class="search-result">
                                                @foreach($Location as $l)
                                                    <li class="appended d-none">
                                                        <a href="#">
                                                            <img src="/front_assets/img/gps.png" alt="">
                                                            <span>{{$l->title}}</span>
                                                        </a>
                                                        <input type="hidden"  id="{{$l->id}}" data-id="{{$l->id}}" data-lat="{{$l->lat}}" data-lng="{{$l->lng}}" class="{{$l->id == $rec->from?'checked' :'' }}">
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="inner sec">
                                            <label for="">{{Lang::get('global.to')}}</label>
                                            <img src="/front_assets/img/right-arrow-(1).png" alt="">
                                            <input type="text" name="to" placeholder="Batumi, Georgia" class="search-input to" autocomplete="off">
                                            <input type="hidden" name="tovalue" class="search-from" value="{{$to->id?:0}}">
                                            <ul class="search-result">
                                                @foreach($Location as $l)
                                                    <li class="appended d-none">
                                                        <a href="#">
                                                            <img src="/front_assets/img/gps.png" alt="">
                                                            <span>{{$l->title}}</span>
                                                        </a>
                                                        <input type="hidden" id="{{$l->id}}" data-id="{{$l->id}}" data-lat="{{$l->lat}}" data-lng="{{$l->lng}}" class="{{$l->id == $rec->to?'checked' :'' }}">
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="input-wrapper">
                                        <div class="inner">
                                            <label for="">{{Lang::get('global.transfer_date')}}</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker1'>
                                                    <input type='text' class="form-control" name="date_from" placeholder="{{Lang::get('global.pick_date')}}" />
                                                    <span class="input-group-addon">
                                                        <img src="/front_assets/img/calendar.png" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inner">
                                            <label for="">{{Lang::get('global.pick_up_time')}}</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker3'>
                                                    <input type='text' data-error="monishnet" class="form-control" name="date_from_time" placeholder="{{Lang::get('global.pick_time')}}"/>
                                                    <span class="input-group-addon">
                                                        <img src="/front_assets/img/stopwatch.png" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="return-way">
                                        <input type="checkbox" name="return" id="return-way1">
                                        <label for="return-way1">{{Lang::get('global.add_return_way')}}</label>
                                    </div>
                                    <div class="input-wrapper append">
                                        <div class="inner">
                                            <label for="">{{Lang::get('global.transfer_date')}}</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker2'>
                                                    <input type='text' class="form-control" name="date_to" placeholder="{{Lang::get('global.pick_date')}}" />
                                                    <span class="input-group-addon">
                                                        <img src="/front_assets/img/calendar.png" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inner">
                                            <label for="">{{Lang::get('global.pick_up_time')}}</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker4'>
                                                    <input type='text' class="form-control"name="date_to_time" placeholder="{{Lang::get('global.pick_time')}}"/>
                                                    <span class="input-group-addon">
                                                        <img src="/front_assets/img/stopwatch.png" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="display-none {{$rec->type=='Tour'? 'active':''}}" data-id="2">
                                    <div class="input-wrapper">
                                        <div class="inner tours first">
                                            <label for="">{{Lang::get('global.from')}}</label>
                                            <img src="/front_assets/img/right-arrow-(1).png" alt="">
                                            <input type="text" placeholder="Tbilisi,georgia" class="search-input from" >
                                            <input type="hidden" name="touridss" class="tourid" value="{{$Tour?$Tour->id:''}}" >
                                            <ul class="search-result">
                                                @foreach($Tours as $tour)
                                                    <li class="appended d-none">
                                                        <a href="#">
                                                            <img src="/front_assets/img/gps.png" alt=""><span>{{$tour->title}}</span>
                                                        </a>
                                                        @if($Tour)
                                                            <input type="hidden"  class="{{$tour->title ==$Tour->title?'checked' :'' }}">
                                                        @endif
                                                        <input type="text" class="d-none" data-name="from" value="{{$tour->from->title}}" data-id="{{$tour->from->id}}"  id="{{$tour->id}}" data-tour="{{$tour->id}}" data-title="{{$tour->from->title}}" data-lat="{{$tour->from->lat}}" data-lng="{{$tour->from->lng}}">
                                                        <input type="text" class="d-none" data-name="to" value="{{$tour->to->title}}" data-id="{{$tour->to->id}}" id="{{$tour->id}}" data-tour="{{$tour->id}}" data-title="{{$tour->to->title}}" data-lat="{{$tour->to->lat}}" data-lng="{{$tour->to->lng}}">
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="input-wrapper pb-20">
                                        <div class="inner">
                                            <label for="">{{Lang::get('global.transfer_date')}}</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker5'>
                                                    <input type='text' class="form-control"  name="date_from_tour" placeholder="{{Lang::get('global.pick_date')}}" />
                                                    <span class="input-group-addon">
                                                        <img src="/front_assets/img/calendar.png" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inner">
                                            <label for="">{{Lang::get('global.pick_up_time')}}</label>
                                            <div class="form-group">
                                                <div class='input-group date' id='datetimepicker6'>
                                                    <input type='text' class="form-control" name="date_from_time_tour"  placeholder="{{Lang::get('global.pick_time')}}"/>
                                                    <span class="input-group-addon">
                                                        <img src="/front_assets/img/stopwatch.png" alt="">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="transport-info">
                                <h4>{{Lang::get('global.tr_types')}}</h4>
                                <ul class="list display-none {{$rec->type=='Tour'?'': 'active'}}" data-id="1">
                                    @foreach($Category as $category)
                                        <li class="item">
                                            <label for="check-{{$category->id}}">
                                                <ul>
                                                    <li class="type">
                                                        <input type="checkbox"  name="Category" id="check-{{$category->id}}" value="{{$category->id}}">
                                                        <img src="/uploads/{{$category->MainImage['route_name']}}/svg/{{$category->MainImage['name']}}" alt="">
                                                        <h5>{{$category->title}}</h5>
                                                    </li>
                                                    <li class="seat noafter">
                                                        <span>
                                                            {{$category->place}}x
                                                            <img src="/front_assets/img/luggage.svg" alt="">
                                                        </span>
                                                        <span>
                                                            {{$category->person}}x
                                                            <img src="/front_assets/img/passenger.svg" alt="">
                                                        </span>
                                                    </li>
                                                    <li class="cost" id="cost-{{$category->id}}">
                                                        <span>From <strong>
                                                                @if(!is_null($CarPrice))
                                                                    @foreach($CarPrice->CarPricesByLocation as $CP)
                                                                        @if($CP->cat_id == $category->id)
                                                                            {{$CP->price}}
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    {{$category->price}}
                                                                @endif
                                                                <b>₾</b></strong>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="list display-none {{$rec->type=='Route'?'': 'active'}}" data-id="2">
                                    @foreach($Category as $category)
                                        <li class="item">
                                            <label for="check-{{$category->id}}">
                                                <ul>
                                                    <li class="type">
                                                        <input type="checkbox" name="CategoryTours" value="{{$category->id}}" id="check-{{$category->id}}">
                                                        <img src="/uploads/{{$category->MainImage['route_name']}}/svg/{{$category->MainImage['name']}}" alt="">
                                                        <h5>{{$category->title}}</h5>
                                                    </li>
                                                    <li class="seat noafter">
                                                        <span>
                                                            {{$category->place}}x
                                                            <img src="/front_assets/img/luggage.svg" alt="">
                                                        </span>
                                                        <span>
                                                            {{$category->person}}x
                                                            <img src="/front_assets/img/passenger.svg" alt="">
                                                        </span>
                                                    </li>
                                                    <li class="cost" id="Tourcost-{{$category->id}}">
                                                        <span>From <strong>
                                                                @if($cartour && count($cartour)>0)
                                                                    @foreach($cartour as $CP)
                                                                        @if($CP->cat_id == $category->id)
                                                                            {{$CP->price}}
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    {{$category->price}}
                                                                @endif
                                                                <b>₾</b></strong>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="detail">
                                    <div class="top">
                                        <span>{{Lang::get('global.adults')}}</span>
                                        <div class="number-wrap">
                                            <button type="button" class="number-down" onclick="this.parentNode.querySelector('[type=number]').stepDown()">
                                                <img src="/front_assets/img/minus.svg" alt="">
                                            </button>
                                            <input type="number" name="adults" value="0" class="detail-input" size="1" max="100" readonly>
                                            <button type="button" class="number-up" onclick="this.parentNode.querySelector('[type=number]').stepUp();">
                                                <img src="/front_assets/img/plus.svg" alt="">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        @if (count($aServices) > 0)
                                            <div class="child-seat dropdown">
                                                <div class="select">
                                                    <div>
                                                        <img src="/front_assets/img/seat-belt.svg" alt="">
                                                        <span id="services-text" data-text="{{Lang::get('global.aditional_services')}}">{{Lang::get('global.aditional_services')}}</span>
                                                    </div>
                                                    <img src="/front_assets/img/down-arrow-copy.png" alt="">
                                                </div>
                                                <ul>
                                                    @foreach($aServices as $service)
                                                        <li>
                                                            <div class="number-wrap">
                                                                <label>
                                                                    <div>
                                                                        <input type="checkbox" class="srvcheck" name="aservices[]" id="{{$service->id}}" value="{{$service->id}}" >{{$service->title}}
                                                                    </div>
                                                                    <span>{{$service->price}}</span>
                                                                </label>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="checkbox promo mb-10">
                                            <input type="checkbox" name="flight" value="1" id="det-check-1">
                                            <label for="det-check-1">{{Lang::get('global.fl_tr_number')}}</label>
                                            <div class="promo-code">
                                                <input type="text" name="flight_number" placeholder="{{Lang::get('global.enter_number')}}">
                                            </div>
                                        </div>
                                        <div class="checkbox">
                                            <input type="checkbox" name="sign" value="1" id="det-check-2">
                                            <label for="det-check-2">{{Lang::get('global.name_sign')}}</label>
                                        </div>
                                        <div class="input">
                                            <img src="/front_assets/img/street-name.svg" alt="">
                                            <input type="text" name="sign_name" placeholder="{{Lang::get('global.default_sign')}}">
                                        </div>

                                        <div class="checkbox promo">
                                            <input type="checkbox" name="pro" value="1" id="det-check-3">
                                            <label for="det-check-3">{{Lang::get('global.promo_code')}}</label>
                                            <div class="promo-code">
                                                <input type="text" name="promo" placeholder="{{Lang::get('global.promo_code')}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="personal-info">
                                <div class="comment">
                                    <label for="">{{Lang::get('global.comment')}}</label>
                                    <img src="/front_assets/img/comment (1).svg" alt="">
                                    <textarea name="comment" id="comment" placeholder="{{Lang::get('global.comment_placeholder')}}"></textarea>
                                    <div class="btn-wrap">
                                        <button type="button" onclick="commentText(`{{Lang::get('global.default_comment')}}`);">{{Lang::get('global.default_text')}}</button>
                                        <button type="button" onclick="commentText(`{{Lang::get('global.helping_comment')}}`);">{{Lang::get('global.helping_text')}}</button>
                                    </div>
                                </div>
                                <div class="input-form">
                                    <label for="">{{Lang::get('global.email')}}</label>
                                    <img src="/front_assets/img/email (1).svg" alt="">
                                    <input type="email" name="email" placeholder="{{Lang::get('global.enter_email')}}">
                                </div>
                                <div class="input-form">
                                    <img src="/front_assets/img/email (1).svg" alt="">
                                    <input type="email" name="email2" placeholder="{{Lang::get('global.confirm_email')}}">
                                </div>
                                <div class="input-form phone">
                                    <label for="">{{Lang::get('global.phone')}}</label>
                                    <div class="wrap">
                                        <div class="dropdown">
                                            <div class="selected">
                                                <img src="/front_assets/img/ena.png" alt="" class="flag">
                                                <img src="/front_assets/img/down-arrow-copy.png" alt="">
                                            </div>
                                            <ul>
                                                <li><img src="/front_assets/img/ena.png" alt=""></li>
                                                <li><img src="/front_assets/img/united-states.png" alt=""></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <input type="number" name="phone" placeholder="{{Lang::get('global.enter_phone')}}">
                                </div>
                            </div>
                            <div class="end">
                                <p class="agreement">{{Lang::get('global.agree_the_agreement')}} <a href="#" onclick="openPrivacyModal();">{{Lang::get('global.service_agreement')}}</a></p>
                                <button id="order-submit" type="submit">{{Lang::get('global.buy_offer')}}</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 display-none {{$rec->type=='Tour'? 'active': ''}}"  data-id="2" id="Tourdiv">
                        @if($Tour)
                        <div class="rightside">
                            <div class="slider">
                                <button type="button" class="left arrow">
                                    <img src="/front_assets/img/arrow-left.svg" alt="">
                                </button>
                                <button type="button" class="right arrow">
                                    <img src="/front_assets/img/arrow-right.svg" alt="">
                                </button>
                                <div class="owl-carousel owl-theme">
                                    @foreach($Tour->Images as $images)
                                    <div class="item">
                                        <div class="img-container">
                                            <img src="/uploads/{{$images['route_name']}}/large/{{$images['name']}}" alt="">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="btn-wrap">
                                <button type="button">
                                    <img src="/front_assets/img/distance.svg" alt="">
                                    {{Lang::get('global.distance')}}:  <span class="distancetext2"> 377km </span>
                                </button>
                                <button type="button">
                                    <img src="/front_assets/img/duration.svg" alt="">
                                    {{Lang::get('global.tour_duration')}}: <span class="durationtext2"> 5H 0 min</span>
                                </button>
                            </div>
                            <h2 class="title" id="Tour_title">{{$Tour->title}}</h2>
                            <div class="text">
                                {!! $Tour->descr !!}
                            </div>
                            <div class="btn-wrap special">
                                <button type="button" onclick="openOffersModal();">
                                    {{Lang::get('global.get_special_tour')}}
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="col-xl-6 col-lg-6 display-none {{$rec->type=='Route'? 'active': ''}}" data-id="1">
                        <div class="rightside">
                            <div class="img-container">
                                <div id="googleMap" style="width:100%;height:400px;"></div>
                            </div>
                            <div class="btn-wrap">
                                <button type="button">
                                    <img src="/front_assets/img/distance.svg" alt="">
                                    {{Lang::get('global.distance')}}: <span class="distancetext"> 377km </span>
                                </button>
                                <button type="button">
                                    <img src="/front_assets/img/duration.svg" alt="">
                                    {{Lang::get('global.tour_duration')}}: <span class="durationtext"> 5H 0 min</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <style type="text/css">
            #myModal {
                /*display: none; */
                position: fixed; /* Stay in place */
                height: 100vh; /* Full height */
                width: 100%;
                max-height: unset;
                top: 0px;
                right: 35%;
                bottom: 0;
                left: 0;
                /*z-index: 1050;*/
                overflow: hidden;
            }
            #SpecialOffers {
                /*display: none;*/
                position: fixed; /* Stay in place */
                height: 100vh; /* Full height */
                width: 100%;
                max-height: unset;
                top: 0px;
                right: 35%;
                bottom: 0;
                left: 0;
                /*z-index: 1050;*/
                overflow: hidden;
            }
            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
            }
            .close {
                color: #aaaaaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }
            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }
            .modal-btn-wrap{
                display: flex;
            }
            .modal-btn-wrap .text-right{
                margin-right: 20px;
            }
            .modal-btn-wrap .btn{
                font-family: ssp-caps;
                font-size: 15px;
                color: white;
                background-color: #115a60;
                transition: 0.2s;
            }
            .modal-btn-wrap {
                margin-top: 15px
            }
            .modal-btn-wrap .btn:hover{
                background-color: #0b4549;
            }
            .modal-content .title{
                font-size: 18px;
                font-family: ssp-caps;
                text-align: center;
                font-weight: bold;
            }
            .modal-content .text-center{
                text-align: center;
            }
        </style>
        <div class="offer-modal" id="myModal">
            <form name="frm1" id="frm1" method="POST" action="https://ecommerce.ufc.ge/ecomm2/ClientHandler">
                <div class="inner">
                    <div class="title">{{Lang::get('global.Payment_Confirmation')}} <button class="close-btn" type="button"><img src="/front_assets/img/delete.png"></button></div>
                    <div class="bottom">
                        <div class="Modal-Inner">

                        </div>
                        <div class="button-wrap">
                            <button type="button" class="close-mod">{{Lang::get('global.refuse')}}</button>
                            <button type="submit">{{Lang::get('global.continue')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
            <div class="offer-modal" id="PrivacyModal">
                    <div class="inner">
                        <div class="title">{{$Privacy->title}} <button class="close-btn" type="button"><img src="/front_assets/img/delete.png"></button></div>
                        <div class="bottom">
                            <div class="Modal-Inner">
                            {!!$Privacy->descr!!}
                            </div>
                        </div>
                    </div>
            </div>
        <div class="offer-modal" id="SpecialOffers">
            <form name="frm1" id="frm1" onsubmit="savePostContact(this); return false;" method="POST" action="{{ route('contact.send') }}">
                <div class="inner">
                    <div class="title">{{Lang::get('global.special_tour_request')}} <button class="close-btn" type="button"><img src="/front_assets/img/delete.png"></button></div>
                    <div class="bottom">
                        <div class="Modal-Inner">
                            @CSRF
                            <div class="form-group">
                                <div class="left">
                                    <div class="input">
                                        <input type="text" name="Name" placeholder="{{Lang::get('global.name')}}" required>
                                    </div>
                                    <div class="input">
                                        <input type="email" name="Email" placeholder="{{Lang::get('global.email')}}" required>
                                    </div>
                                    <div class="input">
                                        <input type="number" name="Phone" placeholder="{{Lang::get('global.phone')}}" required>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="input">
                                        <textarea id="textare" name="Message" placeholder="{{Lang::get('global.message')}}"></textarea>
                                    </div>
                                </div>
                                <div class="capcha">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="button-wrap">
                            <button type="submit">{{Lang::get('global.send')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('footer')
    <script>
        function sendMail(param) {

        }

        function openOffersModal(){
            var OffersModal = $("#SpecialOffers");
            OffersModal.addClass('active');
        }

        function openPrivacyModal(){
            var PrivacyModal = $("#PrivacyModal");
            PrivacyModal.addClass('active');
        }

        function commentText(text){
            $('#comment').val(text);
        }
        $('.srvcheck').change(function() {
            let str = '';
            $('.srvcheck:checked').each(function (){
                str += (str != '' ? ',' : '') + $(this).parent('div').text();
            });
            if (str == ''){
                str = $('#services-text').data('text');
            }
            $('#services-text').text(str);
        });

        function sandPayment(obj){
            event.preventDefault();
            var error       = false;
            var errorInputs = [];
            $('#order-submit').attr("disabled", true);
            $(obj).find('.error').removeClass('error');

            $(obj).find('[data-error]').each(function(){
                if($(this).val().trim() == '') {
                    $(this).addClass('error');
                    error = true;
                    errorInputs.push($(this).parents('div'));
                }
            });

            if(error) {
                document.documentElement.scrollTop = errorInputs[0].offset().top;
                return false;
            }

            var modal = $("#myModal");

            $('#close').on('click', function(){
                modal.removeClass('active');
            });

            $.post($(obj).attr('action'), $(obj).serializeArray(), function(data){
                if (data.StatusCode === 1) {
                    $.ajax({
                        url: '{{route('front.order.detail')}}',
                        type: 'post',
                        data: {transID: data.transID, orderid : data.orderid, discount: data.discount},
                        success: function(response){
                            // Add response in Modal body
                            modal.find('.Modal-Inner').html(response);

                            // Display Modal
                            modal.addClass('active');
                        },
                        complete: function (){
                          $('#order-submit').attr("disabled", false);
                        }
                    });

                } else if (data.StatusCode === 3) {

                    $.toast().reset('all');
                    $.each(data.StatusMessage, function(i) {
                        $.toast({
                            heading:  '{{Lang::get('global.error_found')}}',
                            text: data.StatusMessage[i],
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: false,
                            stack: 10
                        });
                    });
                    $('#order-submit').attr("disabled", false);
                    return false;
                }
                else if (data.StatusCode === 0) {
                    $.toast().reset('all');
                        $.toast({
                            heading:  '{{Lang::get('global.error_found')}}',
                            text: data.StatusMessage,
                            position: 'top-right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: false,
                            stack: 10
                        });
                    $('#order-submit').attr("disabled", false);
                    return false;
                }
                else {
                    modal.css('display', "none");
                    swal('{{Lang::get('global.error')}}');
                    $('#order-submit').attr("disabled", false);
                }

            });

            return false;
        }

        function myMap(from= null, to = null) {

            var directionsDisplay = new google.maps.DirectionsRenderer({
                polylineOptions: {
                    strokeColor: "#8cc63f" ,
                    strokeWeight : 6 ,
                    strokeOpacity: 0.7
                }
                // suppressMarkers: true iconebs aqrobs
            });
            var directionsService = new google.maps.DirectionsService;
            var mapProp= {
                center:new google.maps.LatLng(41.8400,43.3908),
                streetViewControl: false,
                zoom:7,
                styles:[
                    // {elementType: 'labels.text.stroke', stylers: [{color: '#8cc63f'}]},
                    // {elementType: 'geometry', stylers: [{color: '#8cc63f'}]},
                    // {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
                    // {elementType: 'labels.text.fill', stylers: [{color: '#8cc63f'}]},
                ],

            };
            var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            directionsDisplay.setMap(map);
            if(from!= null){
                directionsService.route(
                    {
                        origin:from,
                        destination: to,
                        travelMode: 'DRIVING'
                    },
                    function(response, status){
                        if(status==="OK"){
                            var main = response.routes[0].legs[0];
                            var duration = main.duration.text;
                            var distance = main.distance.text;
                            var seconds = main.duration.value;
                            var days     = Math.floor(seconds / (24*60*60));
                            seconds -= days    * (24*60*60);
                            var hours    = Math.floor(seconds / (60*60));
                            seconds -= hours   * (60*60);
                            var minutes  = Math.floor(seconds / (60));
                            seconds -= minutes * (60);
                            $('.durationtext').text(hours+"h "+minutes+"min");
                            $('.distancetext').text(distance);
                            $('.durationtext2').text(hours+"h "+minutes+"min");
                            $('.distancetext2').text(distance);
                            directionsDisplay.setDirections(response);
                        }
                    }
                );
            }

        }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpRkk2VzConvKwwCgsStn9vhXTeFn_j40&callback=myMap"></script>
@endsection
