@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <style>
        .select2-selection__choice{
            background-color:#007bff !important;
            border:none !important;
        }
        .select2-selection__choice span{
            color:white !important;
        }
    </style>
@endsection

@section ('content')
    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark">+ Add New Country :</h1>
            </div>
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('/admin-country')}}">Country list</a></li>
                <li class="breadcrumb-item active">Add Country</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-8">
                    <div class="card card-body">
                        <form method="POST" action="{{ route('country.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-10">
                                    <label for="name" class="">{{ __('Country Name') }}</label>
                                    <div class="form-group">
                                        <div>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10">
                                    <label for="language" class="">{{ __('Language') }}</label>
                                    <div class="form-group">
                                        <div>
                                            <input id="language" type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ old('language') }}" required autocomplete="language" autofocus>
                                            @error('language')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-2">ADD</button>
                            <a href="{{URL::to('/admin-country')}}" class="btn btn-default m-2">CANCEL</a>
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
@endsection
