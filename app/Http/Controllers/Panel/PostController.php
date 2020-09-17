<?php

namespace App\Http\Controllers\Panel;

use Image;
use Illuminate\Support\Str;
use App\Post;
use App\Tag;
use App\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $posts = Post::all();

        return view('panel.blog.posts.index', compact('posts'));
    }

    public function create() {
        $categories = PostCategory::all();
        $tags = Tag::all();

        return view('panel.blog.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request) {
        $request->validate([
            'title'      =>  'required|max:150',
            'body'      =>  'required',
        ]);
        // dd($request);
        $post = new Post;
        $post->category_id = $request->input('category_id');
        // $post->tag_id = $request->input('tag_id');
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;
        $post->save();

        if ($request->hasFile('image')) {
            $post->image = $this->savePostImage($post, $request);
        }

        // $categories = PostCategory::find((array)$request->category);
        // $post->categories()->attach($categories);

        $tags = Tag::find((array)$request->tags);
        $post->tags()->attach($tags);

        $notification = [
            'message'       =>  'Post added successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->route('panel.blog')->with($notification);
    }

    public function show($id) {
        return view('admin.blog.post.show');
    }

    public function edit($id) {
        $tags = Tag::all();
        $post = Post::find($id);
        $categories = PostCategory::all();

        return view('panel.blog.posts.edit', compact('tags', 'post', 'categories'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title'      =>  'required|max:150',
            'body'      =>  'required',
        ]);

        $post = Post::find($id);
        $post->category_id = $request->input('category_id');
        // $post->tag_id = $request->input('tag_id');
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->body = $request->body;
        $post->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $this->deletPostImage($post);
            $post->image = $this->savePostImage($post, $request);
        }

        $post->tags()->detach(); //Delete existing tags
        $tags = Tag::find((array)$request->tags);
        $post->tags()->attach($tags);

        $post->update();

        $notification = [
            'message'       =>  'Post updated successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->route('panel.blog')->with($notification);
    }

    public function delete($id) {
        $post = Post::find($id);
        $post->tags()->detach(); //Delete existing tags
        $this->deletPostImage($post);
        $post->delete();

        $notification = [
            'message'       =>  'Post deleted successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    private function deletPostImage($post){
        if( $post->image ){
            $imgDestroy = public_path('storage/media/blog/post/'.$post->image);
            // $imgDestroy_sm = public_path('storage/media/blog/post/small/'.$post->image);
            // $imgDestroy_thumb = public_path('storage/media/blog/post/thumb/'.$post->image);

            if ( file_exists($imgDestroy) ) unlink($imgDestroy);
            // if ( file_exists($imgDestroy_sm) ) unlink($imgDestroy_sm);
            // if ( file_exists($imgDestroy_thumb) ) unlink($imgDestroy_thumb);
        }
    }

    private function savePostImage($post, $request){
        $image = $request->file('image');
        $filenameWithExtension = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;

        // $location_sm = public_path('media/blog/post/small/'.$filenameToStore);
        // $location_thumb = public_path('media/blog/post/thumb/'.$filenameToStore);
        // $location = public_path('media/blog/post/'.$filenameToStore);

        // Image::make($image)->resize(89, 89)->save($location_sm);
        // Image::make($image)->resize(360, 250)->save($location_thumb);
        // Image::make($image)->save($location);

        // Image::make($image)->resize(89, 89);
        // $image->storeAs('public/media/blog/post/small', $filenameToStore);

        // Image::make($image)->resize(360, 250);
        // $image->storeAs('public/media/blog/post/thumb', $filenameToStore);

        // Image::make($image);
        $image->storeAs('public/media/blog/post', $filenameToStore);

        return $filenameToStore;
    }

    public function publish($id) {
        $post = Post::find($id);
        $post->status = 'publish';
        $post->update();

        $notification = [
            'message'       =>  'Post published successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function draft($id) {
        $post = Post::find($id);
        $post->status = 'draft';
        $post->update();

        $notification = [
            'message'       =>  'Post now as draft',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

}
