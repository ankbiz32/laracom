<?php

namespace App\Http\Controllers;
use App;
use App\Product;
use App\Cart;
use Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        if(!Session::has('cart')){
            return view('cart.index',['products'=>null]);
        }
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        return view('cart.index', compact ('products','totalPrice','totalQuantity'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if($product && $product->is_active && $product->ProductInventory->in_stock){
            
            if(isset($_GET['attr'])){
                if(!$product->productAttribute->pluck('attribute_detail_id')->contains($_GET['attr'])){
                    return redirect()->back()->with('info','Product variant not found.');
                }
            }

            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            if($oldCart){
                $filteredArray =  array_filter($oldCart->items, function($e) use($id){
                                    return isset($e['product_id']) && $e['product_id'] == $id;
                                });
                if($filteredArray){
                    $qt = 0;
                    foreach($filteredArray as $fa){
                        $qt+=$fa['quantity'];
                    }
                    if($qt < $product->max_order_qty){
                        $cart = new Cart($oldCart);
                        $cart->add($product,$product->id);
                        $request->session()->put('cart',$cart);
                        return redirect()->back()->with('cart_updated','Your cart has some changes');
                    }
                    else{
                        return redirect()->back()->with('info','Max. order limit reached for this product.');
                    }
                }
                else{
                    $cart = new Cart($oldCart);
                    $cart->add($product,$product->id);
                    $request->session()->put('cart',$cart);
                    return redirect()->back()->with('cart_updated','Your cart has some changes');
                }
            }
            else{
                $cart = new Cart($oldCart);
                $cart->add($product,$product->id);
                $request->session()->put('cart',$cart);
                return redirect()->back()->with('cart_updated','Your cart has some changes');
            }
        }
        else{
            return redirect()->back()->with('info','Product not found.');
        }
    }

    public function update(Request $request)
    {
        if($request->ajax())
        {
            if(Session::has('cart')){
                $id=decrypt($request->id);
                $oldCart = Session::get('cart');
                $product = Product::find($id);
                if($request->variant){
                    $filteredArray =  array_filter($oldCart->items, function($e) use($id){
                        return isset($e['product_id']) && $e['product_id'] == $id;
                    });
                    if($filteredArray){
                        $qt = 0;
                        foreach($filteredArray as $fa){
                            if($fa['product_variant'] != $request->variant){
                                $qt+=$fa['quantity'];
                            }
                        }
                        $total_qt = $qt + $request->qty;
                        if($total_qt <= $product->max_order_qty){
                            $cart = new Cart($oldCart);
                            $done = $cart->update_variant($id, $request->qty, $request->variant);
                            if($done){
                                $request->session()->put('cart',$cart);
                                return json_encode(['status'=>'200']);
                            }
                            else{
                                return json_encode(['status'=>'<strong>Some error occured.</strong> <br> Please refresh the page and try again.']);
                            }
                        }
                        else{
                            return json_encode(['status'=>'Max. order limit reached for this product']);
                        }
                    }
                }
                else{
                    if($request->qty <= $product->max_order_qty){
                        $cart = new Cart($oldCart);
                        $done = $cart->update($id, $request->qty);
                        if($done){
                            $request->session()->put('cart',$cart);
                            return json_encode(['status'=>'200']);
                        }
                        else{
                            return json_encode(['status'=>'<strong>Some error occured.</strong> <br> Please refresh the page and try again.']);
                        }
                    }
                    else{
                        return json_encode(['status'=>'Max. order limit reached for this product']);
                    }
                }
            }
            else{
                return json_encode(['status'=>'404']);
            }
        }
        else{
            return json_encode(['status'=>'403']);
        }
    }

    public function remove($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);
        Session::put('cart',$cart);
        if($cart->totalQuantity<=0){
            Session::forget('cart');
        }
        return redirect()->back()->with('success','Product removed from your cart.');
    }

}
