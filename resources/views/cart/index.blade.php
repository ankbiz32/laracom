@extends('layouts.app')

@section ('content')

    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Shop Related Page</h2>
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
                                @if(Session::has('cart') && $totalQuantity >0)
                                    @foreach ($products as $key => $value)
                                    <tr>
                                        <td class="quicky-product-thumbnail"><a href="{{ route('product.show',['product'=>$value['item']->id]) }}"><img height="80" width="100" style="object-fit:contain" src="{{URL::to('/').'/'. $value['item']->image }}" alt="Cart Thumbnail"></a></td>
                                        <td class="quicky-product-name"><a href="{{ route('product.show',['product'=>$value['item']->id]) }}">{{ $value['item']->name }}</a></td>
                                        <td class="quicky-product-price"><span class="amount">{{ $value['price']}}</span></td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="{{ $value['quantity']}}" type="text">
                                                <div class="dec qtybutton"><i class="zmdi zmdi-chevron-down"></i></div>
                                                <div class="inc qtybutton"><i class="zmdi zmdi-chevron-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount">{{ $value['quantity'] * $value['price']}}</span></td>
                                        <td class="quicky-product-remove"><a href="{{ route('cart.remove',['id'=> $key]) }}"><i class="zmdi zmdi-close"
                                            title="Remove"></i></a></td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="quicky-product-name text-center"><a href="{{ route('product.index') }}">Go get some items first :)</a></td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        <li>Subtotal <span>$118.60</span></li>
                                        <li>Total <span>$118.60</span></li>
                                    </ul>
                                    <a href="javascript:void(0)">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section ('script')
@endsection


