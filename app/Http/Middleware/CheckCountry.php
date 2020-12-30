<?php

namespace App\Http\Middleware;

use Closure;

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
        if (session('country_iso')) {
            session(['country_iso' => 'IN']);
        }
        else{
            $iso=geoip('85.214.132.117')->iso_code; //For static ip address
            $country = Country::where('country_iso_code', $iso)->get();
            if($country){
                session(['country_iso' => $country]);
            }
            else{
                session(['country_iso' => 'IN']);
            }
        }
        return $next($request);
    }
}
