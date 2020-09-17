<?php

namespace App\Http\Controllers\Panel;
use App\Tag;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('id', 'desc')->get();
        return view('panel.blog.tag.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.blog.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      =>  'required|max:150',
        ]);
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();
        return back()->with('success','You have successfully created a tag.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $tag = Tag::find($request->id);
        return view('panel.blog.tags.edit')->with('tag', $tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'      =>  'required|max:150',
        ]);

        $tag = Tag::find($request->id);
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->save();

        return back()->with('success','You have successfully update a tag.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $tag = Tag::find($id);
        if ($tag) {
            $tag->delete();
            return back()->with('success','You have successfully delete a tag.');
        }
    }
}
