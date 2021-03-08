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
        $workingKey=env('CCAV_WORKING_KEY');
        $encResponse=$request->encResp;
        $rcvdString=$this->decrypt1($encResponse,$workingKey);
        $order_status="";
        $decryptValues=explode('&', $rcvdString);
        $info=array();
        for($i = 0; $i < count($decryptValues); $i++) 
        {
            $information=explode('=',$decryptValues[$i]);
            $info[$information[0]]=$information[1];
            if($i==3){$order_status=$information[1];}
        }

        dd($info);

        if($info['order_status']=='Success'){

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
            $order->payment_type = 'ONLINE';
            $order->payment_id = $info['tracking_id'];
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
    
            $payment = new Payment();
            $payment->order_id =$order->id;
            $payment->vendor ='HDFC';
            $payment->payment_amount =$cart->totalPrice;
            $payment->status ='success';
            $payment->currency ='INR';
            $payment->hdfc_tracking_id =$info['tracking_id'];
            $payment->bank_ref_no =$info['bank_ref_no'];
            $payment->hdfc_pay_mode =$info['payment_mode'];
            $payment->vendor_errors ='';
            $payment->save();
    
            $info['order_no']=$order->id;
            $info['name']=$order->name;
            $info['amount']=$order->amount;
            $info['pay_mode']='Paid online with HDFC';
            $info['pay_ref']=$info['tracking_id'];
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
        }
        else{
            dd($info);
        }
        
        
    }


    
	function decrypt1($encryptedText,$key)
	{
		$key = $this->hextobin1(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText = $this->hextobin1($encryptedText);
		$decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
		return $decryptedText;
	}

	function hextobin1($hexString) 
		{ 
		$length = strlen($hexString); 
		$binString="";   
		$count=0; 
		while($count<$length) 
		{       
			$subString =substr($hexString,$count,2);           
			$packedString = pack("H*",$subString); 
			if ($count==0)
			{
				$binString=$packedString;
			} 
			
			else 
			{
				$binString.=$packedString;
			} 
			
			$count+=2; 
		} 
		return $binString; 
	} 


}
