<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;
use DataTables;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result = Brand::get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#edit" data-id="'.$row->id.'" data-name="'.$row->name.'" class="edit btn btn-info m-1">EDIT</a>
                            <form action="'.route('admin-brands.destroy', $row->id).'" data-formId="'.$row->id.'" class="d-inline" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <button type="button" onclick="confirmation(event)" data-rid="'.$row->id.'" class="btn btn-danger m-1">REMOVE</button>
                            </form>
                        ';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.brands');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name'=>'required|string',
            'img_src'=>'image'
        ]);

        $brand = new Brand();
        $brand->name=request('name');

        if($request->hasfile('img_src'))
         {
            $imagepath = $request->img_src->store('brands','public');
            $brand->img_src=$imagepath;
         }

        $brand->save();
        return redirect()->route('admin-brands.index')->with('success','Brand added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shark = Brand::find($id);
        $shark->delete();
        return redirect()->route('admin-brands.index')->with('success','Brand deleted !');
    }

    public function editBrand(Request $request)
    {
        // dd($request);
        $this->validate(request(),[
            'name'=>'required|string',
            'img_src'=>'image',
            'id'=>'required'
        ]);

        $brand = Brand::findOrFail(request('id'));

        $brand->name=request('name');

        if(request('img_src'))
        {
            $imagepath = $request->img_src->store('brands','public');
            $brand->img_src=$imagepath;
        }

        $brand->save();
        return redirect()->route('admin-brands.index')->with('success','Brand updated !');
    }
}
