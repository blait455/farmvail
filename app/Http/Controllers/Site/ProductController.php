<?php

namespace App\Http\Controllers\Site;

use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param $slug
     * @return mixed
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('pages.product.show', compact('product'));
    }
}
