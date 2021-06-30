
@extends('layouts.app')

@section ('content')

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
                                            @error('email1')
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
                        <form method="POST" action="{{ route('checkout') }}" id="details_form">
                            @csrf
                            <div class="checkbox-form">
                                <h3>Billing Details</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="country-select clearfix">
                                            <label>Country *</label>
                                            <select class="myniceselect nice-select wide @error('country') is-invalid @enderror" name="country" required>
                                                <option value="in">India</option>
                                            @foreach ($country as $c)
                                                <option value="{{$c->country_iso_code}}">{{$c->country_name}}</option>
                                            @endforeach
                                                <!-- <option value="uk">London</option>
                                                <option value="jpn">Japan</option>
                                                <option value="fr">France</option>
                                                <option value="de">Germany</option>
                                                <option value="aus">Australia</option>
                                                <option value="usa">USA</option> -->
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
                                            <input placeholder="" name="name" type="text" class="@error('name') is-invalid @enderror" value="{{ @old('name') ??( $user->name ?? '')}}" required>
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
                                            <input name="email" id="new_email" placeholder="youremail@xyz.com" value="{{old('email') ??( $user->email ?? '')}}" class="@error('email')form-control is-invalid @enderror" type="email" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>Email already registered.</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="checkout-form-list">
                                            <label>Phone <small>(with country code)</small> <span class="required">*</span></label>
                                            <input name="phone" value="{{old('phone') ??( $user->profile->phonenumber ?? '')}}" placeholder="For eg: +918888888888" class="digits @error('phone') is-invalid @enderror"  type="text" required>
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
                                            <input type="text" name="zipcode" value="{{old('zipcode') ??( $user->profile->zipcode ?? '')}}" class="@error('zipcode') is-invalid @enderror" required>
                                            @error('zipcode')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="checkout-form-list">
                                            <label> Full address<span class="required">*</span></label>
                                            <textarea name="address" data-rule-maxlength="300" maxlength="300" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{old('address') ??( $user->profile->address ?? '')}}</textarea>
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
                                            <label for="cbox">Create an account?</label>
                                        </div>
                                        <div id="cbox-info" class="checkout-form-list create-account">
                                            <p>Create an account by entering the information below. If you are a returning
                                                customer please login at the top of the page.</p>
                                            <label>Set password <span class="required">*</span></label>
                                            <input autocomplete="new-password" type="password" name="new_password" required>
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
                                                <select class="myniceselect sh nice-select wide @error('dcountry') is-invalid @enderror" name="dcountry" >
                                                    <option value="in">India</option>
                                                    <option value="uk">London</option>
                                                    <option value="jon">Japan</option>
                                                    <option value="fr">France</option>
                                                    <option value="de">Germany</option>
                                                    <option value="aus">Australia</option>
                                                    <option value="usa">USA</option>
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
                                                <input name="dphone" value="{{old('dphone')}}" class="sh @error('dphone') is-invalid @enderror"  type="text" >
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
                                                <input type="text" name="dzipcode" value="{{old('dzipcode')}}" class="sh @error('dzipcode') is-invalid @enderror" >
                                                @error('dzipcode')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label> Full address<span class="required">*</span></label>
                                                <textarea name="daddress" maxlength="300" class="sh form-control @error('daddress') is-invalid @enderror" rows="3">{{old('daddress')}}</textarea>
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
                                            <textarea id="checkout-mess" name="note" class="bg-white" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
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
                                            <td class="cart-product-name pl-0"> {{ $value['item']->name}} &nbsp;
                                            × &nbsp; {{ $value['quantity']}} <br> <small>{{$value['product_variant_name']!=null ? ' ('. $value['product_variant_name'] .')' : ''}}</small> </td>
                                            <td class="cart-product-total pr-0 text-right"><span class="amount">{{ $_SESSION['curr'].($value['quantity'] * round($value['price']))}}</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <th class="pl-0">Cart Subtotal</th>
                                            <td class="pr-0 text-right"><span class="amount">{{$_SESSION['curr'].round($totalPrice)}}</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th class="pl-0">Taxes</th>
                                            <td class="pr-0 text-right"><span class="amount">{{$_SESSION['curr']}}0</span></td>
                                        </tr>
                                        <tr class="cart-subtotal">
                                            <th class="pl-0">Shipping</th>
                                            <td class="pr-0 text-right"><span class="amount">{{$_SESSION['curr']}}0</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th class="pl-0">Order Total</th>
                                            <td class="pr-0 text-right"><strong><span class="amount">{{$_SESSION['curr'].round($totalPrice)}}</span></strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title" style="cursor:default">
                                                    <label for="cod_check" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                        <input type="radio" name="payment_type" value="cod" id="cod_check" required> Pay on delivery
                                                    </label>
                                                </h5>
                                            </div>
                                            <!-- <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your Order
                                                        ID as the payment
                                                        reference. Your order won’t be shipped until the funds have cleared in
                                                        our account.</p>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-3">
                                                <h5 class="panel-title" style="cursor:default">
                                                    <label for="online_check" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                        <input name="payment_type" type="radio" value="online" id="online_check" required> Pay with Razorpay
                                                    </label>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="#payment-2">
                                                <h5 class="panel-title" style="cursor:default">
                                                    <label for="hdfc_check" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                                        <input name="payment_type" type="radio" value="hdfc" id="hdfc_check" required checked> Pay with HDFC
                                                    </label>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-button-payment">
                                        <button class="quicky-btn btn-block" data-amount="{{$totalPrice}}" id="order">PLACE ORDER</button>
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
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var SITEURL = '{{URL::to('')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $( "#order" ).click(function() {
            $('#cbox').click();
            if($('#details_form').valid()){
                if($('input[name=payment_type]:checked').val()){
                    if($('input[name=payment_type]:checked').val()=='online'){ 
                        var totalAmount = $(this).attr("data-amount");
                        var options = {
                            "key": "{{env('RAZORPAY_KEY')}}",
                            "amount": (totalAmount*100),
                            "name": $("input[name=name]").val(),
                            "description": "Bhukyra test Payment",
                            "image": "{{URL('/')}}/photo/emblem.png",
                            "order_id": "{{$oid}}",
                            "handler": function (response){
                                if(!response.error){
                                    $input = $('<input type="hidden" name="rpid"/>').val(response.razorpay_payment_id);
                                    $('#details_form').append($input);
                                    $input = $('<input type="hidden" name="roid"/>').val(response.razorpay_order_id);
                                    $('#details_form').append($input);
                                    $input = $('<input type="hidden" name="rs"/>').val(response.razorpay_signature);
                                    $('#details_form').append($input);

                                    $.ajax({
                                        url: SITEURL + '/paysuccess',
                                        type: 'post',
                                        dataType: 'json',
                                        data: $('#details_form').serialize() , 
                                        success: function (msg) {
                                            window.location.href = SITEURL + '/thank-you';
                                        }
                                    });
                                }else{
                                    $.message({
                                        type: "error",
                                        text: "<strong>Payment error</strong> <br> Your order was not placed. <br> Please refresh this page & try again.",
                                        duration: 15000,
                                        positon: "top-right",
                                        showClose: true
                                    });
                                }
                            },
                            "prefill": {
                                "contact": $("input[name=phone]").val(),
                                "email":   $("#new_email").val(),
                            },
                            "theme": {
                                "color": "#415B34"
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.on('payment.failed', function (response){
                            $.message({
                                type: "error",
                                text: "<strong>Payment error</strong> <br> Your order was not placed. <br> Please refresh this page & try again.",
                                duration: 15000,
                                positon: "top-right",
                                showClose: true
                            });
                            // $.ajax({
                            //     url: SITEURL + '/payfailed',
                            //     type: 'post',
                            //     dataType: 'json',
                            //     data: $('#details_form').serialize() , 
                            //     success: function (msg) {
                            //         window.location.href = SITEURL + '/thank-you';
                            //     }
                            // });
                            // alert(response.error.code);
                            // alert(response.error.description);
                            // alert(response.error.source);
                            // alert(response.error.step);
                            // alert(response.error.reason);
                            // alert(response.error.metadata.order_id);
                            // alert(response.error.metadata.payment_id);
                        });
                        rzp1.open();
                    }
                    else if($('input[name=payment_type]:checked').val()=='hdfc'){ 
                        var totalAmount = $(this).attr("data-amount");
                        var d = new Date().getTime();
                        $input = $('<input type="hidden" name="merchant_id"/>').val("{{env('CCAV_MERCHANT_ID')}}");
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="order_id"/>').val('123456');
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="tid"/>').val(d);
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="currency"/>').val('INR');
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="amount"/>').val(totalAmount);
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="redirect_url"/>').val(SITEURL+'/hdfcCheckoutResponse');
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="cancel_url"/>').val(SITEURL+'/hdfcCheckoutResponse');
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="language"/>').val('EN');
                        $('#details_form').append($input);
                        $input = $('<input type="hidden" name="integration_type"/>').val('CheckOut');
                        $('#details_form').append($input);
                
                        $('#details_form').attr('action', SITEURL+'/hdfcCheckoutInit');
                        $('#details_form').submit();
                    }
                    else{
                        $('#details_form').submit();
                    }
                }
                else{
                    $.message({
                        text: " Please select a payment method.",
                        duration: 5000,
                        positon: "top-right",
                        showClose: true
                    });
                }
            }
        });

        $('#ship-box').change(function() {
            if(this.checked) {
                $('.sh').addClass('required');
            }
            else{
                $('.sh').removeClass('required');  
            }    
        });
    </script>
@endsection