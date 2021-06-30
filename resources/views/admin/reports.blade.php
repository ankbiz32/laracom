@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/tags/bootstrap-tagsinput.css">
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/summernote/summernote-bs4.css">
<style>
    .custom-switch .custom-control-label::after {
        background: white !important;
        box-shadow: 1px 1px 5px #00000088;
    }
</style>
@endsection

@section ('content')
<div class="content-wrapper">
    <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{URL::to('/admin-product')}}">Products list</a></li>
                        <li class="breadcrumb-item active">Add product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-body px-sm-3 px-2">
                <form method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mx-3 mx-sm-0 col-sm-3 bg-light py-4 pl-4 pr-0">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active py-2" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">General</a>
                            </div>
                        </div>
                        <div class="col-sm-7 ml-sm-4">
                            <div class="tab-content pt-4" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }} <span class="req"> *</span></label>
                                            <div class="col-sm-10">
                                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                @error('name')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-7 offset-3 mt-2 text-right">
                            <button type="submit" class="btn btn-primary mr-2">SAVE PRODUCT</button>
                            <a href="{{URL::to('/admin-product')}}" class="btn btn-default mr-2 mr-sm-0">CANCEL</a>
                        </div>
                    </div>
                </form>
            </div>
    </section>
</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function() {

    let opts;


    function addAttribute() {
    }


    $(document).on("change keyup", ".attribute_id", function() {

    });
});

    
</script>
@endsection