<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class BackendMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == "Admin" OR Auth::user()->role == "SALES_MANAGER" OR Auth::user()->role == "INVENTORY_MANAGER"){
            return $next($request);
        }
        else{
            return redirect('/');
        }
        
    }
}