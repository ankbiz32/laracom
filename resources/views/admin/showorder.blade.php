@extends('layouts.admin')

@section ('content')

<div class="content-wrapper">
    <div class="content-header my-3">
        <div class="container-fluid">
        <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Details for order no. #{{ $order->id }}:</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item "><a href="{{route('admin.order')}}">Orders list</a></li>
                <li class="breadcrumb-item active">Order details</li>
                </ol>
            </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row d-flex flex-wrap-reverse">
                <div class="col-sm-10">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2 mb-sm-0 mb-4">
                                <h5>ORDER DETAILS</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-5">
                                        Order ID<br>
                                        Payment ID <br>
                                        Buyer Name <br>
                                        Phone Number <br>
                                        Status<br>
                                        Ordered on:

                                    </div>
                                    <div class="col-7">
                                        : {{ $order->id }} <br>
                                        : {{ $order->payment_id }} <br>
                                        : {{ $order->name }} <br>
                                        : {{ $order->phone }} <br>
                                        : {{ $order->order_status }}<br>
                                        : {{date('d/m/Y H:i',strtotime($order->created_at))}}
                                    </div>
                                </div>

                            </div>


                            <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2">
                                <h5>SHIPPING ADDRESS</h5>
                                <hr>
                                <div class="row">
                                    @if($order->ship_to_different_address)
                                    <div class="col-5">
                                        Country <br>
                                        Zipcode <br>
                                        Address <br>
                                        Phone <br>

                                    </div>
                                    <div class="col-7">
                                        : {{ $order->countryFull }} <br>
                                        : {{ $order->ship_zipcode }} <br>
                                        : {{ $order->ship_address }} <br>
                                        : {{ $order->ship_phone }} <br>

                                    </div>
                                    @else
                                    <div class="col-5">
                                        Country <br>
                                        Zipcode <br>
                                        Address <br>

                                    </div>
                                    <div class="col-7">
                                        : {{ $order->countryFull }} <br>
                                        : {{ $order->zipcode }} <br>
                                        : {!! nl2br($order->address) !!} <br>

                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="card-body">
                            @foreach($order->order_details as $item)
                            <div class="col-sm-12 col-md-12 col-lg-12 d-flex order-history mx-auto">
                                <div class="row">
                                        <div class="col-12 mb-4 d-flex justify-content-between ">
                                            <div class="order-image mr-4">
                                                <img src="{{ asset($item->product->image) }}" alt="" width="60">
                                            </div>

                                            <div class="order-detail mr-auto d-flex flex-column justify-content-center">
                                                <div class="detail-1">
                                                    <h5>{{$item->product->name}}
                                                    
                                                    {!! $item->product_variant!=null ? '<small><small> ('.$item->product_variant.')</small></small>' : '' !!}
                                                    </h5>
                                                </div>
                                                <div class="detail-3">
                                                    <h6>Quantity: {{$item->qty}}</h6>
                                                </div>
                                                <div class="detail-4">
                                                    <h6>Price: Rs.   {{$item->price}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            @endforeach
                            
                                <hr>
                                <div class="row">
                                    <h5>Total amount: Rs. {{ $order->amount }}/-</h5>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 mb-5 mb-sm-0">
                    <form action="{{route('admin.updateorder')}}" method="POST">
                    @csrf
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <div class="form-group">
                            <label for="" class="">Update status:</label>
                            <select name="order_status" class="form-control" id="order_status" required>
                                <option value="" hidden>-- Select status --</option>
                                <option value="ORDERED" {{ $order->order_status=="ORDERED" ?'selected':'' }}>ORDERED</option>
                                <option value="ACCEPTED" {{ $order->order_status=="ACCEPTED" ?'selected':'' }}>ACCEPTED</option>
                                <option value="SHIPPED" {{ $order->order_status=="SHIPPED" ?'selected':'' }}>SHIPPED</option>
                                <option value="DELIVERED" {{ $order->order_status=="DELIVERED" ?'selected':'' }}>DELIVERED</option>
                                <option value="REJECTED" {{ $order->order_status=="REJECTED" ?'selected':'' }}>REJECTED</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
