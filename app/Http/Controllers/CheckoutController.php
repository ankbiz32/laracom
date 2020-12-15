<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Cart;
use App\Order;
use DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if(!Session::has('cart')){
            return view('cart.index');
        }
        
        $oldCart= Session::get('cart');
        $cart= new Cart($oldCart);
        $products = $cart->items;
        $totalPrice = $cart->totalPrice;
        $totalQuantity= $cart->totalQuantity;
        $user = Auth::user();
        return view('checkout.index', compact ('products','totalPrice','user','totalQuantity'));
    }

    public function checkout(Request $request)
    {
        dd($request);
        $this->validate(request(), [
            'name' => 'required|string',
            'phonenumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8',
            'country' => 'required|string',
            'city' => 'required|string',
            'address' => 'required',
            'zipcode' => 'required|digits:5',
            'creditcardnumber' => 'required|digits:16',
            'expiremonth' => 'required|digits:2',
            'expireyear' => 'required|digits:2',
            'cvc' => 'required|digits:3',
        ]);

        if(!Session::has('cart')){
            return view('cart.index');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $order = new Order();
        $order->amount = $cart->totalPrice;
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        $order->name = $request->input('name');
        $order->phonenumber = $request->input('phonenumber');
        $order->city = $request->input('city');
        $order->country = $request->input('country');
        $order->zipcode = $request->input('zipcode');

        Auth::user()->orders()->save($order);

        Session::forget('cart');
        return redirect()->route('home.index')->with('success','Successfully purchased the products!');
    }
}
