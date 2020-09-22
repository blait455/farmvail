<?php

namespace App\Http\Controllers\Site;

use Cart;
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

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $options = $request->except('_token', 'productId', 'price', 'qty');
        // dd($options);

        Cart::add(uniqid(), $product->name, $request->input('price'), $request->input('qty'), $options);

        return redirect()->back()->with('message', 'Item added to cart successfully.');
    }
}
