<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class SalesManagerMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == "Admin" OR Auth::user()->role == "SALES_MANAGER"){
            return $next($request);
        }
        else{
            return redirect('/dashboard');
        }
        
    }
}