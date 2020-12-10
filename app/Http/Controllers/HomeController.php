<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $categories = Category::where('parent_id', '=', 0)->get();
        // dd(geoip($request->ip())); //For dynamic ip address
        // dd(geoip('178.18.25.0')); //For static ip address
        // dd($products = Product::where('country_iso_code',geoip($request->ip())->iso_code)->take(4)->get());
        $products = Product::where('is_active',1)->orderBy('id', 'DESC')->get();
        return view('home.index',compact('products'));

    }

    public function tag($tag)
    {
        $categories = Category::where('parent_id', '=', 0)->get();
        $tags = DB::table('tags')->get();
        $tagName = $tag;
        $maxPrice = Product::select('price')->max('price');
        $minPrice = Product::select('price')->min('price');
        return view('tags.index',compact(['tags','tagName','categories','maxPrice','minPrice']));
    }

    public function filter(Request $request)
    {
        $t=$request->get('tag');
        if($request->ajax())
        {
            $products= Product::where('is_active','=',1)->where('tags','LIKE','%'.$t.'%');
            $price = json_decode($request->get('price'));
            preg_match_all('!\d+!', $price, $range);
            $minP=$range[0][0];
            $maxP=$range[0][1];
            if(!empty($price))
            {
                $products= $products->whereBetween('price', [$minP, $maxP]);
            }
            $products=$products->get();

            $total_row = $products->count();
            if($total_row>0)
            {
                $output ='';
                foreach($products as $product)
                {
                    $output .='
                            <div class="col-12">
                                <div class="product-item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="'.route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]).'">
                                                <img src="'.URL('/').'/'.$product->image.'" style="width:100%; height:200px; -o-object-fit:cover; object-fit:cover;" alt="Product Image">
                                            </a>
                                            <div class="add-actions">
                                                <ul>
                                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                    </li>

                                                    <li><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'" data-toggle="tooltip" data-placement="top" title="View product"><i class="icon-eye"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content bg-snow">
                                            <div class="product-desc_info">
                                            <h3 class="product-name"><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'">'.$product->name .'</a></h3>
                                                <div class="price-box">';
                                            if($product->ProductDiscount->has_discount) {
                                                if($product->ProductDiscount->type == 'FLAT') {
                                                    $output .='
                                                            <span class="old-price">₹'.$product->price .'</span>
                                                            <span class="new-price">₹'.$product->ProductDiscount->rate .'</span>';
                                                }
                                                else{
                                                     $output .='    
                                                        <span class="old-price">₹'.$product->price .'</span>          
                                                        <span class="new-price">₹'. ( (100 - $product->ProductDiscount->rate) / 100) * $product->price .'</span>';
                                                }
                                            }
                                            else{
                     $output .='
                                                
                                                    <span class="new-price ml-0">₹'.$product->price.'</span>';

                                            }
                    $output .='
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
                                            <a href="'.route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]).'">
                                                <img src="'.URL('/').'/'.$product->image.'" alt=" Product Image">
                                            </a>
                                        </div>
                                        <div class="quicky-product-content">
                                            <div class="product-desc_info">
                                                <h6 class="product-name"><a href="'.route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]).'">'.$product->name .'</a>
                                                </h6>
                                                <div class="price-box">';
                                                
                                            if($product->ProductDiscount->has_discount) {
                                                if($product->ProductDiscount->type == 'FLAT') {
                                                    $output .='
                                                            <span class="old-price">₹'.$product->price .'</span>
                                                            <span class="new-price">₹'.$product->ProductDiscount->rate .'</span>';
                                                }
                                                else{
                                                     $output .='    
                                                        <span class="old-price">₹'.$product->price .'</span>          
                                                        <span class="new-price">₹'. ( (100 - $product->ProductDiscount->rate) / 100) * $product->price .'</span>';
                                                }
                                            }
                                            else{
                     $output .='
                                                
                                                    <span class="new-price ml-0">₹'.$product->price.'</span>';

                                            }
                                            
                     $output .='
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
                                                    <p>'.$product->ProductDescription->short_des.'</p>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                    </li>

                                                    <li><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'" data-toggle="tooltip" data-placement="top" title="View product"><i class="icon-eye"></i></a>
                                                    </li>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    ';
                }
            }
            else
            {
                $output='
                    <div class="col-12">
                        <h5>No products found.</h5>
                    </div>
                ';
            }
            $data = array(
                'table_data'  =>$output,
                'total_row'  =>$total_row
            );
            echo json_encode($data);
        }
    }
 

    public function category($category_id, $slug)
    {
        $cats = Category::findOrFail($category_id);
        $categories = Category::where('parent_id', '=', 0)->get();
        $tags = DB::table('tags')->get();
        $cid = $category_id;
        $maxPrice = Product::select('price')->max('price');
        $minPrice = Product::select('price')->min('price');
        return view('categories.index',compact(['tags','cid','categories','maxPrice','minPrice']));
    }

    public function categoryFilter(Request $request)
    {
        if($request->ajax())
        {
            
            $price = json_decode($request->get('price'));
            preg_match_all('!\d+!', $price, $range);
            $minP=$range[0][0];
            $maxP=$range[0][1];
            if(!empty($price))
            { 
                $products = Category::findOrFail($request->get('cid'))->products->whereBetween('price', [$minP, $maxP]);
            }
            else{
                $category = Category::findOrFail($request->get('cid'));
                $products= $category->products;
            }

            $total_row = $products->count();
            if($total_row>0)
            {
                $output ='';
                foreach($products as $product)
                {
                    $output .='
                            <div class="col-12">
                                <div class="product-item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="'.route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]).'">
                                                <img src="'.URL('/').'/'.$product->image.'" style="width:100%; height:200px; -o-object-fit:cover; object-fit:cover;" alt="Product Image">
                                            </a>
                                            <div class="add-actions">
                                                <ul>
                                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                    </li>

                                                    <li><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'" data-toggle="tooltip" data-placement="top" title="View product"><i class="icon-eye"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content bg-snow">
                                            <div class="product-desc_info">
                                            <h3 class="product-name"><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'">'.$product->name .'</a></h3>
                                                <div class="price-box">';
                                            if($product->ProductDiscount->has_discount) {
                                                if($product->ProductDiscount->type == 'FLAT') {
                                                    $output .='
                                                            <span class="old-price">₹'.$product->price .'</span>
                                                            <span class="new-price">₹'.$product->ProductDiscount->rate .'</span>';
                                                }
                                                else{
                                                     $output .='    
                                                        <span class="old-price">₹'.$product->price .'</span>          
                                                        <span class="new-price">₹'. ( (100 - $product->ProductDiscount->rate) / 100) * $product->price .'</span>';
                                                }
                                            }
                                            else{
                     $output .='
                                                
                                                    <span class="new-price ml-0">₹'.$product->price.'</span>';

                                            }
                    $output .='
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
                                            <a href="'.route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]).'">
                                                <img src="'.URL('/').'/'.$product->image.'" alt=" Product Image">
                                            </a>
                                        </div>
                                        <div class="quicky-product-content">
                                            <div class="product-desc_info">
                                                <h6 class="product-name"><a href="'.route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]).'">'.$product->name .'</a>
                                                </h6>
                                                <div class="price-box">';
                                                
                                            if($product->ProductDiscount->has_discount) {
                                                if($product->ProductDiscount->type == 'FLAT') {
                                                    $output .='
                                                            <span class="old-price">₹'.$product->price .'</span>
                                                            <span class="new-price">₹'.$product->ProductDiscount->rate .'</span>';
                                                }
                                                else{
                                                     $output .='    
                                                        <span class="old-price">₹'.$product->price .'</span>          
                                                        <span class="new-price">₹'. ( (100 - $product->ProductDiscount->rate) / 100) * $product->price .'</span>';
                                                }
                                            }
                                            else{
                     $output .='
                                                
                                                    <span class="new-price ml-0">₹'.$product->price.'</span>';

                                            }
                                            
                     $output .='
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
                                                    <p>'.$product->ProductDescription->short_des.'</p>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li><a href="#" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                    </li>

                                                    <li><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'" data-toggle="tooltip" data-placement="top" title="View product"><i class="icon-eye"></i></a>
                                                    </li>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    ';
                }
            }
            else
            {
                $output='
                    <div class="col-12">
                        <h5>No products found.</h5>
                    </div>
                ';
            }
            $data = array(
                'table_data'  =>$output,
                'total_row'  =>$total_row
            );
            echo json_encode($data);
        }
    }

}
