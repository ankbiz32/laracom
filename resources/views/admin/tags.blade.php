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
    input[type=checkbox]{
        -ms-transform: scale(1.5); /* IE */
        -moz-transform: scale(1.5); /* FF */
        -webkit-transform: scale(1.5); /* Safari and Chrome */
        -o-transform: scale(1.5); /* Opera */
        padding: 10px;
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
                        <a href="javascript:;" data-toggle="modal" data-target="#addTagModal" class="btn btn-primary">+ ADD TAG</a>
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

    <!--Add Modal -->
    <div class="modal fade" id="addTagModal" tabindex="-1" role="dialog" aria-labelledby="addTagModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form action="admin-tags" method="POST">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="addTagModalTitle">+ Add new tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="input-group">
                <label class="col-form-label mr-3">Tag name:</label>
                <input type="text" name="tag" class="form-control" placeholder="Enter new tag name here" required>
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
    <div class="modal fade" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="editTagModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ route('admin-tag.editTag') }}">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="editTagModalTitle">Edit tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="editTagId" class="form-control" required>
            <div class="input-group mt-2">
                <label class="col-form-label mr-3">Tag name:</label>
                <input type="text" name="tag" id="editTagName" class="form-control" required>
            </div>
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


<script type="text/javascript">

// Alert before removing tag
function confirmation(ev){
    notie.confirm({ text: 'Are you sure?' }, function() {
        var tg= ev.target.dataset.rid;
        $('form[data-formId="'+tg+'"]').submit();
    })
}

$(function () {

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin-tags.index') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
            {data: 'id', name: 'id', orderable: true, searchable: true},
            {data: 'tag', name: 'tag', orderable: true, searchable: true},
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data, type, full, meta) {
                   var cdate= new Date(data);
                   return ('0' + (cdate.getDate())).slice(-2) + '-' + ('0' + (cdate.getMonth()+1)).slice(-2) + '-' + cdate.getFullYear();
                },
                orderable: true,
                searchable: true
            },
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ],
        order: [[ 0, 'desc' ]]
    });

    $('#editTagModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var tag = button.data('tag');
        var modal = $(this);
        modal.find('.modal-title').text('Edit tag "' + tag + '"');
        modal.find('.modal-body input[name="id"]').val(id);
        modal.find('.modal-body input[name="tag"]').val(tag)
    })

});

</script>


@endsection
