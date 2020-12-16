@extends('layouts.app')

@section ('content')

        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="{{URL('/')}}">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="checkout-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <h5><i class="zmdi zmdi-check-square text-success animated infinite pulse"></i> &nbsp;Order successful.</h5>
                        <p></p>
                        <h1 style="line-height:48px">Thank you for shopping with BhuKyra</h1>
                        <br>
                        <p>Hi {{$info['name']}}, we've received your order and are working on it right now. <br>We will email you an update once we have shipped it.</p>
                        <a href="{{route('home.index')}}" class="quicky-btn">SHOP MORE</a>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order px-sm-5 px-3">
                        <h4 class="">Order Details:</h4>
                        <div class="row mt-3">
                            <div class="col-6 ">Order no. :</div>
                            <div class="col-6">#{{$info['order_no']}}</div>
                            <div class="col-6 ">Payment method :</div>
                            <div class="col-6">Cash on delivery</div>
                            <div class="col-6 ">Order amount :</div>
                            <div class="col-6">{{$info['amount']}}</div>
                            <div class="col-6 ">Shipping address :</div>
                            <div class="col-6">{{$info['address']}}</div>
                            <div class="col-6 ">Shipping country :</div>
                            <div class="col-6">{{$info['country']}}</div>
                            <div class="col-6 ">Zip code :</div>
                            <div class="col-6">{{$info['zipcode']}}</div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 @endsection

@section ('script')
@endsection