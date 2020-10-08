<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use DataTables;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $result = Tag::get();
            return Datatables::of($result)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#editTagModal" data-id="'.$row->id.'" data-tag="'.$row->tag.'" class="edit btn btn-info m-1">EDIT</a>
                            <form action="'.route('admin-tags.destroy', $row->id).'" data-formId="'.$row->id.'" class="d-inline" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                <button type="button" onclick="confirmation(event)" data-rid="'.$row->id.'" class="btn btn-danger m-1">REMOVE</button>
                            </form>
                        ';
                    return $btn;
                })
                ->rawColumns(['action', 'check'])
                ->make(true);
        }
        return view('admin.tags');
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
            'tag'=>'required|string',
        ]);

        Tag::firstOrCreate(['tag' => request('tag')]);
        return redirect()->route('admin-tags.index')->with('success','Tag added !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shark = Tag::find($id);
        $shark->delete();
        return redirect()->route('admin-tags.index')->with('success','Tag deleted !');
    }

    public function editTag(Request $request)
    {
        // dd($request);
        $this->validate(request(),[
            'tag'=>'required|string',
            'id'=>'required'
        ]);

        $tag = Tag::findOrFail(request('id'));

        $tag->tag=request('tag');
        $tag->save();
        return redirect()->route('admin-tags.index')->with('success','Tag updated !');
    }
}
