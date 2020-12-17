<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Country;
use DB;
use Session;
use DataTables;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;


    protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectTo()
    {
        if (auth()->user()->role=='Admin') {
            return '/dashboard';
        } else {
            return '/';
        }
    }
    
    
    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country_id' => ['required', 'string'],
        ]);
    }

    public function showRegistrationForm()
    {
        $countrylist = Country::get(["name","id"]);
        return view('auth.register', compact (['countrylist']));
    }


    protected function create(array $data)
    {
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country_id' => $data['country_id'],
        ]);

    }
}