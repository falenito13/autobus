@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{route('home')}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/{{$Meta->MainImage['file_path']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('content')
    <section class="autobus our-fleet">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <div class="container">
            <div class="main-title">
                {!! $Someofus->title !!}
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="text-box">
                        {!! $Someofus->descr !!}
                    </div>
                </div>
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
                                <li data-id="{{$c->id}}" class="{{ $loop->index  ==0 ?'active':'' }}">{{$c->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="tab">
                    <ul>
                        @foreach($Car as $car )
                            <li data-id="{{$car->id}}" class="{{ $loop->index  ==0 ?'active':'' }}">
                                <div class="row">
                                    @foreach($car->Cars as $cc)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="box autopark">
                                            <div class="top">
                                                <div class="car-info">
                                                    @foreach($Producer as $pr)
                                                        @if($pr->id ==$cc->producer_id )
                                                            <span class="type">{{$pr->title}}</span>
                                                        @endif
                                                    @endforeach
                                                    <h3>{{$car->title}}</h3>
                                                </div>
                                                <div class="owl-carousel owl-theme">
                                                    @foreach($cc->Images as $image)
                                                    <div class="item">
                                                        <div class="img-container">
                                                            <img src="/uploads/{{$image['route_name']}}/thumbs/{{$image['name']}}" alt="">
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="bottom">
                                                <div class="item mr-10">
                                                    <div class="mr-10">
                                                        <img src="/front_assets/img/luggage1.svg" alt="">
                                                    </div>
                                                    <span>{{$car->place}}X</span>
                                                </div>
                                                <div class="item">
                                                    <span>{{$car->person}}X</span>
                                                    <div class="ml-10">
                                                        <img src="/front_assets/img/passenger1.svg" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="btn-wrap">
                    <a href="{{route('front.contact')}}" class="btn">{{Lang::get('global.get_offers')}}<img src="/front_assets/img/white-arr.png" alt=""></a>
                </div>
            </div>
        </div>
    </section>
@endsection
