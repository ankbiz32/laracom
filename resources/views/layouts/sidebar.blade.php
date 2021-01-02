
    <style>
        .quicky-content_wrapper .quicky-sidebar-catagories_area .quicky-sidebar_categories .sidebar-categories_menu ul li{
            position: relative;
        }
        .quicky-content_wrapper .quicky-sidebar-catagories_area .quicky-sidebar_categories .sidebar-categories_menu ul li > i{
            font-size: 20px;
            position: absolute;
            top: 0;
            right: 0;
            background-color:#eee;
            padding:5px 10px;
            border-radius:5px;
            -webkit-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        .quicky-content_wrapper .quicky-sidebar-catagories_area .quicky-sidebar_categories .sidebar-categories_menu ul li.open > i {
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        .template-color-1 .sidebar-categories_menu ul li:hover > a {
            color: inherit;
        }
        .template-color-1 .sidebar-categories_menu ul li a:hover {
            color: #a8741a;
        }
    </style>
    
    <div class="col-md-3 order-2 order-lg-1 py-4 shadow px-5 bg-white">
        <div class="quicky-sidebar-catagories_area">

            <div class="quicky-sidebar_categories">
                <div class="quicky-categories_title first-child">
                    <h5 class="pb-2">Filter by price :</h5>
                </div>
                <div class="price-filter">
                    <div id="slider-range"></div>
                    <div class="price-slider-amount">
                        <div class="label-input">
                            <label>price : </label>
                            <input type="text" id="amount" data-min="{{$minPrice}}" data-max="{{$maxPrice}}" name="price" placeholder="Add Your Price" class="mb-2" />
                            
                            <button class="quicky-btn-outline btn-block filter text-center py-2">Apply filter</button>
                            <!-- <button class="filter-btn">Filter</button> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="quicky-sidebar_categories category-module">
                <div class="quicky-categories_title">
                    <h5 class="pb-2">Categories :</h5>
                </div>
                <div class="sidebar-categories_menu">
                    <ul>
                    
                    @isset($categories)
                        @foreach($categories as $c)
                            @if(count($c->childs))
                                <li class="has-sub relative">
                                    <a href="{{ route( 'category.list', ['category'=>$c->id, 'slug'=>$c->meta_title] ) }}">{{$c->name}}</a>
                                    <i class="zmdi zmdi-plus"></i>
                                    <ul>
                                    @foreach($c->childs as $ch)
                                        <li><a href="{{ route( 'category.list', ['category'=>$ch->id, 'slug'=>$ch->meta_title] ) }}">{{$ch->name}}</a></li>
                                    @endforeach
                                    </ul>
                                </li>
                            @else
                                <li><a href="{{ route( 'category.list', ['category'=>$c->id, 'slug'=>$c->meta_title] ) }}">{{$c->name}}</a></li>
                            @endif
                        @endforeach
                            <li></li>
                    @endisset
                    </ul>
                </div>
            </div>

            <div class="quicky-sidebar_categories">
                <div class="quicky-categories_title quicky-tags_title">
                    <h5 class="pb-2">Tags :</h5>
                </div>
                <ul class="quicky-tags_list">
                @foreach($tags as $tag)
                    <li><a href="{{ route( 'tag.list', ['tag'=>$tag->tag] ) }}">{{$tag->tag}}</a></li>
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