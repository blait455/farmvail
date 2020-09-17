<?php

namespace App\Http\Controllers\Panel;

use Image;
use Illuminate\Support\Str;
use App\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostCategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function blog() {
        $post_categories = PostCategory::all();

        return view('panel.blog.index', compact('post_categories'));
    }

    public function index() {
        $post_categories = PostCategory::all();

        return view('panel.blog.categories.index', compact('post_categories'));
    }

    public function create() {
        return view('panel.blog.categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name'      =>  'required|max:150',
        ]);

        $category = new PostCategory;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filenameWithExtension = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            Image::make($image)->resize(360, 431);
            // Image::make($image)->resize(360, 431)->save($location);
            $image->storeAs('public/media/blog/category', $filenameToStore);

            $category->image = $filenameToStore;
        }
        $category->save();

        $notification = [
            'message'       =>  'Post category created successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit($id) {
        $category = PostCategory::find($id);

        return view('panel.blog.categories.edit', compact('category'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name'      =>  'required|max:150',
        ]);

        $category = PostCategory::find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;

        //save image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filenameWithExtension = $image->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            Image::make($image)->resize(360, 431);
            // Image::make($image)->resize(360, 431)->save($location);
            $image->storeAs('public/media/blog/category', $filenameToStore);

            $category->image = $filenameToStore;
        }

        $category->update();

        $notification = [
            'message'       =>  'Post category updated successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function delete($id) {
        $category = PostCategory::find($id);
        $image = 'storage/media/blog/category/'.$category->image;
        unlink(public_path($image));
        $category->delete();

        $notification = [
            'message'       =>  'Post category deleted successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }
}

