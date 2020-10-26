@extends('layouts.front')
@section('title'){{Lang::get('global.history')}}@endsection
@section('header')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endsection
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
                            <span>{{$User->name}} - {{$User->lastname}}</span>
                            <span>{{$User->email}}</span>
                        </div>
                    </div>
                    <div class="bottom">
                        <ul>
                            <li><a href="{{route('user.edit')}}"><img src="/front_assets/img/settings.png" alt="">{{Lang::get('global.edit_profile')}}</a></li>
                            <li><a href="{{route('user.history')}}" class="active"><img src="/front_assets/img/history.png" alt="">{{Lang::get('global.history')}}</a></li>
                            <li><a href="{{route('user.logout')}}"><img src="/front_assets/img/exit.png" alt="">{{Lang::get('global.sign_out')}}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 ">
                <div class="transport-info">
                    <ul class="title-list">
                        <li>
                            <span>{{Lang::get('global.from')}} - {{Lang::get('global.to')}}</span>
                        </li>
                        <li>
                            <span>{{Lang::get('global.date')}}</span>
                        </li>
                        <li>
                            <span>{{Lang::get('global.tr_type')}}</span>
                        </li>
                        <li>
                            <span>{{Lang::get('global.price')}}</span>
                        </li>
                    </ul>
                    <ul class="list">
                        @if($Order)
                            @foreach($Order as $order)
                                <li class="item showOrderInfo" data-id="{{$order->id}}">
                                    <ul>
                                        <li class="from">
                                            {{$order->location_from}} - {{$order->location_to}}
                                        </li>
                                        <li class="list-date">
                                            <span class="date">{{ Date::parse($order->created_at)->format('j M Y')}}</span>
                                        </li>
                                        <li class="type">
                                         <h5>{{$order->transport_type_id}}</h5>
                                        </li>
                                        <li class="cost">
                                            <span> <strong>{{$order->price}} <b>₾</b></strong></span>
                                        </li>
                                    </ul>
                                </li>
                            @endforeach
                        @else
                            {{Lang::get('global.orders_not_found')}}
                        @endif
                    </ul>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="orderModal" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="OrderInformation">{{Lang::get('global.order_details')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{Lang::get('global.close')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type='text/javascript'>
        $(document).ready(function(){

            $('.showOrderInfo').click(function(){
                var orderid = $(this).data('id');

                // AJAX request
                $.ajax({
                    url: '{{route('user.order.detail')}}',
                    type: 'post',
                    data: {orderid: orderid},
                    success: function(response){
                        // Add response in Modal body
                        $('.modal-body').html(response);

                        // Display Modal
                        $('#orderModal').modal('show');
                    }
                });
            });
        });
    </script>

@endsection
