<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\User;
use App\Tag;
use App\Post;
use App\Category;
use App\Wishlist;
use App\PostCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function single(Request $request) {
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
        // $setting = Settings::first();
        $categories = Category::all();
        $tags = Tag::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();
        $post_categories = PostCategory::all();
        $post = Post::where('status', 'publish')->where('slug', $request->slug)->first();
        // $wishlist = Wishlist::where('user_id', Auth::id())->get();

        return view('site.blog.single', compact('post', 'post_categories', 'tags', 'recents', 'categories', 'wishlist', 'cart'));
    }

    public function CategoryPost($id) {
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
        $tags = Tag::all();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $posts = Post::where('status', 'publish')->where('category_id', $id)->paginate(10);
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts', 'cart'));
    }

    public function TagPost(Request $request) {
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
        $tags = Tag::all();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $posts = Tag::where('slug', $request->slug)->first()->posts()->paginate(10);
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();
        // $data = array(
        //     'title' =>  Tag::where('slug', $request->slug)->first()->name,
        //     'posts' => Tag::where('slug', $request->slug)->first()->posts()->paginate(10)
        // );

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts', 'cart'));

    }

    public function UserPost(Request $request) {
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
        $posts = User::find($request->id)->posts()->paginate(10);
        $tags = Tag::all();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts', 'cart'));
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
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
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

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts', 'cart'));
    }
}
