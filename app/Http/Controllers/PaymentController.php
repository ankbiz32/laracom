<?php
 namespace App\Http\Controllers;
 use Razorpay\Api\Api;
 use Illuminate\Http\Request;
 use App\Payment;
 use Redirect,Response;
 class PaymentController extends Controller
 {

    public function index()
    {
        
        $api = new Api('rzp_test_b9bbROv33Dc5tc', 'mp1hUAwjGOoSp0iNy93qMQc0');
        $order = $api->order->create(array(
            'amount' => 500 * 100,
            'currency' => 'INR'
            ));
        $oid=$order['id'];
        return view('payWithRazorpay',compact('oid'));
    }

    public function paysuccess(Request $request){
        // $data = [
        //         'user_id' => '1',
        //         'payment_id' => $request->payment_id,
        //         'amount' => $request->amount,
        //         ];
        // $getId = Payment::insertGetId($data);  
        $gg=['razor_pay_id' => $request->razorpay_payment_id,'razor_product_id' => $request->product_id,'razor_amount' => $request->total_amount,'res' => $request->res];
        session(['gg'=>$gg]);
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
        return Response()->json($arr);    
    }

    public function thankYou()
    {
        dd(session('gg'));
    }


 }