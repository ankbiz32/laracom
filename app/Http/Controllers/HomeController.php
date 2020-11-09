<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // dd(geoip($request->ip())); //For dynamic ip address
        // dd(geoip('178.18.25.0')); //For static ip address
        // dd(geoip('178.18.25.0')); //For static ip address
        $products = Product::take(4)->get();
        return view('home.index',compact('products'));

    }
}
