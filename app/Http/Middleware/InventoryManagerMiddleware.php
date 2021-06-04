<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class InventoryManagerMiddleware
{
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role == "Admin" OR Auth::user()->role == "INVENTORY_MANAGER"){
            return $next($request);
        }
        else{
            return redirect('/dashboard');
        }
        
    }
}