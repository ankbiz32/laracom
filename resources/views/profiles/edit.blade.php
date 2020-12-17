    @extends('layouts.app')

    @section ('content')
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>My account</h2>
                    <ul>
                        <li><a href="{{URL('/')}}">Home</a></li>
                        <li class="active">My Account</li>
                    </ul>
                </div>
            </div>
        </div>

        <main class="page-content">
            <div class="account-page-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">Account Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-orders-tab" data-toggle="tab" href="#account-orders" role="tab" aria-controls="account-orders" aria-selected="false">Orders</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="account-address-tab" data-toggle="tab" href="#account-address" role="tab" aria-controls="account-address" aria-selected="false">Addresses</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab" aria-controls="password" aria-selected="false">Change password</a>
                                </li>
                                <li class="nav-item">
                                    <a  class="nav-link" id="account-logout-tab" role="tab" aria-selected="false" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                                <div class="tab-pane fade" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                    <div class="myaccount-orders">
                                        <h4 class="small-title">MY ORDERS</h4>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>ORDER</th>
                                                        <th>DATE</th>
                                                        <th>STATUS</th>
                                                        <th>TOTAL</th>
                                                        <th></th>
                                                    </tr>
                                                    @if(count($orders))
                                                        @foreach($orders as $o)
                                                            <tr>
                                                                <td><a class="account-order-id" href="javascript:void(0)">#{{$o->id}}</a></td>
                                                                <td>{{date('M d, Y',strtotime($o->created_at))}}</td>
                                                                <td>{{$o->order_status}}</td>
                                                                <td>Rs. {{$o->amount}} for {{count($o->order_details)}} items</td>
                                                                <td><a href="javascript:void(0)" class="modal-btn quicky-btn-2 quicky-btn_sm"><span>View</span></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5"><h5 class="my-3">You have not ordered anything yet.<h5> <a class="quicky-btn" href="{{URL('/')}}">Star tshopping now</a></td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">
                                    <div class="myaccount-address">
                                        <p>The following addresses will be used on the checkout page by default.</p>
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="small-title">BILLING ADDRESS</h4>
                                                <address>
                                                    1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                                </address>
                                            </div>
                                            <div class="col">
                                                <h4 class="small-title">SHIPPING ADDRESS</h4>
                                                <address>
                                                    1234 Heaven Stress, Beverly Hill OldYork UnitedState of Lorem
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="tab-pane fade show active" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                    <div class="myaccount-details">
                                    <h4 class="small-title mb-4">ACCOUNT DETAILS</h4>
                                        <form method="POST" class="quicky-form" action="{{ route('profile.update',['user'])  }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="quicky-form-inner">
                                                <div class="single-input">
                                                    <label for="account-details-firstname">Registered email id: <strong>{{$user->email}}</strong></label>
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="account-details-firstname">Name*</label>
                                                    <input type="text" name="name" value="{{$user->name}}" class="form-control @error('name') is-invalid @enderror" id="account-details-firstname" required>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label>Country*</label>
                                                    <select name="country_id" class="form-control @error('country_id') is-invalid @enderror" required>
                                                        <option value="in">India</option>
                                                        <option value="usa">USA</option>
                                                    </select>
                                                    @error('country_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label>Phone <small>(with country code)</small>*</label>
                                                    <input type="text" value="{{$user->profile->phonenumber}}" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" required>
                                                    @error('phonenumber')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label>Zipcode*</label>
                                                    <input type="text" value="{{$user->profile->zipcode}}" class="form-control @error('zipcode') is-invalid @enderror digits" name="zipcode" required>
                                                    @error('zipcode')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-firstname">Full address*</label>
                                                    <textarea name="address" class="form-control @error('address') is-invalid @enderror" style="height:80px" required>{{$user->profile->address}}</textarea>
                                                    @error('address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input">
                                                    <button class="quicky-btn" type="submit"><span>Save
                                                    Changes</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                    <div class="myaccount-details">
                                    <h4 class="small-title mb-4">CHANGE PASSWORD</h4>
                                        <form method="POST" class="quicky-form" id="password_form" action="{{ route('profile.password',['user'])  }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="quicky-form-inner">
                                                
                                                <div class="single-input">
                                                    <label for="account-details-oldpass">Current password *</label>
                                                    <input type="password" class="form-control @error('oldpass') is-invalid @enderror" name="oldpass" required>
                                                    @error('oldpass')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-newpass">New password *</label>
                                                    <input type="password" class="form-control @error('newpass') is-invalid @enderror" name="newpass" id="newpass" required>
                                                    @error('newpass')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input">
                                                    <label for="account-details-confpass">Confirm new password *</label>
                                                    <input type="password" class="form-control @error('newpass_confirmation') is-invalid @enderror" name="newpass_confirmation" id="confpass"  data-rule-equalto="#newpass" required>
                                                    @error('newpass_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="single-input">
                                                    <button class="quicky-btn" id="password_submit" type="button">Update password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Account Page Area End Here -->
        </main>

        <div class="modal fade modal-wrapper" id="order_details" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="modal-inner-area sp-area row">
                            <div class="col-xl-5 col-lg-6">
                            </div>
                            <div class="col-xl-7 col-lg-6">
                                <div class="sp-content">
                                    <div class="sp-heading">
                                        <h5><a href="#">Moonstar Clock</a></h5>
                                    </div>
                                    <div class="rating-box">
                                        <ul>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li class="silver-color"><i class="zmdi zmdi-star"></i></li>
                                            <li class="silver-color"><i class="zmdi zmdi-star"></i></li>
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span class="new-price new-price-2 ml-0">$194.00</span>
                                        <span class="old-price">$241.00</span>
                                    </div>
                                    <div class="sp-essential_stuff">
                                        <ul>
                                            <li>Brands <a href="javascript:void(0)">Buxton</a></li>
                                            <li>Product Code: <a href="javascript:void(0)">Product 16</a></li>
                                            <li>Reward Points: <a href="javascript:void(0)">100</a></li>
                                            <li>Availability: <a href="javascript:void(0)">In Stock</a></li>
                                            <li>EX Tax: <a href="javascript:void(0)"><span>$453.35</span></a></li>
                                            <li>Price in reward points: <a href="javascript:void(0)">400</a></li>
                                        </ul>
                                    </div>
                                    <div class="color-list_area">
                                        <div class="color-list_heading">
                                            <h4>Available Options</h4>
                                        </div>
                                        <span class="sub-title">Color</span>
                                        <div class="color-list">
                                            <a href="javascript:void(0)" class="single-color active" data-swatch-color="red">
                                                <span class="bg-red_color"></span>
                                                <span class="color-text">Red (+$150)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color" data-swatch-color="orange">
                                                <span class="burnt-orange_color"></span>
                                                <span class="color-text">Orange (+$170)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color" data-swatch-color="brown">
                                                <span class="brown_color"></span>
                                                <span class="color-text">Brown (+$120)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color" data-swatch-color="umber">
                                                <span class="raw-umber_color"></span>
                                                <span class="color-text">Umber (+$125)</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text">
                                            <div class="dec qtybutton"><i class="zmdi zmdi-chevron-down"></i></div>
                                            <div class="inc qtybutton"><i class="zmdi zmdi-chevron-up"></i></div>
                                        <div class="dec qtybutton"><i class="zmdi zmdi-chevron-down"></i></div><div class="inc qtybutton"><i class="zmdi zmdi-chevron-up"></i></div></div>
                                    </div>
                                    <div class="quicky-group_btn">
                                        <ul>
                                            <li><a href="cart.html" class="add-to_cart">Add To Cart</a></li>
                                            <li><a href="wishlist.html"><i class="zmdi zmdi-favorite-outline"></i></a></li>
                                            <li><a href="compare.html"><i class="zmdi zmdi-shuffle"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="quicky-tag-line">
                                        <h6>Tags:</h6>
                                        <a href="javascript:void(0)">clock,</a>
                                        <a href="javascript:void(0)">watch,</a>
                                        <a href="javascript:void(0)">bag</a>
                                    </div>
                                    <div class="quicky-social_link">
                                        <ul>
                                            <li class="facebook">
                                                <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="" data-original-title="Facebook">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="" data-original-title="Twitter">
                                                    <i class="fab fa-twitter-square"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="https://www.youtube.com" data-toggle="tooltip" target="_blank" title="" data-original-title="Youtube">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="" data-original-title="Google Plus">
                                                    <i class="fab fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="" data-original-title="Instagram">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
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
    <script>
        $(document).on( "click", "#password_submit" , function() {
            if($('#password_form').valid()){
                $('#password_form').submit();
            }
            else{
            }
        });

        $(document).on("click", ".modal-btn", function(){
            $('#order_details').modal('show');
        });
    </script>
    
    @endsection