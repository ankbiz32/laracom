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
use Illuminate\Http\Request;
use Validator,Redirect,Response;
use DB;
use Session;
use DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $categories = Category::where('parent_id', '=', 0)->get();
        $brands = Brand::get();
        $tags = DB::table('tags')->get();
        $maxPrice = Product::select('price')->max('price');
        $minPrice = Product::select('price')->min('price');
        return view('products.index',compact(['brands','tags','categories','maxPrice','minPrice','products']));
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
                            <a href="'.route('product.editform',['id'=>$row->id]).'" class="btn btn-info m-1">EDIT</a>
                            <a href="'.route('product.remove',['id'=>$row->id]).'" onclick="confirmation(event)" class="btn btn-danger m-1">REMOVE</a>
                        ';
                    return $btn;
                })
                ->addColumn('newprice', function($row){
                    if($row->ProductDiscount->has_discount){
                        if($row->ProductDiscount->type=='FLAT'){
                            $disc_rate = $row->ProductDiscount->rate;
                        }else{
                            $disc_rate = ((100 - $row->ProductDiscount->rate) / 100) * $row->price;
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
            $products= Product::where('is_active','=',1);
            // $query = json_decode($request->get('query'));
            $price = json_decode($request->get('price'));
            // $brand = json_decode($request->get('brand'));
            // $attribute_detail_id = json_decode($request->get('attribute_detail_id'));
            if(!empty($price))
            {
                $products= $products->where('price','<=',$price);
            }
            // if(!empty($query))
            // {
            //     $products= $products->where('name','like','%'.$query.'%');
            // }
            // if(!empty($brand))
            // {
            //     $products= $products->whereIn('brand_id',$brand);
            // }
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
                                            <a href="single-product.html">
                                                <img src="assets/images/product/medium-size/25.jpg" alt=" Product Image">
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
                                                <img src="assets/images/product/medium-size/25.jpg" alt=" Product Image">
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
                'table_data'  =>$output
            );
            echo json_encode($data);
        }
    }

    public function show(Product $product)
    {
        $data['main'] = $product;
        $data['images'] = $product->productImage;
        $data['descr'] = $product->ProductDescription;
        $data['disc'] = $product->ProductDiscount;
        $data['attr'] = $product->productAttribute;
        $data['inventory'] = $product->ProductInventory;
        $data['brand'] = $product->Brand;
        $data['brands'] = Brand::get();
        return view('products.show', compact ('data'));
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
        $attributes = Attribute::get(["name","id"]);
        $attribute_details = AttributeDetail::get(["name","id"]);

        return view('admin.addproduct', compact (['categories','tags','brands','attributes','attribute_details']));
    }

    public function create(Request $request)
    {
        $this->validate(request(),[
            'name'=>'required|string',
            'price'=>'required|integer',
            'category'=>'required',
            'brand'=>'required',
            'tags'=>'required',
            'max_order_qty'=>'required|integer',
            'image'=>'required|image'
        ]);

        $imagepath = $request->image->store('products','public');

        // Save critical details
        $product = new Product();
        $product->name=request('name');
        $product->price=request('price');
        $product->category_id=json_encode(request('category'));
        $product->brand_id=request('brand');
        $product->image=$imagepath;
        $product->max_order_qty=request('max_order_qty');
        $product->tags=json_encode(request('tags'));
        $product->url_slug=str_slug(request('name'), '-');
        $product->save();

        // Save product discount detail
        $product_discount = new ProductDiscount;
        if(request('has_discount'))
        {
            $product_discount->product_id = $product->id;
            $product_discount->has_discount=1;
            $product_discount->type=request('discount_type');
            $product_discount->rate=request('discount_rate');
        }
        else{
            $product_discount->product_id = $product->id;
            $product_discount->has_discount=0;
            $product_discount->type='';
            $product_discount->rate=$product->price;
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
        if(!empty($attribute_ids)){
            foreach($attribute_ids as $k=>$v){
                if(!empty($v) and !empty($attribute_detail_ids[$k])){
                    $product_attribute = new ProductAttribute;
                    $product_attribute->product_id = $product->id;
                    $product_attribute->attribute_id=$v;
                    $product_attribute->attribute_detail_id=$attribute_detail_ids[$k];
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

        return redirect()->route('admin.product')->with('success','Product added !');
    }

    public function editform($id)
    {

        $product = Product::findOrFail($id);
        $categories=$this->categories_dropdown();
        $tags = Tag::get();
        $brands = Brand::get();
        $attributes = Attribute::get();
        $attribute_details = AttributeDetail::get();
        $productImageList = ProductImage::where('product_id',$id);

        return view('admin.editproduct',compact('product','categories','tags','brands','attributes','attribute_details'));
    }

    public function edit(Request $request,$id)
    {
        $product = Product::findOrFail($id);
        $product->category_id=json_encode($request->get('category'));
        $product->brand_id=$request->get('brand');
        $product->name=$request->get('name');
        $product->price=$request->get('price');
        $product->max_order_qty=$request->get('max_order_qty');
        $product->tags=json_encode($request->get('tags'));
        $product->url_slug=str_slug($request->get('name'), '-');

        $delimg=explode(',',$request->get('pids'));
        if(!empty($delimg)){
            foreach($delimg as $v){
                $productImage =ProductImage::where('id',$v)->delete();
            }
        }


        ProductAttribute::where('product_id',$id)->delete();
        if(!empty($request->get('attr'))){
            for ( $z=0; $z<count($request->get('attr')); $z++){
                $p_attr = new ProductAttribute;
                $p_attr->product_id = $product->id;
                $p_attr->attribute_detail_id = $request->get('attr_detail')[$z];
                $p_attr->attribute_id = $request->get('attr')[$z];
                $p_attr->save();
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
        }
        else{
            $d['has_discount']=0;
            $d['type']='';
            $d['rate']=request('price');
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

        $product_inv = ProductInventory::where('product_id',$id);
        $d = array();
        $d['sku']=request('sku');
        $d['in_stock']=request('in_stock');
        $product_inv->update($d);


        if(!empty($request->get('Attribute'))){
            foreach($request->get('Attribute') as $k){
                $did = $k['attri_id'];
                if(!empty($did)){
                    $product_attribute = ProductAttribute::find($did);
                    $product_attribute->product_id=$id;
                    $product_attribute->attribute_id=$k['attribute_id'];
                    $product_attribute->attribute_detail_id=$k['attribute_detail_id'];
                    $product_attribute->update();
                }
                else{
                    $product_attribute = new ProductAttribute;
                    $product_attribute->product_id=$product->id;
                    $product_attribute->attribute_id=$k['attribute_id'];
                    $product_attribute->attribute_detail_id=$k['attribute_detail_id'];
                    $product_attribute->save();
                }
            }
        }


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
	public function categories_dropdown()
    {
        $result = DB::table('categories')
                     ->orderBy('name','DESC')
                     ->get();
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
