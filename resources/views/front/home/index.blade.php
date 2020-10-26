@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{URL::current()}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/uploads/{{$Meta->MainImage['route_name']}}/large/{{$Meta->MainImage['name']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection

@section('content')
    <section class="main-page">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <div class="intro">
            <div class="search-wrapper">
                <span class="italic-title">{{Lang::get('global.find_way')}}</span>
                <div class="search find">
                    <div class="btn-wrapper">
                        <button data-id="1" onclick="changeclass('Route');" class="routeortour active">{{Lang::get('global.route')}} <img src="/front_assets/img/tracking.svg" alt=""></button>
                        <button data-id="2" onclick="changeclass('Tour');"  class="routeortour">{{Lang::get('global.tours')}} <img src="/front_assets/img/trekking.svg" alt=""></button>
                    </div>
                    <form action="/offers" Method="GET" autocomplete="off">
                        <input type="hidden" name="type" class="routeor" value="Route" autocomplete="off">
                        <div data-id="1" class="display-none input-data input-wrapper active">
                            <div class="inner first">
                                <img src="/front_assets/img/right-arrow-green.png" alt="">
                                <input type="text" placeholder="{{Lang::get('global.from')}}: airport, train station, city, hotel" class="search-input" autocomplete="off" required>
                                <input type="hidden" name="from" class="search-input-hidden" autocomplete="off" >
                                <ul class="search-result">
                                    @foreach($Location as $l)
                                        <li class="appended d-none">
                                            <a href="#">
                                                <img src="/front_assets/img/gps.png" alt=""><span>{{ $l->title }}</span>
                                            </a>
                                            <input type="hidden" value="{{$l->id}}" id="{{$l->id}}" data-lat="{{$l->lat}}" data-lng="{{$l->lng}}" autocomplete="off">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="inner sec">
                                <img src="/front_assets/img/right-arrow-green.png" alt="">
                                <input type="text" placeholder="{{Lang::get('global.to')}}: airport, train station, city, hotel" class="search-input" autocomplete="off" required>
                                <input type="hidden" name="to" class="search-input-hidden"  autocomplete="off">
                                <ul class="search-result">
                                    @foreach($Location as $l)
                                        <li class="appended d-none">
                                            <a href="#">
                                                <img src="/front_assets/img/gps.png" alt=""><span>{{ $l->title }}</span>
                                            </a>
                                            <input type="hidden" value="{{$l->id}}" id="{{$l->id}}" data-lat="{{$l->lat}}" data-lng="{{$l->lng}}" autocomplete="off">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div data-id="2" class="display-none input-wrapper">
                            <div class="inner tours first">
                                <img src="/front_assets/img/right-arrow-(1).png" alt="">
                                <input type="text" placeholder="Tbilisi,georgia" class="search-input from" autocomplete="off">
                                <ul class="search-result">
                                    @foreach($Tours as $tour)
                                        <li class="appended d-none">
                                            <a href="#">
                                                <img src="/front_assets/img/gps.png" alt=""><span>{{$tour->title}}</span>
                                            </a>
                                            <input type="text" class="d-none" data-name="from" value="{{$tour->from->id}}" data-tour="{{$tour->id}}" id="{{$tour->id}}" data-id="{{$tour->from->id}}" data-title="{{$tour->from->id}}" data-lat="{{$tour->from->lat}}" data-lng="{{$tour->from->lng}}" autocomplete="off">
                                            <input type="text" class="d-none" data-name="to" value="{{$tour->to->id}}"  id="{{$tour->id}}" data-id="{{$tour->to->id}}" data-title="{{$tour->to->id}}" data-lat="{{$tour->to->lat}}" data-lng="{{$tour->to->lng}}" autocomplete="off">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="btn-wrap special">
                            <button class="btn-link" type="submit">{{Lang::get('global.get_offers')}}</button>
                            <button type="button" class="btn-link" onclick="openOffersModal();">
                                {{Lang::get('global.get_special_tour')}}
                            </button>
                        </div>
                    </form>
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
        <div class="container">
            <div class="services">
                <span class="main-title">{{Lang::get('global.services')}}</span>
                <div class="row">
                    @foreach($Services as $s )
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <a href="{{route('front.services')}}" class="service-box">
                                <img src="/uploads/{{$s->MainImage['route_name']}}/svg/{{$s->MainImage['name']}}" alt="">
                                <h2>{{$s->title}}</h2>
                                <div class="text">
                                    {{ str_limit(strip_tags($s->descr), $limit = 150, $end = '...') }}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="our-fleet">
                <span class="main-title">{{Lang::get('global.our_fleet')}}</span>
                <div class="top-tab">
                    <ul class="list">
                        @foreach($Car as $c )
                            <li data-id="{{$c->id}}" class="{{ $loop->index  ==0 ?'active':'' }}">{{$c->title}}</li>
                        @endforeach
                    </ul>
                    <div class="dropdown">
                        <div class="selected">
                            <span>{{Lang::get('global.economy')}}</span>
                            <img src="/front_assets/img/down-arrow-copy.png" alt="">
                        </div>
                        <ul>
                            @foreach($Car as $c )
                                <li data-id="{{$c->id}}" class="{{ $loop->index  == 0 ? 'active':'' }}">{{$c->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="bottom-tab">
                    <ul>
                        @foreach($Car as $c )
                            <li data-id="{{$c->id}}" class="{{ $loop->index  == 0 ?'active':'' }} ">
                                <div class="img-container">
                                    @foreach($Cars as $ca)
                                        @if($ca->id == $c->Car->id)
                                            <img src="/uploads/{{$ca->MainImage['route_name']}}/thumbs/{{$ca->MainImage['name']}}" alt="">
                                        @endif
                                    @endforeach
                                </div>
                                <div class="info">
                                    <span>{{$c->place}}X</span>
                                    <div>
                                        <img src="/front_assets/img/luggage.svg" alt="">
                                    </div>
                                </div>
                                <div class="info">
                                    <span>{{$c->person}}X</span>
                                    <div>
                                        <img src="/front_assets/img/passenger.svg" alt="">
                                    </div>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
{{--            <div class="reviews">--}}
{{--                <span class="main-title">“{{Lang::get('global.reviews')}}”--}}
{{--                    <a href="javascript:void(0)" class="write-review">Write review <img src="/front_assets/img/edit.svg" alt=""></a>--}}
{{--                </span>--}}
{{--                <div class="row">--}}
{{--                    <div class="col-xl-6 col-lg-6">--}}
{{--                        <div class="box">--}}
{{--                           <span class="avatar">--}}
{{--                               <img src="/front_assets/img/Layer-7.png" alt="">--}}
{{--                               <img src="/front_assets/img/Layer-14.png" alt="">--}}
{{--                            </span>--}}
{{--                            <div class="text-box">--}}
{{--                                <p><b>George Stone</b> We used their services both for--}}
{{--                                    transportation of our group and for sightseeing.--}}
{{--                                    The service received was outstanding on time,--}}
{{--                                    excellent guide, and good selection of touring--}}
{{--                                    activities. Lorem Ipsum has been the industry's--}}
{{--                                    standard dummy text ever since the 1500s, when--}}
{{--                                    an unknown printer took a galley of type and--}}
{{--                                    scrambled it to make a type specimen book. It--}}
{{--                                    has survived not only five centuries, but also--}}
{{--                                    the leap into electronic typesetting, remaining--}}
{{--                                    essentially unchanged.--}}
{{--                                    Ipsum.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-6 col-lg-6">--}}
{{--                        <div class="box">--}}
{{--                           <span class="avatar">--}}
{{--                               <img src="/front_assets/img/Layer-8.png" alt="">--}}
{{--                               <img src="/front_assets/img/Layer-14.png" alt="">--}}
{{--                            </span>--}}
{{--                            <div class="text-box">--}}
{{--                                <p><b>Anna Depp</b> We used their services both for--}}
{{--                                    transportation of our group and for sightseeing.--}}
{{--                                    The service received was outstanding on time,--}}
{{--                                    excellent guide, and good selection of touring--}}
{{--                                    activities. Lorem I--}}
{{--                                    Ipsum.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-6 col-lg-6">--}}
{{--                        <div class="box">--}}
{{--                           <span class="avatar">--}}
{{--                               <img src="/front_assets/img/Layer-8.png" alt="">--}}
{{--                               <img src="/front_assets/img/Layer-14.png" alt="">--}}
{{--                            </span>--}}
{{--                            <div class="text-box">--}}
{{--                                <p><b>George Stone</b> We used their services both for--}}
{{--                                    transportation of our group and for sightseeing.--}}
{{--                                    The service received was outstanding on time,--}}
{{--                                    excellent guide, and good selection of touring--}}
{{--                                    activities. Lorem I--}}
{{--                                    Ipsum.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-6 col-lg-6">--}}
{{--                        <div class="box">--}}
{{--                           <span class="avatar">--}}
{{--                               <img src="/front_assets/img/Layer-7.png" alt="">--}}
{{--                               <img src="/front_assets/img/Layer-14.png" alt="">--}}
{{--                            </span>--}}
{{--                            <div class="text-box">--}}
{{--                                <p><b>George Stone</b> We used their services both for--}}
{{--                                    transportation of our group and for sightseeing.--}}
{{--                                    The service received was outstanding on time,--}}
{{--                                    excellent guide, and good selection of touring--}}
{{--                                    activities. Lorem I--}}
{{--                                    Ipsum.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="social-reviews">--}}
{{--                        <a href="javascript:void(0)">--}}
{{--                            <button>--}}
{{--                                <div>--}}
{{--                                    <img src="/front_assets/img/facebook-blue.svg" alt="">Facebook review--}}
{{--                                </div>--}}
{{--                                <!-- <span>5.0</span> -->--}}
{{--                            </button>--}}
{{--                        </a>--}}
{{--                        <a href="javascript:void(0)">--}}
{{--                            <button>--}}
{{--                                <div>--}}
{{--                                    <img src="/front_assets/img/green-tripadvisor.svg" alt="">Tripadvisor review--}}
{{--                                </div>--}}
{{--                                <!-- <span>5.0</span> -->--}}
{{--                            </button>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="blog">
                <span class="main-title">{{Lang::get('global.blog')}}</span>
                <div class="row">
                    @foreach($Blog as $item)
                        <div class="col-xl-3 col-lg-3 col-md-6">
                            <a href="{{route('blog.detail',[$item->id,$item->title])}}" class="blog-box">
                                <div class="img-container">
                                    <img src="/uploads/{{$item->MainImage['route_name']}}/thumbs/{{$item->MainImage['name']}}" alt="">
                                    <span>{{Lang::get('global.see_more')}}<img src="/front_assets/img/right-arrow.png" alt=""></span>
                                </div>
                                <div class="p-20">
                                    <h3>{{$item->title}}</h3>
                                    <span class="date">{{ Date::parse($item->updated_at)->format('j F Y')}}</span>
                                    <div class="text">
                                        {{ Str::limit(strip_tags($item->descr), 50, '...') }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
@section('footer')
    <script>

    </script>
@endsection

