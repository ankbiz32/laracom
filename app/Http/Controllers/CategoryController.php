<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Country;
use File;
class CategoryController extends Controller {

    public function treeView(){
        $countries = Country::get();
        $Categorys = Category::where('parent_id', '=', 0)->get();
        if(count($Categorys)){
            $tree='<ul id="navigation" class="filetree"><li class="tree-view"></li>';
            foreach ($Categorys as $Category) {
                 $tree .='<li class="tree-view closed"><a class="tree-name text-md" href="javascript:;" data-id="'.$Category->id.'">'.$Category->name.'<sup> '.$Category->country_iso_code.'</sup></a>';
                 if(count($Category->childs)) {
                    $tree .=$this->childView($Category);
                }
            }
            $tree .='<ul>';
        } else{
            $tree=null;
        }
        // return $tree;
        return view('admin.category',compact('tree','countries'));
    }

    public function childView($Category){
            $html ='<ul>';
            foreach ($Category->childs as $arr) {
                if(count($arr->childs)){
                        $html .='<li class="tree-view closed"><a href="javascript:;" class="tree-name text-md" data-id="'.$arr->id.'">'.$arr->name.'<sup> '.$arr->country_iso_code.'</sup></a>';
                    $html.= $this->childView($arr);
                }else{
                    $html .='<li class="tree-view"><a href="javascript:;" class="tree-name text-md" data-id="'.$arr->id.'">'.$arr->name.'<sup> '.$arr->country_iso_code.'</sup></a>';
                    $html .="</li>";
                }
            }

            $html .="</ul>";
            return $html;
    }

    public function create(Request $request)
    {
        $this->validate(request(),[
            'image'=>'image',
            'country_iso_code'=>'required',
            'name'=>'required|string'
        ]);

        foreach(request('country_iso_code') as $iso){
            $category = new Category();
            $category->name=request('name');
            $category->parent_id=request('parent_id');
            $category->country_iso_code=$iso;
            $category->meta_description=request('meta_description');
            if(request('meta_title'))
            {
                $category->meta_title=str_slug(request('meta_title'), '-');
            }
            else{
                $category->meta_title=str_slug(request('name'), '-');
            }
            if(request('image'))
            {
                $imagepath = $request->image->store('categories','public');
                $category->img_src=$imagepath;
            }

            $category->save();
        }
        if(request('parent_id')==0){
            return redirect()->route('admin.categories')->with('success','Category added !');
        }
        else{
            return redirect()->route('admin.categories')->with('success','Sub-category added !');
        }
    }

    public function editForm(Request $request)
    {
        $cat = Category::where('id',request('id'))->get();
        return response()->json($cat);
    }

    public function edit(Request $request)
    {
        $this->validate(request(),[
            'image'=>'image',
            'country_iso_code'=>'required',
            'name'=>'required|string'
        ]);
        $category = Category::findOrFail(request('id'));

        $category->name=request('name');
        $category->country_iso_code=request('country_iso_code');
        $category->meta_description=request('meta_description');
        if(request('meta_title'))
        {
            $category->meta_title=str_slug(request('meta_title'), '-');
        }
        else{
            $category->meta_title=str_slug(request('name'), '-');
        }
        if(request('image'))
        {
            $imagepath = $request->image->store('categories','public');
            $category->img_src=$imagepath;
        }
        $category->save();
        return redirect()->route('admin.categories')->with('success','Category updated !');
    }

    public function remove(Request $request)
    {
        Category::where('id',request('id'))->delete();
        $childs=Category::where('parent_id',request('id'))->get();
        foreach($childs as $child){
            $child2=Category::where('parent_id',$child->id)->get();
            foreach($child2 as $c){
                Category::where('id',$c->id)->delete();
            }
            Category::where('id',$child->id)->delete();
        }
        return redirect()->route('admin.categories')->with('success','Category removed !');
    }

    public function removeImg($id)
    {
        $category = Category::findOrFail($id);
        $name=explode('/',$category->img_src);
        $filename = public_path($name[0].'\\'.$name[1]);
        if(File::exists($filename)) {
            File::delete($filename);
        }
        $category->img_src=NULL;
        $category->save();
        return redirect()->route('admin.categories')->with('success','Image removed !');
    }


}
