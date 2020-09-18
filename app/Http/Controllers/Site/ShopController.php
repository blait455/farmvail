<?php

namespace App\Http\Controllers\Site;

use App\Product;
use App\Category;
use App\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function show(Request $request) {
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $product = Product::where('status', 1)->where('slug', $request->slug)->first();
        $related = Product::where('status', 1)->where('category_id', $product->category->id)->orderBy('id', 'desc')->limit(4)->get();

        return view('site.shop.show', compact('categories', 'product', 'related', 'wishlist'));
    }

    public function categoryProduct($id) {
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $products = Product::where('status', 1)->where('category_id', $id)->paginate(12);

        return view('site.shop.index', compact('categories', 'products', 'wishlist'));
    }
}
