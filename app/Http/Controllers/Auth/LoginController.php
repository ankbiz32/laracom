<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if (Auth::user()->is_active) {
            if (Auth::user()->role == 'Admin') {
                return 'dashboard';
            } elseif (Auth::user()->role == 'Customer') {
                return url()->previous();
            } else {
                return '/';
            }
        }
        else{
           Auth::logout();
           return '/login';
        }
    }

    public function showLoginForm()
    {
        // Get URLs
        $urlPrevious = url()->previous();
        $urlBase = url()->to('/');

        // Set the previous url that we came from to redirect to after successful login but only if is internal
        if (($urlPrevious != $urlBase . '/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
            session()->put('url.intended', $urlPrevious);
        }

        return view('auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
