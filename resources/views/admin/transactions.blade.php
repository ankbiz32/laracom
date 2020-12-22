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
    .bulk-span{
        position:absolute !important;
        top:14px;
        left:55%;
        transform:translateX(-100%);
        z-index:10 !important;
    }
    @media(max-width:780px){
        .bulk-span{
            position:relative !important;
            top:25px;
            left:24px;
            transform:translateX(0);
            z-index:10 !important;
        }
    }
</style>
@endsection


@section ('content')
    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tranactions list :</h1>
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
                    <div class="row col mb-4">
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-hover yajra-datatable">
                            <span class="dropdown ml-auto bulk-span">
                                <a class="dropdown-toggle btn btn-default btn-bulk" style="display:none ;" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                                    UPDATE SELECTED ORDERS STATUS<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateOrder('ORDERED')">ORDERED</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateOrder('ACCEPTED')">ACCEPTED</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateOrder('SHIPPED')">SHIPPED</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateOrder('DELIVERED')">DELIVERED</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateOrder('REJECTED')">REJECTED</a>
                                </div>
                            </span>
                            <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" class="allSelector"></th>
                                <th scope="col">Payment Ref.</th>
                                <th scope="col">Total Amt.</th>
                                <th scope="col">Order no.</th>
                                <th scope="col">Payment Date</th>
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

    var items= new Array();
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.transactions') }}",
            columns: [
                // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
                {data: 'check', name: 'check', orderable: false, searchable: true},
                {data: 'id', name: 'id', orderable: true, searchable: true},
                {data: 'amount', name: 'amount', orderable: true, searchable: true},
                {data: 'type', name: 'type', orderable: true, searchable: true},
                {data: 'is_paid', name: 'is_paid',
                    render: function (data, type, full, meta) {
                        if(data==1){
                            var stat= '<span class="text-success d-block text-center">PAID</span>';
                            return stat;
                        }
                        else{
                            var stat= '<p class="text-warning d-block text-center">PENDING</p>';
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
                    return cdate.getDate() + '/' + cdate.getMonth() + '/' + cdate.getFullYear().toString().substr(-2)+ ' &nbsp; ' + cdate.getHours()+ ':' + cdate.getMinutes();
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


        $('#editOrderModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('.modal-body input[name="id"]').val(id);
        })

    });

</script>


@endsection
