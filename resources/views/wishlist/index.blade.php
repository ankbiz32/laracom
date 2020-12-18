@extends('layouts.app')

@section ('content')

        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>My wishlist</h2>
                    <ul>
                        <li><a href="{{URL('/')}}">Home</a></li>
                        <li class="active">Wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="quicky-wishlist_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <form action="javascript:void(0)">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="quicky-product_remove">remove</th>
                                            <th class="quicky-product-thumbnail">images</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="quicky-product-price">Unit Price</th>
                                            <th class="quicky-product-stock-status">Stock Status</th>
                                            <th class="quicky-cart_btn">add to cart</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wishlist as $w)
                                        <tr>
                                            <td class="quicky-product_remove"><a href='{{URL("/")}}/wishlist/remove/{{$w->id}}'><i class="zmdi zmdi-close"
                                                title="Remove"></i></a></td>
                                            <td class="quicky-product-thumbnail"><a href="{{ route('product.show',['product'=>$w->product_id,'slug'=>$w->product->url_slug]) }})"><img src="{{ $w->product->image }}" alt=" Wishlist Thumbnail"></a>
                                            </td>
                                            <td class="quicky-product-name"><a href="{{ route('product.show',['product'=>$w->product_id,'slug'=>$w->product->url_slug]) }}">{{ $w->product->name }}</a></td>
                                            <td class="quicky-product-price"><span class="amount">${{ $w->product->name }}</span></td>
                                            <td class="quicky-product-stock-status">@if($w->product->ProductInventory->in_stock) <span class="in-stock">In stock</span> @else <span class="out-stock">Out of stock @endif</span></td>
                                            <td class="quicky-cart_btn"><a href="javascript:void(0)">add to cart</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@endsection


@section ('script')
@endsection

  