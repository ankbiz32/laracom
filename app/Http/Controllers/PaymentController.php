<?php
    namespace App\Http\Controllers;
    use Razorpay\Api\Api;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use App\Payment;
    use App\Cart;
    use App\Order;
    use App\Profile;
    use App\Order_details;
    use App\User;
    use Redirect,Response,Session,Auth,DB;
 class PaymentController extends Controller
 {

    public function paysuccess(Request $request){
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
        $order->payment_id = $request->input('rpid');
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
        $payment->payment_amount =$cart->totalPrice;
        $payment->vendor_payment_id =$request->input('rpid');
        $payment->vendor_order_id =$request->input('roid');
        $payment->vendor_signature =$request->input('rs');
        $payment->vendor_errors ='';
        $payment->save();

        Session::forget('cart');

        $info['order_no']=$order->id;
        $info['name']=$order->name;
        $info['amount']=$order->amount;
        $info['pay_mode']='ONLINE';
        $info['pay_ref']=$request->input('rpid');
        $info['items']=$cart->items;
        $info['address']=$order->address;
        $info['country']=$order->country;
        $info['zipcode']=$order->zipcode;
        if($request->input('different_shipping')){
            $info['address']=$order->ship_address;
            $info['country']=$order->ship_country;
            $info['zipcode']=$order->ship_zipcode;
        }
        session(['order_success_details'=>$info]);
        $arr = array('msg' => 'Payment successfully done', 'status' => true);
        return Response()->json($arr);  
    }

    public function thankYou()
    {
        if(Session::has('order_success_details')){
            $info=session('order_success_details');
            Session::forget('order_success_details');
            return view('checkout.success',compact(['info']));
        }
        abort(404);
    }


 }