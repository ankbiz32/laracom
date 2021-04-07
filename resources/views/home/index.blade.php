    @extends('layouts.app')


    @section ('loader')
        <div class="loading">
            <div class="text-center middle">
                <img src="{{URL::to('/')}}/assets/images/menu/logo/1.png" alt="Logo">
                <p class="mt-4">LEGACY COMMITTED TO EXCELLENCE</p>
            </div>
        </div>
    @endsection

    @section ('content')
        <style>
            .featured-products .slick-list{
                padding: 0 15% 0 0;
            }
            @media(max-width:480px){
                .featured-products .slick-list{
                    padding: 0 30% 0 0;
                }
            }
        </style>

        <div class="slider-area">

            <div class="quicky-element-carousel home-slider arrow-style" data-slick-options='{
                "slidesToShow": 1,
                "slidesToScroll": 1,
                "infinite": true,
                "arrows": true,
                "dots": false,
                "autoplay" : false,
                "fade" : true,
                "autoplaySpeed" : 7000,
                "pauseOnHover" : false,
                "pauseOnFocus" : false
                }' data-slick-responsive='[
                {"breakpoint":768, "settings": {
                "slidesToShow": 1
                }},
                {"breakpoint":575, "settings": {
                "slidesToShow": 1
                }}
            ]'>
                <div class="slide-item animation-style-02 bg-1">
                    <div class="slider-progress"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="inner-slide">
                                    <div class="slide-content">
                                        <h2><strong>Rose water</strong></h2>
                                        <p class="short-desc">Rose water is a liquid made from water and rose petals.
                                            It is used as a perfume due to its sweet scent,
                                             but it has medicinal and culinary values, as well.</p>
                                        <div class="slide-btn">
                                            <a class="quicky-btn" href="#">Shop Now <i class="zmdi zmdi-chevron-right"></i><i class="zmdi zmdi-chevron-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="slider-img">
                                        <img src="assets/images/slider/slider-product/b2.png" alt="Slider Product">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-item animation-style-01 bg-1">
                    <div class="slider-progress"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="inner-slide">
                                    <div class="slide-content">
                                        <h2><strong>Gold Charged Rose Water</strong></h2>
                                        <p class="short-desc">Rose water contains numerous, powerful antioxidants.
                                            Recent research has found that it can help relax the
                                            central nervous system.</p>
                                        <div class="slide-btn">
                                            <a class="quicky-btn" href="#">Shop Now <i class="zmdi zmdi-chevron-right"></i><i class="zmdi zmdi-chevron-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="slider-img">
                                        <img src="assets/images/slider/slider-product/b1.png" alt="Slider Product">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide-item animation-style-01 bg-1">
                    <div class="slider-progress"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="inner-slide">
                                    <div class="slide-content">
                                        <h2><strong>Kamal Hair Oil</strong></h2>
                                        <p class="short-desc">This hairoil is known to maintain the haircolor inspite of aging.
                                            It is especially curated with the herbs of choice by the
                                            legendary Vaidya Kamalabai Joshi herself.</p>
                                        <div class="slide-btn">
                                            <a class="quicky-btn" href="#">Shop Now <i class="zmdi zmdi-chevron-right"></i><i class="zmdi zmdi-chevron-right"></i></a>
                                        </div>
                                    </div>
                                    <div class="slider-img">
                                        <img src="assets/images/slider/slider-product/b4.png" alt="Slider Product">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="service-area pt-100 ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mb-5">
                        <div class="section-title">
                            <h3 class="heading">Top Categories</h3>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach($categories as $catg)
                    <a href="{{ route( 'category.list', ['category'=>$catg->id, 'slug'=>$catg->meta_title] ) }}" class="col-md-4">
                        <div class="service-item flex-column align-items-center">
                            <div class="service-img mb-2 mb-sm-0">
                                <img src="{{URL::to('/').'/'.$catg->img_src}}" height="70" style="object-fit:contain" alt="Category">
                            </div>
                            <div class="service-content pl-0 text-center">
                                <h3 class="heading">{{$catg->name}}</h3>
                                <p><small>See products →</small></p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="banner-area pt-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-6 custom-xxs-col">
                        <div class="banner-item">
                            <div class="banner-img">
                                <a href="javascript:void(0)">
                                    <img src="assets/images/banner/1-1.jpg" alt="Banner">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-6 custom-xxs-col">
                        <div class="row banner-wrap">
                            <div class="col-md-6">
                                <div class="banner-item">
                                    <div class="banner-img">
                                        <a href="javascript:void(0)">
                                            <img src="assets/images/banner/1-2.jpg" alt="Banner">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner-item">
                                    <div class="banner-img">
                                        <a href="javascript:void(0)">
                                            <img src="assets/images/banner/1-3.jpg" alt="Banner">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row banner-wrap d-none d-md-block">
                            <div class="col-lg-12">
                                <div class="banner-item">
                                    <div class="banner-img">
                                        <a href="javascript:void(0)">
                                            <img src="assets/images/banner/1-4.jpg" alt="Banner">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 d-block d-md-none">
                        <div class="banner-item specific-banner_item">
                            <div class="banner-img">
                                <a href="javascript:void(0)">
                                    <img src="assets/images/banner/1-4.jpg" alt="Banner">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-area pt-95 featured-products">
            <div class="containers pl-4" style="width:100%;overflow:hidden">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3 class="heading">Featured Products</h3>
                            <p class="short-desc">Produce and supply various health care items all over
                                the world which were very attractive</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="quicky-element-carousel product-slider" data-slick-options='{
                        "slidesToShow": 3,
                        "slidesToScroll": 1,
                        "infinite": false,
                        "arrows": false,
                        "dots": false,
                        "spaceBetween": 30
                        }' data-slick-responsive='[
                        {"breakpoint":992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint":480, "settings": {
                        "slidesToShow": 1
                        }}
                    ]'>
                        @foreach ($products as $product)
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="{{ route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) }}">
                                            <img src="{{ $product->image }}" style="width:100%; height:250px; -o-object-fit:contain; object-fit:contain;" alt="Product Image">
                                        </a>
                                        @if(!$product->ProductInventory->in_stock)
                                            <span class="sticker bg-light pt-2 px-2 shadow shadow-md"><strong>Out of stock</strong></span>
                                        @else
                                            @if($product->ProductDiscount->has_discount)
                                                @if($product->ProductDiscount->type == 'FLAT')
                                                    <span class="sticker-2"><small class="bg-warning pt-2 pb-1 text-dark px-2">FLAT DISCOUNT</small></span>
                                                @else
                                                    <span class="sticker-2"><small class="bg-warning pt-2 pb-1 text-dark px-2">{{$product->ProductDiscount->rate}}% OFF</small></span>
                                                @endif
                                            @endif
                                        @endif
                                        <div class="add-actions">
                                            <ul>
                                                <li>
                                                    @if($product->wishlist)
                                                    <a href="{{route('wishlist.remove', ['id'=>$product->wishlist->id])}}" data-toggle="tooltip" data-placement="top" title="Wishlisted"><i class="icon-heart"></i>
                                                    </a>
                                                    @else
                                                    <a href="{{route('wishlist.add', ['id'=>$product->id])}}" data-toggle="tooltip" data-placement="top" title="Add to wishlist"><i class="icon-heart"></i>
                                                    </a>
                                                    @endif
                                                </li>

                                                <li><a href="{{ route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) }}" data-toggle="tooltip" data-placement="top" title="View product"><i class="icon-eye"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content ">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="{{ route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) }}">{{ $product->name }}</a></h3>
                                            <div class="price-box">
                                            @if($product->ProductDiscount->has_discount)
                                                <span class="old-price">{{ $_SESSION['curr'].$product->price }}</span>
                                                @if($product->ProductDiscount->type == 'FLAT')
                                                    <span class="new-price">{{ $_SESSION['curr'].$product->ProductDiscount->rate }}</span>
                                                @else
                                                    <span class="new-price">{{$_SESSION['curr']. ( (100 - $product->ProductDiscount->rate) / 100) * $product->price  }}</span>
                                                @endif
                                            @else
                                                <span class="new-price ml-0">{{$_SESSION['curr']. $product->price }}</span>
                                            @endif
                                            </div>
                                            <div class="review-area d-flex justify-content-between align-items-center">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span class="manufacture-product">{{$product->categories[0]->name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="best-deals_area pt-85">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-xl-6 col-lg-12">
                        <div class="best-deal_wrap">
                            <div class="quicky-element-carousel best-deal_slider" data-slick-options='{
                                "slidesToShow": 1,
                                "slidesToScroll": 1,
                                "infinite": true,
                                "arrows": false,
                                "dots": false,
                                "fade": true
                                }' data-slick-responsive='[
                                {"breakpoint":992, "settings": {
                                "slidesToShow": 1
                                }},
                                {"breakpoint":768, "settings": {
                                "slidesToShow": 1
                                }},
                                {"breakpoint":575, "settings": {
                                "slidesToShow": 1
                                }}
                            ]'>

                                <div class="best-deal_item best-deal-bg-01">
                                    <div class="best-deal_content">
                                        <span class="product-discount">DISCOUNTED UP TO <strong>50%</strong></span>
                                        <h3 class="product-name">Rose Water</h3>
                                        <span class="product-offer">LIMITED TIME OFEER</span>
                                        <div class="countdown-wrap">
                                            <div class="countdown item-4" data-countdown="2020/09/01" data-format="short">
                                                <div class="countdown__item">
                                                    <span class="countdown__time daysLeft"></span>
                                                    <span class="countdown__text daysText"></span>
                                                </div>
                                                <div class="countdown__item">
                                                    <span class="countdown__time hoursLeft"></span>
                                                    <span class="countdown__text hoursText"></span>
                                                </div>
                                                <div class="countdown__item">
                                                    <span class="countdown__time minsLeft"></span>
                                                    <span class="countdown__text minsText"></span>
                                                </div>
                                                <div class="countdown__item">
                                                    <span class="countdown__time secsLeft"></span>
                                                    <span class="countdown__text secsText"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="quicky-btn-ps_left">
                                            <!-- <a class="quicky-btn horizontal-line_ltr" href="#">Discover -->
                                            <a class="quicky-btn" href="#">Discover
                                                Now!</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <div class="testimonial-wrap">
                            <div class="quicky-element-carousel testimonial-slider" data-slick-options='{
                                "slidesToShow": 1,
                                "slidesToScroll": 1,
                                "infinite": false,
                                "arrows": false,
                                "autoplay" : true,
                                "dots": false
                                }' data-slick-responsive='[
                                {"breakpoint":992, "settings": {
                                "slidesToShow": 1
                                }},
                                {"breakpoint":768, "settings": {
                                "slidesToShow": 1
                                }},
                                {"breakpoint":575, "settings": {
                                "slidesToShow": 1
                                }}
                            ]'>

                                <div class="testimonial-item testimonial-bg-01">
                                    <div class="testimonial-content">
                                        <p class="short-desc">They are always quick to respond to my email with answers that I am needing. Very nice and professional.
                                            <div class="user-info">
                                                <h3 class="user-name">Nicolus Alberto</h3>
                                                <small class="user-occupation">CEO, Opex</small>
                                            </div>
                                        </p>
                                    </div>
                                </div>
                                <div class="testimonial-item testimonial-bg-01">
                                    <div class="testimonial-content">
                                        <p class="short-desc">I swear by Bhukyra's Liquid Chyavanprash - it keeps my immune system humming. I tell everyone about it and how it keeps me feeling GREAT!
                                            <div class="user-info">
                                                <h3 class="user-name">Alberto Nicolus</h3>
                                                <small class="user-occupation">CEO, Opex</small>
                                            </div>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-area product-area-2 pt-95">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3 class="heading">Popular Products</h3>
                            <p class="short-desc">Produce and supply various Handicraft items all over
                                the world which were very attractive</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="quicky-element-carousel product-slider" data-slick-options='{
                        "slidesToShow": 3,
                        "slidesToScroll": 1,
                        "infinite": false,
                        "arrows": false,
                        "dots": false,
                        "spaceBetween": 30,
                        "rows" : 2
                        }' data-slick-responsive='[
                        {"breakpoint":992, "settings": {
                        "slidesToShow": 2
                        }},
                        {"breakpoint":480, "settings": {
                        "slidesToShow": 1
                        }}
                    ]'>


                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="assets/images/product/medium-size/b6.png" style="width:100%; height:340px; -o-object-fit:contain; object-fit:contain;" alt="Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <span class="sticker-2">-16%</span>
                                        <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                        class="icon-magnifier"></i></a>
                                                </li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                </li>

                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#">Oro Safe Tooth Powder</a></h3>
                                            <div class="price-box">
                                                <span class="old-price">₹149</span>
                                                <span class="new-price">₹149</span>
                                            </div>
                                            <div class="review-area d-flex justify-content-between align-items-center">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span class="manufacture-product">Handcraft</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="assets/images/product/medium-size/b1.png" style="width:100%; height:340px; -o-object-fit:contain; object-fit:contain;" alt="Product Image">
                                        </a>
                                        <span class="sticker">New</span>
                                        <span class="sticker-2"><small class="bg-warning pt-2 pb-1 text-dark px-2">16% OFF</small></span>
                                        <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                        class="icon-magnifier"></i></a>
                                                </li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                </li>

                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#">Gold charged rose water</a></h3>
                                            <div class="price-box">
                                                <span class="old-price">₹599</span>
                                                <span class="new-price">₹599</span>
                                            </div>
                                            <div class="review-area d-flex justify-content-between align-items-center">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span class="manufacture-product">Skin care</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="assets/images/product/medium-size/b3.png" style="width:100%; height:340px; -o-object-fit:contain; object-fit:contain;" alt=" Product Image">
                                        </a>
                                        <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                        class="icon-magnifier"></i></a>
                                                </li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                </li>

                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#">Rose water</a></h3>
                                            <div class="price-box">
                                                <span class="old-price">₹349</span>
                                                <span class="new-price">₹349</span>
                                            </div>
                                            <div class="review-area d-flex justify-content-between align-items-center">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span class="manufacture-product">Skin care</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="assets/images/product/medium-size/b4.png" style="width:100%; height:340px; -o-object-fit:contain; object-fit:contain;" alt="Quicky's Product Image">
                                        </a>
                                        <span class="sticker"></span>
                                        <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                        class="icon-magnifier"></i></a>
                                                </li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                </li>

                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#">Kamla Hair Oil</a></h3>
                                            <div class="price-box">
                                                <span class="old-price">₹149</span>
                                                <span class="new-price">₹169</span>
                                            </div>
                                            <div class="review-area d-flex justify-content-between align-items-center">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span class="manufacture-product">Health care</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="assets/images/product/medium-size/b5.png" style="width:100%; height:340px; -o-object-fit:contain; object-fit:contain;" alt="Quicky's Product Image">
                                        </a>
                                        <span class="sticker">Hot</span>
                                        <span class="sticker-2"><small class="bg-warning pt-2 pb-1 text-dark px-2">25% OFF</small></span>
                                        <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                        class="icon-magnifier"></i></a>
                                                </li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                </li>

                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#">Liquid Chyavanprash</a></h3>
                                            <div class="price-box">
                                                <span class="old-price">₹149</span>
                                                <span class="new-price">₹149</span>
                                            </div>
                                            <div class="review-area d-flex justify-content-between align-items-center">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span class="manufacture-product">Health care</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-item">
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="#">
                                            <img src="assets/images/product/medium-size/b2.png" style="width:100%; height:340px; -o-object-fit:contain; object-fit:contain;" alt=" Product Image">
                                        </a>
                                        <div class="add-actions">
                                            <ul>
                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                        class="icon-magnifier"></i></a>
                                                </li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                </li>

                                                <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="product-desc_info">
                                            <h3 class="product-name"><a href="#">Rose water</a></h3>
                                            <div class="price-box">
                                                <span class="old-price">₹349</span>
                                                <span class="new-price">₹349</span>
                                            </div>
                                            <div class="review-area d-flex justify-content-between align-items-center">
                                                <div class="rating-box">
                                                    <ul>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                        <li><i class="icon-star"></i></li>
                                                    </ul>
                                                </div>
                                                <span class="manufacture-product">Skin care</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-area-2 pt-85">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-6 custom-xxs-col">
                        <div class="banner-item">
                            <div class="banner-img">
                                <a href="javascript:void(0)">
                                    <img src="assets/images/banner/1-5.jpg" alt="Quicky's Banner">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6 custom-xxs-col">
                        <div class="banner-item">
                            <div class="banner-img">
                                <a href="javascript:void(0)">
                                    <img src="assets/images/banner/1-6.jpg" alt="Quicky's Banner">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-6 custom-xxs-col">
                        <div class="banner-item">
                            <div class="banner-img">
                                <a href="javascript:void(0)">
                                    <img src="assets/images/banner/1-7.jpg" alt="Quicky's Banner">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection


    @section ('script')
        <script>
            $(document).on("click", ".quick-view-btn", function(){
                var id=$(this).data('id');
                $.ajax({
                    url: 'product/quickView',
                    type:'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: id
                    },
                    beforeSend : function(){
                        // $('#quickViewModal').modal('show');
                    },
                    success: function(e){
                        $('#quickViewModal').modal('show');
                        $('#quickViewModal .modal-content .sp-heading h5 a').html(e.prod.name);
                        if(e.disc.has_discount==1){
                            if(e.disc.type=='FLAT'){
                                $('#quickViewModal .modal-content .price-box .new-price').html('₹'+e.disc.rate);
                                $('#quickViewModal .modal-content .price-box .old-price').html('₹'+e.prod.price);
                            }else{
                                var new_price= ((100 - e.disc.rate) / 100 ) * e.prod.price;
                                $('#quickViewModal .modal-content .price-box .new-price').html('₹'+Math.ceil(new_price));
                                $('#quickViewModal .modal-content .price-box .old-price').html('₹'+e.prod.price);
                            }
                        }
                        else{
                            $('#quickViewModal .modal-content .price-box .new-price').html('₹'+e.prod.price);
                            $('#quickViewModal .modal-content .price-box .old-price').html('');
                        }
                        $('#quickViewModal .modal-content .sp-essential_stuff li.brand-name a').html(e.brand.name);
                        $('#quickViewModal .modal-content .sp-essential_stuff li.sku a').html(e.inventory.sku);
                        if(e.inventory.in_stock==1){
                            $('#quickViewModal .modal-content .sp-essential_stuff li.in-stock a').html('In stock');
                        }else{
                            $('#quickViewModal .modal-content .sp-essential_stuff li.in-stock a').html('Out of stock');
                        }
                        var tags=JSON.parse(e.prod.tags);
                        var j = '';
                        tags.forEach(function (tag){
                            j += ' <a href="javascript:void(0)"> '+tag+' </a> &nbsp;';
                        })
                        $('#quickViewModal .modal-content .quicky-tag-line').html(j);

                        j = '<div class="single-slide red"><img src="'+e.prod.image+'" style="width:100%; height: 360px; -o-object-fit: contain; object-fit: contain;" alt=" Product Image"></div>';
                        e.images.forEach(function (img){
                            j += '<div class="single-slide red"><img src="'+img.img_src+'" style="width:100%; height: 360px; -o-object-fit: contain; object-fit: contain;" alt="Product Thumnail"></div>';
                        })
                        $('#quickViewModal .sp-img_slider').html(j);
                        $("#quickViewModal .sp-img_slider").slick();

                        j = '<div class="single-slide red"><img src="'+e.prod.image+'" style="width:100%; height: 60px; -o-object-fit: contain; object-fit: contain;" alt=" Product Image"></div>';
                        e.images.forEach(function (img){
                            j += '<div class="single-slide red"><img src="'+img.img_src+'" style="width:100%; height: 60px; -o-object-fit: contain; object-fit: contain;" alt="Product Thumnail"></div>';
                        })
                        $('#quickViewModal .sp-img_slider-nav').html(j);
                    },
                    error: function(response){
                        $('#quickViewModal .modal-content').html('<div class="modal-body"><h4>Server error !</h4></div>');
                    }
                });
            });
        </script>
    @endsection

