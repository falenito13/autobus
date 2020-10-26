@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{route('home')}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/{{$Meta->MainImage['file_path']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('content')
    <section class="contact">
        @if (!Auth::check())
            @include('layouts.login')
        @endif
        <div class="map">
            <img src="/front_assets/img/Layer-2.png" alt="">
        </div>
        <div class="container">
            <div class="info">
                <div class="row">
                    <div class="col-xl-3">
                        <span class="title">{{Lang::get('global.contact_us')}}</span>
                        <ul>
                            <li>
                                <a href="#">
                                    <div class="img">
                                        <img src="/front_assets/img/location-green.png" alt="">
                                    </div>
                                    <div>
                                        {{$Contact->address}}
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{$Contact->phone}}">
                                    <div class="img">
                                        <img src="/front_assets/img/phone-green.png" alt="">
                                    </div>
                                    <div>
                                        {{$Contact->phone}}
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="tel:{{$Contact->phone1}}">
                                    <div class="img">
                                        <img src="/front_assets/img/phone-green.png" alt="">
                                    </div>
                                    <div>
                                        {{$Contact->phone1}}
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="mailto:{{$Contact->email}}">
                                    <div class="img">
                                        <img src="/front_assets/img/mail-green.png" alt="">
                                    </div>
                                    <div>
                                        {{$Contact->email}}
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xl-8 offset-xl-1">
                        <form  action="{{ route('contact.sendmail') }}" method="POST">
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
                                    <div class="capcha">
                                        {!! NoCaptcha::renderJs() !!}
                                        {!! NoCaptcha::display() !!}
                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="input">
                                        <textarea name="Message" placeholder="{{Lang::get('global.message')}}"></textarea>
                                    </div>
                                    <div class="btn-wrap">
                                        <button type="submit">{{Lang::get('global.send')}} <img src="/front_assets/img/arrow-right-white.png" alt=""></button>
                                    </div>
                                </div>
                                @if(session()->has('success'))
                                    <div class="alert alert-success">
                                        {{session()->get('success')}}
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{session()->get('error')}}
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
