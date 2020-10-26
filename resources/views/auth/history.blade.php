@extends('layouts.front')
@section('title'){{$Meta->title}}@endsection
@section('description'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('ogurl'){{route('home')}}@endsection
@section('ogtitle'){{$Meta->title}}@endsection
@section('ogimage'){{ env('APP_URL') }}/{{$Meta->MainImage['file_path']}}@endsection
@section('ogdescription'){{ Str::limit(strip_tags($Meta->descr), 100, '...') }}@endsection
@section('content')
    <section class="user offer-page">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 ">
                    <div class="profile">
                        <div class="top">
                            <div class="avatar">
                                <img src="/front_assets/img/GEO_80871.png" alt="">
                            </div>
                            <div class="name">
                                <span>James bond</span>
                                <span>Jamesbond@gmail.com</span>
                            </div>
                        </div>
                        <div class="bottom">
                            <ul>
                                <li><a href="#"><img src="/front_assets/img/settings.png" alt="">Edit Profile</a></li>
                                <li><a href="#" class="active"><img src="/front_assets/img/history.png" alt="">History</a></li>
                                <li><a href="#"><img src="/front_assets/img/exit.png" alt="">Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 ">
                    <div class="transport-info">
                        <ul class="title-list">
                            <li>
                                <span>From - to</span>
                            </li>
                            <li>
                                <span>date</span>
                            </li>
                            <li>
                                <span>type</span>
                            </li>
                            <li>
                                <span>price</span>
                            </li>
                        </ul>
                        <ul class="list">
                            <li class="item">
                                <ul>
                                    <li class="from">
                                        Tbilisi - batumi
                                    </li>
                                    <li class="list-date">
                                        25 jun 2020
                                    </li>
                                    <li class="type">
                                        <img src="/front_assets/img/ekonomi.svg" alt="">
                                        <h5>Economy</h5>
                                    </li>
                                    <li class="cost">
                                        <span> <strong>190<b>$</b></strong></span>
                                    </li>
                                </ul>
                            </li>
                            <li class="item">
                                <ul>
                                    <li class="from">
                                        Rustavi - Bakuriani
                                    </li>
                                    <li class="list-date">
                                        25 jun 2020
                                    </li>
                                    <li class="type">
                                        <img src="/front_assets/img/komforti.svg" alt="">
                                        <h5>Confort</h5>
                                    </li>
                                    <li class="cost">
                                        <span> <strong>190<b>$</b></strong></span>
                                    </li>
                                </ul>
                            </li>
                            <li class="item">
                                <ul>
                                    <li class="from">
                                        Tbilisi - batumi
                                    </li>
                                    <li class="list-date">
                                        25 jun 2020
                                    </li>
                                    <li class="type">
                                        <img src="/front_assets/img/biznesi.svg" alt="">
                                        <h5>Business</h5>
                                    </li>
                                    <li class="cost">
                                        <span> <strong>19000<b>$</b></strong></span>
                                    </li>
                                </ul>
                            </li>
                            <li class="item">
                                <ul>
                                    <li class="from">
                                        Rustavi - Bakuriani
                                    </li>
                                    <li class="list-date">
                                        25 jun 2020
                                    </li>
                                    <li class="type">
                                        <img src="/front_assets/img/vipcar.svg" alt="">
                                        <h5>VIP</h5>
                                    </li>
                                    <li class="cost">
                                        <span> <strong>19000<b>$</b></strong></span>
                                    </li>
                                </ul>
                            </li>
                            <li class="item">
                                <ul>
                                    <li class="from">
                                        Tbilisi - batumi
                                    </li>
                                    <li class="list-date">
                                        25 jun 2020
                                    </li>
                                    <li class="type">
                                        <img src="/front_assets/img/minivan.svg" alt="">
                                        <h5>Van</h5>
                                    </li>
                                    <li class="cost">
                                        <span> <strong>19000<b>$</b></strong></span>
                                    </li>
                                </ul>
                            </li>
                            <li class="item">
                                <ul>
                                    <li class="from">
                                        Rustavi - Bakuriani
                                    </li>
                                    <li class="list-date">
                                        25 jun 2020
                                    </li>
                                    <li class="type">
                                        <img src="/front_assets/img/minibus.svg" alt="">
                                        <h5>Minibus</h5>
                                    </li>
                                    <li class="cost">
                                        <span> <strong>19000<b>$</b></strong></span>
                                    </li>
                                </ul>
                            </li>
                            <li class="item">
                                <ul>
                                    <li class="from">
                                        Tbilisi - batumi
                                    </li>
                                    <li class="list-date">
                                        25 jun 2020
                                    </li>
                                    <li class="type">
                                        <img src="/front_assets/img/bus1.svg" alt="">
                                        <h5>Bus</h5>
                                    </li>
                                    <li class="cost">
                                        <span> <strong>19000<b>$</b></strong></span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
