<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $categories = Category::where('parent_id', '=', 0)->get();
        // dd(geoip($request->ip())); //For dynamic ip address
        // dd(geoip('178.18.25.0')); //For static ip address
        // dd($products = Product::where('country_iso_code',geoip($request->ip())->iso_code)->take(4)->get());
        $products = Product::orderBy('id', 'DESC')->get();
        return view('home.index',compact('products'));

    }
}
