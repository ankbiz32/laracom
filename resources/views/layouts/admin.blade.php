<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }} CMS</title>
  <link rel="icon" href="{{ URL::asset('photo/favicon.ico') }}" type="image/x-icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{URL::to('/')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::to('/')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{URL::to('/')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
  <style>
    .notie-container {
      z-index: 100000;
    }

    table.dataTable tr td,
    table.dataTable tr th {
      vertical-align: middle;
    }

    span.req {
      color: red;
    }
  </style>

  @yield('css')

</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-expand navbar-light navbar-warning">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><strong><i class="fas fa-bars"></i>&nbsp; Menu</strong></a>
        </li>
      </ul>

      <span class="mx-auto d-sm-none d-flex align-items-center">
        <img src="{{URL::to('/')}}/dist/img/bhukyra_emblem.png" alt="Logo" class="brand-image img-circle " height="30">
        <span class="ml-1">Bhukyra</span>
      </span>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->

        <li class="nav-item mr-2 d-none d-sm-inline-block">
          <a href="{{URL::to('/')}}" target="_blank" class="nav-link"><strong><i class="fas fa-external-link-alt"></i>&nbsp; Visit Store</strong></a>
        </li>
        <li class="nav-item dropdown mr-0 mr-sm-2">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-user"></i> &nbsp;<i class="fa fa-caret-down"></i>
            <!-- <span class="badge badge-warning navbar-badge">15</span> -->
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- <span class="dropdown-item dropdown-header">15 Notifications</span> -->
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-user"></i> &nbsp; Admin profile
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt"></i> &nbsp; {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->



    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-warning elevation-0">
      <!-- Brand Logo -->
      <a href="{{URL::to('/dashboard')}}" class="brand-link navbar-warning">
        <img src="{{URL::to('/')}}/dist/img/bhukyra_emblem.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text text-dark text-md">Bhukyra <strong>CMS</strong></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
          <div class="image">
            <img src="{{URL::to('/')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-0" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            <small class="text-muted">{{ Auth::user()->role }}</small>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar nav-child-indent nav-compacts nav-legacy flex-column pb-5" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('admin.index') }}" class="nav-link py-3 active">
                <i class="fas fa-tachometer-alt nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
            @if (Auth::user()->role == 'Admin' OR Auth::user()->role == 'INVENTORY_MANAGER')
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link py-3">
                <i class="nav-icon fas fa-cube"></i>
                <p class="">
                  Products
                  <i class="right mt-2 fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.product') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Products</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.categories') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.attribute') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attribute</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin-brands.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Brands</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin-tags.index') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tags</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            @if (Auth::user()->role == 'Admin' OR Auth::user()->role == 'SALES_MANAGER')
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link py-3">
                <i class="nav-icon fas fa-rupee-sign"></i>
                <p class="">
                  Sales
                  <i class="right mt-2 fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.order') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Orders</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.txn') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Transactions</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{route('admin.wishlist')}}" class="nav-link py-3">
                <i class="fas fa-heart nav-icon"></i>
                <p>Wishlists</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.enquiries')}}" class="nav-link py-3">
                <i class="fa fa-question nav-icon"></i>
                <p>Enquiries</p>
              </a>
            </li>


            @if (Auth::user()->role == 'Admin')
            <li class="nav-header pt-2 text-grey" style="opacity: .5">FRONTEND</li>
            <li class="nav-item">
              <a href="#" class="nav-link py-3">
                <i class="fas fa-store nav-icon"></i>
                <p>Store Profile</p>
              </a>
            </li>
            @endif

            <li class="nav-header pt-2 text-grey" style="opacity: .5">SYSTEM</li>
            <li class="nav-item">
              <a href="{{ route('admin.reports') }}" class="nav-link py-3">
                <i class="far fa-chart-bar nav-icon"></i>
                <p>Reports</p>
              </a>
            </li>
            
            @if (Auth::user()->role == 'Admin')
            <li class="nav-item">
              <a href="{{ route('admin.country') }}" class="nav-link py-3">
                <i class="fa fa-map-marked-alt nav-icon"></i>
                <p>Marketplaces</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link py-3">
                <i class="nav-icon fas fa-users"></i>
                <p class="">
                  Users
                  <i class="right mt-2 fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.user') }}" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.role') }}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Roles</p>
                  </a>
                </li>
              </ul>
            </li>
            @endif


            <!-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link py-3">
                <i class="nav-icon fas fa-list"></i>
                <p>
                    Multilevel
                    <i class="right mt-2 fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                        Level 2
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                        </a>
                    </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                    </a>
                </li>
                </ul>
            </li> -->

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    @yield('content')




    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020-21 <a href="https://bhukyra.com" target="_blank">Bhukyra Agro Pvt. Ltd.</a></strong> |
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b></b>
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{URL::to('/')}}/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{URL::to('/')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{URL::to('/')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="{{URL::to('/')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{URL::to('/')}}/dist/js/adminlte.js"></script>
  <script src="https://unpkg.com/notie"></script>
  @yield('scripts')


  @if ($errors->any())
  @foreach ($errors->all() as $error)
  <script>
    notie.alert({
      text: "{{ $error}}",
      type: 'error'
    })
  </script>
  @endforeach
  @endif

  @if(Session::has('success'))
  <script>
    notie.alert({
      text: "{{ Session::get('success') }}",
      type: 'success'
    })
  </script>
  @elseif(Session::has('error'))
  <script>
    notie.alert({
      text: "{{ Session::get('error') }}",
      type: 'error'
    })
  </script>
  @endif

</body>

</html>