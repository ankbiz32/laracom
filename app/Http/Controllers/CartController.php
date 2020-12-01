<?php

namespace App\Http\Controllers;
use App;
use App\Product;
use App\Cart;
use Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id)
    {
        $product = Product::find($id);
        if($product){
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product,$product->id);
            $request->session()->put('cart',$cart);
            return redirect()->route('cart.index');
        }
        else{
            return redirect()->route('cart.index');
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
        return redirect()->route('cart.index');
    }

    public function index()
    {
        dd(Session::get('cart'));
        if(!Session::has('cart')){
            return view('cart.index',['products'=>null]);
        }
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        // dd($products);
        return view('cart.index', compact ('products','totalPrice','totalQuantity'));
    }
}
