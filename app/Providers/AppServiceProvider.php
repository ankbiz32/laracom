<?php

namespace App\Providers;
use App\Country;
use App\Product;
use Closure, Session;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    { 
        session_start();
        if (!isset($_SESSION['country_iso_code'])) 
        {
            $__iso=geoip($request->ip())->iso_code; //For dynamic ip address
            // $__iso = geoip('192.206.151.131')->iso_code;
            $__available = Country::where('country_iso_code', $__iso)->first();
            if($__available){
                if(count($__available->products)){
                    $_SESSION['country_iso_code']=$__iso;
                    $_SESSION['curr']=$__available->currency_symbol.' ';
                }
                else{
                    $_SESSION['country_iso_code']='IN';
                    $_SESSION['curr']='dsd ';
                }
            }
            else{
                $_SESSION['country_iso_code']='IN';
                $_SESSION['curr']='dsd ';
            }
        }
        view()->composer(['layouts.app'],function ($view){
            $view->with('categories', \App\Category::where('parent_id', '=', 0)->where('country_iso_code', $_SESSION['country_iso_code'])->get());
        });
    }
}

// Germany IP -> 109.40.243.183
// India IP -> 182.70.210.1
// Korea IP -> 23.251.224.0
// Canada IP -> 192.206.151.131