@extends('layouts.admin')
@section ('css')
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .custom-switch .custom-control-label::after{
            background:white !important;
            box-shadow: 1px 1px 5px #00000088;
        }
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
                <h1 class="m-0 text-dark">Products list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Products list</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row col mb-4">
                        <a href="{{ route('admin.addform') }}" class="btn btn-primary">+ ADD PRODUCT</a>
                        <!-- <a href="{{ route('admin.addform') }}" class="btn btn-default btn-flat ml-auto">BULK ACTION</a> -->
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table yajra-datatable table-hover datatable">
                            <span class="dropdown ml-auto bulk-span">
                                <a class="dropdown-toggle btn btn-default btn-bulk" style="display: none;" data-toggle="dropdown" href="#" aria-expanded="false">
                                    BULK ACTION <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="changeStatus(1)">Activate products</a>
                                    <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="changeStatus(0)">Deactivate products</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" tabindex="-1" href="javascript:;"  onclick="removeProducts(event)">Remove products</a>
                                </div>
                            </span>
                            <thead>
                            <tr>
                                <th scope="col"><input type="checkbox" class="allSelector"></th>
                                <th scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
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
                ajax: "{{ route('admin.product') }}",
                columns: [
                    // {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: true, searchable: true},
                    {data: 'check', name: 'check', orderable: false, searchable: true},
                    {data: 'id', name: 'id', orderable: true, searchable: true},
                    {
                        name: "image",
                        data: "image",
                        render: function (data, type, full, meta) {
                            return "<img src=\"" + data + "\" height=\"50\"/>";
                        },
                        searchable: true
                    },
                    {data: 'name', name: 'name', orderable: true, searchable: true},
                    {data: 'price', name: 'price', orderable: true, searchable: true},
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

            // Change user status on switching switch button
            $(document).on('change', '.custom-control-input', function() {
                var id=$(this).data('id');
                if(this.checked){
                    $.ajax({
                        type: 'post',
                        url: "{{ route('product.status',['id'=>"+id+"]) }}",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            id:id,
                            active:1,
                        },
                        success:function(response){
                            notie.alert({
                                text: "Product activated!" ,
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
                        url: "{{ route('product.status',['id'=>"+id+"]) }}",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            id:id,
                            active:0,
                        },
                        success:function(response){
                            notie.alert({
                                text: "Product de-activated!" ,
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

        // Alert before removing product
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            notie.confirm({ text: 'Are you sure?' }, function() {
                window.location = urlToRedirect;
            })
        }

        // Bulk status change for user
        function changeStatus(act){
            $.ajax({
                type: 'post',
                url: "{{ route('product.bulkStatus') }}",
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

        // Bulk remove products
        function removeProducts(ev){
            ev.preventDefault();
            notie.confirm({ text: 'Remove selected products ?' }, function() {
                $.ajax({
                    type: 'post',
                    url: "{{ route('product.bulkRemove') }}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        id:JSON.stringify(items),
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
            })
        }


    </script>


@endsection
