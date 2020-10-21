<?php

namespace App\Http\Controllers;

use App;
use Storage;
use App\Attribute;
use App\AttributeDetail;
use Illuminate\Http\Request;
use DB;
use Session;

 
class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attribute = DB::select('select * from attributes');
        return view('admin.attribute',['attributes'=>$attribute]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addattribute');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute = new Attribute;
        $attribute->name=$request->input('name');
        $attribute->save();

        if(!empty($request->input('Attribute'))){
            foreach($request->input('Attribute') as $k){
                if(!empty($k)){
                    $attribute_detail = new AttributeDetail;
                    $attribute_detail->attribute_id=$attribute->id;
                    $attribute_detail->name=$k['name'];
                    $attribute_detail->describe=$k['describe'];
                    $attribute_detail->save();
                }
            }
        }
        return redirect()->route('admin.attribute')->with('success','Attribute added !');
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
        $attribute = Attribute::with('attributeDetail')->findOrFail($id);
        //echo '<pre>';
        //print_r($attribute->toArray());
        //exit;
        //$attribute = Attribute::findOrFail($id);
        //print_r($attribute);
        //exit;
        return view('admin.editattribute',compact('attribute'));

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

        $attribute = Attribute::find($id);
        $attribute->name = $request->get('name'); 
        $attribute->update();

            foreach($request->get('Attribute') as $k){
                //print_r($k);
                //exit;
                $did = $k['attribute_id'];
                if(!empty($did)){
                    $attribute_detail = AttributeDetail::find($did);
                    $attribute_detail->attribute_id=$attribute->id;
                    $attribute_detail->name=$k['name'];
                    $attribute_detail->describe=$k['describe'];
                    $attribute_detail->update();
                }
                else{
                    $attribute_detail = new AttributeDetail;
                    $attribute_detail->attribute_id=$attribute->id;
                    $attribute_detail->name=$k['name'];
                    $attribute_detail->describe=$k['describe'];
                    $attribute_detail->save();
                }
            }
        return redirect()->route('admin.attribute')->with('success','Attribute update !');


        if(request('image'))
        {
            $imagepath = $request->image->store('products','public');
            $product = Product::findOrFail($id);

            $product->name=request('name');
            $product->brand=request('brand');
            $product->price=request('price');
            $product->gender=request('gender');
            $product->category=request('category');
            $product->image=$imagepath;
            $product->save();
        }
        else
        {
            $product = Product::findOrFail($id);
            $product->name=request('name');
            $product->brand=request('brand');
            $product->price=request('price');
            $product->gender=request('gender');
            $product->category=request('category');
            $product->save();
        }
        return redirect()->route('admin.product')->with('success','Product updated !');




        //$attribute = Attribute::with('attributeDetail')->findOrFail($id);
        //echo '<pre>';
        //print_r($attribute->toArray());
        //exit;
        //$attribute = Attribute::findOrFail($id);
        //print_r($attribute);
        //exit;
        //return view('admin.editattribute',compact('attribute'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attribute::where('id',$id)->delete();
        AttributeDetail::where('attribute_id',$id)->delete();

        return redirect()->route('admin.attribute')->with('success','Attribute removed !');
    }



    public function getAttributeDeleted(Request $request)
    {
        if($request->ajax())
        {
            $attribute_id = json_decode($request->get('attribute_id'));
            //echo json_encode($attribute_id);
            //exit;
            $attributeDetailsList =AttributeDetail::where('id',$attribute_id)->delete();
            //$attributeDetailsList = AttributeDetail::all()->where('attribute_id',$attribute_id);
            if(!empty($attributeDetailsList)){
    
               $response = array("status"=>200,"msg"=>'success');
               echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
               exit;
            } 
        }
    }
}
