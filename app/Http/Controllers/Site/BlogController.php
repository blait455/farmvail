<?php

namespace App\Http\Controllers\Site;

use App\User;
use App\Tag;
use App\Post;
use App\Category;
use App\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function single(Request $request) {
        // $setting = Settings::first();
        $categories = Category::all();
        $tags = Tag::all();
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();
        $post_categories = PostCategory::all();
        $post = Post::where('status', 'publish')->where('slug', $request->slug)->first();
        // $wishlist = Wishlist::where('user_id', Auth::id())->get();

        return view('site.blog.single', compact('post', 'post_categories', 'tags', 'recents', 'categories'));
    }

    public function CategoryPost($id) {
        $tags = Tag::all();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $posts = Post::where('status', 'publish')->where('category_id', $id)->paginate(10);
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts'));
    }

    public function TagPost(Request $request) {
        $tags = Tag::all();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $posts = Tag::where('slug', $request->slug)->first()->posts()->paginate(10);
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();
        // $data = array(
        //     'title' =>  Tag::where('slug', $request->slug)->first()->name,
        //     'posts' => Tag::where('slug', $request->slug)->first()->posts()->paginate(10)
        // );

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts'));

    }

    public function UserPost(Request $request) {
        $posts = User::find($request->id)->posts()->paginate(10);
        $tags = Tag::all();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts'));
    }

    public function show(Request $request){
        $post = Post::where('slug', $request->slug)->first();
        $previous = Post::where('id', '<', $post->id)->orderBy('id','desc')->first();
        $next = Post::where('id', '>', $post->id)->orderBy('id')->first();

        $data = array(
            'post' => $post,
            'previous' => $previous,
            'next' => $next
        );

    	return view('post.single')->with($data);
    }

    public function search(Request $request){
        $tags = Tag::all();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();
        $item = $request->search;
        // $products = Product::where('status', 1)->where('name', 'LIKE', "%$item%")->paginate(10);
        $posts = Post::orWhere('title', 'like', "%$item%" )
                    ->orWhere('body', 'like', "%$item%" )
                    ->orWhere('slug', 'like', "%$item%" )
                    ->orderBy('id', 'desc')
                    ->paginate(9);

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts'));
    }
}
