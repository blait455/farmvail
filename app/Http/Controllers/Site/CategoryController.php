<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $product = Category::where('slug', $slug)->first();

        return view('pages.category', compact('category'));
    }

}
