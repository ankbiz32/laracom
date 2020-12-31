<?php

namespace App\Http\Middleware;

use App\Country;
use App\Product;
use Closure, Session;

class CheckCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session_start();
        if (!isset($_SESSION['country_iso_code'])) 
        {
            $__iso=geoip($request->ip())->iso_code; //For dynamic ip address
            // $__iso = geoip('109.40.243.183')->iso_code;
            $__available = Country::where('country_iso_code', $__iso)->first();
            if($__available){
                if(count($__available->products)){
                    $_SESSION['country_iso_code']=$__iso;
                }
                else{
                    $_SESSION['country_iso_code']='IN';
                }
            }
            else{
                $_SESSION['country_iso_code']='IN';
            }
        }
        return $next($request);
    }
}

// Germany IP -> 109.40.243.183
// India IP -> 182.70.210.1
// Korea IP -> 23.251.224.0
