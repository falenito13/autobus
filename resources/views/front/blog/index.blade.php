@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{route('home')}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/{{$Meta->MainImage['file_path']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('content')
<section class="main-page">
    @if (!Auth::check())
        @include('layouts.login')
    @endif
    <div class="container">
        <div class="blog list-page">
            <span class="main-title">{{Lang::get('global.blog')}}</span>
            <div class="row">
                @foreach($Blog as $item)
                <div class="col-xl-3 col-lg-3 col-md-6">
                    <a href="{{route('blog.detail',[$item->id,$item->title])}}" class="blog-box">
                        <div class="img-container">
                            <img src="/uploads/{{$item->MainImage['route_name']}}/thumbs/{{$item->MainImage['name']}}" alt="">
                            <span>{{Lang::get('global.see_more')}}<img src="assets/img/right-arrow.png" alt=""></span>
                        </div>
                        <div class="p-20">
                            <h3>{{$item->title}}</h3>
                            <span class="date">{{ Date::parse($item->updated_at)->format('j M Y')}}</span>
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
