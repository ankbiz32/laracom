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
    input[type=checkbox]{
        -ms-transform: scale(1.5); /* IE */
        -moz-transform: scale(1.5); /* FF */
        -webkit-transform: scale(1.5); /* Safari and Chrome */
        -o-transform: scale(1.5); /* Opera */
        padding: 10px;
    }
    .bulk-span{
        position:absolute !important;
        top:15px;
        left:50%;
        transform:translateX(-100%);
        z-index:10 !important;
    }
    @media(max-width:780px){
        .bulk-span{
            position:relative !important;
            top:0px;
            left:80px;
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
                <h1 class="m-0 text-dark">Users list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Users list</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row col mb-4">
                        <a href="{{ route('user.create') }}" class="btn btn-primary">+ ADD USER</a>
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-sm table-hover yajra-datatable" id="userTable" style="position:relative">
                            <span class="dropdown ml-auto bulk-span">
                                <a class="dropdown-toggle btn btn-default btn-bulk" style="display: none;" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                                    BULK ACTION<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                    <span class="dropdown-item text-secondary bg-light">CHANGE ROLE:</span>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateRole('Customer')">Customer</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateRole('INVENTORY_MANAGER')">Inventory Manager</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateRole('SALES_MANAGER')">Sales Manager</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="updateRole('Admin')">Admin</a>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-item text-secondary bg-light mt-3">CHANGE STATUS:</span>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="changeStatus(1)">Activate User</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="changeStatus(0)">Deactivate User</a>
                                </div>
                            </span>

                            <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" class="allSelector"></th>
                                <th scope="col">User id</th>
                                <th scope="col">Name</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Contact no.</th>
                                <th scope="col">Role</th>
                                <!-- <th scope="col">Created</th> -->
                                <th scope="col">Status</th>
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
        <form method="POST" action="{{ route('user.role') }}">
        @csrf
        <div class="modal-header">
            <h5 class="modal-title" id="editTagModalTitle">Change user role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group mt-2">
                <label class="">User id :</label>
                <input type="text" name="id" id="editOrderId" class="form-control" required readonly>
            </div>
            <div class="form-group mt-2">
                <label class="">Change role to :</label>
                <select name="role" class="form-control" id="order_status" required>
                    <option value="" hidden>-- Select role --</option>
                    <option value="Customer">Customer</option>
                    <option value="Admin">Admin</option>
                    <option value="INVENTORY_MANAGER">Inverntory Manager</option>
                    <option value="SALES_MANAGER">Sales Manager</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

var items= new Array();
$(function () {

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.user') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
            {data: 'check', name: 'check', orderable: false, searchable: true},
            {data: 'id', name: 'id', orderable: true, searchable: true},
            {data: 'name', name: 'name', orderable: true, searchable: true},
            {data: 'email', name: 'email', orderable: true, searchable: true},
            {data: 'phonenumber', name: 'phonenumber', orderable: true, searchable: true},
            {data: 'role', name: 'role', orderable: true, searchable: true},
            // {
            //     data: 'created_at',
            //     name: 'created_at',
            //     render: function (data, type, full, meta) {
            //         if(data){
            //             var cdate= new Date(data);
            //             return cdate.getDate() + '-' + cdate.getMonth() + '-' + cdate.getFullYear();
            //         }
            //         else{
            //             return data;
            //         }
            //     },
            //     orderable: true,
            //     searchable: true
            // },
            {
                data: 'status',
                name: 'status',
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
            getSelected();
        }
        else{
            $('.rowSelector').prop( "checked", false );
            getSelected();
        }
    });

    // Individual select/deselect button
    $(document).on('click', '.rowSelector', function() {
        getSelected();
    });

    function getSelected(){
        items= [];
        $("input:checkbox[class=rowSelector]:checked").each(function () {
            val= $(this).data("id");
            items.push(val);
        });
        if(items.length==0){
            $('.btn-bulk').hide();
        }
        else{
            $('.btn-bulk').show();
        }
    }

    $('#editOrderModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-body input[name="id"]').val(id);
    })

     // Change user status on switching switch button
    $(document).on('change', '.custom-control-input', function() {
        var id=$(this).data('id');
        console.log(id);
        if(this.checked){
            $.ajax({
                type: 'post',
                url: "{{ route('user.status',['id'=>"+id+"]) }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    id:id,
                    active:1,
                },
                success:function(response){
                    notie.alert({
                        text: "User activated!" ,
                        type: 'success'
                    })
                },
                error: function(){
                    notie.alert({
                        text: "Server error !" ,
                        type: 'error'
                    })
                }
            });
        }
        else{
            $.ajax({
                type: 'post',
                url: "{{ route('user.status',['id'=>"+id+"]) }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    id:id,
                    active:0,
                },
                success:function(response){
                    notie.alert({
                        text: "User de-activated!" ,
                        type: 'success'
                    })
                },
                error: function(){
                    notie.alert({
                        text: "Server error !" ,
                        type: 'error'
                    })
                }
            });
        }
    });

});


// Bulk role update for user
function updateRole(role){
    notie.confirm({ text: 'Change role to '+role+' ?' }, function() {
        $.ajax({
            type: 'post',
            url: "{{ route('user.updateRoleBulk') }}",
            data:{
                "_token": "{{ csrf_token() }}",
                id:JSON.stringify(items),
                role:role,
            },
            success:function(response){
                location.reload(true);
            },
            error: function(){
                notie.alert({
                    text: "Server error !" ,
                    type: 'error'
                })
            }
        });
    });
}

// Bulk status change for user
function changeStatus(act){
    $.ajax({
        type: 'post',
        url: "{{ route('user.bulkStatus') }}",
        data:{
            "_token": "{{ csrf_token() }}",
            id:JSON.stringify(items),
            active:act,
        },
        success:function(response){
            location.reload(true);
        },
        error: function(){
            notie.alert({
                text: "Server error !" ,
                type: 'error'
            })
        }
    });
}

</script>


<?php if(isset($_GET['email'])){ 
    $cl=urldecode($_GET['email']);
?>
    <script>
        $(document).ready(function(){
            $('#userTable').DataTable().search('<?=$cl?>').draw();
        });
    </script>
<?php }?>

@endsection



