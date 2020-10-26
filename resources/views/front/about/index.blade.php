@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{route('home')}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/{{$Meta->MainImage['file_path']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('content')
    <section class="about-us">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <div class="container">
            <div class="row mt-40 mb-80">
                <div class="col-xl-6">
                    <div class="about-image">
                        <img src="/uploads/{{$About[0]->MainImage['route_name']}}/large/{{$About[0]->MainImage['name']}}" alt="">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="about-text">
                        <div>
                            <span class="title">{{$About[0]->title}}</span>
                            <div class="text">
                                {!! $About[0]->descr !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="background">
            <div class="container">
                <div class="inner">
                    <h2>{{Lang::get('global.Check_autobus')}}</h2>
                    <div class="btn-wrapper">
                        <a href="{{route('front.someofus')}}" class="btn">{{Lang::get('global.view')}} <img src="/front_assets/img//arrow-right-white.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mtb-60 ">
                <div class="col-xl-6 order-xl-2">
                    <div class="about-image">
                        <img src="/uploads/{{$About[1]->MainImage['route_name']}}/large/{{$About[1]->MainImage['name']}}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 order-xl-1">
                    <div class="about-text order1">
                        <div>
                            <span class="title">{{$About[1]->title}}</span>
                            <div class="text">
                                {!! $About[1]->descr !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
