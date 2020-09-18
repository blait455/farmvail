<?php

namespace App\Http\Controllers\Site;

use App\Tag;
use App\Post;
use App\Banner;
use App\Partner;
use App\Category;
use App\Wishlist;
use App\PostCategory;
use App\Http\Controllers\Controller;
use App\Product;
use App\Testimony;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index() {
        $banners = Banner::all();
        $products = Product::all();
        $partners = Partner::all();
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $category = Category::inRandomOrder()->first();
        $categories_desc = Category::orderBy('id', 'desc')->limit(2)->get();
        $categories_asc = Category::whereNotIn('id', [1])->orderBy('id', 'asc')->limit(2)->get();
        $testimonies = Testimony::where('status', 1)->get();
        // dd($testimonies);
        return view('site.index', compact('banners', 'categories', 'category', 'categories_desc', 'categories_asc', 'partners', 'products', 'testimonies', 'wishlist'));
    }

    public function shop() {
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $products = Product::where('status', '1')->paginate(10);

        return view('site.shop.index', compact('categories', 'products', 'wishlist'));
    }

    public function about() {
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $testimonies = Testimony::where('status', 1)->get();

        return view('site.about', compact('categories', 'testimonies', 'wishlist'));
    }

    public function blog() {
        $tags = Tag::all();
        $posts = Post::where('status', 'publish')->get();
        $categories = Category::all();
        $post_categories = PostCategory::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $recents = Post::where('status', 'publish')->orderBy('id', 'desc')->limit(3)->get();

        return view('site.blog.index', compact('categories', 'post_categories', 'recents', 'tags', 'posts', 'wishlist'));
    }

    public function contact() {
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();

        return view('site.contact', compact('categories','wishlist'));
    }

    public function wishlist() {
        // $user = Auth::id();
        // $items = Cart::content();
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();

        // $user_list = Wishlist::where('user_id', $user)->first();
        // $den = $user_list->products;
        // dd($den);

        return view('site.wishlist', compact('categories', 'wishlist'));
    }
}
