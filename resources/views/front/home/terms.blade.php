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
        <h1>Terms</h1>
    </section>
@endsection
@section('footer')
    <script>
        function changeclass(text){
            $('.routeortour').each(function(){
                if($(this).hasClass('active')){
                    $('.routeor').val(text);
                }
            });
        }

    </script>
@endsection

