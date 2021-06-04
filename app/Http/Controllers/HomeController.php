<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Wishlist;
use App\Country;
use App\Enquiry;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::where('parent_id', '=', 0)->where('country_iso_code',$_SESSION['country_iso_code'])->get();
        $products = Product::where('is_active',1)->where('country_iso_code',$_SESSION['country_iso_code'])->orderBy('id', 'DESC')->get();
        return view('home.index',compact('products','categories'));
    }

    public function about()
    {
        return view('home.about-us');
    }

    public function contact()
    {
        return view('home.contact');
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
            $price = json_decode($request->get('price'));
            preg_match_all('!\d+!', $price, $range);
            $sort = $request->get('sort');
            $minP=(int)$range[0][0];
            $maxP=(int)$range[0][1];
            $wl=Wishlist::where('user_id',auth()->user()->id)->get();
            $a=array();
            foreach($wl as $w){
                $a[$w->id]=$w->product_id;
            }
            if(!empty($price))
            {
                $products = DB::table('products')
                            ->leftJoin('product_discounts', 'products.id', '=', 'product_discounts.product_id')
                            ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                            ->where('products.is_active','=',1)
                            ->where('products.tags','LIKE','%'.$t.'%')
                            ->whereBetween('product_discounts.new_price', [$minP, $maxP])
                            ->select('products.*', 'product_discounts.has_discount', 'product_discounts.new_price','product_descriptions.short_des');
                            if($sort=='plth'){
                                $products=$products->orderBy('product_discounts.new_price','ASC');
                            }
                            elseif($sort=='phtl'){
                                $products=$products->orderBy('product_discounts.new_price','DESC');
                            }
                $products=$products->get();
            }
            else{
                $products = DB::table('products')
                            ->leftJoin('product_discounts', 'products.id', '=', 'product_discounts.product_id')
                            ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                            ->where('products.is_active','=',1)
                            ->where('products.tags','LIKE','%'.$t.'%')
                            ->select('products.*', 'product_discounts.has_discount', 'product_discounts.new_price','product_descriptions.short_des')
                            ->get();
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
                                                <ul>';
                                                if(in_array($product->id,$a)) {
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/remove/'.array_keys($a,$product->id)[0].'" data-toggle="tooltip" data-placement="top" title="Wishlisted"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                                                else{
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/add/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                        $output .='
                                                    <li><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'" data-toggle="tooltip" data-placement="top" title="View product"><i class="icon-eye"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content bg-snow">
                                            <div class="product-desc_info">
                                            <h3 class="product-name"><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'">'.$product->name .'</a></h3>
                                                <div class="price-box">';
                                            if($product->has_discount) {
                                                $output .='
                                                        <span class="old-price">₹'.$product->price .'</span>
                                                        <span class="new-price">₹'.$product->new_price .'</span>';
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
                                                
                                            if($product->has_discount) {
                                                $output .='
                                                        <span class="old-price">₹'.$product->price .'</span>
                                                        <span class="new-price">₹'.$product->new_price .'</span>';
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
                                                    <p>'.$product->short_des.'</p>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>';
                                                if(in_array($product->id,$a)) {
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/remove/'.array_keys($a,$product->id)[0].'" data-toggle="tooltip" data-placement="top" title="Wishlisted"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                                                else{
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/add/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                        $output .='
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
        $categories = Category::where('parent_id', '=', 0)->where('country_iso_code', $_SESSION['country_iso_code'])->get();
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
            $sort = $request->get('sort');
            $minP=(int)$range[0][0];
            $maxP=(int)$range[0][1];
            $wl=Wishlist::where('user_id',auth()->user()->id)->get();
            $a=array();
            foreach($wl as $w){
                $a[$w->id]=$w->product_id;
            }
            if(!empty($price))
            { 
                $categ = Category::findOrFail($request->get('cid'));
                $products = DB::table('products')
                            ->leftJoin('product_discounts', 'products.id', '=', 'product_discounts.product_id')
                            ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                            ->leftJoin('category_product', 'products.id', '=', 'category_product.product_id')
                            ->where('category_product.category_id','=',$request->get('cid'))
                            ->where('products.is_active','=',1)
                            ->whereBetween('product_discounts.new_price', [$minP, $maxP])
                            ->select('products.*', 'product_discounts.has_discount', 'product_discounts.new_price','product_descriptions.short_des');
                            if($sort=='plth'){
                                $products=$products->orderBy('product_discounts.new_price','ASC');
                            }
                            elseif($sort=='phtl'){
                                $products=$products->orderBy('product_discounts.new_price','DESC');
                            }
                $products=$products->get();
                
            }
            else{
                $categ = Category::findOrFail($request->get('cid'));
                $products = DB::table('products')
                            ->leftJoin('product_discounts', 'products.id', '=', 'product_discounts.product_id')
                            ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                            ->leftJoin('category_product', 'products.id', '=', 'category_product.product_id')
                            ->where('category_product.category_id','=',$request->get('cid'))
                            ->where('products.is_active','=',1)
                            ->select('products.*', 'product_discounts.has_discount', 'product_discounts.new_price','product_descriptions.short_des')
                            ->get();
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
                                                <ul>';
                                                if(in_array($product->id,$a)) {
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/remove/'.array_keys($a,$product->id)[0].'" data-toggle="tooltip" data-placement="top" title="Wishlisted"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                                                else{
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/add/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                        $output .='
                                                    <li><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'" data-toggle="tooltip" data-placement="top" title="View product"><i class="icon-eye"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product-content bg-snow">
                                            <div class="product-desc_info">
                                            <h3 class="product-name"><a href="'. route('product.show',['product'=>$product->id,'slug'=>$product->url_slug]) .'">'.$product->name .'</a></h3>
                                                <div class="price-box">';
                                            if($product->has_discount) {
                                                $output .='
                                                        <span class="old-price">₹'.$product->price .'</span>
                                                        <span class="new-price">₹'.$product->new_price .'</span>';
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
                                                
                                            if($product->has_discount) {
                                                $output .='
                                                        <span class="old-price">₹'.$product->price .'</span>
                                                        <span class="new-price">₹'.$product->new_price .'</span>';
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
                                                    <p>'.$product->short_des.'</p>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul>';
                                                if(in_array($product->id,$a)) {
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/remove/'.array_keys($a,$product->id)[0].'" data-toggle="tooltip" data-placement="top" title="Wishlisted"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                                                else{
                                                    $output .='
                                                        <li><a href="'.URL('/').'/wishlist/add/'.$product->id.'" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="icon-heart"></i></a>
                                                        </li>';
                                                }
                        $output .='
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

    
    public function contactSubmit(Request $request)
    {
        $this->validate(request(),[
            'con_name'=>'required|string|max:50',
            'con_email'=>'required|email|max:50',
            'con_subject'=>'max:120',
            'con_message'=>'max:300'
        ]);
        $enq = new Enquiry();
        $enq->name=request('con_name');
        $enq->email=request('con_email');
        $enq->subject=request('con_subject');
        $enq->message=substr(trim(strip_tags(request('con_message'))),0,300);
        
        $enq->save();
        return redirect()->route('home.contact')->with('success','Thank you for contacting us. Our team will get in touch with you soon.');
    }

}
