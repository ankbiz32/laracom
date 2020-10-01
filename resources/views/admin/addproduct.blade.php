@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
                <div class="col-12">
                    <!-- <div class="card card-body">
                        <form method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row ">

                                <div class="col-sm-6">
                                    <label for="name" class="">{{ __('Name') }}</label>
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

                                <div class="col-sm-6">
                                    <label for="price" class="">{{ __('Price') }}</label>
                                    <div class="form-group">
                                        <div>
                                            <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price')  }}" required autocomplete="price" autofocus>
                                            @error('price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="brand" class="">{{ __('Brand') }}</label>
                                    <div class="form-group">
                                        <div>
                                            <select name="brand" id="addproductbrand" class="form-control">
                                                <option selected="true" value="" disabled hidden>Choose product brand</option>
                                                <option value="Nike">Nike</option>
                                                <option value="Adidas">Adidas</option>
                                                <option value="New Balance">New Balance</option>
                                                <option value="Asics">Asics</option>
                                                <option value="Puma">Puma</option>
                                                <option value="Skechers">Skechers</option>
                                                <option value="Fila">Fila</option>
                                                <option value="Bata">Bata</option>
                                                <option value="Burberry">Burberry</option>
                                                <option value="Converse">Converse</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="gender" class="">{{ __('Gender') }}</label>
                                    <div class="form-group">
                                        <div>
                                            <select name="gender" id="addproductgender" class="form-control">
                                                <option selected="true" value="" disabled hidden>Choose product brand</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                <option value="Unisex">Unisex</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="category" class="">{{ __('Category') }}</label>
                                    <div class="form-group">
                                        <div>
                                            <select name="category" id="addproductcategory" class="form-control">
                                                <option value="Shoes">Shoes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="image" class="">Product Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')

                                        <div style="color:red; font-weight:bold; font-size:0.7rem;">{{ $message }}</div>

                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary m-2">ADD PRODUCT</button>
                            <a href="{{URL::to('/admin-product')}}" class="btn btn-default m-2">CANCEL</a>

                        </form>
                    </div> -->
                </div>

                <div class="card card-body px-sm-3 px-2">
                <form method="POST" action="{{ route('product.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-4 col-sm-3 bg-light py-4 pl-4 pr-0">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active py-2" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">General</a>
                            <a class="nav-link py-2" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Images</a>
                            <a class="nav-link @error('meta_title') text-danger @enderror py-2" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">SEO</a>
                            <a class="nav-link py-2" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Options</a>
                            <a class="nav-link py-2" id="vert-tabs-discount-tab" data-toggle="pill" href="#vert-tabs-discount" role="tab" aria-controls="vert-tabs-discount" aria-selected="false">Discount</a>
                            <a class="nav-link py-2" id="vert-tabs-inventory-tab" data-toggle="pill" href="#vert-tabs-inventory" role="tab" aria-controls="vert-tabs-inventory" aria-selected="false">Inventory</a>
                            <a class="nav-link py-2" id="vert-tabs-location-tab" data-toggle="pill" href="#vert-tabs-location" role="tab" aria-controls="vert-tabs-location" aria-selected="false">Marketplace</a>
                            </div>
                        </div>
                        <div class="col-8 col-sm-7 ml-sm-4">
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
                                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price')  }}" required autocomplete="price" autofocus>
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
                                                <select name="category" id="addproductcategory" class="form-control select2" style="width: 100%;" required>
                                                    <option value="">Select category</option>
                                                    @foreach($categories as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>

                                                    @endforeach
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
                                            <label class="col-sm-2 col-form-label" for="image">Max selling qty<span class="req"> *</span></label>
                                            <div class="input-group col-sm-10">
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                    Additional images.
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                                    <div class="col">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" for="price">Meta title :</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror">
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
                                                <textarea rows="6" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                                    Options like size, color etc.
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-discount" role="tabpanel" aria-labelledby="vert-tabs-discount-tab">
                                    Discounts
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-inventory" role="tabpanel" aria-labelledby="vert-tabs-inventory-tab">
                                    Inventory - SKU , stock
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-location" role="tabpanel" aria-labelledby="vert-tabs-location-tab">
                                    Countries, where the product will be available
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
    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });

        $('.select2').select2()
    </script>
@endsection
