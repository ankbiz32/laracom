<?php

namespace App\Http\Controllers;
use App\Order;
use App\User;
use App\Product;
use App\Profile;
use App\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class AdminController extends Controller
{
    public function index()
    {
        $totalgross = 0;

        $users = User:: get();
        $totaluser = count($users);

        $orders = Order::get();
        $totalorder = count($orders);

        $products = Product::get();
        $totalproduct = count($products);

        $latest=Order::orderBy('created_at','DESC')->take(5)->get();

        if(Reminder::find(1)==null)
        {
            $reminder=new Reminder();
            $reminder->id = 1;
            $reminder->reminder="Type something";
            $reminder->save();
            $reminder = Reminder::find(1);
        }
        else
        {
            $reminder = Reminder::find(1);
        }

        $gross = Order::get();
        $gross->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });

        foreach ($gross as $x){
           $totalgross+= $x->cart->totalPrice;
        }



        return view('admin.dashboard',compact('latest','totaluser','totalorder','totalproduct','totalgross','reminder'));
    }

    public function order(Request $request)
    {

        if ($request->ajax()) {
            $result = Order::orderBy('created_at','DESC')->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('check', '<input type="checkbox" class="rowSelector" data-id="{{ $id }}">')
                ->addColumn('action', function($row){
                    $btn = '
                            <a href="'.route('admin.showorder',['id'=>$row->id]).'" title="View Order" class="btn btn-sm btn-warning m-1"><i class="fa fa-eye"></i></a>

                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editOrderModal" data-id="'.$row->id.'" class="edit btn btn-sm btn-info m-1">CHANGE STATUS</a>
                        ';
                    return $btn;
                })
                ->rawColumns(['action', 'check'])
                ->make(true);
        }
        return view('admin.order');
    }

    public function show_order($id)
    {
        $ids =DB::table('orders')->where('id',$id)->get();

        $order =DB::table('orders')->where('id',$id)->get();
        $order->transform(function($order,$key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.showorder',compact('order','ids'));
    }

    public function user()
    {
        $users=DB::table('users')->leftjoin('profiles','users.id','=','profiles.user_id')->get();
        return view('admin.user',compact('users'));
    }

    public function updatereminder()
    {
        $this->validate(request(),[
            'reminder'=>'required'
        ]);
        $reminder= Reminder::find(1);
        $reminder->reminder = request('reminder');
        if( $reminder->save()){
            return redirect()->route('admin.index')->with('success','Reminder updated !');
        }
        else{
            return redirect()->route('admin.index')->with('error','Error! Try again');
        }
    }
}

