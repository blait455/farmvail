<?php

namespace App\Http\Controllers\Site;

use App\Banner;
use App\Partner;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Testimony;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        $banners = Banner::all();
        $products = Product::all();
        $partners = Partner::all();
        $categories = Category::all();
        $category = Category::inRandomOrder()->first();
        $categories_desc = Category::orderBy('id', 'desc')->limit(2)->get();
        $categories_asc = Category::whereNotIn('id', [1])->orderBy('id', 'asc')->limit(2)->get();
        $testimonies = Testimony::where('status', 1)->get();
        // dd($testimonies);
        return view('site.index', compact('banners', 'categories', 'category', 'categories_desc', 'categories_asc', 'partners', 'products', 'testimonies'));
    }

    public function shop() {
        $categories = Category::all();

        return view('site.shop', compact('categories'));
    }

    public function about() {
        $categories = Category::all();
        $testimonies = Testimony::where('status', 1)->get();

        return view('site.about', compact('categories', 'testimonies'));
    }

    public function blog() {
        $categories = Category::all();

        return view('site.blog', compact('categories'));
    }

    public function contact() {
        $categories = Category::all();

        return view('site.contact', compact('categories'));
    }
}
