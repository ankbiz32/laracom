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
            <div class="col-8">
                <div class="card card-body px-sm-3 px-2">
                <form method="POST" action="{{ route('country.update',['id'=>$countries->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-sm-10">
                            <label for="name" class="">{{ __('Country Name') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $countries->name}}" required autocomplete="name" autofocus>
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
                            <label for="language" class="">{{ __('Language ') }}</label>
                            <div class="form-group">
                                <div>
                                    <input id="language" type="text" class="form-control @error('language') is-invalid @enderror" name="language" value="{{ old('language') ?? $countries->language}}" required autocomplete="name" autofocus>
                                    @error('language')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2 mt-4">UPDATE</button>
                    <a href="{{URL::to('/admin-attribute')}}" class="btn btn-default mr-2 mr-sm-0  mt-4">CANCEL</a>
                </form>
                </div>
            </div>
            </div>
        </section>
    </div>


@endsection
