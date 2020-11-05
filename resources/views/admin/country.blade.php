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
                <h1 class="m-0 text-dark">Country list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Country list</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row col mb-4">
                        <a href="{{ route('admin.addcountry') }}" class="btn btn-primary">+ Add Country</a>
                        <span class="dropdown ml-auto">
                            <a class="dropdown-toggle btn btn-secondary btn-bulk" style="display: none;" data-toggle="dropdown" href="#" aria-expanded="false">
                                BULK ACTION <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="activateCountry()">Activate Country</a>
                                <a class="dropdown-item" tabindex="-1" href="javascript:;" onclick="deActivateCountry()">Deactivate Country</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" tabindex="-1" href="javascript:;"  onclick="removeCountry(event)">Remove Country</a>
                            </div>
                        </span>
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                            <tr>
                                <th scope="col" class="allSelector">⬜</th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Language</th>
                                <th scope="col">Created</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $countries)
                                <tr>
                                <td></td>
                                <td>{{ $countries->id }}</td>
                                <td>{{ $countries->name }}</td>
                                <td>{{ $countries->language }}</td>
                                <td>{{ $countries->created_at }}</td>
                                <td>
                                    <a href="{{ route('country.editform',['id'=>$countries->id]) }}" class="btn btn-info m-1">EDIT</a>
                                    <a href="{{ route('country.remove',['id'=>$countries->id]) }}" onclick="confirmation(event)" class="btn btn-danger m-1">REMOVE</a>
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
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-select/js/dataTables.select.min.js"></script>
    <script src="plugins/datatables-select/js/select.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript">
    
        var items = new Array();

        // Datatable initialise
        var table= $('.datatable').DataTable( {
            columnDefs: [ {
                orderable: false,
                className: 'selector',
                targets:   0
            } ],
            select: {
                style:    'multi',
                selector: 'td:first-child'
            },
            order: [[ 1, 'desc' ]]
        });

        // Datatable individual checkbox operation
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

        // All select/deselect button
        $(document).on('click', '.allSelector', function() {
            if($(this).hasClass('all')){
                $(this).removeClass('all');
                $(this).html('⬜');
                $('.btn-bulk').hide();
                table.rows({ search: 'applied' }).deselect();
                items=[];

            }
            else{
                $(this).addClass('all');
                $(this).html('☑');
                table.rows({ search: 'applied' }).select();
                items = $.map(table.rows('.selected').data(), function (items) {
                    return items[1]
                });
            }

        });
    
        // Alert before removing country
        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getCountry('href');
            notie.confirm({ text: 'Are you sure?' }, function() {
                window.location = urlToRedirect;
            })
        }

        // Bulk activate Country
        function activateCountry(){
            $.ajax({
                type: 'post',
                url: "{{ route('country.bulkStatus') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    id:JSON.stringify(items),
                    active:1,
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

        // Bulk de-activate Country
        function deActivateCountry(){
            $.ajax({
                type: 'post',
                url: "{{ route('country.bulkStatus') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    id:JSON.stringify(items),
                    active:0,
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

        // Bulk remove Country
        function removeCountry(ev){
            ev.preventDefault();
            notie.confirm({ text: 'Are you sure?' }, function() {
                $.ajax({
                    type: 'post',
                    url: "{{ route('country.bulkRemove') }}",
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
