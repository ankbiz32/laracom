@extends('layouts.admin')

@section ('content')

    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark"> Edit Country :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('/admin-country')}}">Country list</a></li>
                <li class="breadcrumb-item active">Edit Country</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
            <div class="col-12">
                <div class="card card-body px-sm-3 px-2">
                <form method="POST" action="{{ route('country.update',['id'=>$countries->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="country_name" class="">{{ __('Country Name') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="country_name" type="text" value="{{ old('country_name') ?? $countries->country_name}}" class="form-control @error('country_name') is-invalid @enderror" name="country_name" placeholder="India" value="{{ old('country_name') }}" required>
                                    @error('country_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="country_iso_code" class="">{{ __('Country ISO code') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="country_iso_code" value="{{ old('country_iso_code') ?? $countries->country_iso_code}}" type="text" class="form-control @error('country_iso_code') is-invalid @enderror" name="country_iso_code" placeholder="IN" value="{{ old('country_iso_code') }}" required>
                                    @error('country_iso_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="currency" class="">{{ __('Currency') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="currency" type="text" value="{{ old('currency') ?? $countries->currency}}" class="form-control @error('currency') is-invalid @enderror" name="currency" value="{{ old('currency') }}" placeholder="INR" required>
                                    @error('currency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="currency_symbol" class="">{{ __('Currency symbol') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="currency_symbol" value="{{ old('currency_symbol') ?? $countries->currency_symbol}}" type="text" class="form-control @error('currency_symbol') is-invalid @enderror" name="currency_symbol" placeholder="₹" value="{{ old('currency_symbol') }}" required>
                                    @error('currency_symbol')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="locale_code" class="">{{ __('Language code') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="locale_code" value="{{ old('locale_code') ?? $countries->locale_code}}"  type="text" class="form-control @error('locale_code') is-invalid @enderror" name="locale_code" placeholder="EN" value="{{ old('locale_code') }}" required>
                                    @error('locale_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="locale_name" class="">{{ __('Language name') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="locale_name" value="{{ old('locale_name') ?? $countries->locale_name}}" type="text" class="form-control @error('locale_name') is-invalid @enderror" name="locale_name" placeholder="english" value="{{ old('locale_name') }}" required>
                                    @error('locale_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2 mt-4">UPDATE</button>
                    <a href="{{URL::to('/admin-country')}}" class="btn btn-default mr-2 mr-sm-0  mt-4">CANCEL</a>
                </form>
                </div>
            </div>
            </div>
        </section>
    </div>


@endsection
