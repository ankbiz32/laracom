<?php

namespace App\Http\Controllers;

use App;
use Storage;
use App\Country;
use Illuminate\Http\Request;
use DB;
use Session;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get();
        return view('admin.country',['countries'=>$countries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addcountry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'country_name'=>'required|string',
            'country_iso_code'=>'required|unique:countries|string',
            'currency'=>'required|string',
            'currency_symbol'=>'required|string',
            'locale_code'=>'required|string',
            'locale_name'=>'required|string',
        ]);
        $country = new Country;
        $country->country_name=$request->input('country_name');
        $country->country_iso_code=$request->input('country_iso_code');
        $country->currency=$request->input('currency');
        $country->currency_symbol=$request->input('currency_symbol');
        $country->locale_code=$request->input('locale_code');
        $country->locale_name=$request->input('locale_name');
        $country->save();
        return redirect()->route('admin.country')->with('success','Country added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::findOrFail($id);
        return view('admin.editcountry',compact('countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(),[
            'country_name'=>'required|string',
            'country_iso_code'=>'required|unique:countries,id|string',
            'currency'=>'required|string',
            'currency_symbol'=>'required|string',
            'locale_code'=>'required|string',
            'locale_name'=>'required|string',
        ]);
        $country = Country::find($id);
        $country->country_name=$request->input('country_name');
        $country->country_iso_code=$request->input('country_iso_code');
        $country->currency=$request->input('currency');
        $country->currency_symbol=$request->input('currency_symbol');
        $country->locale_code=$request->input('locale_code');
        $country->locale_name=$request->input('locale_name');
        $country->update();
        return redirect()->route('admin.country')->with('success','Country updated !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Country::where('id',$id)->delete();
        return redirect()->route('admin.country')->with('success','Country removed !');

    }
}
