@extends('layouts.front')
@section('title'){{Lang::get('global.user_profile')}}@endsection
@section('ogurl'){{route('home')}}@endsection
@section('content')


@if(app()->getLocale() == 'ka')
    <style type="text/css">
        .user .profile .bottom ul li a{
            font-size: 14px;
        }
    </style>
@endif 
<section class="user offer-page">
    <div class="container">
        <div class="row">
            <div class="col-xl-3">
                <div class="profile">
                    <div class="top">
                        <div class="avatar">
                            <img src="/front_assets/img/GEO_80871.png" alt="">
                        </div>
                        <div class="name">
                            <span>{{$User->name}} - {{$User->lastname}}</span>
                            <span>{{$User->email}}</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <ul>
                            <li><a href="{{route('user.edit')}}" class="active"><img src="/front_assets/img/settings.png" alt="">{{Lang::get('global.edit_profile')}}</a></li>
                            <li><a href="{{route('user.history')}}" ><img src="/front_assets/img/history.png" alt="">{{Lang::get('global.history')}}</a></li>
                            <li><a href="{{route('user.logout')}}"><img src="/front_assets/img/exit.png" alt="">{{Lang::get('global.sign_out')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <div class="intro">
                    <form action="{{route('user.editpost')}}" method="POST" onsubmit="user.savePost(this); return false">
                        @csrf
                        <div class="search personal-info">
                        <div class="input-wrapper">
                            <div class="inner">
                                <label for="">{{Lang::Get('global.name')}}</label>
                                <img src="/front_assets/img/right-arrow-(1).png" alt="">
                                <input type="text" name="name" value="{{$User->name}}" required>
                            </div>
                            <div class="inner">
                                <label for="">{{Lang::Get('global.lastname')}}</label>
                                <img src="/front_assets/img/right-arrow-(1).png" alt="">
                                <input type="text" name="lastname" value="{{$User->lastname}}" required>
                            </div>
                        </div>
                        <div class="input-wrapper">
                            <div class="input-form phone">
                                <label for="">{{Lang::Get('global.phone')}}</label>
                                <div class="wrap">
                                    <div class="dropdown">
                                        <div class="selected">
                                            <img src="/front_assets/img/ena.png" alt="" class="flag">
                                            <img src="/front_assets/img/down-arrow-copy.png" alt="">
                                        </div>
                                        <ul>
                                            <li><img src="/front_assets/img/ena.png" alt=""></li>
                                            <li><img src="/front_assets/img/united-states.png" alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                                <input type="number" name="phone_number" value="{{$User->mobile_number}}" required>
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn-link">{{Lang::Get('global.save')}}</button>
                    </form>
                    <form action="{{ route('user.change.password.post') }}" method="POST" onsubmit="user.savePost(this); return false">
                        @csrf
                        <div class="search personal-info">
                            @if (Auth::user()->getAuthPassword() != NULL)
                        <div class="input-wrapper">
                            <div class="inner">
                                <label for="">{{Lang::Get('global.old_password')}}</label>
                                <img src="/front_assets/img/padlock.png" alt="">
                                <input type="password" name="current_password" placeholder="{{Lang::Get('global.old_password')}}">
                            </div>
                        </div>
                            @endif
                        <div class="input-wrapper">
                            <div class="inner">
                                <label for="">{{Lang::Get('global.new_password')}}</label>
                                <img src="/front_assets/img/padlock.png" alt="">
                                <input type="password" name="new_password" required>
                            </div>
                            <div class="inner">
                                <label for="">{{Lang::Get('global.confirm_password')}}</label>
                                <img src="/front_assets/img/padlock.png" alt="">
                                <input type="password" name="new_confirm_password" required>
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="btn-link">{{Lang::Get('global.save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
