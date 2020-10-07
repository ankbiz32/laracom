@extends('layouts.admin')

@section ('content')

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12 col-lg-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                            @foreach ($ids as $id)
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2">
                                <h5>ORDER DETAILS</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        Order ID<br>
                                        Payment ID <br>
                                        Buyer ID<br>
                                        Buyer Name <br>
                                        Phone Number <br>
                                        Status

                                    </div>
                                    <div class="col-7">
                                        : {{ $id->id }} <br>
                                        : {{ $id->payment_id }} <br>
                                        : {{ $id->user_id }} <br>
                                        : {{ $id->name }} <br>
                                        : {{ $id->phonenumber }} <br>
                                        : PAID
                                    </div>
                                </div>

                            </div>


                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2">
                                <h5>SHIPPING ADDRESS</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        Country <br>
                                        City <br>
                                        Zipcode <br>
                                        Address <br>

                                    </div>
                                    <div class="col-7">
                                        : {{ $id->country }} <br>
                                        : {{ $id->city }} <br>
                                        : {{ $id->zipcode }} <br>
                                        : {{ $id->address }} <br>

                                    </div>
                                </div>
                            </div>
                           @endforeach
                        </div>
                        </div>
                        <div class="card-body">
                            @foreach($order as $order)
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex order-history mx-auto">
                                <div class="row">
                                    @foreach ($order->cart->items as $item)
                                        <div class="col-12 mb-4 d-flex justify-content-between ">
                                            <div class="order-image mr-4">
                                                <img src="{{ asset($item['item']['image']) }}" alt="" height="40">
                                            </div>

                                            <div class="order-detail mr-auto d-flex flex-column justify-content-center">
                                                <div class="detail-1">
                                                    <h5>{{ $item['item']['name'] }}</h5>
                                                </div>
                                                <div class="detail-3">
                                                    <h6>Quantity: {{ $item['quantity'] }}</h6>
                                                </div>
                                                <div class="detail-4">
                                                    <h6>Price: RM   {{ $item['price'] }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
