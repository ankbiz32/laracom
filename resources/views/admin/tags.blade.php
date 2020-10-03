@extends('layouts.admin')

@section ('css')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
    .custom-control-label.btn::after, .custom-switch.custom-switch-on-success .custom-control-input:checked~.custom-control-label::after{
        background:white;
    }
    .selector, .allSelector{
        cursor:pointer
    }
    td.selector::after{
        content:'⬜';
    }
    .selected .selector::after{
        content:'☑';
    }
</style>
@endsection


@section ('content')
    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tags list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Tags list</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row col mb-4">
                        <a href="{{ route('admin.addform') }}" class="btn btn-primary">+ ADD TAG</a>
                        <span class="dropdown ml-auto">
                            <a class="dropdown-toggle btn btn-secondary btn-bulk" style="display: none;" data-toggle="dropdown" href="#" aria-expanded="false">
                                BULK ACTION <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="activateProducts()">Activate products</a>
                                <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="deActivateProducts()">Deactivate products</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" tabindex="-1" href="javascript:;"  onclick="removeProducts(event)">Remove products</a>
                            </div>
                        </span>
                        <!-- <a href="{{ route('admin.addform') }}" class="btn btn-default btn-flat ml-auto">BULK ACTION</a> -->
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-hover yajra-datatable">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tag</th>
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
@endsection


@section ('scripts')
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-select/js/dataTables.select.min.js"></script>
    <script src="plugins/datatables-select/js/select.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


<script type="text/javascript">
  $(function () {

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.tags') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
            {data: 'tag', name: 'tag', orderable: true, searchable: true},
            {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ]
    });

  });
</script>


@endsection
