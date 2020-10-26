@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{URL::current()}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/{{$Meta->MainImage['file_path']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection

@section('content')
<section class="services-page">
    @if (!Auth::check())
        @include('layouts.login')
    @endif
        <div class="container">
            <div class="main-title">
                {{Lang::get('global.services')}}
            </div>
            <div class="row">
                @foreach($Services as $item)
                    <div class="col-xl-6 col-lg-6">
                        <a href="#" class="box">
                            <div class="left">
                                <div>
                                    <img src="/uploads/{{$item->MainImage['route_name']}}/svg/{{$item->MainImage['name']}}" alt="">
                                    <h2>{{$item->title}}</h2>
                                </div>
                            </div>
                            <div class="text">
                                {!! $item->descr !!}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
