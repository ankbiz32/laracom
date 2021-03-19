<?php

namespace App\Http\Controllers;
use App\User;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function edit(User $user){
        $this->authorize('update',$user->profile);
        $orders=Order::where('user_id',$user->id)->orderBy('id','DESC')->get();
        return view('profiles.edit', compact('user','orders'));
    }

    public function update($user){
        $name = request()->validate([
            'name'=>['required', 'string', 'max:255'],
            'country_iso_code'=>['required', 'string', 'max:255'],
        ]);
        $data = request()->validate([
            'phonenumber'=> ['required', 'numeric'] ,
            'address'=>['required', 'string', 'max:255'],
            'zipcode'=>['required'],

        ]);

        auth()->user()->profile->update($data);
        auth()->user()->update($name);

        return redirect()->back()->with('success','Your account information has been updated.');
    }

    public function password($user){
        $data = request()->validate([
            'oldpass'=> ['required'],
            'newpass'=> ['required','confirmed'],
        ]);
        if (Hash::check(request('oldpass'), auth()->user()->password))
        {
            $data['password']=Hash::make($data['newpass']);
            auth()->user()->update($data);
            return redirect()->back()->with('success','Password changed successfully.');
        }
        else{
            return redirect()->back()->with('error','Wrong current password. Please try again with the correct password.');
        }
    }
}