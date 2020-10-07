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
                <h1 class="m-0 text-dark">Orders list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Orders list</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-hover yajra-datatable">
                            <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" class="allSelector"></th>
                                <th scope="col">Order no.</th>
                                <th scope="col">Total Amt.</th>
                                <th scope="col">Payment type</th>
                                <th scope="col">Payment status</th>
                                <th scope="col">Order status</th>
                                <th scope="col">Order Date</th>
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


    <!--Edit Modal -->
    <div class="modal fade" id="editOrderModal" tabindex="-1" role="dialog" aria-labelledby="editOrderModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <form method="POST" action="{{ route('admin-tag.editTag') }}">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="editTagModalTitle">Change order status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group mt-2">
                <label class="">Order no. :</label>
                <input type="text" name="id" id="editOrderId" class="form-control" required readonly>
            </div>
            <div class="form-group mt-2">
                <label class="">Change status to :</label>
                <select name="order_status" class="form-control" id="order_status" required>
                    <option value="">-- Select status --</option>
                    <option value="ORDERED">Ordered</option>
                    <option value="ACCEPTED">Accepted</option>
                    <option value="REJECTED">Rejected</option>
                    <option value="SHIPPED">Shipped</option>
                    <option value="DELIVERED">Delivered</option>
                </select>
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


$(function () {

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.order') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
            {data: 'check', name: 'check', orderable: false, searchable: true},
            {data: 'id', name: 'id', orderable: true, searchable: true},
            {data: 'amount', name: 'amount', orderable: true, searchable: true},
            {data: 'payment_type', name: 'payment_type', orderable: true, searchable: true},
            {data: 'is_paid', name: 'is_paid',
                render: function (data, type, full, meta) {
                    if(data==1){
                        var stat= '<span class="text-success">PAID</span>';
                        return stat;
                    }
                    else{
                        var stat= '<p class="text-warning">PENDING</p>';
                        return stat;
                    }
                },
             orderable: true, searchable: true},
            {data: 'order_status', name: 'order_status', orderable: true, searchable: true},
            {
                data: 'created_at',
                name: 'created_at',
                render: function (data, type, full, meta) {
                   var cdate= new Date(data);
                   return cdate.getDate() + '-' + cdate.getMonth() + '-' + cdate.getFullYear();
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
        order: [[ 1, 'desc' ]]
    });

    // All select/deselect button
    $(document).on('click', '.allSelector', function() {
        if ($(this).is(':checked')) {
            $('.rowSelector').prop( "checked", true );
            $('.btn-bulk').hide();
        }
        else{
            $('.rowSelector').prop( "checked", false );
            $('.btn-bulk').show();
        }

    });

    $('#editOrderModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-body input[name="id"]').val(id);
    })

});

</script>


@endsection
