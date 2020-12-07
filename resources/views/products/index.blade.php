@extends('layouts.app')

@section ('content')
  <div class="breadcrumb-area">
      <div class="container">
          <div class="breadcrumb-content">
              <h2>Product</h2>
              <ul>
                  <li><a href="{{URL('/')}}">Home</a></li>
                  <li class="active">Products</li>
              </ul>
          </div>
      </div>
  </div>

  <div class="quicky-content_wrapper pt-90 pb-100">
      <div class="container">
          <div class="row">
              <div class="col-lg-3 order-2 order-lg-1 py-4 shadow px-5 bg-white">
                  <div class="quicky-sidebar-catagories_area">

                      <div class="quicky-sidebar_categories">
                          <div class="quicky-categories_title first-child">
                              <h5>Filter by price</h5>
                          </div>
                          <div class="price-filter">
                              <div id="slider-range"></div>
                              <div class="price-slider-amount">
                                  <div class="label-input">
                                      <label>price : </label>
                                      <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                      <button class="filter-btn">Filter</button>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <div class="quicky-sidebar_categories category-module">
                          <div class="quicky-categories_title">
                              <h5>Product Categories</h5>
                          </div>
                          <div class="sidebar-categories_menu">
                              <ul>
                                @isset($categories)
                                    @foreach($categories as $c)
                                        <li>
                                            <span class="megamenu-title">{{$c->name}}</span>
                                            @if(count($c->childs))
                                                <ul>
                                                @foreach($c->childs as $ch)
                                                    <li><a href="#">› {{$ch->name}}</a></li>
                                                @endforeach
                                                </ul>
                                            @else
                                            @endif
                                        </li>
                                    @endforeach
                                @endisset
                                  <li class="has-sub"><a href="javascript:void(0)">Clock<i
                                          class="zmdi zmdi-plus"></i></a>
                                      <ul>
                                          <li><a href="javascript:void(0)">Margherita</a></li>
                                          <li><a href="javascript:void(0)">Marinara</a></li>
                                          <li><a href="javascript:void(0)">Quattro Stagioni</a></li>
                                          <li><a href="javascript:void(0)">Carbonara</a></li>
                                          <li><a href="javascript:void(0)">Crudo</a></li>
                                          <li><a href="javascript:void(0)">Napoli</a></li>
                                          <li><a href="javascript:void(0)">Diavola</a></li>
                                          <li><a href="javascript:void(0)">Funghi</a></li>
                                      </ul>
                                  </li>
                                  <li><a href="javascript:void(0)">Basket</a></li>
                              </ul>
                          </div>
                      </div>

                      <div class="quicky-sidebar_categories">
                          <div class="quicky-categories_title quicky-tags_title">
                              <h5>Product Tags</h5>
                          </div>
                          <ul class="quicky-tags_list">
                            @foreach($tags as $tag)
                                <li><a href="javascript:void(0)">{{$tag->tag}}</a></li>
                            @endforeach
                          </ul>
                      </div>

                      <div class="quicky-sidebar_categories quicky-banner_area sidebar-banner_area">
                      <div class="banner-item img-hover_effect mt-4">
                          <div class="banner-img">
                              <a href="javascript:void(0)">
                                  <img class="img-full" src="{{URL('/')}}/assets/images/banner/3-1.jpg" alt="Ad Banner">
                              </a>
                          </div>
                      </div>
                  </div>
                  </div>
              </div>
              <div class="col-lg-9 order-1 order-lg-2">
                  <div class="shop-toolbar">
                      <div class="product-view-mode">
                          <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="zmdi zmdi-grid"></i></a>
                          <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List View"><i class="zmdi zmdi-view-list-alt"></i></a>
                      </div>
                      <div class="product-page_count">
                          <p>(Showing 1–9 of 40 results)</p>
                      </div>
                      <div class="product-item-selection_area">
                          <div class="product-short">
                              <label class="select-label">Sort By:</label>
                              <select class="nice-select">
                                  <option value="1">Default sorting</option>
                                  <option value="2">Name, A to Z</option>
                                  <option value="3">Name, Z to A</option>
                                  <option value="4">Price, low to high</option>
                                  <option value="5">Price, high to low</option>
                                  <option value="5">Rating (Highest)</option>
                                  <option value="5">Rating (Lowest)</option>
                                  <option value="5">Model (A - Z)</option>
                                  <option value="5">Model (Z - A)</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="shop-product-wrap grid gridview-3 row">
                      <div class="col-12">
                          <div class="product-item">
                              <div class="single-product">
                                  <div class="product-img">
                                      <a href="single-product.html">
                                          <img src="assets/images/product/medium-size/25.jpg" alt="Quicky's Product Image">
                                      </a>
                                      <div class="add-actions">
                                          <ul>
                                              <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-magnifier"></i></a>
                                              </li>
                                              <li><a href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                      class="icon-heart"></i></a>
                                              </li>
                                              <li><a href="compare.html" data-toggle="tooltip" data-placement="top" title="Add To Compare"><i
                                                      class="icon-refresh"></i></a>
                                              </li>
                                              <li><a href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="product-content bg-snow">
                                      <div class="product-desc_info">
                                          <div class="manufacture-product_top">
                                              <span>Clock</span>
                                          </div>
                                          <h3 class="product-name"><a href="single-product.html">Abstract Design
                                                  Clock</a></h3>
                                          <div class="price-box">
                                              <span class="new-price ml-0">$70.00</span>
                                          </div>
                                          <div class="review-area d-flex justify-content-between align-items-center">
                                              <div class="rating-box gamboge-color">
                                                  <ul>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="list-product_item">
                              <div class="single-product">
                                  <div class="product-img">
                                      <a href="single-product.html">
                                          <img src="assets/images/product/medium-size/25.jpg" alt="Quicky's Product Image">
                                      </a>
                                  </div>
                                  <div class="quicky-product-content">
                                      <div class="product-desc_info">
                                          <h6 class="product-name"><a href="single-product.html">Abstract Design Clock</a>
                                          </h6>
                                          <div class="price-box">
                                              <span class="old-price">$75.00</span>
                                              <span class="new-price">$70.00</span>
                                          </div>
                                          <div class="rating-box gamboge-color">
                                              <ul>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                              </ul>
                                          </div>
                                          <div class="product-short_desc">
                                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                  veniam, quis nostrud exercitation ullamco,Proin lectus ipsum, gravida et
                                                  mattis vulputate, tristique ut lectus</p>
                                          </div>
                                      </div>
                                      <div class="add-actions">
                                          <ul>
                                              <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-magnifier"></i></a>
                                              </li>
                                              <li><a href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                      class="icon-heart"></i></a>
                                              </li>
                                              <li><a href="compare.html" data-toggle="tooltip" data-placement="top" title="Add To Compare"><i
                                                      class="icon-refresh"></i></a>
                                              </li>
                                              <li><a href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="product-item">
                              <div class="single-product">
                                  <div class="product-img">
                                      <a href="single-product.html">
                                          <img src="assets/images/product/medium-size/26.jpg" alt="Quicky's Product Image">
                                      </a>
                                      <span class="sticker red-color">Sale</span>
                                      <div class="add-actions hover-right_side">
                                          <ul>
                                              <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-magnifier"></i></a>
                                              </li>
                                              <li><a href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                      class="icon-heart"></i></a>
                                              </li>
                                              <li><a href="compare.html" data-toggle="tooltip" data-placement="top" title="Add To Compare"><i
                                                      class="icon-refresh"></i></a>
                                              </li>
                                              <li><a href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="product-content bg-snow">
                                      <div class="product-desc_info">
                                          <div class="manufacture-product_top">
                                              <span>Clock</span>
                                          </div>
                                          <h3 class="product-name"><a href="single-product.html">Fency Design Clock</a></h3>
                                          <div class="price-box">
                                              <span class="new-price ml-0">$45.00</span>
                                          </div>
                                          <div class="review-area d-flex justify-content-between align-items-center">
                                              <div class="rating-box gamboge-color">
                                                  <ul>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="list-product_item">
                              <div class="single-product">
                                  <div class="product-img">
                                      <a href="single-product.html">
                                          <img src="assets/images/product/medium-size/26.jpg" alt="Quicky's Product Image">
                                      </a>
                                  </div>
                                  <div class="quicky-product-content">
                                      <div class="product-desc_info">
                                          <h6 class="product-name"><a href="single-product.html">Fency Design Clock</a>
                                          </h6>
                                          <div class="price-box">
                                              <span class="new-price ml-0">$45.00</span>
                                          </div>
                                          <div class="rating-box gamboge-color">
                                              <ul>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                              </ul>
                                          </div>
                                          <div class="product-short_desc">
                                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                  veniam, quis nostrud exercitation ullamco,Proin lectus ipsum, gravida et
                                                  mattis vulputate, tristique ut lectus</p>
                                          </div>
                                      </div>
                                      <div class="add-actions">
                                          <ul>
                                              <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-magnifier"></i></a>
                                              </li>
                                              <li><a href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                      class="icon-heart"></i></a>
                                              </li>
                                              <li><a href="compare.html" data-toggle="tooltip" data-placement="top" title="Add To Compare"><i
                                                      class="icon-refresh"></i></a>
                                              </li>
                                              <li><a href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="col-12">
                          <div class="product-item">
                              <div class="single-product">
                                  <div class="product-img">
                                      <a href="single-product.html">
                                          <img src="assets/images/product/medium-size/27.jpg" alt="Quicky's Product Image">
                                      </a>
                                      <div class="add-actions">
                                          <ul>
                                              <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-magnifier"></i></a>
                                              </li>
                                              <li><a href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                      class="icon-heart"></i></a>
                                              </li>
                                              <li><a href="compare.html" data-toggle="tooltip" data-placement="top" title="Add To Compare"><i
                                                      class="icon-refresh"></i></a>
                                              </li>
                                              <li><a href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="product-content bg-snow">
                                      <div class="product-desc_info">
                                          <div class="manufacture-product_top">
                                              <span>Clock</span>
                                          </div>
                                          <h3 class="product-name"><a href="single-product.html">Wooden Style Clock</a></h3>
                                          <div class="price-box">
                                              <span class="new-price ml-0">$65.00</span>
                                          </div>
                                          <div class="review-area d-flex justify-content-between align-items-center">
                                              <div class="rating-box gamboge-color">
                                                  <ul>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                      <li><i class="icon-star"></i></li>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="list-product_item">
                              <div class="single-product">
                                  <div class="product-img">
                                      <a href="single-product.html">
                                          <img src="assets/images/product/medium-size/27.jpg" alt="Quicky's Product Image">
                                      </a>
                                  </div>
                                  <div class="quicky-product-content">
                                      <div class="product-desc_info">
                                          <h6 class="product-name"><a href="single-product.html">Wooden Style Clock</a>
                                          </h6>
                                          <div class="price-box">
                                              <span class="new-price ml-0">$65.00</span>
                                          </div>
                                          <div class="rating-box gamboge-color">
                                              <ul>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                                  <li><i class="icon-star"></i></li>
                                              </ul>
                                          </div>
                                          <div class="product-short_desc">
                                              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                                  veniam, quis nostrud exercitation ullamco,Proin lectus ipsum, gravida et
                                                  mattis vulputate, tristique ut lectus</p>
                                          </div>
                                      </div>
                                      <div class="add-actions">
                                          <ul>
                                              <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="icon-magnifier"></i></a>
                                              </li>
                                              <li><a href="wishlist.html" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                      class="icon-heart"></i></a>
                                              </li>
                                              <li><a href="compare.html" data-toggle="tooltip" data-placement="top" title="Add To Compare"><i
                                                      class="icon-refresh"></i></a>
                                              </li>
                                              <li><a href="cart.html" data-toggle="tooltip" data-placement="top" title="Add To cart"><i class="icon-bag"></i></a>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="quicky-paginatoin-area">
                              <ul class="quicky-pagination-box">
                                  <li class="active"><a href="javascript:void(0)">1</a></li>
                                  <li><a href="javascript:void(0)">2</a></li>
                                  <li><a href="javascript:void(0)">3</a></li>
                                  <li><a href="javascript:void(0)">4</a></li>
                                  <li><a href="javascript:void(0)">5</a></li>
                                  <li><a class="Next" href="javascript:void(0)">Next</a></li>
                              </ul>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection


@section ('script')
<script>

  $(document).ready(function(){

      filter_data('');

      function filter_data(query='')
      {
          var search=JSON.stringify(query);
          var price =JSON.stringify($('#pricerange').val());
          var gender =JSON.stringify(get_filter('gender'));
          var brand =JSON.stringify(get_filter('brand'));
          $.ajax({
              url:"{{ route('product.filter') }}",
              method:'GET',
              data:{
                  query:search,
                  price:price,
                  gender:gender,
                  brand:brand,
                  },
              dataType:'json',
              success:function(data)
              {
                  $('#products').html(data.table_data);
              }
          })
      }

      function get_filter(class_name)
      {
          var filter=[];
          $('.'+class_name+':checked').each(function(){
              filter.push($(this).val());
          });
          return filter;
      }

      $(document).on('keyup','#search',function(){
          var query = $(this).val();
          filter_data(query);
      });

      $('.selector').click(function(){
          var query = $('#search').val();
          filter_data(query);
      });

      $(document).on('input','#pricerange',function(){
          var range = $(this).val();
          $('#currentrange').html(range);
      });

      $(document).on('change','#size-dropdown',function(){
          var size = $(this).val();
          document.cookie="shoes_size="+size+";"+"path=/";
          $('#add-to-cart').removeClass('disabled');
      });

  });

</script>
@endsection
