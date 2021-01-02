
@extends('layouts.admin')

@section ('css')
    <link rel="stylesheet" href="plugins/jquery-treeview/css/jquery-treeview.css" />
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/tags/bootstrap-tagsinput.css">
    <style>
        .select2-selection__choice{
            background-color:#007bff !important;
            border:none !important;
        }
        .select2-selection__choice span{
            color:white !important;
        }
        .custom-switch .custom-control-label::after{
            background:white !important;
            box-shadow: 1px 1px 5px #00000088;
        }
        .select2-container--default .select2-selection--single , .select2-selection--multiple {
            border: 1px solid #ddd !important;
        }
        .select2-selection__arrow {
            top:0.12rem !important;
        }
    </style>
@endsection ('css')


@section ('content')
    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Category list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Categories</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <?php if(empty($tree)){?>
                    <div class="col text-center mt-5 noCat">
                        <h6 class="mb-3">No categories found!</h6>
                        <button class="btn btn-xl btn-primary showBtn">+ Create a category</button>
                    </div>

                    <div class="card card-body mt-3 addCategory" style="display:none">
                        <form method="POST" action="{{ route('category.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 mb-4">
                                <h5>Create new category:</h5>
                            </div>
                            <div class="col-12 mb-2">
                                <h6 class="text-muted ">GENERAL</h6>
                            </div>

                            <input type="hidden" class="parent_id" id="parent_id" name="parent_id" value="0" required>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="name">Category name: <span class="req"> *</span></label>
                                    <div class="col-sm-6">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required autofocus>
                                        @error('name')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="country_iso_code">{{ __('Category available in') }}: <span class="req"> *</span></label>
                                    <div class="col-sm-7">
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
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="image">Category Image:</label>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" name="image" accept=".jpg, .jpeg, .png, .bmp, .svg">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('image')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <hr class="border">
                            <div class="col-12 mb-2">
                                <h6 class="text-muted ">SEO</h6>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="meta_title">Meta title:</label>
                                    <div class="col-sm-6">
                                        <input id="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title')  }}" autocomplete="meta_title" autofocus>
                                        @error('meta_title')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="name">Meta Description: </label>
                                    <div class="col-sm-6">
                                        <textarea rows="5" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description">{{ old('meta_description')  }}</textarea>
                                        @error('meta_description')
                                            <small class="text-danger">{{$message}}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-6">
                                        <button type="submit" class="btn btn-primary mr-2">SAVE CATEGORY</button>
                                        <a href="{{URL::to('/admin-categories')}}" class="btn btn-default mr-2 mr-sm-0">CANCEL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>

                <?php } else{?>
                    <div class="card card-body mt-5">
                        <div class="row">
                            <div class="col-sm-3 bg-light py-4 px-4">
                                <button class="btn btn-outline-primary btn-sm addNewMaster">+ Add new master category</button>
                                <p class=" text-muted mt-3">OR</p>
                                <h6>Select any below category to see options:</h6>

                                {!! $tree !!}

                            </div>
                            <div class="col-sm-8 ml-0 ml-sm-4 py-4">

                                <form method="POST" class="masterForm" action="{{ route('category.create') }}" enctype="multipart/form-data" style="display:none">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <h5>Create new <span id="formHeading">master</span> category <span id="forCategory"></span> :</h5>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <h6 class="text-muted ">GENERAL</h6>
                                        </div>

                                        <input id="pidM" type="hidden" class="" name="parent_id" required>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="name">Category name: <span class="req"> *</span></label>
                                                <div class="col-sm-7">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name')  }}" required autocomplete="price" autofocus>
                                                    @error('name')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="country_iso_code">{{ __('Category available in') }}: <span class="req"> *</span></label>
                                                <div class="col-sm-7">
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
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="image">Category Image:</label>
                                                <div class="col-sm-7">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" name="image" accept=".jpg, .jpeg, .png, .bmp, .svg">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                    @error('image')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="border">
                                        <div class="col-12 mb-2">
                                            <h6 class="text-muted ">SEO</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="meta_title">Meta title:</label>
                                                <div class="col-sm-7">
                                                    <input id="meta_title" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title')  }}" autocomplete="meta_title" autofocus>
                                                    @error('meta_title')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="name">Meta Description: </label>
                                                <div class="col-sm-7">
                                                    <textarea rows="5" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description">{{ old('meta_description')  }}</textarea>
                                                    @error('meta_description')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary mr-2">SAVE CATEGORY</button>
                                                    <a href="{{URL::to('/admin-categories')}}" class="btn btn-default mr-2 mr-sm-0">CANCEL</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="row editFormHeader" style="display:none">
                                    <div class="col-12 mb-4">
                                        <div class="row align-items-center">
                                            <h5 class="">Edit category:</h5>
                                            <form method="POST" id="removeForm" class="ml-auto" action="{{ route('category.remove') }}">
                                                @csrf
                                                <input type="hidden" name="id" id="removeId">
                                                <button type="button" class="ml-sm-auto text-sm-right text-danger btn link" onclick="confirmation(event)"><i class="fa fa-trash-alt fa-sm"></i> Remove this category</button>
                                                <button type="button" data-pid="" class="btn text-primary link addNewSub"><i class="fa fa-plus"></i> Add sub-category</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <form method="POST" class="editForm" action="{{ route('category.edit') }}" enctype="multipart/form-data" style="display:none">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h6 class="text-muted ">GENERAL</h6>
                                        </div>
                                        <input type="hidden" class="main_id" id="main_id" name="id" required>
                                        <input type="hidden" class="parent_id" id="parent_id" name="parent_id" required>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="name">Category name: <span class="req"> *</span></label>
                                                <div class="col-sm-7">
                                                    <input id="nameE" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="price" autofocus>
                                                    @error('name')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="edit_country_iso_code">{{ __('Category available in') }}: <span class="req"> *</span></label>
                                                <div class="col-sm-7">
                                                    <div class="input-group ">
                                                        <select name="country_iso_code" id="edit_country_iso_code" class="form-control @error('country_iso_code') is-invalid @enderror" style="width: 100%;" required>
                                                            @if($countries)
                                                                @foreach($countries as $cn)
                                                                <option value="{{ $cn->country_iso_code }}">{{ $cn->country_name.' ('.$cn->country_iso_code.')' }}</option>
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
                                        
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="image">Category Image:</label>
                                                <div class="col-sm-7">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="customFile" name="image" accept=".jpg, .jpeg, .png, .bmp, .svg">
                                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                                    </div>
                                                    @error('image')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror

                                                    <img src="" id="currentImg" alt="Image" class="mt-2" height="40"> <br>
                                                    <small id="currentImgMsg"></small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="border">
                                        <div class="col-12 mb-2">
                                            <h6 class="text-muted ">SEO</h6>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="meta_title">Meta title:</label>
                                                <div class="col-sm-7">
                                                    <input id="meta_titleE" type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" autocomplete="meta_title" autofocus>
                                                    @error('meta_title')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label" for="name">Meta Description: </label>
                                                <div class="col-sm-7">
                                                    <textarea rows="5" id="meta_descriptionE" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description"></textarea>
                                                    @error('meta_description')
                                                        <small class="text-danger">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"></label>
                                                <div class="col-sm-9">
                                                    <button type="submit" class="btn btn-primary mr-2">UPDATE CATEGORY</button>
                                                    <a href="{{URL::to('/admin-categories')}}" class="btn btn-default mr-2 mr-sm-0">CANCEL</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                <?php }?>
        </section>
    </div>
@endsection


@section ('scripts')
    <script src="plugins/jquery-treeview/js/jquery-treeview.js"></script>
    <script type="text/javascript" src="plugins/jquery-treeview/js/jquery-treeview-demo.js"></script>
    <script src="{{URL::to('/')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{URL::to('/')}}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{URL::to('/')}}/plugins/tags/bootstrap-tagsinput.js"></script>
    <script>
        $(document).ready(function () {

            $('.select2').select2();
            bsCustomFileInput.init();

            $('.showBtn').on("click", function(){
                $('.noCat').hide();
                $('.addCategory').fadeIn();
            });

            $('.addNewMaster').on("click", function(){
                $('.editForm').hide();
                $('.editFormHeader').hide();
                $('.masterForm').fadeIn();
                $('#formHeading').html('master');
                $('#pidM').val('0');
                $('#forCategory').html(' ');
            });

            $('.addNewSub').on("click", function(){
                var pid= $(this).data('pid');
                $('.editForm').hide();
                $('.editFormHeader').hide();
                $('.masterForm').fadeIn();
                $('#formHeading').html('sub');
                $('#pidM').val(pid);
            });

            $('a.tree-name').on("click", function(){
                // alert($(this).data('id'));
                id=($(this).data('id'));
                $('a.tree-name').removeClass('text-secondary');
                $(this).addClass('text-secondary');
                $('.editForm').fadeIn();
                $('.editFormHeader').fadeIn();
                $('.masterForm').hide();
                $('#removeId').val(id);
                $('#main_id').val(id);
                $('.addNewSub').data('pid',id);

                $.post("{{ route('category.editForm') }}",
                {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                function(data, status){
                    console.log(data[0].country_iso_code);
                    $('#parent_id').val(data[0].parent_id);
                    $('#nameE').val(data[0].name);
                    $('#edit_country_iso_code option').removeAttr('selected');
                    $('#edit_country_iso_code option[value='+data[0].country_iso_code+']').attr('selected', 'selected');
                    if(data[0].img_src!=null){
                        $('#currentImg').attr('src',data[0].img_src);
                        $('#currentImg').fadeIn();
                        $('#currentImgMsg').html('<a href="admin-categories/remove/'+data[0].id+'" class="link text-danger">Remove image</a>');
                    }
                    else{
                        $('#currentImg').hide();
                        $('#currentImgMsg').html('No image found for this category');
                    }
                    $('#meta_titleE').val(data[0].meta_title);
                    $('#meta_descriptionE').val(data[0].meta_description);
                    $('#forCategory').html('for "'+data[0].name+'"');
                });

            });
        });

        // Alert before removing product
        function confirmation(ev){
            ev.preventDefault();
            notie.confirm({ text: 'Are you sure?' }, function() {
                $('#removeForm').submit();
            })
        }
    </script>
@endsection

