<?php

namespace App\Http\Controllers;

use App;
use Storage;
use App\Product;
use App\Tag;
use App\Brand;
use App\Attribute;
use App\AttributeDetail;
use App\ProductAttribute;
use App\ProductImage;
use App\ProductDescription;
use App\ProductInventory;
use App\ProductDiscount;
use App\ProductSeo;
use App\Category;
use App\Cart;
use App\Wishlist;
use App\Country;
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use DB;
use Session;
use DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', '=', 0)->where('country_iso_code',$_SESSION['country_iso_code'])->get();
        $tags = DB::table('tags')->limit(5)->get();
        $maxPrice = Product::where('country_iso_code',$_SESSION['country_iso_code'])->select('price')->max('price');
        $minPrice = Product::where('country_iso_code',$_SESSION['country_iso_code'])->select('price')->min('price');
        return view('products.index',compact(['tags','categories','maxPrice','minPrice']));
    }

    public function listProducts(Request $request)
    {
        if ($request->ajax()) {
            $result=Product::all();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('check', '<input type="checkbox" class="rowSelector" data-id="{{ $id }}">')
                ->addColumn('stock', function($row){
                    if($row->ProductInventory->in_stock){
                        return $txt='<span class="text-success">In stock</span>';
                    }
                    else{
                        return $txt='<span class="text-danger">Out of stock</span>';
                    }
                })
                ->addColumn('status', function($row){
                    $btns = '
                            <div class="custom-control custom-switch custom-switch-off-muted custom-switch-on-success">
                                <input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="customSwitch'.$row->id.'"
                        ';

                    if($row->is_active==1){
                        $btns .= ' checked>';
                    }
                    else{
                        $btns .= '>';
                    }

                    $btns .= '
                                <label class="custom-control-label btn" for="customSwitch'.$row->id.'"></label>
                            </div>
                        ';
                    return $btns;
                })
                ->addColumn('action', function($row){
                    $btn = '
                            <a href="'.route('product.editform',['id'=>$row->id]).'" class="btn btn-sm btn-info m-1">EDIT</a>
                            <a href="'.route('product.remove',['id'=>$row->id]).'" onclick="confirmation(event)" class="btn btn-sm btn-danger m-1">REMOVE</a>
                        ';
                    return $btn;
                })
                ->addColumn('country', function($row){
                    return $txt= $row->country->country_name.' ('.$row->country_iso_code.')' ;
                })
                ->addColumn('newprice', function($row){
                    if($row->ProductDiscount->has_discount){
                        if($row->ProductDiscount->type=='FLAT'){
                            $disc_rate = $row->ProductDiscount->rate;
                        }else{
                            $disc_rate = round(((100 - $row->ProductDiscount->rate) / 100) * $row->price);
                        }
                        return $txt='<del>'.$row->price.'</del>&emsp;'.$disc_rate;
                    }
                    else{
                        return $txt = $row->price;
                    }
                })
                ->rawColumns(['action', 'check','stock', 'status', 'newprice'])
                ->make(true);
        }
        return view('admin.product');
    }

    public function getAttributeDetailsList(Request $request)
    {
        if($request->ajax())
        {
            $attribute_id = json_decode($request->get('attribute_id'));
            //echo json_encode($attribute_id);
            //exit;
            //$attributeDetailsList= AttributeDetail::where('attribute_id','=',1);
            $attributeDetailsList = AttributeDetail::all()->where('attribute_id',$attribute_id);
            if(!empty($attributeDetailsList)){
                $strOpts = "";
                foreach($attributeDetailsList as $row){
                    $strOpts.='<option value="'.$row->id.'">'.$row->name.'</option>';
                }
               $response = array("status"=>200,"data"=>$strOpts);
               echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
               exit;
            }
        }
    }

    public function getProductImageDeleted(Request $request)
    {
        if($request->ajax())
        {
            $productImage_id = json_decode($request->get('productImage_id'));
            //echo json_encode($productImage_id);
            //exit;
            $productImage =ProductImage::where('id',$productImage_id)->delete();
            if(!empty($productImage)){
               $response = array("status"=>200,"msg"=>'success');
               echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
               exit;
            }
        }
    }

    public function getProductAttributeDeleted(Request $request)
    {
        if($request->ajax())
        {
            $attribute_id = json_decode($request->get('attribute_id'));
           // echo json_encode($attribute_id);
            //exit;
            $productAttribute =ProductAttribute::where('id',$attribute_id)->delete();
            if(!empty($productAttribute)){
               $response = array("status"=>200,"msg"=>'success');
               echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
               exit;
            }
        }
    }

    public function filter(Request $request)
    {
        if($request->ajax())
        {
            // $query = json_decode($request->get('query'));
            // $attribute_detail_id = json_decode($request->get('attribute_detail_id'));
            $a= array();
            if(auth()->user()){
                $wl=Wishlist::where('user_id',auth()->user()->id)->get();
                foreach($wl as $w){
                    $a[$w->id]=$w->product_id;
                }
            }
            
            $price = json_decode($request->get('price'));
            $sort = $request->get('sort');
            preg_match_all('!\d+!', $price, $range);
            $minP=(int)$range[0][0];
            $maxP=(int)$range[0][1];
            if(!empty($price))
            { 
                $products = DB::table('products')
                        ->leftJoin('product_discounts', 'products.id', '=', 'product_discounts.product_id')
                        ->leftJoin('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')
                        ->where('products.is_active','=',1)
                        ->where('products.country_iso_code',$_SESSION['country_iso_code'])
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
                        ->where('products.country_iso_code',$_SESSION['country_iso_code'])
                        ->select('products.*', 'product_discounts.has_discount', 'product_discounts.new_price','product_descriptions.short_des')
                        ->get();
            }
            // if(!empty($query))
            // {
            //     $products= $products->where('name','like','%'.$query.'%');
            // }

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
                                                <img src="'.$product->image.'" style="width:100%; height:200px; -o-object-fit:cover; object-fit:cover;" alt="Product Image">
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
                                                        <span class="new-price">₹'.$product->new_price.'</span>';
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
                                                <img src="'.$product->image.'" alt=" Product Image">
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

    public function show(Product $product)
    {
        if($product->is_active && $product->country_iso_code==$_SESSION['country_iso_code']){
            $data['main'] = $product;
            $data['images'] = $product->productImage;
            $data['descr'] = $product->ProductDescription;
            $data['disc'] = $product->ProductDiscount;
            $data['inventory'] = $product->ProductInventory;
            $data['brand'] = $product->Brand;
            $data['wishlist'] = $product->wishlist;
            $data['brands'] = Brand::get();
            return view('products.show', compact ('data', 'product'));
        }
        abort(404);
    }

    public function quickView(Request $request)
    {
        // dd(decrypt($request->id));
        if ($request->ajax()) {
            $response = array();
            $id=decrypt($request->id);
            $result=Product::with('productImage')->findOrFail($id);
            $response['prod'] = $result;
            $response['images'] = $result->productImage;
            $response['descr'] = $result->ProductDescription;
            $response['disc'] = $result->ProductDiscount;
            $response['attr'] = $result->productAttribute;
            $response['inventory'] = $result->ProductInventory;
            $response['brand'] = $result->Brand;

            return $response;
        }
    }

    public function form()
    {
        $cats = new Category;
        $categories=$this->categories_dropdown();
        $tags = Tag::get();
        $brands = Brand::get();
        $countries = Country::get();
        $attributes = Attribute::get(["name","id"]);
        $attribute_details = AttributeDetail::get(["name","attribute_id","id"]);

        return view('admin.addproduct', compact (['categories','tags','brands','countries','attributes','attribute_details']));
    }

    public function create(Request $request)
    {
        // dd($request);
        $this->validate(request(),[
            'name'=>'required|string',
            'price'=>'required|integer',
            'category'=>'required',
            'brand'=>'required',
            'tags'=>'required',
            'max_order_qty'=>'required|integer',
            'image'=>'required|image',
            'country_iso_code'=>'required',
        ]);

        foreach(request('country_iso_code') as $iso){

            $imagepath = $request->image->store('products','public');

            // Save critical details
            $product = new Product();
            $product->name=request('name');
            $product->price=request('price');
            $product->brand_id=request('brand');
            $product->image=$imagepath;
            $product->max_order_qty=request('max_order_qty');
            $product->tags=json_encode(request('tags'));
            $product->url_slug=str_slug(request('name'), '-');
            if($product->url_slug==''){
                $product->url_slug=time();
            }
            $product->country_iso_code=$iso;
            $product->save();

            // Save category product relation
            $dataSet = [];
            foreach (request('category') as $ctgid) {
                $dataSet[] = [
                    'category_id'  => $ctgid,
                    'product_id'    => $product->id,
                    'created_at'       => date('Y-m-d H:i:s'),
                    'updated_at'       => date('Y-m-d H:i:s')
                ];
            }
            DB::table('category_product')->insert($dataSet);

            // Save product discount detail
            $product_discount = new ProductDiscount;
            if(request('has_discount'))
            {
                $product_discount->product_id = $product->id;
                $product_discount->has_discount=1;
                $product_discount->type=request('discount_type');
                $product_discount->rate=request('discount_rate');
                if (request('discount_type')=='FLAT'){
                    $product_discount->new_price=request('discount_rate');
                }
                else{
                    $product_discount->new_price=( (100 - request('discount_rate')) / 100 ) * $product->price ;
                }
            }
            else{
                $product_discount->product_id = $product->id;
                $product_discount->has_discount=0;
                $product_discount->type='';
                $product_discount->rate=$product->price;
                $product_discount->new_price=$product->price;
            }
            $product_discount->save();

            // Save product descr detail
            $product_description = new ProductDescription;
            $product_description->product_id = $product->id;
            $product_description->short_des=request('short_des');
            $product_description->full_des=request('full_des');
            $product_description->save();

            // Save product SEO detail
            $product_seo = new ProductSeo;
            $product_seo->product_id = $product->id;
            if(request('meta_title')==''){
                $product_seo->title =request('name');
            }else{
                $product_seo->title =request('meta_title');
            }
            $product_seo->description=request('meta_descr');
            $product_seo->save();

            // Save product inventory detail
            $product_inventory = new ProductInventory;
            $product_inventory->product_id = $product->id;
            $product_inventory->sku=request('sku');
            $product_inventory->in_stock=request('in_stock');
            $product_inventory->save();

            // Save product attributes detail
            $attribute_ids = $request->input("attribute_id");
            $attribute_detail_ids = $request->input("attribute_detail_id");
            $attribute_prices = $request->input("attribute_detail_price");
            if(!empty($attribute_ids) && !empty($attribute_detail_ids)){
                $aid = null;
                foreach ($attribute_ids as $z){
                    $aid = $z;
                }
                foreach($attribute_detail_ids as $k=>$v){
                    if(!empty($v)){
                        $product_attribute = new ProductAttribute;
                        $product_attribute->product_id = $product->id;
                        $product_attribute->attribute_id=$aid;
                        $product_attribute->attribute_detail_id=$attribute_detail_ids[$k];
                        $product_attribute->attribute_price=$attribute_prices[$k];
                        $product_attribute->save();
                    }
                }
            }

            // Save product additional images
            if($request->hasfile('multi_img'))
            {
            foreach(request('multi_img') as $img)
            {
                $multiimagepath = $img->store('products','public');
                DB::table('product_images')->insert(
                    ['img_src' => $multiimagepath, 'product_id' => $product->id]
                );
            }
            }

            // Additional/New tags are saved in diff table
            foreach(request('tags') as $tag){
                Tag::firstOrCreate(['tag' => $tag]);
            }
        }

        return redirect()->route('admin.product')->with('success','Product added !');
    }

    public function editform($id)
    {
        $product = Product::findOrFail($id);
        $categories=$this->categories_dropdown();
        $tags = Tag::get();
        $brands = Brand::get();
        $attributes = Attribute::get();
        $countries = Country::get();
        $attribute_details = AttributeDetail::get();
        $productImageList = ProductImage::where('product_id',$id);
        // dd($product->productAttribute);
        return view('admin.editproduct',compact('product','categories','countries','tags','brands','attributes','attribute_details'));
    }

    public function edit(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $product->country_iso_code=$request->get('country_iso_code');
        $product->brand_id=$request->get('brand');
        $product->name=$request->get('name');
        $product->price=$request->get('price');
        $product->max_order_qty=$request->get('max_order_qty');
        $product->tags=json_encode($request->get('tags'));
        $product->url_slug=str_slug($request->get('name'), '-');
        if($product->url_slug==''){
            $product->url_slug=time();
        }

        $delimg=explode(',',$request->get('pids'));
        if(!empty($delimg)){
            foreach($delimg as $v){
                $productImage =ProductImage::where('id',$v)->delete();
            }
        }
        
        // Edit category product relation
        DB::table('category_product')->where('product_id', $id)->delete();
        $dataSet = [];
        foreach (request('category') as $ctgid) {
            $dataSet[] = [
                'category_id'  => $ctgid,
                'product_id'    => $id,
                'updated_at'       => date('Y-m-d H:i:s')
            ];
        }
        DB::table('category_product')->insert($dataSet);

        ProductAttribute::where('product_id',$id)->delete();
         $attribute_ids = $request->input("attribute_id");
         $attribute_detail_ids = $request->input("attribute_detail_id");
         $attribute_prices = $request->input("attribute_detail_price");
         if(!empty($attribute_ids) && !empty($attribute_detail_ids)){
             $aid = null;
             foreach ($attribute_ids as $z){
                 $aid = $z;
             }
             foreach($attribute_detail_ids as $k=>$v){
                 if(!empty($v)){
                     $product_attribute = new ProductAttribute;
                     $product_attribute->product_id = $product->id;
                     $product_attribute->attribute_id=$aid;
                     $product_attribute->attribute_detail_id=$attribute_detail_ids[$k];
                     $product_attribute->attribute_price=$attribute_prices[$k];
                     $product_attribute->save();
                 }
             }
         }
  

        if ($request->file('image') == null) {
            $imagepath = $product->image;
            $product->image=$imagepath;
        }else{
            $imagepath = $request->image->store('products','public');
            $product->image=$imagepath;
        }
        $product->update();


        $product_discount = ProductDiscount::where('product_id',$id);
        $d = array();
        $d['product_id']=$id;
        if(request('has_discount'))
        {
            $d['has_discount']=1;
            $d['type']=request('type');
            if(request('rate')){
                $d['rate']=request('rate');
            }else{
                $d['rate']=request('price');
            }
            
            if (request('type')=='FLAT'){
                $d['new_price']=request('rate');
            }else{
                $d['new_price']=ceil(( (100 - request('rate')) / 100 ) * request('price'));
            }
        }
        else{
            $d['has_discount']=0;
            $d['type']='';
            $d['rate']=request('price');
            $d['new_price']=request('price');
        }
        $product_discount->update($d);


        $product_descr = ProductDescription::where('product_id',$id);
        $d = array();
        $d['full_des']=request('full_des');
        $d['short_des']=request('short_des');
        $product_descr->update($d);

        $product_seo = ProductSeo::where('product_id',$id);
        $d = array();
        if(request('meta_title')==''){
            $d['title'] =request('name');
        }else{
            $d['title']=request('meta_title');
        }
        $d['description']=request('meta_descr');
        $product_seo->update($d);

        ProductAttribute::where('product_id',$id)->delete();
        $attribute_ids = $request->input("attribute_id");
        $attribute_detail_ids = $request->input("attribute_detail_id");
        $attribute_prices = $request->input("attribute_detail_price");
        if(!empty($attribute_ids) && !empty($attribute_detail_ids)){
            $aid = null;
            foreach ($attribute_ids as $z){
                $aid = $z;
            }
            foreach($attribute_detail_ids as $k=>$v){
                if(!empty($v)){
                    $product_attribute = new ProductAttribute;
                    $product_attribute->product_id = $id;
                    $product_attribute->attribute_id=$aid;
                    $product_attribute->attribute_detail_id=$attribute_detail_ids[$k];
                    $product_attribute->attribute_price=$attribute_prices[$k];
                    $product_attribute->save();
                }
            }
        }


        $product_inv = ProductInventory::where('product_id',$id);
        $d = array();
        $d['sku']=request('sku');
        $d['in_stock']=request('in_stock');
        $product_inv->update($d);


        if($request->hasfile('multi_img'))
        {
            foreach(request('multi_img') as $img)
            {
                $multiimagepath = $img->store('products','public');
                DB::table('product_images')->insert(
                    ['img_src' => $multiimagepath, 'product_id' => $product->id]
                );
            }
        }


        foreach(request('tags') as $tag){
            Tag::firstOrCreate(['tag' => $tag]);
        }
        return redirect()->route('admin.product')->with('success','Product updated !');
    }

    public function status(Request $request)
    {
        $product = Product::findOrFail(request('id'));
            $product->is_active=request('active');
            $product->save();

        return response()->json(['success'=>'Status updated!']);
    }

    public function bulkStatus(Request $request)
    {
        $ids=json_decode(request('id'),true);
        foreach($ids as $id){
            $product = Product::findOrFail($id);
            $product->is_active=request('active');
            $product->save();
        }
        $request->session()->flash('success', 'Status updated !');
        return response()->json(['success'=>'Status updated!']);
    }

    public function remove($id)
    {
        Product::where('id',$id)->delete();
        DB::table('product_images')->where('product_id', '=', $id)->delete();

        return redirect()->route('admin.product')->with('success','Product removed !');
    }

    public function bulkRemove(Request $request)
    {
        $ids=json_decode(request('id'),true);
        foreach($ids as $id){
            Product::where('id',$id)->delete();
        }

        $request->session()->flash('success', 'Products removed !');
        return response()->json(['success'=>'Product removed !']);
    }



    // FUNCTIONS FOR CATEGORIES DROPDOWN WITH PARENT NAME
	public function categories_dropdown($ciso=null)
    {
        $result = DB::table('categories')
                     ->orderBy('name','DESC');
                     if($ciso){
                        $result=$result->where('country_iso_code',$ciso);
                     }
                     $result=$result->get();
        if(count($result))
        {
			foreach($result as $k=>$row){
				$result[$k]->full_name = substr_replace($this->get_parent_name($row->id),"", -3);

			}
            $result=$result->toArray();
			usort($result, array("App\Http\Controllers\ProductController","cmp"));
			return $result;
        }
        else
        {
            return null;
        }
    }

	public function cmp($a, $b){
		return strcmp($a->full_name, $b->full_name);
	}

	public function get_parent_name($id=0) {
        $query = DB::table('categories')
                    ->where('id', $id)
                    ->first();
                    // dd($query);

		if ($query) {
			return $this->get_parent_name($query->parent_id).$query->name . ' > ';
		}
		else {
			return false;
		}
	}

}
