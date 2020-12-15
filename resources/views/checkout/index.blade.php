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
                    <div class="col-12">
                        <div class="coupon-accordion">
                        @guest
                            <h3 id="showlogin">Returning customer? <span >Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                    <p class="coupon-text mb-3">Please enter your registered e-mail & password to login.</p>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <p class="form-row-first">
                                            <label>E-mail <span class="required">*</span></label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="form-row-last">
                                            <label>Password <span class="required">*</span></label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </p>
                                        <p class="form-row align-items-end">
                                            <button type="submit" class="quicky-btn text-center quicky-btn_fullwidth square-btn">
                                                {{ __('Login') }}
                                            </button>
                                            <label>
                                                <input type="checkbox" class="ml-4" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                Remember me
                                            </label>
                                        </p>
                                        <p class="lost-password"><a href="javascript:void(0)">Lost your password?</a></p>
                                    </form>
                                </div>
                            </div>
                        @endguest
                            <!-- <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="javascript:void(0)">
                                        <p class="checkout-coupon">
                                            <input placeholder="Coupon code" type="text">
                                            <input class="coupon-inner_btn" value="Apply Coupon" type="submit">
                                        </p>
                                    </form>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <form method="POST" action="{{ route('checkout') }}">
                            @csrf
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="country-select clearfix">
                                            <label>Country *</label>
                                            <select class="myniceselect nice-select wide @error('country') is-invalid @enderror" name="country">
                                                <option data-display="Bangladesh">Bangladesh</option>
                                                <option value="uk">London</option>
                                                <option value="rou">Romania</option>
                                                <option value="fr">French</option>
                                                <option value="de">Germany</option>
                                                <option value="aus">Australia</option>
                                            </select>
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Name <span class="required">*</span></label>
                                            <input placeholder="" name="name" type="text" class="@error('name') is-invalid @enderror" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Email id<span class="required">*</span></label>
                                            <input name="email" value="{{old('email')}}" class="@error('email') is-invalid @enderror" type="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <span class="required">*</span></label>
                                            <input name="phone" value="{{old('phone')}}" class="@error('phone') is-invalid @enderror"  type="text">
                                        </div>
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label> Postcode / Zip<span class="required">*</span></label>
                                            <input type="text" name="zipcode" value="{{old('zipcode')}}" class="@error('zipcode') is-invalid @enderror" >
                                            @error('zipcode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label> Full adress<span class="required">*</span></label>
                                            <textarea name="address" maxlength="300" class="form-control @error('address') is-invalid @enderror" rows="3">{{old('address')}}</textarea>
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    @guest
                                    <div class="col-md-12">
                                        <div class="checkout-form-list create-acc">
                                            <input id="cbox" name="new_account" type="checkbox">
                                            <label>Create an account?</label>
                                        </div>
                                        <div id="cbox-info" class="checkout-form-list create-account">
                                            <p>Create an account by entering the information below. If you are a returning
                                                customer please login at the top of the page.</p>
                                            <label>Set password <span class="required">*</span></label>
                                            <input placeholder="password" type="password" name="new_password">
                                        </div>
                                    </div>
                                    @endguest
                                </div>
                                <div class="different-address">
                                    <div class="ship-different-title">
                                        <h3>
                                            <label>Ship to a different address?</label>
                                            <input id="ship-box" name="different_shipping" type="checkbox">
                                        </h3>
                                    </div>
                                    <div id="ship-box-info" class="row">
                                        <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Country *</label>
                                                <select class="myniceselect nice-select wide @error('dcountry') is-invalid @enderror" name="dcountry" >
                                                    <option data-display="Bangladesh">Bangladesh</option>
                                                    <option value="uk">London</option>
                                                    <option value="rou">Romania</option>
                                                    <option value="fr">French</option>
                                                    <option value="de">Germany</option>
                                                    <option value="aus">Australia</option>
                                                </select>
                                                @error('dcountry')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label>Phone <span class="required">*</span></label>
                                                <input name="dphone" value="{{old('dphone')}}" class="@error('dphone') is-invalid @enderror"  type="text" >
                                            </div>
                                            @error('dphone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label> Postcode / Zip<span class="required">*</span></label>
                                                <input type="text" name="dzipcode" value="{{old('dzipcode')}}" class="@error('dzipcode') is-invalid @enderror" >
                                                @error('dzipcode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label> Full adress<span class="required">*</span></label>
                                                <textarea name="daddress" maxlength="300" class="form-control @error('daddress') is-invalid @enderror" rows="3">{{old('daddress')}}</textarea>
                                                @error('daddress')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-notes">
                                        <div class="checkout-form-list checkout-form-list-2">
                                            <label>Order Notes</label>
                                            <textarea id="checkout-mess" class="bg-white" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="your-order px-sm-5 px-3">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name text-left"><strong>Product</strong></th>
                                            <th class="cart-product-total text-right"><strong>Total</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $key => $value)
                                        <tr class="cart_item">
                                            <td class="cart-product-name pl-0"> {{ $value['item']->name}}<strong class="product-quantity">
                                            × {{ $value['quantity']}}</strong></td>
                                            <td class="cart-product-total pr-0 text-right"><span class="amount">£{{ $value['quantity'] * $value['price']}}</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th class="pl-0">Cart Subtotal</th>
                                            <td class="pr-0 text-right"><span class="amount">£{{$totalPrice}}</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th class="pl-0">Taxes</th>
                                            <td class="pr-0 text-right"><span class="amount">£0</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th class="pl-0">Shipping</th>
                                            <td class="pr-0 text-right"><span class="amount">£0</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th class="pl-0">Order Total</th>
                                            <td class="pr-0 text-right"><strong><span class="amount">£{{$totalPrice}}</span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title">
                                                    <a href="javascript:void(0)" class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        Direct Bank Transfer.
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order
                                                        ID as the payment
                                                        reference. Your order won’t be shipped until the funds have cleared in
                                                        our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-2">
                                                <h5 class="panel-title">
                                                    <a href="javascript:void(0)" class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                        Cheque Payment
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order
                                                        ID as the payment
                                                        reference. Your order won’t be shipped until the funds have cleared in
                                                        our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-3">
                                                <h5 class="panel-title">
                                                    <a href="javascript:void(0)" class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                        PayPal
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order
                                                        ID as the payment
                                                        reference. Your order won’t be shipped until the funds have cleared in
                                                        our account.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <input value="Place order" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

 @endsection

@section ('script')
    <script src="{{URL::to('/')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
@endsection