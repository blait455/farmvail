<?php

namespace App\Http\Controllers\Site;

use App\Product;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function show(Request $request) {
        $categories = Category::all();
        $product = Product::where('status', 1)->where('slug', $request->slug)->first();
        $related = Product::where('status', 1)->where('category_id', $product->category->id)->orderBy('id', 'desc')->limit(4)->get();

        return view('site.shop.show', compact('categories', 'product', 'related'));
    }

    public function categoryProduct($id) {
        $categories = Category::all();
        $products = Product::where('status', 1)->where('category_id', $id)->paginate(12);

        return view('site.shop.index', compact('categories', 'products'));
    }
}
