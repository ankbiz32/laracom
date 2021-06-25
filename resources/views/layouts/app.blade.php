<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <title>Bhukyra Agro Pvt. Ltd | Legacy Committed to excellence</title> -->
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content='The word "Bhukyra" is a compound name derived from "Bhu" (Earth, Land, Soil) and "Kyra" (Sun). The fundamental concept of Bhukyra is to maintain health. Bhukyra is aimed at keeping a person healthy, not curing them of disease.'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="{{URL::to('/')}}/assets/images/favicon.ico">

    <!-- Top bar color for mobile browser -->
    <meta name="theme-color" content="#EAC71D">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#EAC71D">

    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/vendor/material-design-iconic-font.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/vendor/font.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/plugins/slick.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/plugins/animate.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/plugins/jquery-ui.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/plugins/timecircles.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/plugins/td-message/td-message.css"/>
    <script src="{{URL::to('/')}}/assets/js/vendor/jquery-1.12.4.min.js"></script>

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above) -->
    <!--
    <script src="{{URL::to('/')}}/assets/js/vendor/vendor.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/plugins.min.js"></script>
    -->

    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/assets/css/custom.css">

</head>

<body class="template-color-1 font-family-01 bg-ivory">

    <div class="main-wrapper">

        @yield('loader')

        <header class="main-header_area">
            <div class="main-header main-h">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-header_nav position-relative">
                                <div class="header-logo_area">
                                    <a href="{{URL::to('/')}}">
                                        <img src="{{URL::to('/')}}/assets/images/menu/logo/1.png" alt="Header Logo">
                                        <small><small><sup>{{$_SESSION['country_iso_code']}}</sup></small> </small>
                                    </a>
                                </div>
                                <div class="main-menu_area d-none d-lg-block">
                                    <nav class="main-nav d-flex justify-content-center">
                                        <ul>
                                            <li class=""><a href="{{URL::to('/')}}">Home</a>
                                            </li>
                                            <li class="megamenu-holder position-static"><a href="javascript:void(0)">Shop <small><small><i class="icon-arrow-down"></i></small></small></a>
                                                <div class="quicky-megamenu_wrap">
                                                    <ul class="quicky-megamenu">
                                                    @isset($categories)
                                                        @foreach($categories as $c)
                                                            <li>
                                                                <span class="megamenu-title"><a href="{{ route( 'category.list', ['category'=>$c->id, 'slug'=>$c->meta_title] ) }}">{{$c->name}}</a></span>
                                                                @if(count($c->childs))
                                                                    <ul>
                                                                    @foreach($c->childs as $ch)
                                                                        <li><a href="{{ route( 'category.list', ['category'=>$ch->id, 'slug'=>$ch->meta_title] ) }}">› {{$ch->name}}</a></li>
                                                                    @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    @endisset
                                                    </ul>
                                                    <div class="main-menu_bg">
                                                        <img src="{{URL::to('/')}}/assets/images/menu/bg/1.jpg" alt="Main Menu Images">
                                                    </div>
                                                </div>
                                            </li>
                                            <li><a href="javascript:void(0)">Pages <small><small><i class="icon-arrow-down"></i></small></small>
                                            </a></a>
                                                <ul class="quicky-dropdown">
                                                    <li><a href="{{ route('home.about') }}">About Us</a></li>
                                                    <li><a href="#">FAQ</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{ route('product.index') }}">Products</a>
                                            </li>
                                            <li><a href="{{ route('home.contact') }}">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <div class="header-right_area">
                                    <ul>
                                        <li class="mr-3">
                                            <a href="#searchBar" class="search-btn toolbar-btn">
                                                <i class="zmdi zmdi-search"></i>
                                            </a>
                                        </li>
                                        <li class="minicart-wrap mr-3">
                                            <a href="#miniCart" class="minicart-btn toolbar-btn">
                                                <div class="minicart-count_area">
                                                    <i class="zmdi zmdi-mall p-1"></i>
                                                    <small><sup class="badge badge-danger pt-sm-1 pt-1">
                                                    @if(Session::has('cart'))
                                                    {{ Session::get('cart')->totalQuantity }}
                                                    @else
                                                        0
                                                    @endif

                                                    </sup></small>
                                                    <!-- <p class="total-price">$420 <span>(10)</span></p> -->
                                                </div>
                                            </a>
                                        </li>
                                        <li class="mobile-menu_wrap d-inline-block d-lg-none mr-md_0">
                                            <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                                <i class="zmdi zmdi-menu pt-1"></i>
                                            </a>
                                        </li>
                                        <li class="dropdown-holder user-setting_wrap"><a href="javascript:void(0)"><i class="zmdi zmdi-account-o"></i></a>
                                            <ul class="quicky-dropdown">
                                                <li class="position-relative"><a href="javascript:void(0)">User Setting</a>
                                                    <ul class="quicky-dropdown quicky-submenu">
                                                        <li>
                                                            @guest
                                                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                                                @if (Route::has('register'))
                                                                    <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                                                @endif
                                                            @else
                                                                <a href="{{route('profile.edit',['user'=>Auth::user()->id ])}}">{{ Auth::user()->name }}</a>
                                                                <a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">
                                                                    {{ __('Logout') }}
                                                                </a>
                                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                </form>
                                                            @endguest
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="position-relative"><a href="javascript:void(0)">Currency</a>
                                                    <ul class="quicky-dropdown quicky-submenu">
                                                        <li>
                                                            <a href="javascript:void(0)">INR ₹</a>
                                                            <a href="javascript:void(0)">EUR €</a>
                                                            <a href="javascript:void(0)">USD $</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="position-relative"><a href="javascript:void(0)">Language</a>
                                                    <ul class="quicky-dropdown quicky-submenu">
                                                        <li>
                                                            <a href="javascript:void(0)">English</a>
                                                            <a href="javascript:void(0)">Français</a>
                                                            <a href="javascript:void(0)">Romanian</a>
                                                            <a href="javascript:void(0)">Japanese</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mobile-menu_wrapper" id="mobileMenu">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close white-close_btn"><i class="zmdi zmdi-close"></i></a>
                        <div class="offcanvas-inner_logo">
                            <a href="javascript:void(0)">
                                <img src="{{URL::to('/')}}/assets/images/menu/logo/1.png" alt="Header Logo">
                                <small><small><sup>{{$_SESSION['country_iso_code']}}</sup></small> </small>
                            </a>
                        </div>
                        <nav class="offcanvas-navigation">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active"><a href="#"><span
                                        class="mm-text">Home</span></a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Shop</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="menu-item-has-children">
                                            <a href="#">
                                                <span class="mm-text">Health care products</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">
                                                        <span class="mm-text">Skin Care</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="mm-text">Oral care</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="mm-text">Hair care</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#">
                                                <span class="mm-text">Agro based products</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <a href="#">
                                                        <span class="mm-text">Agro product 1</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="mm-text">Agro product 2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Blog</span>
                                    </a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">
                                        <span class="mm-text">Pages</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="#">
                                                <span class="mm-text">About Us</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mm-text">Contact</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mm-text">My Account</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mm-text">Login | Register</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#l">
                                                <span class="mm-text">Wishlist</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mm-text">Cart</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mm-text">Checkout</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="faq.html">
                                                <span class="mm-text">FAQ</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="mm-text">Error 404</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <nav class="offcanvas-navigation user-setting_area">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active">
                                    <a href="#">
                                        <span class="mm-text">User
                                        Settings
                                    </span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                        @guest
                                            <a href="{{ route('login') }}">
                                                <span class="mm-text">{{ __('Login') }}</span>
                                            </a>
                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}">
                                                    <span class="mm-text">{{ __('Register') }}</span>
                                                </a>
                                            @endif
                                        @else
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">{{ Auth::user()->name }}</span>
                                            </a>
                                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#"><span class="mm-text">Currency</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">EUR €</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">USD $</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><a href="#"><span class="mm-text">Language</span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">English</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Français</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Romanian</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <span class="mm-text">Japanese</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="offcanvas-minicart_wrapper" id="miniCart">
                <div class="offcanvas-menu-inner">
                    <a href="#" class="btn-close" style="display: flex;align-items: center;"><i class="zmdi zmdi-close mb-1 mr-2"></i><span class="d-sm-inline d-none">close</span></a>
                    
                    @if(Session::has('cart'))
                    <?php $cart=Session::get('cart'); ?>
                    <div class="minicart-content">
                        <div class="minicart-heading">
                            <h4>Shopping Cart</h4>
                        </div>
                        <ul class="minicart-list mt-3">
                        
                            @foreach ($cart->items as $key => $value)
                            <li class="minicart-product align-items-start">
                                <a class="product-item_remove" href="{{ route('cart.remove',['id'=> $key]) }}"><i
                                    class="zmdi zmdi-close"></i></a>
                                <div class="product-item_img">
                                    <img src="{{URL::to('/').'/'. $value['item']->image }}" style="width:100%; height: 60px; -o-object-fit: contain; object-fit: contain;" alt="Product Image">
                                </div>
                                <div class="product-item_content">
                                    <a class="product-item_title" href="{{ route('product.show',[ 'product'=>$value['item']->id, 'slug'=>$value['item']->url_slug ])}}">{{ $value['item']->name }}</a> 
                                    <span class="product-item_quantity pt-0"><small>{{$value['product_variant_name'] ?? ''}}</small></span>
                                    <span class="product-item_quantity pt-0">{{ $value['quantity'] }} x {{$_SESSION['curr']. round($value['price'])}}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="minicart-item_total">
                        <span>Subtotal:</span>
                        <span class="ammount">{{$_SESSION['curr']. round($cart->totalPrice)}}</span>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="{{route('cart.index')}}" class="quicky-btn-outline btn-block text-center quicky-btn_fullwidth square-btn">View Cart</a>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="{{route('checkout.index')}}" class="quicky-btn btn-block text-center quicky-btn_fullwidth square-btn">Checkout</a>
                    </div>
                    @else
                    <div class="minicart-content">
                        <div class="col-12 mt-5 text-center">
                            <i class="zmdi zmdi-shopping-cart-plus mb-3 mt-5" style="transform:scale(6)"></i>
                            <h5 class="mt-5 mb-2">Your shopping cart is empty.</h5>
                            <h5>Please add some products.</h5>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="offcanvas-search_wrapper" id="searchBar">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="zmdi zmdi-close"></i></a>
                        <!-- Begin Offcanvas Search Area -->
                        <div class="offcanvas-search">
                            <form action="#" class="hm-searchbox">
                                <input type="text" placeholder="Search for item...">
                                <button class="search_btn" type="submit"><i
                                    class="zmdi zmdi-search"></i></button>
                            </form>
                        </div>
                        <!-- Offcanvas Search Area End Here -->
                    </div>
                </div>
            </div>

            <div class="global-overlay"></div>
        </header>

        @yield('content')

        <div class="service-area pt-100 pb-90">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{URL::to('/')}}/assets/images/service/1.png" alt="Quicky's Service">
                            </div>
                            <div class="service-content">
                                <h3 class="heading">Free Home Delivery</h3>
                                <p class="short-desc">Provide free home delivery
                                    for all product over $100</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{URL::to('/')}}/assets/images/service/2.png" alt="Quicky's Service">
                            </div>
                            <div class="service-content">
                                <h3 class="heading">Quality Products</h3>
                                <p class="short-desc">We ensure our product
                                    quality all times</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{URL::to('/')}}/assets/images/service/3.png" alt="Quicky's Service">
                            </div>
                            <div class="service-content">
                                <h3 class="heading">3 Day Return</h3>
                                <p class="short-desc">Our producr return policy
                                    is very easy & simple</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-area">
            <div class="footer-top_area bg-buttery-white">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-widgets_area">
                                <div class="logo-area">
                                    <a href="javascript:void(0)">
                                        <img src="{{URL::to('/')}}/assets/images/footer/1.png" alt="Logo" height="55">
                                        <small><small><sup>{{$_SESSION['country_iso_code']}}</sup></small> </small>
                                    </a>
                                </div>
                                <p class="short-desc">Produce and supply various Health care items all over the world
                                    which were very attractive</p>
                                <div class="social-link">
                                    <ul>
                                        <li class="facebook">
                                            <a href="#" data-toggle="tooltip" target="_blank" title="Facebook">
                                                <i class="icon-social-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="#" data-toggle="tooltip" target="_blank" title="Twitter">
                                                <i class="icon-social-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="#" data-toggle="tooltip" target="_blank" title="Instagram">
                                                <i class="icon-social-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="footer-widgets_area">
                                <h3 class="heading">Quick Link</h3>
                                <div class="footer-widgets">
                                    <ul>
                                        <li><a href="javascript:void(0)">About us</a></li>
                                        <li><a href="javascript:void(0)">Our Service</a></li>
                                        <li><a href="javascript:void(0)">Pages</a></li>
                                        <li><a href="javascript:void(0)">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="footer-widgets_area">
                                <h3 class="heading">Information</h3>
                                <div class="footer-widgets">
                                    <ul>
                                        <li><a href="javascript:void(0)">Payment System</a></li>
                                        <li><a href="javascript:void(0)">Return Policy</a></li>
                                        <li><a href="javascript:void(0)">Terms & Conditins</a></li>
                                        <li><a href="javascript:void(0)">Quick Support</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer-widgets_area">
                                <h3 class="heading">Get in Touch</h3>
                                <div class="footer-widgets">
                                    <p class="address-info">265, South Block,<br>
                                        Holly City, Main Street, State, <br>
                                        India</p>
                                    <div class="widgets-mail">
                                        <a href="mailto://info@example.com">info@example.com</a>
                                        <a href="#">www.example.com</a>
                                    </div>
                                    <a class="widgets-contects" href="tel://+0981 2568 658">+91987 654 321</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom_area">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="copyright">
                                <span>Copyright &copy; {{date('Y')}}
                                <a href="#">Bhukyra Agro Pvt. Ltd.</a>
                                <a href="#" target="_blank">All Rights Reserved.</a>
                            </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="payment">
                                <img src="{{URL::to('/')}}/assets/images/footer/payment/1.png" alt=" Payment Method">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade modal-wrapper" id="quickViewModal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area sp-area row">
                            <div class="col-xl-5 col-lg-6">
                                <div class="sp-img_area">
                                    <div class="quicky-element-carousel sp-img_slider slick-img-slider" data-slick-options='{
                                    "slidesToShow": 1,
                                    "arrows": false,
                                    "fade": true,
                                    "draggable": false,
                                    "swipe": false,
                                    "asNavFor": ".sp-img_slider-nav"
                                    }'>
                                        <div class="single-slide">
                                            <img src="{{URL::to('/')}}/assets/images/product/large-size/b1.png" style="width:100%; height: 360px; -o-object-fit: contain; object-fit: contain;" alt="Product Image">
                                        </div>
                                        <div class="single-slide">
                                            <img src="{{URL::to('/')}}/assets/images/product/large-size/b2.png" style="width:100%; height: 360px; -o-object-fit: contain; object-fit: contain;" alt="Product Image">
                                        </div>
                                    </div>

                                    <div class="quicky-element-carousel sp-img_slider-nav arrow-style arrow-sm_size arrow-day_color" data-slick-options='{
                                    "slidesToShow": 3,
                                        "asNavFor": ".sp-img_slider",
                                    "focusOnSelect": true,
                                    "arrows" : true,
                                    "spaceBetween": 30
                                    }' data-slick-responsive='[
                                        {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                        {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                        {"breakpoint":992, "settings": {"slidesToShow": 3}},
                                        {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                        {"breakpoint":575, "settings": {"slidesToShow": 2}}
                                    ]'>
                                        <div class="single-slide">
                                            <img src="{{URL::to('/')}}/assets/images/product/large-size/b1.png" style="width:100%; height: 60px; -o-object-fit: contain; object-fit: contain;" alt="Product Thumnail">
                                        </div>
                                        <div class="single-slide">
                                            <img src="{{URL::to('/')}}/assets/images/product/large-size/b2.png" style="width:100%; height: 60px; -o-object-fit: contain; object-fit: contain;" alt="Product Thumnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-6">
                                <div class="sp-content">
                                    <div class="sp-heading">
                                        <h5><a href="#">Rose Water</a></h5>
                                    </div>
                                    <div class="rating-box">
                                        <ul>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li><i class="zmdi zmdi-star"></i></li>
                                            <li class="silver-color"><i class="zmdi zmdi-star"></i></li>
                                            <li class="silver-color"><i class="zmdi zmdi-star"></i></li>
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span class="new-price new-price-2 ml-0"></span>
                                        &nbsp;
                                        <span class="old-price"></span>
                                    </div>
                                    <div class="sp-essential_stuff">
                                        <ul>
                                            <li class="brand-name">Brands <a href="javascript:void(0)"></a></li>
                                            <li class="sku">Product Code: <a href="javascript:void(0)"></a></li>
                                            <li class="in-stock">Availability: <a href="javascript:void(0)">In Stock</a></li>
                                        </ul>
                                    </div>
                                    <!-- <div class="color-list_area">
                                        <div class="color-list_heading">
                                            <h4>Available Options</h4>
                                        </div>
                                        <span class="sub-title">Color</span>
                                        <div class="color-list">
                                            <a href="javascript:void(0)" class="single-color active" data-swatch-color="red">
                                                <span class="bg-red_color"></span>
                                                <span class="color-text">Red (+$150)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color" data-swatch-color="orange">
                                                <span class="burnt-orange_color"></span>
                                                <span class="color-text">Orange (+$170)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color" data-swatch-color="brown">
                                                <span class="brown_color"></span>
                                                <span class="color-text">Brown (+$120)</span>
                                            </a>
                                            <a href="javascript:void(0)" class="single-color" data-swatch-color="umber">
                                                <span class="raw-umber_color"></span>
                                                <span class="color-text">Umber (+$125)</span>
                                            </a>
                                        </div>
                                    </div> -->
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text">
                                            <div class="dec qtybutton"><i class="zmdi zmdi-chevron-down"></i></div>
                                            <div class="inc qtybutton"><i class="zmdi zmdi-chevron-up"></i></div>
                                        </div>
                                    </div>
                                    <div class="quicky-group_btn">
                                        <ul>
                                            <li><a href="javascript:void(0)" class="add-to_cart quicky-btn">Add To Cart</a></li>
                                            <!-- <li><a href="javascript:void(0)"><i class="zmdi zmdi-favorite-outline"></i></a></li> -->
                                        </ul>
                                    </div>
                                    <div class="quicky-tag-line">
                                        <h6>Tags:</h6>
                                        <a href="javascript:void(0)">Health,</a>
                                        <a href="javascript:void(0)">Skin care,</a>
                                        <a href="javascript:void(0)">Rose water</a>
                                    </div>
                                    <div class="quicky-social_link">
                                        <ul>
                                            <li class="facebook">
                                                <a href="javascript:void(0)" data-toggle="tooltip" target="_blank" title="Facebook">
                                                    <i class="fab fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="twitter">
                                                <a href="javascript:void(0)" data-toggle="tooltip" target="_blank" title="Twitter">
                                                    <i class="fab fa-twitter-square"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="javascript:void(0)" data-toggle="tooltip" target="_blank" title="Youtube">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="javascript:void(0)" data-toggle="tooltip" target="_blank" title="Google Plus">
                                                    <i class="fab fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="javascript:void(0)" data-toggle="tooltip" target="_blank" title="Instagram">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="scroll-to-top" href=""><i class="icon-arrow-up"></i></a>

    </div>


    <script src="{{URL::to('/')}}/assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/vendor/popper.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/vendor/bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/slick.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/jquery.barrating.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/jquery.counterup.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/jquery.nice-select.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/jquery.sticky-sidebar.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/jquery-ui.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/jquery.ui.touch-punch.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/theia-sticky-sidebar.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/waypoints.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/timecircles.js"></script>
    <script src="{{URL::to('/')}}/plugins/td-message/td-message.min.js"></script>

    <!-- Vendor & Plugins JS (Please remove the comment from below vendor.min.js & plugins.min.js for better website load performance and remove js files from avobe) -->
    <!--
    <script src="{{URL::to('/')}}/assets/js/vendor/vendor.min.js"></script>
    <script src="{{URL::to('/')}}/assets/js/plugins/plugins.min.js"></script> -->

    <script src="{{URL::to('/')}}/assets/js/main.js"></script>

    @yield('script')

    @if(Session::get('cart_updated'))
        <script>
            $('.offcanvas-minicart_wrapper').addClass('open');
            $('.global-overlay').addClass('overlay-open');
        </script>
    @endif

    <!-- For notifications -->
    @if($errors->any())
        <script>
            $.message({
                type: "warning",
                text: "Please fill the required fields or check the information that you submitted.",
                duration: 5000,
                positon: "top-right",
                showClose: true
            });
        </script>
    @endif
    @if(Session::get('info'))
        <script>
            $.message({
                text: "{!!Session::get('info')!!}",
                duration: 5000,
                positon: "top-right",
                showClose: true
            });
        </script>
    @endif
    @if(Session::get('success'))
        <script>
            $.message({
                type: "success",
                text: "{!!Session::get('success')!!}",
                duration: 5000,
                positon: "top-right",
                showClose: true
            });
        </script>
    @endif
    @if(Session::get('error'))
        <script>
            $.message({
                type: "error",
                text: "{{Session::get('error')}}",
                duration: 5000,
                positon: "top-right",
                showClose: true
            });
        </script>
    @endif

</body>

</html>
