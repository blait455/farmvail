<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $products = Product::all();

        return view('panel.products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('panel.products.create', compact('categories'));
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'      =>  'required|unique:products|max:100',
            'image'     =>  'image',
            'price'     =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'special_price'     =>  'regex:/^\d+(\.\d{1,2})?$/',
            'quantity'  =>  'required|numeric',
        ]);

        $status = isset($request->status[0]) ? 1 : 0;
        $featured = isset($request->featured[0]) ? 1 : 0;

        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->status = $status;
        $product->featured = $featured;
        if ($request->hasFile('image')) {
            $product->image = $this->saveProductImage($request);
        }
        $product->save();

        return redirect()->route('panel.products.index');
    }

    public function edit($id) {
        $product = Product::find($id);
        $categories = Category::all();

        return view('panel.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'name'      =>  'required|max:100',
            'image'     =>  'image',
            'price'     =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'special_price'     =>  'regex:/^\d+(\.\d{1,2})?$/',
            'quantity'  =>  'required|numeric',
        ]);

        $status = isset($request->status[0]) ? 1 : 0;
        $featured = isset($request->featured[0]) ? 1 : 0;

        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->price = $request->price;
        $product->discount_price = $request->special_price;
        $product->status = $status;
        $product->featured = $featured;
        if ($request->hasFile('image')) {
            $this->deleteProductImage($product);
            $product->image = $this->saveProductImage($request);
        }
        $product->update();

        return redirect()->route('panel.products.index');
    }

    public function delete($id) {
        $product = Product::find($id);
        $this->deleteProductImage($product);
        $product->delete();

        return redirect()->back();
    }

    private function deleteProductImage($product){
        if( $product->image ){
            $imgDestroy = public_path('storage/media/product/'.$product->image);
            if ( file_exists($imgDestroy) ) unlink($imgDestroy);
        }
    }

    private function saveProductImage($request){
        $image = $request->file('image');
        $filenameWithExtension = $image->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $image->storeAs('public/media/product', $filenameToStore);

        return $filenameToStore;
    }
}
