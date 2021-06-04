@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<style>
    .select2-selection__choice {
        background-color: #007bff !important;
        border: none !important;
    }

    .select2-selection__choice span {
        color: white !important;
    }

    .text-sm .select2-container--default .select2-selection--single,
    select.form-control-sm~.select2-container--default .select2-selection--single {
        height: calc(2.3rem + 2px);
        padding-top: 10px;
    }

    .select2-container--default .select2-selection--single,
    .select2-selection--multiple {
        border: 1px solid #ddd !important;
    }

    .select2-selection__arrow {
        top: 0.5rem !important;
        right: 0.5rem !important;
    }

    label.error {
        color: #d00000
    }
</style>
@endsection

@section ('content')
<div class="content-wrapper">
    <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark">Edit user :</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/users')}}">Users list</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card card-body">
                    <form method="POST" id="editUserForm" action="{{ route('user.update',['id'=>$user->id]) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name" class="">{{ __('Name') }}</label>
                                <div class="form-group">
                                    <div>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Full name" value="{{ old('name') ?? $user->name}}" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="email" class="">{{ __('Email') }} <small>( Will be used for login )</small></label>
                                <div class="form-group">
                                    <div>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="xyz@abc.com" name="email" value="{{ old('email') ?? $user->email }}" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="phonenumber" class="">{{ __('Contact no.') }}</label>
                                <div class="form-group">
                                    <div>
                                        <input id="phonenumber" type="text" maxlength="10" minlength="10" class="form-control number @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') ?? $user->profile->phonenumber }}" required>
                                        @error('phonenumber')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6" hidden>
                                <label for="country_iso_code" class="">{{ __('Country') }}</label>
                                <div class="form-group">
                                    <div>
                                        <select name="country_iso_code" class="form-control select2 @error('country_iso_code') is-invalid @enderror" id="country_iso_code" value="{{ old('country_iso_code') }}" required>
                                            @foreach ($countries as $c)
                                            <option value="{{$c->country_iso_code}}" {{$c->country_iso_code == $user->country_iso_code ? "selected" : null}}>{{$c->country_name}} ( {{$c->country_iso_code}} )</option>
                                            @endforeach
                                        </select>
                                        @error('country_iso_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="role" class="">{{ __('Role') }}</label>
                                <div class="form-group">
                                    <div>
                                        <select name="role" class="form-control select2 @error('role') is-invalid @enderror" id="role" value="{{ old('role') }}" required>
                                            <option value="Customer" {{$user->role == "Customer" ? "selected" : null}} selected>Customer</option>
                                            <option value="Admin" {{$user->role == "Admin" ? "selected" : null}}>Admin</option>
                                            <option value="INVENTORY_MANAGER" {{$user->role == "INVENTORY_MANAGER" ? "selected" : null}}>Inverntory Manager</option>
                                            <option value="SALES_MANAGER" {{$user->role == "SALES_MANAGER" ? "selected" : null}}>Sales Manager</option>
                                        </select>
                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="password" class="">{{ __('Pasword') }} <small>( Leave blank if not changing password )</small> </label>
                                <div class="form-group">
                                    <div>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="password_confirmation" class="">{{ __('Confrm password') }} <small>( Leave blank if not changing password )</small> </label>
                                <div class="form-group">
                                    <div>
                                        <input id="password_confirmation" type="text" class="form-control @error('password_confirmation') is-invalid @enderror" data-rule-equalTo="#password" data-msg-equalTo="Passwords do not match. Please type the same password again" name="password_confirmation" value="{{ old('password_confirmation') }}" >
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Passwords do not match. Please type the same password again</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-2">UPDATE</button>
                        <a href="{{URL::to('/users')}}" class="btn btn-default m-2">CANCEL</a>
                    </form>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection


@section('scripts')
<script src="{{URL::to('/')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="{{URL::to('/')}}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{URL::to('/')}}/plugins/jquery-validation/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $("#editUserForm").validate();
    })
</script>
@endsection