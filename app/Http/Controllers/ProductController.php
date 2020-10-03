<?php

namespace App\Http\Controllers;

use App;
use Storage;
use App\Product;
use App\Category;
use App\Stock;
use App\Cart;
use Illuminate\Http\Request;
use DB;
use Session;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        $genders = Product::select('gender')->groupBy('gender')->get();
        $brands = Product::select('brand')->groupBy('brand')->get();
        $categories = Product::select('category')->groupBy('category')->get();
        $maxPrice = Product::select('price')->max('price');
        $minPrice = Product::select('price')->min('price');
        return view('products.index',compact(['brands','genders','categories','maxPrice','minPrice','products']));

    }

    public function filter(Request $request)
    {
        if($request->ajax())
        {
            $products= Product::where('quantity','>',0);
            $query = json_decode($request->get('query'));
            $price = json_decode($request->get('price'));
            $gender = json_decode($request->get('gender'));
            $brand = json_decode($request->get('brand'));

            if(!empty($query))
            {
                $products= $products->where('name','like','%'.$query.'%');
            }
            if(!empty($price))
            {
                $products= $products->where('price','<=',$price);
            }
            if(!empty($gender))
            {
                $products= $products->whereIn('gender',$gender);
            }
            if(!empty($brand))
            {
                $products= $products->whereIn('brand',$brand);
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
                                    <div class="info-4"><h5>'.$product->brand.'</h5></div>
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
                'table_data'    =>$output
            );
            echo json_encode($data);

        }
    }

    public function show(Product $product)
    {
        $sizes = Stock::where('product_id','=',$product->id)
                     ->get([
                            'name',
                            'quantity',
                        ]);

        return view('products.show', compact ('product','sizes'));
    }

    public function form()
    {
        $cats = new Category;
        $categories=$this->categories_dropdown();
        // dd($categories);
        return view('admin.addproduct', compact ('categories'));
    }

    public function create(Request $request)
    {
        // dd($request);
        $this->validate(request(),[
            'name'=>'required|string',
            'price'=>'required|integer',
            // 'category_id'=>'required',
            'image'=>'required|image',
            'max_order_qty'=>'required|integer'
        ]);

        $imagepath = $request->image->store('products','public');

        $product = new Product();
        $product->name=request('name');
        $product->price=request('price');
        $product->category_id=json_encode(request('category_id'));
        $product->max_order_qty=request('max_order_qty');
        $product->image=$imagepath;

        if($request->hasfile('multi_img'))
         {
            foreach(request('multi_img') as $img)
            {
                $multiimagepath = $img->store('products','public');
                $images[] = $multiimagepath;
            }
         }

        $product->additional_images=json_encode($images);

        dd($request,$product);

        $product->save();
        return redirect()->route('admin.product')->with('success','Product added !');
    }

    public function editform($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.editproduct',compact('product'));
    }

    public function edit(Request $request,$id)
    {
        $this->validate(request(),[
            'image'=>'',
            'name'=>'required|string',
            'brand'=>'required|in:Nike,Adidas,New Balance,Asics,Puma,Skechers,Fila,Bata,Burberry,Converse',
            'price'=>'required|integer',
            'gender'=>'required|in:Male,Female,Unisex',
            'category'=>'required|in:Shoes',
        ]);
        if(request('image'))
        {
            $imagepath = $request->image->store('products','public');
            $product = Product::findOrFail($id);

            $product->name=request('name');
            $product->brand=request('brand');
            $product->price=request('price');
            $product->gender=request('gender');
            $product->category=request('category');
            $product->image=$imagepath;
            $product->save();
        }
        else
        {
            $product = Product::findOrFail($id);
            $product->name=request('name');
            $product->brand=request('brand');
            $product->price=request('price');
            $product->gender=request('gender');
            $product->category=request('category');
            $product->save();
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
        Stock::where('product_id',$id)->delete();

        return redirect()->route('admin.product')->with('success','Product removed !');
    }

    public function bulkRemove(Request $request)
    {
        $ids=json_decode(request('id'),true);
        foreach($ids as $id){
            Product::where('id',$id)->delete();
            Stock::where('product_id',$id)->delete();
        }

        $request->session()->flash('success', 'Products removed !');
        return response()->json(['success'=>'Product removed !']);
    }

    public function listProducts()
    {
        $products = Product::orderBy('id')->get();
        return view('admin.product', compact ('products'));
    }

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
