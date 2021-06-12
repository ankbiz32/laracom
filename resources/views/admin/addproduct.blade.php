@extends('layouts.admin')

@section('css')
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/tags/bootstrap-tagsinput.css">
<link rel="stylesheet" href="{{URL::to('/')}}/plugins/summernote/summernote-bs4.css">
<style>
    .select2-selection__choice {
        background-color: #007bff !important;
        border: none !important;
    }

    .select2-selection__choice span {
        color: white !important;
    }

    .custom-switch .custom-control-label::after {
        background: white !important;
        box-shadow: 1px 1px 5px #00000088;
    }

    .select2-container--default .select2-selection--single,
    .select2-selection--multiple {
        border: 1px solid #ddd !important;
    }

    .select2-selection__arrow {
        top: 0.12rem !important;
    }
</style>
@endsection

@section ('content')
<div class="content-wrapper">
    <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">+ Add new product :</h1>
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
                                <a class="nav-link py-2" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Images</a>
                                <a class="nav-link py-2" id="vert-tabs-description-tab" data-toggle="pill" href="#vert-tabs-description" role="tab" aria-controls="vert-tabs-description" aria-selected="false">Description</a>
                                <a class="nav-link @error('meta_title') text-danger @enderror py-2" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">SEO</a>
                                <a class="nav-link py-2" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Attributes</a>
                                <a class="nav-link py-2" id="vert-tabs-discount-tab" data-toggle="pill" href="#vert-tabs-discount" role="tab" aria-controls="vert-tabs-discount" aria-selected="false">Discount</a>
                                <a class="nav-link py-2" id="vert-tabs-inventory-tab" data-toggle="pill" href="#vert-tabs-inventory" role="tab" aria-controls="vert-tabs-inventory" aria-selected="false">Inventory</a>
                                <a class="nav-link py-2" id="vert-tabs-location-tab" data-toggle="pill" href="#vert-tabs-location" role="tab" aria-controls="vert-tabs-location" aria-selected="false">Marketplace</a>
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

                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="price">{{ __('Price') }} <span class="req"> *</span></label>
                                            <div class="col-sm-10">
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <strong class="input-group-text">₹</strong>
                                                    </div>
                                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price')  }}" required autocomplete="price" autofocus>
                                                </div>
                                                @error('price')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="category">{{ __('Category') }}<span class="req"> *</span></label>
                                            <div class="col-sm-10">
                                                <select name="category[]" id="addproductcategory" multiple class="form-control select2" style="width: 100%;">
                                                    @if($categories)
                                                    <option value="" disabled>Select categories</option>
                                                    @foreach($categories as $c)
                                                    <option value="{{ $c->id }}">{{ $c->full_name }} ({{ $c->country_iso_code }}) </option>
                                                    @endforeach
                                                    @else
                                                    <option value="" disabled>No categories found. Add some categories first.</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="category">{{ __('Brand') }}<span class="req"> *</span></label>
                                            <div class="col-sm-10">
                                                <select name="brand" id="addBrand" class="form-control select2" style="width: 100%;" required>
                                                    @if(count($brands))
                                                    <option value="" disabled>Select brand</option>
                                                    @foreach($brands as $b)
                                                    <option value="{{ $b->id }}">{{ $b->name }} ({{ $b->country_iso_code }})</option>
                                                    @endforeach
                                                    @else
                                                    <option value="" disabled>No brands found. Add some brands first.</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="image">Product Image<span class="req"> *</span></label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" name="image" accept=".jpg, .jpeg, .png, .bmp, .svg" required>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                @error('image')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="max_selling_qty">Max order qty <span class="req"> *</span></label>
                                            <div class="input-group col-sm-10">
                                                <input type="number" id="max_order_qty" value="{{ old('max_order_qty') }}" name="max_order_qty" class="form-control @error('max_order_qty') is-invalid @enderror" required>
                                            </div>
                                            @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="tags">{{ __('Tags') }}<span class="req"> *</span></label>
                                            <div class="col-sm-10">
                                                <select name="tags[]" id="tags" multiple class="form-control" style="width: 100%;" required>
                                                    @if($tags)
                                                    <option value="" disabled>Start typing some tags...</option>
                                                    @foreach($tags as $t)
                                                    <option value="{{ $t->tag }}">{{ $t->tag }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="customMultiFile">Additional Images</label>
                                            <div class="col-sm-10">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input @error('multi_img') is-invalid @enderror" id="customMultiFile" name="multi_img[]" accept=".jpg, .jpeg, .png, .bmp, .svg" multiple>
                                                    <label class="custom-file-label" for="customMultiFile">Choose file</label>
                                                </div>
                                                <small>( Multiple images can be uploaded )</small>
                                                @error('multi_img')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="vert-tabs-description" role="tabpanel" aria-labelledby="vert-tabs-description-tab">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="price">Short description</label>
                                            <div class="col-sm-10">
                                                <textarea name="short_des" id="short_des" class="form-control @error('short_des') is-invalid @enderror" rows="3" maxlength="200"></textarea>
                                                @error('short_des')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="price">Full description</label>
                                            <div class="col-sm-10">
                                                <textarea name="full_des" id="full_des" class="form-control @error('full_des') is-invalid @enderror" rows="5"></textarea>
                                                @error('full_des')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="price">Meta title :</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror">
                                                @error('meta_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="price">Meta Description :</label>
                                            <div class="col-sm-10">
                                                <textarea rows="6" name="meta_descr" class="form-control" maxlength="500"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">

                                    <div class="attributesDiv">
                                        <?php
                                        if (!empty($_POST["attribute_id"])) {
                                            foreach ($_POST["attribute_id"] as $k => $v) {
                                        ?>
                                                <div class="form-row attribute_row<?php echo $k; ?>">
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="attribute_id<?php echo $k; ?>" class="">Attribute</label>
                                                            <select id="attribute_id<?php echo $k; ?>" name="attribute_id[<?php echo $k; ?>]" class="form-control-sm form-control select2 attribute_id" data-placeholder="Select Attribute" data-no="<?php echo $k; ?>">
                                                                <option value=""></option>
                                                                <?php if (!empty($attributes)) {
                                                                    foreach ($attributes as $row) { ?>
                                                                        <option value="<?php echo $row->id; ?>" <?php echo ($v == $row->id) ? 'selected="selected"' : ''; ?>><?php echo $row->name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <label id="attribute_id<?php echo $k; ?>-error" class="error" for="attribute_id<?php echo $k; ?>"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="position-relative form-group">
                                                            <label for="attribute_detail_id<?php echo $k; ?>" class="">Attribute Option</label>
                                                            <select id="attribute_detail_id<?php echo $k; ?>" name="attribute_detail_id[<?php echo $k; ?>]" class="form-control-sm form-control select2 attribute_detail_id" data-placeholder="Select Option" data-no="<?php echo $k; ?>">
                                                                <option value=""></option>
                                                                <?php if (!empty($attributeDetailsList)) {
                                                                    foreach ($attributeDetailsList as $row) { ?>
                                                                        <option value="<?php echo $row->id; ?>" <?php echo ($_POST["attribute_detail_id"][$k] == $row->id) ? 'selected="selected"' : ''; ?>><?php echo $row->name; ?></option>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <label id="attribute_detail_id<?php echo $k; ?>-error" class="error" for="attribute_detail_id<?php echo $k; ?>"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="margin-top:30px;">
                                                        <a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="removeAttributeDiv('attribute_row<?php echo $k; ?>');"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <div class="form-row addAttr">
                                        <div class="col-md-3" style="margin-bottom:15px;">
                                            <a href="javascript:void(0);" class="btn btn-info btn-sm btn_add_attribute" onclick="addAttribute();"><i class="fa fa-plus"></i> Add Attributes</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-discount" role="tabpanel" aria-labelledby="vert-tabs-discount-tab">
                                    <div class="col">
                                        <div class="form-group row">
                                            <div class="col-sm-10">
                                                <label class="form-check-label mr-2" for="has_discount"><strong>Product has discount</strong></label>
                                                <div class="custom-control custom-switch d-inline">
                                                    <input type="checkbox" class="custom-control-input" name="has_discount" id="has_discount">
                                                    <label class="custom-control-label btn" for="has_discount"></label>
                                                </div>
                                                @error('has_discount')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col discOptions mt-5" style="display:none">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="discount_type">{{ __('Discount type') }} <span class="req"> *</span></label>
                                            <div class="col-sm-9">
                                                <div class="input-group ">
                                                    <select name="discount_type" id="discount_type" class="form-control @error('discount_type') is-invalid @enderror">
                                                        <option value="PERCENT">PERCENT OFF</option>
                                                        <option value="FLAT">FLAT RATE</option>
                                                    </select>
                                                </div>
                                                @error('discount_type')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col discOptions" style="display:none">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="discount_rate">{{ __('Discount rate') }} <span class="req"> *</span></label>
                                            <div class="col-sm-9">
                                                <div class="input-group ">
                                                    <input id="discount_rate" type="number" class="form-control @error('discount_rate') is-invalid @enderror" name="discount_rate" step="0.01" value="{{ old('discount_rate')  }}">
                                                </div>
                                                <small>* Enter discount percent OR discounted product price</small>
                                                @error('discount_rate')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-inventory" role="tabpanel" aria-labelledby="vert-tabs-inventory-tab">


                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="sku">{{ __('Product SKU') }} :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group ">
                                                    <input id="sku" type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{ old('sku')  }}">
                                                </div>
                                                @error('sku')
                                                <small class="text-danger">{{$message}} </small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="in_stock">{{ __('Stock availability') }} :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group ">
                                                    <select name="in_stock" id="in_stock" class="form-control @error('in_stock') is-invalid @enderror">
                                                        <option value="1">In stock</option>
                                                        <option value="0">Out of stock</option>
                                                    </select>
                                                </div>
                                                @error('in_stock')
                                                <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-location" role="tabpanel" aria-labelledby="vert-tabs-location-tab">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="country_iso_code">{{ __('Product available in') }} :</label>
                                            <div class="col-sm-9">
                                                <div class="input-group ">
                                                    <select name="country_iso_code[]" id="country_iso_code" class="select2 form-control @error('country_iso_code') is-invalid @enderror" style="width: 100%;" required multiple>
                                                        @if($countries)
                                                        @foreach($countries as $cn)
                                                        <option value="{{ $cn->country_iso_code }}" @if($cn->country_iso_code=='IN') selected @endif>{{ $cn->country_name.' ('.$cn->country_iso_code.')' }}</option>
                                                        @endforeach
                                                        @else
                                                        <option value="" disabled>No countries found. Add some countries first.</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                @error('country_iso_code')
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
<script src="{{URL::to('/')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="{{URL::to('/')}}/plugins/select2/js/select2.full.min.js"></script>
<script src="{{URL::to('/')}}/plugins/tags/bootstrap-tagsinput.js"></script>
<script src="{{URL::to('/')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {

        bsCustomFileInput.init();

        $('#full_des').summernote({
            height: 200,
        });

        $("#has_discount").change(function() {
            if ($(this).is(':checked')) {
                $('.discOptions').fadeIn();
                $('#discount_type').attr('required', '');
                $('#discount_rate').attr('required', '')
            } else {
                $('.discOptions').fadeOut();
                $('#discount_type').removeAttr('required');
                $('#discount_rate').removeAttr('required')
            }
        });

        $("#discount_type").change(function() {
            var selected = $(this).children("option:selected").val();
            if (selected == '') {

            } else {

            }
        });
    });

    $('.select2').select2();
    $('#tags').select2({
        tags: true
    });

    $('#tags-input').tagsinput({
        confirmKeys: [13, 188]
    });

    function addAttribute() {
        var tsp = Date.now();
        var l = $(".attribute_id").length;
        $('<div class="form-row attribute_row' + tsp + '"><div class="col-md-4"><div class="position-relative form-group"><label for="attribute_id' + tsp + '" class="">Attribute</label><select id="attribute_id' + tsp + '" name="attribute_id[' + tsp + ']" class="form-control-sm form-control attribute_id" data-placeholder="Select Attribute" data-no="' + tsp + '"><option value=""></option><?php if (!empty($attributes)) {
                                                                                                                                                                                                                                                                                                                                                                                                            foreach ($attributes as $row) { ?> <option value="{{ $row->id}}">{{ $row->name }}</option> <?php }
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        } ?></select><label id="attribute_id' + tsp + '-error" class="error" for="attribute_id' + tsp + '"></label></div></div><div class="col-md-4"><div class="position-relative form-group"><label for="attribute_detail_id' + tsp + '" class="">Attribute Option</label><select id="attribute_detail_id' + tsp + '" name="attribute_detail_id[' + tsp + ']" class="form-control-sm form-control attribute_detail_id" data-placeholder="Select Option"  data-no="' + tsp + '" ></select><label id="attribute_detail_id' + tsp + '-error" class="error" for="attribute_detail_id' + tsp + '"></label></div></div><div class="col-md-2" style="margin-top:30px;"><a href="javascript:void(0);" class="btn btn-danger btn-sm" onclick="removeAttributeDiv(\'attribute_row' + tsp + '\');"><i class="fa fa-trash"></i></a></div></div>').insertBefore($('.addAttr'));
        $('#attribute_id' + tsp + '').select2();
        $('#attribute_detail_id' + tsp + '').select2();
    }

    function removeAttributeDiv(divId) {
        notie.confirm({
            text: 'Are you sure?'
        }, function() {
            $("." + divId).remove();
        })
    }

    $(document).on("change keyup", ".attribute_id", function() {

        var itemNo = $(this).attr("data-no");
        var attribute_id = $(this).val();
        var validSelection = true;

        $("#attribute_detail_id" + itemNo).html('<option value="">Select Options</option>');
        $('#attribute_detail_id' + itemNo + '').trigger('change');

        let adt = <?= $attribute_details ?>;
        let ast = adt.filter(a => a.attribute_id == attribute_id)
        console.log(ast);
        let opts = '<option value="">Select Option</option>';
        ast.map(a => {
            opts += `<option value="${a.id}">${a.name}</option>`;
        })

        $("#attribute_detail_id" + itemNo).html(opts);
        $('#attribute_detail_id' + itemNo + '').trigger('change');
    });

    $(document).on("change keyup", ".attribute_detail_id", function() {
        var cId = $(this).attr("id");
        var attribute_id = $(this).val();
        $(".attribute_detail_id").each(function(i, row) {
            if ($(row).val() && $(row).val() == attribute_id && $(row).attr("id") != cId) {
                alert("Already Selected");
                $('#' + cId + '').val(null).trigger('change');
            }
        });
    });
    
</script>
@endsection