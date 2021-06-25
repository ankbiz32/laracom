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
                                <span class="price-box">
                                    @if(count($product->productAttribute))
                                        @if($data['disc']->has_discount)
                                            <span class="old-price">{{ $_SESSION['curr'].$product->productAttribute[0]->attribute_price }}</span>
                                            @if($data['disc']->type == 'FLAT')
                                                <span class="new-price">{{ $_SESSION['curr'].$data['disc']->rate }}</span>
                                            @else
                                                <span class="new-price">{{$_SESSION['curr']. round(( (100 - $data['disc']->rate) / 100) * $product->productAttribute[0]->attribute_price)  }}</span>
                                            @endif
                                        @else
                                            <span class="new-price ml-0">{{$_SESSION['curr']. $product->productAttribute[0]->attribute_price }}</span>
                                        @endif
                                    @else
                                        @if($data['disc']->has_discount)
                                            <span class="old-price">{{ $_SESSION['curr'].$data['main']->price }}</span>
                                            @if($data['disc']->type == 'FLAT')
                                                <span class="new-price">{{ $_SESSION['curr'].$data['disc']->rate }}</span>
                                            @else
                                                <span class="new-price">{{$_SESSION['curr']. round(( (100 - $data['disc']->rate) / 100) * $data['main']->price)  }}</span>
                                            @endif
                                        @else
                                            <span class="new-price ml-0">{{$_SESSION['curr']. $data['main']->price }}</span>
                                        @endif
                                    @endif
                                </span>
                                <p class="h6 mt-3 mb-1">{{ $data['descr']->short_des }}</p>
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
                                </ul>
                            </div>
                            @if (count($product->productAttribute))
                            <div class="product-size_box">
                                <span>Select {{$product->productAttribute[0]->attribute->name}} :</span>
                                <select class="myniceselect nice-select" id="attrChange">
                                    @foreach ($product->productAttribute as $opt)
                                        <option data-price="{{$opt->attribute_price}}" value="{{$opt->attributeDetail->id}}">{{$opt->attributeDetail->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                           
                            <!-- <div class="quantity">
                                <label>Quantity</label>
                                <div class="cart-plus-minus">
                                    <input class="cart-plus-minus-box" value="1" type="text">
                                    <div class="dec qtybutton"><i class="zmdi zmdi-chevron-down"></i></div>
                                    <div class="inc qtybutton"><i class="zmdi zmdi-chevron-up"></i></div>
                                </div>
                            </div> -->
                            <div class="qty-btn_area">
                                <ul>
                                    @if($data['inventory']->in_stock)
                                        @if (count($product->productAttribute))
                                            <li class="mr-2"><a href="{{ route('cart.add',['product'=>$data['main']->id]) }}?attr={{$product->productAttribute[0]->attributeDetail->id}}" id="productAdder" class="quicky-btn btn-block text-center quicky-btn_fullwidth square-btn">Add to cart</a></li>
                                        @else
                                            <li class="mr-2"><a href="{{ route('cart.add',['product'=>$data['main']->id]) }}" id="productAdder" class="quicky-btn btn-block text-center quicky-btn_fullwidth square-btn">Add to cart</a></li>
                                        @endif
                                    @endif

                                    @if($data['main']->wishlist)
                                        <li class=""><a class="qty-wishlist_btn" href="{{route('wishlist.remove', ['id'=>$data['main']->wishlist->id])}}" data-toggle="tooltip" title="Wishlisted"><i class="zmdi zmdi-favorite"></i></a></li>
                                    @else
                                        <li class=""><a class="qty-wishlist_btn" href="{{route('wishlist.add', ['id'=>$data['main']->id])}}" data-toggle="tooltip" title="Add To Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="quicky-tag-line">
                                <h6>Tags:</h6>
                                <?php $tags= json_decode($data['main']->tags) ?>
                                @foreach($tags as $t)
                                    <a href="{{ route( 'tag.list', ['tag'=>$t] ) }}">{{$t}}
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
                                    {!! $data['descr']->full_des !!}
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
                            @foreach($data['brands'] as $b)
                            <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::to('/').'/'.$b->img_src}}" alt="{{$b->name}}" height="60">
                                </a>
                            </div>
                            @endforeach

                            <!-- <div class="brand-item">
                                <a href="javascript:void(0)">
                                    <img src="{{URL::to('/')}}/assets/images/brand/1.png" alt=" Brand">
                                </a>
                            </div> -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section ('script')
<script>
    $(document).on('change', '#attrChange', function(){
       let price =  $(this).find(':selected').data('price');
       $('#productAdder').attr('href', "{{ route('cart.add',['product'=>$data['main']->id]) }}?attr="+$(this).val());
       let disc =  <?=$data['disc']->has_discount?>;
       if(disc){
            let discType =  "<?=$data['disc']->type?>";
            let rate =  <?=$data['disc']->rate?>;
            if(discType == 'FLAT'){
                $('.old-price').html("<?=$_SESSION['curr']?>" + price);
                $('.new-price').html("<?=$_SESSION['curr']?>"+ rate);
            } else{ 
                let new_price = Math.round(((100-rate)/100)*price);
                $('.old-price').html("<?=$_SESSION['curr']?>" + price);
                $('.new-price').html("<?=$_SESSION['curr']?>" + new_price);
            } 
        } else { 
            $('.new-price').html("<?=$_SESSION['curr']?>" + price);
        }
    })
</script>
@endsection
