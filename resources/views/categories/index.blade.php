@extends('layouts.app')

@section ('content')
  <div class="breadcrumb-area">
      <div class="container">
          <div class="breadcrumb-content">
              <h2>Categories</h2>
              <ul>
                  <li><a href="{{URL('/')}}">Home</a></li>
                  <li class="active">category</li>
              </ul>
          </div>
      </div>
  </div>

  <div class="quicky-content_wrapper pt-90 pb-100">
      <div class="container">
          <div class="row">
            @include('layouts.sidebar')
              <div class="col-md-9 order-1 order-lg-2">
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
                              <select class="nice-select sort">
                                  <option value="default">Default sorting</option>
                                  <option value="plth">Price: low to high</option>
                                  <option value="phtl">Price: high to low</option>
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
              </div>
          </div>
      </div>
  </div>
@endsection


@section ('script')
<script>

  $(document).ready(function(){

    var loader = $('.ajax-loader');
      filter_data('','default');

      function filter_data(query='',sort)
      {
          var price =JSON.stringify($('#amount').val());
          $.ajax({
              url:"{{ route('category.filter') }}",
              method:'GET',
              data:{
                  price:price,
                  sort:sort,
                  cid:'{{$cid}}'
                },
              dataType:'json',
              beforeSend:function(){
                  $('.shop-product-wrap').html(loader);
                  loader.fadeIn();
              },
              success:function(data)
              {
                  loader.fadeOut();
				    $('.price-slider-amount button.filter').removeClass('quicky-btn').addClass('quicky-btn-outline');
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

      $(document).on('change','.sort',function(){
          var val = $(this).val();
          filter_data('',val);
      });

      $(document).on('keyup','#search',function(){
          var query = $(this).val();
          filter_data(query);
      });

      $(document).on('click','.filter',function(){
          filter_data('',$('.sort').val());
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
