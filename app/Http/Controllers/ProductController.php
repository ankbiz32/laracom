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
        $brands = Brand::get();
        $categories = Category::select('name')->groupBy('name')->get();
        $maxPrice = Product::select('price')->max('price');
        $minPrice = Product::select('price')->min('price');
        return view('products.index',compact(['brands','categories','maxPrice','minPrice','products']));
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
            $query = json_decode($request->get('query'));
            $price = json_decode($request->get('price'));
            $brand = json_decode($request->get('brand'));
            $attribute_detail_id = json_decode($request->get('attribute_detail_id'));

            if(!empty($query))
            {
                $products= $products->where('name','like','%'.$query.'%');
            }
            if(!empty($price))
            {
                $products= $products->where('price','<=',$price);
            }
            if(!empty($brand))
            {
                $products= $products->whereIn('brand_id',$brand);
            }
            $products=$products->get();

            $total_row = $products->count();
            if($total_row>0)
            {
                $output ='';
                foreach($products as $product)
                {
                    $output .='
                    <div class="col-lg-4 col-md-6 col-sm-12 pt-3">
                        <div class="card">
                            <a href="product/'.$product->id.'">
                                <div class="card-body ">
                                    <div class="product-info">

                                    <div class="info-1"><img src="'.asset($product->image).'" alt=""></div>
                                    <div class="info-4"><h5>'.$product->brand_id.'</h5></div>
                                    <div class="info-2"><h4>'.$product->name.'</h4></div>
                                    <div class="info-3"><h5>RM '.$product->price.'</h5></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    ';
                }
            }
            else
            {
                $output='
                <div class="col-lg-4 col-md-6 col-sm-6 pt-3">
                    <h4>No Data Found</h4>
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
        return view('products.show', compact ('product'));
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

        $product = new Product();
        $product->name=request('name');
        $product->price=request('price');
        $product->category_id=json_encode(request('category'));
        $product->brand_id=request('brand');
        $product->image=$imagepath;
        $product->max_order_qty=request('max_order_qty');
        $product->tags=json_encode(request('tags'));
        $product->url_slug=str_slug(request('name'), '-');
        $product->short_descr=request('short_descr');
        $product->full_descr=request('full_descr');
        $product->meta_title=request('meta_title');
        $product->meta_descr=request('meta_descr');
        $product->sku=request('sku');
        $product->in_stock=request('in_stock');

        if(request('has_discount'))
        {
            $product->has_discount=1;
            $product->discount_type=request('discount_type');
            $product->discount_rate=request('discount_rate');
        }
        else{
            $product->has_discount=0;
            $product->discount_type='';
        }

        $product->save();

        $attribute_ids = $request->input("attribute_id");					
        $attribute_detail_ids = $request->input("attribute_detail_id");
        //echo "<pre>";
        //print_r($attribute_ids);
        //print_r($attribute_detail_ids);
        //exit; 
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


        // Additional images are uploaded & saved in diff table
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


        // Additional tags are saved in diff table
        foreach(request('tags') as $tag){
            Tag::firstOrCreate(['tag' => $tag]);
        }


        return redirect()->route('admin.product')->with('success','Product added !');
    }

    public function editform($id)
    {
        
        $product = Product::with('productImage','productAttribute')->findOrFail($id);
        //echo '<pre>';
        //print_r($product->toArray());
        //exit;
        $categories=$this->categories_dropdown();
        $tags = Tag::get();
        $brands = Brand::get();
        $attributes = Attribute::get();
        $attribute_details = AttributeDetail::get();

        return view('admin.editproduct',compact('product','categories','tags','brands','attributes','attribute_details'));
    }

    public function edit(Request $request,$id)
    {
        //$imagepath = $request->image->store('products','public');
        $product = Product::findOrFail($id);
        $product->category_id=json_encode($request->get('category'));
        $product->brand_id=$request->get('brand');
        $product->name=$request->get('name');
        $product->price=$request->get('price');
        //$imagepath = $request->get('image');
        //$product->image=$imagepath;
        $product->sku=$request->get('sku');
        $product->in_stock=$request->get('in_stock');
        //$product->has_discount=$request->get('has_discount');
        $product->discount_type=$request->get('discount_type');
        $product->discount_rate=$request->get('discount_rate');
        $product->max_order_qty=$request->get('max_order_qty');
        $product->tags=json_encode($request->get('tags'));
        $product->url_slug=str_slug($request->get('name'), '-');
        $product->short_descr=$request->get('short_descr');
        $product->full_descr=$request->get('full_descr');
        $product->meta_title=$request->get('meta_title');
        $product->meta_descr=$request->get('meta_descr');

        if(request('has_discount'))
        {
            $product->has_discount=1;
            $product->discount_type=request('discount_type');
            $product->discount_rate=request('discount_rate');
        }
        else{
            $product->has_discount=0;
            $product->discount_type='';
        }

        if ($request->file('image') == null) {
            $imagepath = $product->image;
            $product->image=$imagepath;
        }else{
            $imagepath = $request->image->store('products','public');
            $product->image=$imagepath;  
        }

        $product->update();

        foreach($request->get('Attribute') as $k){
            //print_r($k);
           // exit;
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
                $product_attribute->product_id=$id;
                $product_attribute->attribute_id=$k['attribute_id'];
                $product_attribute->attribute_detail_id=$k['attribute_detail_id'];
                $product_attribute->save();
            }
        }

        // Additional images are uploaded & saved in diff table
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

        // Additional tags are saved in diff table
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

    public function listProducts()
    {
        $products = Product::orderBy('id')->get();
        return view('admin.product', compact ('products'));
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
