@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{route('home')}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/{{$Meta->MainImage['file_path']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('content')
    <section class="about-scroll">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        @foreach($About as $item)
            <article class="about-us mainn">
                <div class="mr-t positions">
                    <div class="about-img">
                        <img src="/uploads/{{$item->MainImage['route_name']}}/large/{{$item->MainImage['name']}}"
                             alt="img"/>
                    </div>
                </div>
                <div class="mr-b positions">
                    <div class="description-bg">
                        <div class="description">
                            <h4>{{$item->title}}</h4>
                            <div class="text-scroll">
                                {!! $item->descr !!}
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        @endforeach
        <aside class="about-audio">
            <button class="audio"></button>
        </aside>
    </section>
@endsection
