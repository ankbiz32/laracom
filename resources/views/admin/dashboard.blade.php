    @extends('layouts.admin')

    @section ('css')
        <!-- JQVMap -->
        <link rel="stylesheet" href="{{URL::to('/')}}/plugins/jqvmap/jqvmap.min.css">
        <!-- summernote -->
        <link rel="stylesheet" href="{{URL::to('/')}}/plugins/summernote/summernote-bs4.css">
    @endsection


    @section ('content')

    <div class="content-wrapper">
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
                </ol>
            </div>
            </div>
        </div>
        </div>

        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success ">
                <div class="inner">
                    <h3>₹ {{ $totalgross }}</h3>

                    <p>Total Sales</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a href="{{ route('admin.order') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $totalorder }}</h3>

                    <p>Total orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-cart"></i>
                </div>
                <a href="{{ route('admin.order') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totaluser }}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('admin.user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalproduct }}</h3>

                    <p>Products listed</p>
                </div>
                <div class="icon">
                    <i class="ion ion-ios-pricetag"></i>
                </div>
                <a href="{{ route('admin.product') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            </div>

            <div class="row mt-3">
                <section class="col-lg-7 connectedSortable">
                    <!-- Reminder widget -->
                    <div class="card card-info disabled">
                        <div class="card-header">
                        <h3 class="card-title">
                           Reminder / Notes
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                            <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                            <i class="fas fa-times"></i></button>
                        </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pad px-2 pb-3">
                        <form action="{{ route('admin.reminder') }}" enctype="multipart/form-data" method="POST">
                        @method('PATCH')
                            @csrf
                            <div class="">
                                <textarea name="reminder" class="textarea"
                                        style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $reminder->reminder ?? ''}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info float-right"><i class="fa fa-save"></i>&nbsp; Save</button>

                        </form>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <!-- <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Orders</h3>

                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                <tr>
                                <th>Order ID</th>
                                <th>Item</th>
                                <th>Status</th>
                                <th>Popularity</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                <td>Call of Duty IV</td>
                                <td><span class="badge badge-success">Delivered</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                </td>
                                </tr>
                                <tr>
                                <td><a href="pages/examples/invoice.html">OR1848</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-warning">Pending</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                </td>
                                </tr>
                                <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>iPhone 6 Plus</td>
                                <td><span class="badge badge-info">Shipped</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                </td>
                                </tr>
                                <tr>
                                <td><a href="pages/examples/invoice.html">OR7429</a></td>
                                <td>Samsung Smart TV</td>
                                <td><span class="badge badge-primary">Processing</span></td>
                                <td>
                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="card-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a>
                            <a href="{{ route('admin.order') }}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                        </div>
                    </div> -->

                    <!-- Morris chart - Sales -->
                    <!-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Sales
                            </h3>
                            <div class="card-tools">
                            <ul class="nav nav-pills ml-auto">
                                <li class="nav-item">
                                <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                                </li>
                            </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">
                            <div class="chart tab-pane active" id="revenue-chart"
                                style="position: relative; height: 300px;">
                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                            </div>
                        </div>
                    </div> -->
                </section>

                <section class="col-lg-5 connectedSortable">

                    <!-- Recent Products -->
                    <!-- <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recently Added Products</h3>

                            <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li class="item">
                                <div class="product-img">
                                <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Samsung TV
                                    <span class="badge badge-warning float-right">$1800</span></a>
                                <span class="product-description">
                                    Samsung 32" 1080p 60Hz LED Smart HDTV.
                                </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">Bicycle
                                    <span class="badge badge-info float-right">$700</span></a>
                                <span class="product-description">
                                    26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">
                                    Xbox One <span class="badge badge-danger float-right">
                                    $350
                                </span>
                                </a>
                                <span class="product-description">
                                    Xbox One Console Bundle with Halo Master Chief Collection.
                                </span>
                                </div>
                            </li>
                            <li class="item">
                                <div class="product-img">
                                <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                                </div>
                                <div class="product-info">
                                <a href="javascript:void(0)" class="product-title">PlayStation 4
                                    <span class="badge badge-success float-right">$399</span></a>
                                <span class="product-description">
                                    PlayStation 4 500GB Console (PS4)
                                </span>
                                </div>
                            </li>
                            </ul>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.product') }}" class="uppercase">View All Products</a>
                        </div>
                    </div> -->

                    <!--Visitors Map card -->
                    <!-- <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Visitors
                            </h3>
                            <div class="card-tools">
                            <button type="button"
                                    class="btn btn-primary btn-sm daterange"
                                    data-toggle="tooltip"
                                    title="Date range">
                                <i class="far fa-calendar-alt"></i>
                            </button>
                            <button type="button"
                                    class="btn btn-primary btn-sm"
                                    data-card-widget="collapse"
                                    data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                                <div class="text-white">Visitors</div>
                            </div>
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                                <div class="text-white">Online</div>
                            </div>
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                                <div class="text-white">Sales</div>
                            </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- solid sales graph -->
                    <!-- <div class="card bg-gradient-info">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                            <i class="fas fa-th mr-1"></i>
                            Sales Graph
                            </h3>

                            <div class="card-tools">
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row">
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                                    data-fgColor="#39CCCC">

                                <div class="text-white">Mail-Orders</div>
                            </div>
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                                    data-fgColor="#39CCCC">

                                <div class="text-white">Online</div>
                            </div>
                            <div class="col-4 text-center">
                                <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                                    data-fgColor="#39CCCC">

                                <div class="text-white">In-Store</div>
                            </div>
                            </div>
                        </div>
                    </div> -->
                </section>
            </div>
        </div>
        </section>
    </div>

    @endsection


    @section ('scripts')
        <!-- ChartJS -->
        <script src="{{URL::to('/')}}/plugins/chart.js/Chart.min.js"></script>
        <!-- Sparkline -->
        <script src="{{URL::to('/')}}/plugins/sparklines/sparkline.js"></script>
        <!-- JQVMap -->
        <script src="{{URL::to('/')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
        <script src="{{URL::to('/')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
        <!-- Summernote -->
        <script src="{{URL::to('/')}}/plugins/summernote/summernote-bs4.min.js"></script>

        <script src="{{URL::to('/')}}/dist/js/demo.js"></script>
        <script src="dist/js/pages/dashboard.js"></script>
    @endsection
