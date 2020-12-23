<?php

namespace App\Http\Controllers;
use App\Order;
use App\Payment;
use App\User;
use App\Product;
use App\Profile;
use App\Wishlist;
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

        $totalgross=0;


        return view('admin.dashboard',compact('latest','totaluser','totalorder','totalproduct','totalgross','reminder'));
    }

    public function order(Request $request)
    {

        if ($request->ajax()) {
            $result = Order::orderBy('created_at','DESC')->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('check', '<input type="checkbox" class="rowSelector" data-id="{{ $id }}">')
                ->addColumn('type', function($row){
                    if($row->payment_id){
                        $btn = '
                                <p class="mb-0">'.$row->payment_type.'</p>
                                <a href="'.URL('/').'/transactions?pay_ref='.urlencode($row->payment_id).'" title="Payment reference" class="link">#'.$row->payment_id.'</a>
                            ';
                        return $btn;
                    }
                    else{
                        $btn = '
                                <p class="mb-0">'.$row->payment_type.'</p>
                            ';
                        return $btn;
                    }
                })
                ->addColumn('action', function($row){
                    $btn = '
                            <a href="'.route('admin.showorder',['id'=>$row->id]).'" title="View Order" class="btn btn-sm btn-warning m-1"><i class="fa fa-eye"></i></a>

                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editOrderModal" data-id="'.$row->id.'" class="edit btn btn-sm btn-info m-1">UPDATE STATUS</a>
                        ';
                    return $btn;
                })
                ->rawColumns(['action','type', 'check'])
                ->make(true);
        }
        return view('admin.order');
    }

    public function show_order($id)
    {
        $order =Order::findOrFail($id);
        return view('admin.showorder',compact('order'));
    }

    public function update_order(Request $request)
    {
        $this->validate(request(),[
            'id'=>'required',
            'order_status'=>'required'
        ]);
        $order= Order::find(request('id'));
        $order->order_status = request('order_status');
        if( $order->save()){
            return redirect()->route('admin.order')->with('success','Order status updated !');
        }
        else{
            return redirect()->route('admin.order')->with('error','Error! Try again');
        }
    }

    public function update_order_bulk(Request $request)
    {
        $ids=json_decode(request('ids'),true);
        foreach($ids as $id){
            $order = Order::findOrFail($id);
            $order->order_status=request('stat');
            $order->save();
        }
        $request->session()->flash('success', 'Status updated !');
        return response()->json(['success'=>'Status updated!']);
    }


    public function transactions(Request $request)
    {
        if ($request->ajax()) {
            $result = Payment::orderBy('created_at','DESC')->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('email', function($row){
                    $btn = '
                            <a href="'.URL('/').'/users?email='.urlencode($row->order->email).'" title="User email" class="link">'.$row->order->email.'</a>
                        ';
                    return $btn;
                })
                ->addColumn('action', function($row){
                    $btn = '
                            <a target="_blank" href="'.route('txn.info',['pid'=>$row->vendor_payment_id]).'" title="View raw info" class="btn btn-sm btn-default m-1">View raw info</a>
                        ';
                    return $btn;
                })
                ->rawColumns(['email','action'])
                ->make(true);
        }
        return view('admin.transactions');
    }

    public function user(Request $request)
    {
        if ($request->ajax()) {
            $result=DB::table('users')->leftjoin('profiles','users.id','=','profiles.user_id')->get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('check', '<input type="checkbox" class="rowSelector" data-id="{{ $id }}">')
                ->addColumn('status', function($row){
                    $btns = '
                            <div class="custom-control custom-switch custom-switch-off-muted custom-switch-on-success">
                                <input type="checkbox" data-id="'.$row->id.'" class="custom-control-input" id="customSwitch'.$row->id.'"
                        ';

                    if($row->is_active==1){
                        $btns .= ' checked>';
                    }
                    else{
                        $btns .= '>';
                    }

                    $btns .= '
                                <label class="custom-control-label btn" for="customSwitch'.$row->id.'"></label>
                            </div>
                        ';
                    return $btns;
                })
                ->addColumn('action', function($row){
                    $btn = '
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editOrderModal" data-id="'.$row->id.'" class="edit btn btn-sm btn-info m-1">CHANGE ROLE</a>
                        ';
                    return $btn;
                })
                ->rawColumns(['action', 'check', 'status'])
                ->make(true);
        }
        return view('admin.user');
    }

    public function userRoles()
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


    public function userStatus(Request $request)
    {
        $user = User::findOrFail(request('id'));
            $user->is_active=request('active');
            $user->save();

        return response()->json(['success'=>'Status updated!']);
    }

    public function userBulkStatus(Request $request)
    {
        $ids=json_decode(request('id'),true);
        foreach($ids as $id){
            $user = User::findOrFail($id);
            $user->is_active=request('active');
            $user->save();
        }
        $request->session()->flash('success', 'Status updated !');
        return response()->json(['success'=>'Status updated!']);
    }

    public function userSingleRole(Request $request)
    {
        $user = User::findOrFail(request('id'));
        $user->role=request('role');

        if( $user->save()){
            return redirect()->route('admin.user')->with('success','User role updated !');
        }
        else{
            return redirect()->route('admin.user')->with('error','Error! Try again');
        }
    }

    public function userBulkRole(Request $request)
    {
        $ids=json_decode(request('id'),true);
        foreach($ids as $id){
            $user = User::findOrFail($id);
            $user->role=request('role');
            $user->save();
        }
        $request->session()->flash('success', 'Role updated !');
        return response()->json(['success'=>'Role updated!']);
    }

    public function wishlist(Request $request)
    {
        if ($request->ajax()) {
            $result = Wishlist::all()->groupBy('product_id');
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('id', function($row){
                        return $row[0]->product_id;
                })
                ->addColumn('product', function($row){
                        return $row[0]->product->name;
                })
                ->addColumn('img_src', function($row){
                        return $row[0]->product->image;
                })
                ->addColumn('stock', function($row){
                    if($row[0]->product->ProductInventory->in_stock){
                        return '<p class="text-success">In Stock</p>';
                    }
                    else{
                        return '<p class="text-danger">Out of stock</p>';
                    }
                })
                ->addColumn('count', function($row){
                        return $row->count();
                })
                ->rawColumns(['stock'])
                ->make(true);
        }
        return view('admin.wishlist');
    }

}

