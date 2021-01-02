@extends('layouts.admin')

@section ('css')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
@endsection


@section ('content')
    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Brands list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Brands list</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row col mb-4">
                        <a href="javascript:;" data-toggle="modal" data-target="#add" class="btn btn-primary">+ ADD BRAND</a>
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-hover yajra-datatable">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Image</th>
                                <th scope="col">Country</th>
                                <th scope="col">Created</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        </div>
                    </div>

                </div>
        </section>
    </div>

    <!--Add Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form action="admin-brands" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="addTitle">+ Add new brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="input-group d-block">
                <label class="col-form-label mr-3">Brand name:  <span class="req"> *</span></label>
                <input type="text" name="name" class="form-control" placeholder="Enter brand name here" required>
            </div>
            <div class="input-group mt-2">
                <label class="col-form-label mr-3" for="country_iso_code">{{ __('Brand available in') }}: <span class="req"> *</span></label>
                <select style="width:100%;" name="country_iso_code[]" id="country_iso_code" class="select2 form-control @error('country_iso_code') is-invalid @enderror" required multiple>
                    @if($countries)
                        @foreach($countries as $cn)
                        <option value="{{ $cn->country_iso_code }}" @if($cn->country_iso_code=='IN') selected @endif>{{ $cn->country_name.' ('.$cn->country_iso_code.')' }}</option>
                        @endforeach
                    @else
                        <option value="" disabled>No countries found. Add some countries first.</option>
                    @endif
                </select>
                @error('country_iso_code')
                    <small class="text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="input-group mt-2 d-block">
                <label class="col-form-label mr-3">Brand Image: <span class="req"> *</span></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('img_src') is-invalid @enderror" id="customFile" name="img_src" accept=".jpg, .jpeg, .png, .bmp, .svg" required>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        </form>
        </div>
    </div>
    </div>

    <!--Edit Modal -->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ route('admin-brand.editBrand') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="editTagModalTitle">Edit brand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="editBrandId" class="form-control" required>
            <div class="input-group mt-2 d-block">
                <label class="col-form-label mr-3">Brand name:</label>
                <input type="text" name="name" id="editBrandName" class="form-control" required>
            </div>
            <div class="input-group mt-2 d-block">
                <label class=" col-form-label" for="edit_country_iso_code">{{ __('Brand available in') }}: <span class="req"> *</span></label>
                <div class="input-group ">
                    <select name="country_iso_code" id="edit_country_iso_code" class="select2 form-control @error('country_iso_code') is-invalid @enderror" style="width: 100%;" required>
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
            <div class="col">
                <div class="form-group row">
                    <div class="col-sm-7">
                        
                    </div>
                </div>
            </div>
            <div class="input-group mt-2 d-block">
                <label class="col-form-label mr-3">Brand Image:</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('img_src') is-invalid @enderror" id="customFile1" name="img_src" accept=".jpg, .jpeg, .png, .bmp, .svg">
                    <label class="custom-file-label" for="customFile1">Choose file</label>
                </div>
            </div>
            <small>* Choose only if you want to change image</small>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
        </form>
        </div>
    </div>
    </div>


@endsection


@section ('scripts')
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-select/js/dataTables.select.min.js"></script>
    <script src="plugins/datatables-select/js/select.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="{{URL::to('/')}}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="{{URL::to('/')}}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{URL::to('/')}}/plugins/tags/bootstrap-tagsinput.js"></script>


<script type="text/javascript">

// Alert before removing tag
function confirmation(ev){
    notie.confirm({ text: 'Are you sure?' }, function() {
        var tg= ev.target.dataset.rid;
        $('form[data-formId="'+tg+'"]').submit();
    })
}

$(function () {
    
    $('.select2').select2();
    bsCustomFileInput.init();

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin-brands.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
            {data: 'id', name: 'id', orderable: true, searchable: true},
            {data: 'name', name: 'name', orderable: true, searchable: true},
            {
                name: "img_src",
                data: "img_src",
                render: function (data, type, full, meta) {
                    return "<img src=\"" + data + "\" height=\"50\"/>";
                },
                searchable: true
            },
            {data: 'country', name: 'country', orderable: true, searchable: true},
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data, type, full, meta) {
                   var cdate= new Date(data);
                   return cdate.getDate() + '-' + ('0' + (cdate.getMonth()+1)).slice(-2) + '-' + cdate.getFullYear();
                },
                orderable: true,
                searchable: true
            },
            {data: 'action',name: 'action',orderable: true,searchable: true},
        ],
        order: [[ 0, 'desc' ]]
    });

    $('#edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var iso = button.data('iso');
        var modal = $(this);
        modal.find('.modal-title').text('Edit brand "' + name + '"');
        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body input[name="name"]').val(name);
        $('#edit_country_iso_code option').removeAttr('selected');
        $('#edit_country_iso_code option[value='+iso+']').attr('selected', 'selected');
        $('.select2').select2();
    })

});

</script>
<style>
    .select2 .select2-container{
        flex:1 1 0 !important;
    }
</style>


@endsection
