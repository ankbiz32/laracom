<?php

namespace App\Http\Controllers;
use App\Order;
use App\Country;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Request $request){
        if ($request->ajax()) {
            $order=Order::find($request->id); 
            if($order->payment){
                $pay_by=$order->payment->vendor;
                $pay_id=$order->payment->vendor_payment_id;
                $pay_stat=$order->payment->status;
            }
            else{
                $pay_by='Pay on delivery';
                $pay_stat='PENDING';
                $pay_id='<em><small>Not available</small></em>';
            }
            if($order->ship_to_different_address){
                $countryfull=Country::where('country_iso_code',$order->ship_country)->firstOrFail()->country_name;
            }else{
                $countryfull=Country::where('country_iso_code',$order->country)->firstOrFail()->country_name;
            }
            $response='
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2 mb-sm-0 mb-4">
                                    <h6>ORDER DETAILS</h6>
                                    <hr>
                                    <div class="row">
                                        <div class="col-5">
                                            Order ID<br>
                                            Phone Number <br>
                                            Status<br>
                                            Ordered on: <br>
                                            Paid through <br>
                                            Payment status <br>
                                            Payment ID

                                        </div>
                                        <div class="col-7">
                                            : '.$order->id .' <br>
                                            : '. $order->phone .'<br>
                                            : '. $order->order_status .'<br>
                                            : '.date("d/m/Y H:i",strtotime($order->created_at)).' <br>
                                            : '. $pay_by .' <br>
                                            : '. $pay_stat .' <br>
                                            : '. $pay_id .'
                                        </div>
                                    </div>

                                </div>
                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 pt-2">
                                    <h6>SHIPPING ADDRESS</h6>
                                    <hr>
                                    <div class="row">
                                ';

                                if($order->ship_to_different_address){
                                $response.='
                                            <div class="col-5">
                                            Phone <br>
                                            Country <br>
                                            Zipcode <br>
                                            Address <br>

                                        </div>
                                        <div class="col-7">
                                        : '.$order->ship_phone .' <br>
                                            : '. $countryfull .' <br>
                                            : '. $order->ship_zipcode .'<br>
                                            : '.$order->ship_address .' <br>

                                        </div>
                                        ';
                                } else {
                                $response.='
                                        <div class="col-5">
                                            Country <br>
                                            Zipcode <br>
                                            Address <br>

                                        </div>
                                        <div class="col-7">
                                            : '.$countryfull .' <br>
                                            : '.$order->zipcode .' <br>
                                            : '.$order->address .' <br>

                                        </div>
                                ';
                                }
                                $response.='
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="card-body">
                            ';
                                foreach($order->order_details as $item){
                                $response.='
                                <div class="col-sm-12 col-md-12 col-lg-12 d-flex order-history mx-auto">
                                    <div class="row">
                                            <div class="col-12 mb-4 d-flex justify-content-between ">
                                                <div class="order-image mr-4">
                                                    <img src="'. asset($item->product->image) .'" alt="" width="60">
                                                </div>

                                                <div class="order-detail mr-auto d-flex flex-column justify-content-center">
                                                    <div class="detail-1">
                                                        <p class="h6">'.$item->product->name;

                                                    $item->product_variant!=null ? $response.= '<small> ('.$item->product_variant.')</small>' : '' ;
                                                    
                                                    $response.='</p>  
                                                    </div>
                                                    <div class="detail-3">
                                                        <p class="mb-0">Quantity: '.$item->qty.'</p>
                                                    </div>
                                                    <div class="detail-4">
                                                        <p >Price: Rs.   '.$item->price.'</p>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                ';
                            }
                                
                                $response.='
                                   <hr>
                                    <div class="row col">
                                        <p class="h6"><strong>Total amount: Rs. '. $order->amount .'/-</strong></p>
                                    </div>
                            </div>
                        </div>
                    ';
            
            echo $response;
        }
    }
}
