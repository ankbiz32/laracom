@extends('layouts.app')
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/td-message/td-message.css"/>
<style>
    th{
        font-weight:bold !important;
        border-right:none !important;
    }
    td{
        border-right:none !important;
    }
</style>

@section ('content')

    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>My cart</h2>
                <ul>
                    <li><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="quicky-cart-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('cart') && $totalQuantity >0)
                    <form action="javascript:void(0)">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="quicky-product-thumbnail">images</th>
                                        <th class="cart-product-name">Product</th>
                                        <th class="quicky-product-price">Unit Price</th>
                                        <th class="quicky-product-quantity">Quantity</th>
                                        <th class="quicky-product-subtotal">Total</th>
                                        <th class="quicky-product-remove">remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $value)
                                    <tr>
                                        <td class="quicky-product-thumbnail"><a href="{{ route('product.show',['product'=>$value['item']->id,'slug'=>$value['item']->url_slug]) }}"><img height="80" width="100" style="object-fit:contain" src="{{URL::to('/').'/'. $value['item']->image }}" alt="Cart Thumbnail"></a></td>
                                        <td class="quicky-product-name"><a href="{{ route('product.show',['product'=>$value['item']->id,'slug'=>$value['item']->url_slug]) }}">{{ $value['item']->name }}</a></td>
                                        <td class="quicky-product-price"><span class="amount">{{ $value['price']}}</span></td>
                                        <td class="quantity">
                                            <div class="cart-plus-minus ">
                                                <input class="cart-plus-minus-box" value="{{ $value['quantity']}}" data-max="{{$value['item']->max_order_qty}}" type="number" min=0 max="{{$value['item']->max_order_qty}}" data-id="{{encrypt($value['item']->id)}}" readonly>
                                                <div class="dec qtybutton"><i class="zmdi zmdi-chevron-down"></i></div>
                                                <div class="inc qtybutton"><i class="zmdi zmdi-chevron-up"></i></div>
                                            </div>
                                            <!-- <label class="mt-2"><small>Max: {{ $value['item']->max_order_qty}}</small></label> -->
                                        </td>
                                        <td class="product-subtotal"><span class="amount">{{ $value['quantity'] * $value['price']}}</span></td>
                                        <td class="quicky-product-remove"><a href="{{ route('cart.remove',['id'=> $key]) }}"><i class="zmdi zmdi-close"
                                            title="Remove"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="row">
                            <div class="col-12">
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                        <input class="button mt-xxs-30" name="apply_coupon" value="Apply coupon" type="submit">
                                    </div>
                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="row coupon-all">
                            <div class="col-sm-3">
                                <div class="coupon2 float-none">
                                    <!-- <input class="button" name="update_cart" value="Update cart" type="submit"> -->
                                </div>
                            </div>
                            <div class="col-sm-5 ml-auto">
                                <div class="cart-page-total pt-0">
                                    <h2>Cart totals</h2>
                                    <ul class="mb-3">
                                        <li class="cart-subtotal">Subtotal <span>{{$totalPrice}}</span></li>
                                        <li class="cart-shipping">Shipping <span>0</span></li>
                                        <li class="cart-total">Total <span>{{$totalPrice}}</span></li>
                                    </ul>
                                    <a href="{{route('checkout.index')}}" class="float-right quicky-btn ">PROCEED TO CHECKOUT</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="col-12 text-center">
                        <i class="zmdi zmdi-shopping-cart-plus" style="transform:scale(4)"></i>
                        <h5 class="mt-5 mb-3">Your shopping cart is empty. Please add some products.</h5>
                        <a href="{{ route('product.index') }}" class="quicky-btn">Go to shop </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('script')
<script src="{{URL::to('/')}}/plugins/td-message/td-message.min.js"></script>
    <script>
        function update(e){
            if(e.val()<1){
                e.val(1);
            }
            else if(e.val()>e.data('max')){
                e.val(e.data('max'));
            }
            $.ajax({
                url:"{{ route('cart.update') }}",
                method:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "id": e.data('id'),
                    "qty": e.val()
                },
                dataType:'json',
                success:function(data)
                {
                    if(data.status==200){
                        
                        var p = e.parent().parent().parent().find('.quicky-product-price span').text();
                        var s = e.parent().parent().parent().find('.product-subtotal span').text();
                        var c = $('.cart-subtotal span').text();
                        var t = $('.cart-total span').text();
                        var ship = $('.cart-shipping span').text();
                        var pst = parseInt(p) * e.val();
                        var cst = parseInt(c) - parseInt(s) + pst;
                        var ct = parseInt(c) + parseInt(ship) - parseInt(s) + pst;
                        e.parent().parent().parent().find('.product-subtotal span').text(pst);
                        $('.cart-subtotal span').text(cst);
                        $('.cart-total span').text(ct);
                        $.message({
                            type: "success",
                            text: "Your cart has been updated",
                            duration: 2000,
                            positon: "top-right",
                            showClose: true
                        });;
                    }
                    else if(data.status==404){
                        $.message({
                            type: "info",
                            text: "Product not found",
                            duration: 2000,
                            positon: "top-right",
                            showClose: true
                        });;
                    }
                    else{
                        $.message({
                            type: "warning",
                            text: "<strong>Warning</strong> <br> This action is not allowed",
                            duration: 2000,
                            positon: "top-right",
                            showClose: true
                        });;
                    }

                },
                error:function()
                {
                        $.message({
                            type: "error",
                            text: "<strong>Some error occured.</strong> <br> Please refresh the page and try again.",
                            duration: 6000,
                            positon: "top-right",
                            showClose: true
                        });;
                }
            })
        }

        // $('table').on('change', 'input', function () {
        //     update($(this));
        // });
    </script>
@endsection


