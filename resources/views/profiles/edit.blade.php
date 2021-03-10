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
                                                                <td><a href="javascript:void(0)" data-id="{{$o->id}}" class="modal-btn quicky-btn-2 quicky-btn_sm"><span>View</span></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="5"><h5 class="my-3">You have not ordered anything yet.<h5> <a class="quicky-btn" href="{{URL('/')}}">Start shopping now</a></td>
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
                                                    <select name="country_iso_code" class="form-control @error('country_id') is-invalid @enderror" required>
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
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times; close</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                var id=$(this).data('id');
                $.ajax({
                    url: '{{route("order.show")}}',
                    type:'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    beforeSend : function(){
                        $('#order_details').modal('show');
                        $('#order_details .modal-body').html('<h5 class="d-inline-block"><i class="zmdi zmdi-spinner zmdi-hc-spin"> </i> &nbsp; Loading . . .</h5>');
                    },
                    success: function(resp){
                        $('#order_details .modal-body').html(resp);
                    },
                    error: function(){
                        $('#order_details .modal-body').html('<h5>Server error! Please try again.</h5>');
                    }
                });
        });
    </script>
    
    @endsection