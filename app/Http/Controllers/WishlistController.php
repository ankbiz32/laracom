<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Wishlist;

class WishlistController extends Controller
{

    public function index(Request $request)
    {
        $wishlist= Wishlist::where('user_id',auth()->user()->id)->get();
        return view('wishlist.index', compact ('wishlist'));
    }

    public function add($id)
    {
        $p=Product::where('id',$id)->where('is_active',1)->firstOrFail();
        $w = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $id)->get();
        if(count($w)){
            return redirect()->back()->with('info','Already wishlisted');
        }
        else{
            $wl = new Wishlist;
            $wl->product_id=$id;    
            $wl->user_id=auth()->user()->id;
            $wl->save();
            return redirect()->back()->with('success','Added to wishlist');
        }
       
    }

    public function remove(Request $request)
    {
        Wishlist::where('id',$request->id)->delete();
        return redirect()->back()->with('success','Removed from wishlist');
    }
    
    public function update($id)
    {
        $wl=Wishlist::findOrFail($id);
        Wishlist::where('id',$id)->delete();
        return redirect()->route('cart.add',['product'=>$wl->product->id]);
        // return redirect()->back()->with('success','Product moved to cart');
    }


}
