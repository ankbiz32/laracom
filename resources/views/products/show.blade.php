@extends('layouts.app')


@section ('content')

    <div class="sp-area pt-100">
        <div class="container">
            <div class="sp-nav">
                <div class="row">
                    <div class="col-lg-5  bg-ivory">
                        <div class="sp-img_area">
                            <div class="sp-img_slider slick-img-slider quicky-element-carousel" data-slick-options='{
                                "slidesToShow": 1,
                                "arrows": false,
                                "fade": true,
                                "draggable": false,
                                "swipe": false,
                                "asNavFor": ".sp-img_slider-nav"
                                }'>
                                <div class="single-slide zoom">
                                    <img src="{{URL::to('/')}}/{{$data['main']->image}}" alt=" Product Image">
                                </div>
                                @foreach($data['images'] as $img)
                                <div class="single-slide zoom">
                                    <img src="{{URL::to('/')}}/{{$img->img_src}}" alt=" Product Image">
                                </div>
                                @endforeach
                            </div>
                            <div class="sp-img_slider-nav slick-slider-nav quicky-element-carousel arrow-style arrow-sm_size arrow-day_color" data-slick-options='{
                                "slidesToShow": 3,
                                "asNavFor": ".sp-img_slider",
                                "focusOnSelect": true,
                                "arrows" : true,
                                "spaceBetween": 30
                                }' data-slick-responsive='[
                                        {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                        {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                        {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                        {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                        {"breakpoint":575, "settings": {"slidesToShow": 2}}
                                    ]'>
                                <div class="single-slide">
                                    <img src="{{URL::to('/')}}/{{$data['main']->image}}" alt=" Product Image">
                                </div>
                                @foreach($data['images'] as $img)
                                <div class="single-slide">
                                    <img src="{{URL::to('/')}}/{{$img->img_src}}" alt=" Product Image">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7  bg-ivory">
                        <div class="sp-content ml-lg-4">
                            <div class="sp-heading">
                                <h4 class="h4">{{$data['main']->name}}</h4>
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
                            <div class="sp-essential_stuff">
                                <ul>
                                    <li>Brand: <a href="javascript:void(0)">{{$data['brand']->name}}</a></li>
                                    <li>Product Code: <a href="javascript:void(0)" style="pointer-events:none;">{{$data['inventory']->sku}}</a></li>
                                    <li>Availability: <a href="javascript:void(0)" style="pointer-events:none;">{{$data['inventory']->in_stock==1?' In stock':'Out of stock'}}</a></li>
                                    <!-- <li>EX Tax: <a href="javascript:void(0)"><span>$453.35</span></a></li> -->
                                </ul>
                            </div>
                            <div class="product-size_box">
                                <span>Size</span>
                                <select class="myniceselect nice-select">
                                    <option value="1">S</option>
                                    <option value="2">M</option>
                                    <option value="3">L</option>
                                    <option value="4">XL</option>
                                </select>
                            </div>
                            <div class="quantity">
                                <label>Quantity</label>
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" value="1" type="text">
                                    <div class="dec qtybutton"><i class="zmdi zmdi-chevron-down"></i></div>
                                    <div class="inc qtybutton"><i class="zmdi zmdi-chevron-up"></i></div>
                                </div>
                            </div>
                            <div class="qty-btn_area">
                                <ul>
                                    <li><a href="{{ route('cart.add',['product'=>$data['main']->id]) }}" class="quicky-btn btn-block text-center quicky-btn_fullwidth square-btn">Add to cart</a></li>
                                    <li class="ml-2"><a class="qty-wishlist_btn" href="wishlist.html" data-toggle="tooltip" title="Add To Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="quicky-tag-line">
                                <h6>Tags:</h6>
                                <?php $tags= json_decode($data['main']->tags) ?>
                                @foreach($tags as $t)
                                    <a href="javascript:void(0)">{{$t}}
                                    @if(!$loop->last)
                                        ,
                                    @endif
                                    </a>
                                @endforeach
                            </div>
                            <div class="social-link-4 square-style align-left border-style">
                                <ul>
                                    <li class="facebook">
                                        <a href="https://www.facebook.com" data-toggle="tooltip" target="_blank" title="Facebook">
                                            <i class="zmdi zmdi-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="twitter">
                                        <a href="https://twitter.com" data-toggle="tooltip" target="_blank" title="Twitter">
                                            <i class="zmdi zmdi-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="instagram">
                                        <a href="https://rss.com" data-toggle="tooltip" target="_blank" title="Instagram">
                                            <i class="zmdi zmdi-instagram"></i>
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

    <div class="product-tab_area pt-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="sp-product-tab_nav">
                        <div class="product-tab">
                            <ul class="nav product-menu">
                                <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a>
                                </li>
                                <li><a data-toggle="tab" href="#reviews"><span>Reviews (1)</span></a></li>
                            </ul>
                        </div>
                        <div class="tab-content uren-tab_content">
                            <div id="description" class="tab-pane active show" role="tabpanel">
                                <div class="product-description">
                                    {!! $data['main']->full_descr !!}
                                </div>
                            </div>
                            <div id="reviews" class="tab-pane" role="tabpanel">
                                <div class="tab-pane active" id="tab-review">
                                    <form class="form-horizontal" id="form-review">
                                        <div id="review">
                                            <table class="table table-striped table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 50%;"><strong>Customer</strong></td>
                                                        <td class="text-right">20/02/20</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <p>Good product! Thank you very much</p>
                                                            <div class="rating-box">
                                                                <ul>
                                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <h2>Write a review</h2>
                                        <div class="form-group required">
                                            <div class="col-sm-12 p-0">
                                                <label>Your Email <span class="required">*</span></label>
                                                <input class="review-input plr-10" type="email" name="con_email" id="con_email" required>
                                            </div>
                                        </div>
                                        <div class="form-group required second-child">
                                            <div class="col-sm-12 p-0">
                                                <label class="control-label">Share your opinion</label>
                                                <textarea class="review-textarea plr-10" name="con_message" id="con_message"></textarea>
                                                <div class="help-block"><span class="text-danger">Note:</span> HTML is
                                                    not
                                                    translated!</div>
                                            </div>
                                        </div>
                                        <div class="form-group last-child required">
                                            <div class="col-sm-12 p-0">
                                                <div class="your-opinion">
                                                    <label>Your Rating</label>
                                                    <div class="rating-box">
                                                        <ul>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                            <li><i class="zmdi zmdi-star"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="quicky-btn-ps_right">
                                                <button class="quicky-btn-2 square-btn">Continue</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="brand-area ptb-90">
        <div class="container">
            <div class="brand-nav">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="quicky-element-carousel brand-slider" data-slick-options='{
                            "slidesToShow": 4,
                            "slidesToScroll": 1,
                            "infinite": true,
                            "arrows": false,
                            "dots": false,
                            "spaceBetween": 30
                            }' data-slick-responsive='[
                            {"breakpoint":992, "settings": {
                            "slidesToShow": 3
                            }},
                            {"breakpoint":768, "settings": {
                            "slidesToShow": 2
                            }},
                            {"breakpoint":575, "settings": {
                            "slidesToShow": 2
                            }}
                        ]'>

                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::to('/')}}/assets/images/brand/1.png" alt=" Brand">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::to('/')}}/assets/images/brand/2.png" alt=" Brand">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::to('/')}}/assets/images/brand/3.png" alt=" Brand">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::to('/')}}/assets/images/brand/4.png" alt=" Brand">
                                </a>
                            </div>
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::to('/')}}/assets/images/brand/1.png" alt=" Brand">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section ('script')
@endsection
