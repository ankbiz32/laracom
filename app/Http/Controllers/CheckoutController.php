<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Cart;
use App\Order;
use App\Order_details;
use App\User;
use Illuminate\Support\Facades\Hash;
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
        // dd($request);

        if(!Session::has('cart')){
            return view('cart.index');
        }

        if(Auth::user()){
            $this->validate(request(), [
                'name' => 'required|string',
                'phone' => 'required',
                'email' => 'required|string',
                'zipcode' => 'required',
                'country' => 'required|string',
                'address' => 'required'
            ]);
            $uid=Auth::user()->id;
        }
        else{
            $this->validate(request(), [
                'name' => 'required|string',
                'phone' => 'required',
                'email' => 'required|string',
                'zipcode' => 'required',
                'country' => 'required|string',
                'address' => 'required',
                'new_password' => 'required',
            ]);
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->role = 'Customer';
            $user->is_active = 1;
            $user->save();
            $uid=$user->id;
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $order = new Order();
        $order->user_id = $uid;
        $order->amount = $cart->totalPrice;
        $order->name = $request->input('name');
        $order->phone = $request->input('phone');
        $order->email = $request->input('email');
        $order->zipcode = $request->input('zipcode');
        $order->address = $request->input('address');
        $order->country = $request->input('country');
        $order->payment_type = 'COD';
        $order->is_paid = 1;

        $order->save();

        foreach($cart->items as $item){
            $order_det = new Order_details();
            $order_det->order_id = $order->id;
            $order_det->product_id = $item['product_id'];
            $order_det->qty = $item['quantity'];
            $order_det->price = $item['price'];
            $order_det->save();
        }

        // Session::forget('cart');
        return redirect()->route('home.index')->with('success','Successfully purchased the products!');
    }
}
