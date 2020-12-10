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
            @include('layouts.sidebar')
              <div class="col-sm-9 order-1 order-lg-2">
                  <div class="shop-toolbar">
                      <div class="product-view-mode">
                          <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="Grid View"><i class="zmdi zmdi-grid"></i></a>
                          <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List View"><i class="zmdi zmdi-view-list-alt"></i></a>
                      </div>
                      <div class="product-page_count">
                          <p></p>
                      </div>
                      <div class="product-item-selection_area">
                          <div class="product-short">
                              <label class="select-label">Sort by:</label>
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
                  <div class="shop-product-wrap grid gridview-3 row h-100">
                    <div class="h-100 w-100 bg-white d-flex justify-content-center align-items-center ajax-loader" style="opacity:0.4">
                        <div class="zmdi zmdi-hc-spin" style="margin-top:-500px;">
                            <i class="zmdi zmdi-refresh" style="transform:scale(4);opacity:0.6"></i>
                        </div>
                    </div>
                  </div>
                  <!-- <div class="row">
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
                  </div> -->
              </div>
          </div>
      </div>
  </div>
@endsection


@section ('script')
<script>

  $(document).ready(function(){

    var loader = $('.ajax-loader');
      filter_data('');

      function filter_data(query='')
      {
        //   var search=JSON.stringify(query);
          var price =JSON.stringify($('#amount').val());
        //   var gender =JSON.stringify(get_filter('gender'));
        //   var brand =JSON.stringify(get_filter('brand'));
          $.ajax({
              url:"{{ route('product.filter') }}",
              method:'GET',
              data:{
                  price:price,
                //   query:search,
                //   gender:gender,
                //   brand:brand,
                  },
              dataType:'json',
              beforeSend:function(){
                  $('.shop-product-wrap').html(loader);
                  loader.fadeIn();
              },
              success:function(data)
              {
                  loader.fadeOut();
                  $('.shop-product-wrap').html(data.table_data);
                  $('.product-page_count p').html('(Total '+data.total_row+' products found)');
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

      $(document).on('click','.filter',function(){
          filter_data('');
      });

      $('.selector').click(function(){
          var query = $('#search').val();
          filter_data(query);
      });

      $(document).on('change','#size-dropdown',function(){
          var size = $(this).val();
          document.cookie="shoes_size="+size+";"+"path=/";
          $('#add-to-cart').removeClass('disabled');
      });

  });

</script>
@endsection
