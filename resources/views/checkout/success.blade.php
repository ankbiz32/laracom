@extends('layouts.app')

@section ('content')

        <div class="checkout-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        @if($resp['order_status']=='Success')
                            <h5><i class="zmdi zmdi-check-square text-success animated infinite pulse"></i> &nbsp;Order successful.</h5>
                            <p></p>
                            <h1 style="line-height:48px">Thank you for shopping with BhuKyra</h1>
                            <br>
                            <p>Hi {{$resp['name']}}, we've received your order and are working on it right now. <br>We will email you an update once we have shipped it.</p>
                            <a href="{{route('home.index')}}" class="quicky-btn">SHOP MORE</a>
                        @else
                            <h2><i class="zmdi zmdi-alert-triangle text-danger animated infinite pulse"></i> &nbsp;Order rejected.</h2>
                            <p></p>
                            <h4 style="line-height:48px">Thank you for shopping with BhuKyra</h4>
                            <br>
                            <p>Hi {{$resp['name']}}, we are afraid that your order was not successful because the payment did not go through. <br>We will email you an update for the transaction. Please try & order again. </p>
                            <a href="{{route('home.index')}}" class="quicky-btn">SHOP MORE</a>
                        @endif
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order px-sm-5 px-3 mt-5 mt-sm-0 pb-0 pb-sm-3">
                        <h4 class="">Order Details:</h4>
                        <div class="row mt-3">
                            <div class="col-6 ">Order no. :</div>
                            <div class="col-6">#{{$resp['order_no']}}</div>
                            <div class="col-6 ">Payment method :</div>
                            <div class="col-6">{{$resp['pay_mode']}}</div>
                            <div class="col-6 ">Order amount :</div>
                            <div class="col-6">{{$_SESSION['curr'].$resp['amount']}}</div>
                            <div class="col-6 ">Payment status :</div>
                            <div class="col-6">{{$resp['order_status']}}</div>
                            @if($resp['pay_ref']!='')
                                <div class="col-6 ">Payment ref :</div>
                                <div class="col-6">{{$resp['pay_ref']}}</div>
                            @endif
                            <br> <br>
                            <div class="col-6 ">Shipping address :</div>
                            <div class="col-6">{!!nl2br($resp['address'])!!}</div>
                            <div class="col-6 ">Shipping country :</div>
                            <div class="col-6">{{$resp['country']}}</div>
                            <div class="col-6 ">Zip code :</div>
                            <div class="col-6">{{$resp['zipcode']}}</div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 @endsection

@section ('script')
@endsection