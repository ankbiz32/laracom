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
    use App\Country;
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
                $order_det->product_variant = $item['product_variant_name'];
                $order_det->qty = $item['quantity'];
                $order_det->price = $item['price'];
                $order_det->save();
            }
            
            $payment = new Payment();
            $payment->vendor ='Razorpay';
            $payment->status ='Success';
            $payment->currency ='INR';
            $payment->payment_amount =$cart->totalPrice;
            $payment->order_id =$order->id;
            $payment->vendor_payment_id =$request->input('rpid');
            $payment->vendor_order_id =$request->input('roid');
            $payment->vendor_signature =$request->input('rs');
            $payment->vendor_errors ='';
            $payment->save();

            Session::forget('cart');

            $resp['order_no']=$order->id;
            $resp['name']=$order->name;
            $resp['amount']=$order->amount;
            $resp['pay_mode']='ONLINE';
            $resp['pay_ref']=$request->input('rpid');
            $resp['items']=$cart->items;
            $resp['address']=$order->address;
            $resp['country']= Country::where('country_iso_code',$order->country)->firstOrFail()->country_name;
            $resp['zipcode']=$order->zipcode;
            $resp['order_status']='Success';
            if($request->input('different_shipping')){
                $resp['address']=$order->ship_address;
                $resp['country']=$order->ship_country;
                $resp['zipcode']=$order->ship_zipcode;
            }
            session(['order_success_details'=>$resp]);
            $arr = array('msg' => 'Payment successfully done', 'status' => true);
            return Response()->json($arr);  
        }

        public function thankYou()
        {
            if(Session::has('order_success_details')){
                $resp=session('order_success_details');
                Session::forget('order_success_details');
                return view('checkout.success',compact(['resp']));
            }
            abort(404);
        }

        
        public function hdfcCheckoutInit(Request $request)
        {
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

                Auth::loginUsingId($uid);
            }

            $oldCart = Session::get('cart');
            $cart = new Cart($oldCart);

            $t=time();

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
            $order->payment_id = $t;
            $order->note = $request->input('note');
            $order->order_status = 'REJECTED';
            $order->is_paid = 0;
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
                $order_det->product_variant = $item['product_variant_name'];
                $order_det->qty = $item['quantity'];
                $order_det->price = $item['price'];
                $order_det->save();
            }

            $payment = new Payment();
            $payment->order_id =$order->id;
            $payment->vendor ='HDFC';
            $payment->payment_amount =$cart->totalPrice;
            $payment->status ='Aborted';
            $payment->currency ='INR';
            $payment->vendor_payment_id =$t;
            $payment->hdfc_tracking_id =$t;
            $payment->vendor_errors ='';
            $payment->save();

            $resp=array();
            $resp['merchant_id']=$request->input('merchant_id');
            $resp['order_id']=$order->id;
            $resp['tid']=$request->input('tid');
            $resp['currency']=$request->input('currency');
            $resp['amount']=$cart->totalPrice;
            $resp['redirect_url']=$request->input('redirect_url');
            $resp['cancel_url']=$request->input('cancel_url');
            $resp['language']=$request->input('language');
            $resp['integration_type']=$request->input('integration_type');
            $resp['merchant_param1']=encrypt(auth()->user());
            Session::forget('cart');
            return view('checkout.ccavRequestHandler',compact(['resp']));
        }

        public function hdfcCheckout(Request $request)
        {
            if($request->encResp){
                $workingKey=env('CCAV_WORKING_KEY');
                $access_code=env('CCAV_ACCESS_CODE');
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

                Auth::logout();
                Auth::login(decrypt($info['merchant_param1']));

                // Status API for S2S communication
                $merchant_json_data =
                    array(
                    'order_no' => '',
                    'reference_no' =>$info['tracking_id']
                );
                $merchant_data = json_encode($merchant_json_data);
                $encrypted_data = $this->encrypt1($merchant_data,$workingKey);
                $final_data = 'enc_request='.$encrypted_data.'&access_code='.$access_code.'&command=orderStatusTracker&request_type=JSON&response_type=JSON';
                $headers = [];
                $headers[] = 'Content-Type: application/json';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://apitest.ccavenue.com/apis/servlet/DoWebTrans");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers) ;
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $final_data);
                $result = curl_exec($ch);
                curl_close($ch);
                $information = explode('&', $result);
                $dataSize = sizeof($information);
                for ($i = 0; $i < $dataSize; $i++) {
                    $info_value = explode('=', $information[$i]);
                    if ($info_value[0] == 'enc_response') {
                        // $status = $this->decrypt1(trim($info_value[1]), $workingKey);
                    }
                }

        
                if($info['order_status']=='Success'){
        
                    $order = Order::findOrFail($info['order_id']);
                    $order->payment_id = $info['tracking_id'];
                    $order->is_paid = 1;
                    $order->order_status = 'ORDERED';
                    $order->update();
        
                    $payment = Payment::where('order_id',$info['order_id'])->firstOrFail();
                    $payment->status ='Success';
                    $payment->hdfc_tracking_id =$info['tracking_id'];
                    $payment->vendor_payment_id=$info['tracking_id'];
                    $payment->bank_ref_no =$info['bank_ref_no'];
                    $payment->hdfc_pay_mode =$info['payment_mode'];
                    $payment->vendor_errors ='';
                    $payment->update();
            
                    $resp['order_no']=$order->id;
                    $resp['name']=$order->name;
                    $resp['amount']=$order->amount;
                    $resp['pay_mode']='Paid online with HDFC';
                    $resp['pay_ref']=$info['tracking_id'];
                    $resp['address']=$order->address;
                    $resp['country']= Country::where('country_iso_code',$order->country)->firstOrFail()->country_name;
                    $resp['zipcode']=$order->zipcode;
                    $resp['order_status']='Success';
                    if($order->ship_to_different_address){
                        $resp['address']=$order->ship_address;
                        $resp['country']=$order->ship_country;
                        $resp['zipcode']=$order->ship_zipcode;
                    }

                    return view('checkout.success',compact(['resp']));
                }
                else{
            
                    $order = Order::findOrFail($info['order_id']);
                    $order->payment_id = $info['tracking_id'];
                    $order->is_paid = 0;
                    $order->update();
        
                    $payment = Payment::where('order_id',$info['order_id'])->firstOrFail();
                    $payment->status =$info['order_status'];
                    $payment->hdfc_tracking_id =$info['tracking_id'];
                    $payment->vendor_payment_id =$info['tracking_id'];
                    $payment->bank_ref_no =$info['bank_ref_no'];
                    $payment->hdfc_pay_mode =$info['payment_mode'];
                    $payment->vendor_errors =$info['failure_message'];
                    $payment->update();
        
                    $resp['order_no']=$order->id;
                    $resp['name']=$order->name;
                    $resp['amount']=$order->amount;
                    $resp['pay_mode']='Online with HDFC';
                    $resp['pay_ref']=$info['tracking_id'];
                    $resp['address']=$order->address;
                    $resp['country']= Country::where('country_iso_code',$order->country)->firstOrFail()->country_name;
                    $resp['zipcode']=$order->zipcode;
                    $resp['order_status']=$info['order_status'];
                    if($order->ship_to_different_address){
                        $resp['address']=$order->ship_address;
                        $resp['country']=$order->ship_country;
                        $resp['zipcode']=$order->ship_zipcode;
                    }
                    return view('checkout.success',compact(['resp']));
        
                    
                }
            }
            else{
                abort(404);
            }
            
        }


        function encrypt1($plainText,$key)
        {
            $key = $this->hextobin1(md5($key));
            $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
            $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
            $encryptedText = bin2hex($openMode);
            return $encryptedText;
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

        public function info(Request $request)
        {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $payment = $api->payment->fetch($request->pid);
            echo '<pre>';
            var_dump($payment);
        }

    }