<?php

namespace App\Http\Controllers;

use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Cart;
use App\Order;
use App\Profile;
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
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $order = $api->order->create(array(
            'amount' => $cart->totalPrice * 100,
            'currency' => 'INR'
            // 'currency' => $_SESSION['currency_code']
            ));
        $oid=$order['id'];
        $user = Auth::user();
        return view('checkout.index', compact ('products','totalPrice','user','totalQuantity','oid'));
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
            $user->password = Hash::make($request->input('new_password'));
            $user->role = 'Customer';
            $user->is_active = 1;
            $user->save();
            $uid=$user->id;

            $profile = new Profile();
            $profile->user_id = $uid;
            $profile->phonenumber = $request->input('phone');
            $profile->address = $request->input('address');
            $profile->zipcode = $request->input('zipcode');
            $profile->save();
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
        $order->note = $request->input('note');
        $order->is_paid = 1;
        $order->ship_to_different_address = 0;
        if($request->input('different_shipping')){
            $order->ship_to_different_address = 1;
            $order->ship_phone = $request->input('dphone');
            $order->ship_zipcode = $request->input('dzipcode');
            $order->ship_address = $request->input('daddress');
            $order->ship_country = $request->input('dcountry');
        }
        $order->save();

        foreach($cart->items as $item){
            $order_det = new Order_details();
            $order_det->order_id = $order->id;
            $order_det->product_id = $item['product_id'];
            $order_det->qty = $item['quantity'];
            $order_det->price = $item['price'];
            $order_det->save();
        }

        $info['order_no']=$order->id;
        $info['name']=$order->name;
        $info['amount']=$order->amount;
        $info['pay_mode']='Pay on delivery';
        $info['pay_ref']='';
        $info['items']=$cart->items;
        $info['address']=$order->address;
        $info['country']=$order->country;
        $info['zipcode']=$order->zipcode;
        if($request->input('different_shipping')){
            $info['address']=$order->ship_address;
            $info['country']=$order->ship_country;
            $info['zipcode']=$order->ship_zipcode;
        }

        Session::forget('cart');
        return view('checkout.success',compact(['info']));
        // return redirect()->route('home.index')->with('success','Successfully purchased the products !');
    }

    public function hdfcCheckout(Request $request)
    {
        dd($request);

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
            $user->password = Hash::make($request->input('new_password'));
            $user->role = 'Customer';
            $user->is_active = 1;
            $user->save();
            $uid=$user->id;

            $profile = new Profile();
            $profile->user_id = $uid;
            $profile->phonenumber = $request->input('phone');
            $profile->address = $request->input('address');
            $profile->zipcode = $request->input('zipcode');
            $profile->save();
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
        $order->note = $request->input('note');
        $order->is_paid = 1;
        $order->ship_to_different_address = 0;
        if($request->input('different_shipping')){
            $order->ship_to_different_address = 1;
            $order->ship_phone = $request->input('dphone');
            $order->ship_zipcode = $request->input('dzipcode');
            $order->ship_address = $request->input('daddress');
            $order->ship_country = $request->input('dcountry');
        }
        $order->save();

        foreach($cart->items as $item){
            $order_det = new Order_details();
            $order_det->order_id = $order->id;
            $order_det->product_id = $item['product_id'];
            $order_det->qty = $item['quantity'];
            $order_det->price = $item['price'];
            $order_det->save();
        }

        $info['order_no']=$order->id;
        $info['name']=$order->name;
        $info['amount']=$order->amount;
        $info['pay_mode']='Pay on delivery';
        $info['pay_ref']='';
        $info['items']=$cart->items;
        $info['address']=$order->address;
        $info['country']=$order->country;
        $info['zipcode']=$order->zipcode;
        if($request->input('different_shipping')){
            $info['address']=$order->ship_address;
            $info['country']=$order->ship_country;
            $info['zipcode']=$order->ship_zipcode;
        }

        Session::forget('cart');
        return view('checkout.success',compact(['info']));
        // return redirect()->route('home.index')->with('success','Successfully purchased the products !');
    }
}
