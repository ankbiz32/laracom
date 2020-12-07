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
                <h1 class="m-0 text-dark">+ Add New Attribute :</h1>
            </div>
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{URL::to('/admin-attribute')}}">Attributes list</a></li>
                <li class="breadcrumb-item active">Add Attribute</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-8">
                    <div class="card card-body">
                        <form method="POST" action="{{ route('attribute.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-10">
                                    <label for="name" class="">{{ __('Attribute') }}</label>
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
                            <div class="attributeDiv">
                                <div class="row form-row attribute_row_0" >
                                    <div class="col-sm-5">
                                        <div class="position-relative form-group">
                                            <label for="attribute_option_0" class="">Option Name</label>
                                            <input type="text" id="attribute_option_0" name="Attribute[0][name]" class="form-control attribute_option" value="" required />
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="position-relative form-group">
                                            <label for="attribute_describe_0" class="">Description</label>
                                            <input type="text" id="attribute_describe_0" name="Attribute[0][describe]" class="form-control attribute_describe" value="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="position-relative form-group" style="margin-top:30px;">
                                            <a href="javascript:void(0);" class="btn btn-info" onclick="addMoreOption();"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary m-2">ADD ATTRIBUTE</button>
                            <a href="{{URL::to('/admin-attribute')}}" class="btn btn-default m-2">CANCEL</a>
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
    <script>
function addMoreOption(){

	var tsp = Date.now();

	$(".attributeDiv").append('<div class="form-row attribute_row_'+tsp+'"><div class="col-md-5"><div class="position-relative form-group"><label for="attribute_option_'+tsp+'" class="">Option Name</label><input type="text" id="attribute_option_'+tsp+'" name="Attribute['+tsp+'][name]" class="form-control attribute_option" value="" required></div></div><div class="col-md-5"><div class="position-relative form-group"><label for="attribute_describe_'+tsp+'" class="">Description</label><input type="text" id="attribute_describe_'+tsp+'" name="Attribute['+tsp+'][describe]" class="form-control attribute_describe" value=""></div></div><div class="col-md-2"><div class="position-relative form-group mt-30" style="margin-top:30px;"><a href="javascript:void(0);" class="btn btn-danger" onclick="removeOption(\'attribute_row_'+tsp+'\');"><i class="fa fa-trash"></i></a></div></div></div>');
}

function removeOption(rowId){
    notie.confirm({ text: 'Are you sure?' }, function() {
        $("."+rowId+"").remove();
    })
}
    </script>
@endsection
