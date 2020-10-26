@extends('layouts.front')
@section('title'){{Lang::get('global.success_title')}}@endsection
@section('description'){{Lang::get('global.success')}}@endsection
@section('ogurl'){{URL::current()}}@endsection
@section('ogdescription'){{Lang::get('global.success')}}@endsection

@section('content')
    <section class="main-page">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <div class="intro">
            <div class="search-wrapper">
                <span class="italic-title">{{Lang::get('global.success')}}</span>
            </div>

        </div>

    </section>

@endsection

