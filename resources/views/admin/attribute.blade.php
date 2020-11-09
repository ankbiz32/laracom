@extends('layouts.admin')

@section ('css')
<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="plugins/datatables-select/css/select.bootstrap4.css">
<link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection


@section ('content')
    <div class="content-wrapper">
        <div class="content-header my-3">
        <div class="container-fluid">
            <div class="row mb-2 mt-3 px-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Attributes list :</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Attribute list</li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="row col mb-4">
                        <a href="{{ route('admin.addattribute') }}" class="btn btn-primary">+ Add Attribute</a>
                    </div>
                    <div class="card card-body">
                        <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($attributes as $attribute)
                                <tr>
                                <td>{{ $attribute->id }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>{{ $attribute->created_at }}</td>
                                <td>
                                    <a href="{{ route('attribute.editform',['id'=>$attribute->id]) }}" class="btn btn-info m-1">EDIT</a>
                                    <a href="{{ route('attribute.remove',['id'=>$attribute->id]) }}" onclick="confirmation(event)" class="btn btn-danger m-1">REMOVE</a>
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
        // Datatable initialise
        var table= $('.datatable').DataTable( {
            order: [[ 1, 'desc' ]]
        });

        function confirmation(ev){
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            notie.confirm({ text: 'Are you sure?' }, function() {
                window.location = urlToRedirect;
            })
        }
    </script>
@endsection
