<?php

namespace App\Http\Controllers\Panel;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('panel.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('panel.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000',
            'featured.*' => 'integer',
            'menu.*' => 'integer'
        ]);

        $featured = isset($request->featured[0]) ? 1 : 0;
        $menu = isset($request->menu[0]) ? 1 : 0;

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->featured = $featured;
        $category->menu = $menu;
        if ($request->hasFile('image')) {
            $category->image = $this->saveCategoryImage($category, $request);
        }
        $category->save();

        return redirect()->route('panel.categories.index');
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
        $targetCategory = Category::find($id);
        $categories = Category::all();
        return view('panel.categories.edit', compact('targetCategory', 'categories'));
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
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $featured = isset($request->featured[0]) ? 1 : 0;
        $menu = isset($request->menu[0]) ? 1 : 0;

        $category = Category::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->featured = $featured;
        $category->menu = $menu;
        if ($request->hasFile('image')) {
            $this->deleteCategoryImage($category);
            $category->image = $this->saveCategoryImage($category, $request);
        }
        $category->update();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Category::find($id);
        $this->deleteCategoryImage($category);
        $category->delete();

        return redirect()->back();
    }

    private function deleteCategoryImage($category){
        if( $category->image ){
            $imgDestroy = public_path('storage/media/product/category/'.$category->image);
            if ( file_exists($imgDestroy) ) unlink($imgDestroy);
        }
    }

    private function saveCategoryImage($category, $request){
        $image = $request->file('image');
        $filenameWithExtension = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $image->storeAs('public/media/product/category', $filenameToStore);

        return $filenameToStore;
    }
}
