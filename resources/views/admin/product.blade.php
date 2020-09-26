@extends('layouts.admin')

@section ('css')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.css">
@endsection ('css')


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
                        <span class="dropdown ml-auto">
                            <a class="dropdown-toggle btn btn-secondary btn-bulk" style="display: none;" data-toggle="dropdown" href="#" aria-expanded="false">
                                BULK ACTION <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                <a class="dropdown-item" tabindex="-1" href="#">Activate products</a>
                                <a class="dropdown-item" tabindex="-1" href="#">Deactivate products</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" tabindex="-1" href="#"  onclick="confirmation(event)">Delete products</a>
                            </div>
                        </span>
                        <!-- <a href="{{ route('admin.addform') }}" class="btn btn-default btn-flat ml-auto">BULK ACTION</a> -->
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td></td>
                                <td scope="row">{{ $product->id }}</td>
                                <td><img style="height:60px;" src="{{ asset($product->image) }}" alt=""></td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    <div class="custom-control custom-switch custom-switch-off-muted custom-switch-on-success">
                                    <input type="checkbox" data-id="{{ $product->id }}" class="custom-control-input" id="customSwitch{{ $product->id }}" 
                                    {{ $product->is_active==1 ?'checked':'' }}
                                    >
                                    <label class="custom-control-label btn" for="customSwitch{{ $product->id }}"></label>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('product.editform',['id'=>$product->id]) }}" class="btn btn-info m-1">EDIT</a>
                                    <a href="{{ route('product.remove',['id'=>$product->id]) }}" onclick="confirmation(event)" class="btn btn-danger m-1">REMOVE</a>
                                </td>
                            </tr>
                            @endforeach
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
    <script>
        var items = new Array();

        // Datatable initialise
        var table= $('.datatable').DataTable( {
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            order: [[ 1, 'desc' ]]
        });

        // Datatable checkbox operation
        table
            .on( 'select', function ( e, dt, type, indexes ) {
                var rowData = table.rows( indexes ).data().toArray();
                items.push(rowData[0][1]);
                    $('.btn-bulk').show();
            } )
            .on( 'deselect', function ( e, dt, type, indexes ) {
                var rowData = table.rows( indexes ).data().toArray();
                var index = items.indexOf(rowData[0][1]);
                items.splice(index, 1);
                if(items.length<1){
                    $('.btn-bulk').hide();
                }
        });

        // Change product status on switching switch button
        $(document).on('change', 'input[type="checkbox"]', function() {
            var id=$(this).data('id');
            if(this.checked){
                console.log(id+' On');

                $.ajax({
                    type: 'post',
                    url: "{{ route('product.status',['id'=>$product->id]) }}",
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
                    url: "{{ route('product.status',['id'=>$product->id]) }}",
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

        // Alert before removing product
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            notie.confirm({ text: 'Are you sure?' }, function() {
                window.location = urlToRedirect;
            })
        }
    </script>

@endsection
