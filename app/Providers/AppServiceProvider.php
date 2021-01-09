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
        // unset($_SESSION);
        if ( !isset($_SESSION['country_iso_code']) || !isset($_SESSION['currency_code']) || !isset($_SESSION['curr']) || !isset($_SESSION['locale_code'])) 
        {
            $__iso=geoip($request->ip())->iso_code; //For dynamic ip address
            // $__iso = geoip('192.206.151.131')->iso_code;
            $__available = Country::where('country_iso_code', $__iso)->first();
            if($__available){
                if(count($__available->products)){
                    $_SESSION['country_iso_code']=$__iso;
                    $_SESSION['currency_code']=$__available->currency.' ';
                    $_SESSION['curr']=$__available->currency_symbol.' ';
                    $_SESSION['locale_code']=$__available->locale_code.' ';
                }
                else{
                    $__this = Country::where('country_iso_code', 'IN')->first();
                    $_SESSION['country_iso_code']='IN';
                    $_SESSION['currency_code']=$__this->currency.' ';
                    $_SESSION['curr']=$__this->currency_symbol.' ';
                    $_SESSION['locale_code']=$__this->locale_code.' ';
                }
            }
            else{
                $__available = Country::where('country_iso_code', $__iso)->first();
                $_SESSION['country_iso_code']='IN';
                $_SESSION['currency_code']=$__this->currency.' ';
                $_SESSION['curr']=$__this->currency_symbol.' ';
                $_SESSION['locale_code']=$__this->locale_code.' ';
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