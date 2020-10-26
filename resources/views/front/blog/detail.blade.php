@extends('layouts.front')
@section('title'){{$Blog->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Blog->descr), 100, '...') }}@endsection
@section('ogurl'){{URL::current()}}@endsection
@section('ogtitle'){{$Blog->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/uploads/{{$Blog->MainImage['route_name']}}/large/{{$Blog->MainImage['name']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Blog->descr), 100, '...') }}@endsection
@section('content')
    <section class="blog page">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="img-cont">
                        <img src="/uploads/{{$Blog->MainImage['route_name']}}/thumbs/{{$Blog->MainImage['name']}}" alt="">
                    </div>
                    <h2 class="title">{{$Blog->title}} <button onclick="Share( '{{URL::current()}}' );">Share<img src="/front_assets/img/share.png" alt=""></button></h2>
                    <span class="blog-date">{{ Date::parse($Blog->updated_at)->format('j F Y')}}</span>
                    <div class="blog-text">
                        {!! $Blog->descr !!}
                    </div>
                </div>
                <div class="col-xl-3">
                    @foreach($Blogs as $B)
                    <a href="{{route('blog.detail',[$B->id,$B->title])}}" class="blog-box">
                        <div class="img-container">
                            <img src="/uploads/{{$B->MainImage['route_name']}}/thumbs/{{$B->MainImage['name']}}" alt="">
                            <span>{{Lang::get('global.see_more')}}<img src="/front_assets/img/right-arrow.png" alt=""></span>
                        </div>
                        <div class="p-20">
                            <h3>{{ $B->title }}</h3>
                            <span class="date">{{ Date::parse($B->updated_at)->format('j F Y')}}</span>
                            <div class="text">
                                {{ Str::limit(strip_tags($B->descr), 50, '...') }}
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
@section('footer')
    <script>
        $(function(){
            // initialize fb sdk
            window.fbAsyncInit = function() {
                FB.init({
                    appId      : '{{env('FACEBOOK_CLIENT_ID')}}',
                    xfbml      : true,
                    version    : 'v2.2'
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        });
    function Share(url) {
    FB.ui({
    method: 'share',
    href: url,
    }, function(response){});
    }
    </script>
@endsection
