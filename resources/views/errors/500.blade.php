@extends('layouts.front')
@section('title'){{Lang::get('global.500_error_title')}}@endsection
@section('description'){{Lang::get('global.500_error')}}@endsection
@section('ogurl'){{URL::current()}}@endsection
@section('ogdescription'){{Lang::get('global.500_error')}}@endsection

@section('content')
    <section class="main-page">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <div class="intro">
            <div class="search-wrapper">
                <span class="italic-title">{{Lang::get('global.500_error')}}</span>
            </div>

        </div>

    </section>

@endsection

