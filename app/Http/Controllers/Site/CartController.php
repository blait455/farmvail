<?php

namespace App\Http\Controllers\Site;

use App\Cart;
use App\Product;
use App\Category;
use App\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCart()
    {
        $cart = Cart::getContent();
        // dd($cart);
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();

        return view('site.cart', compact('categories', 'wishlist', 'cart'));
    }

    // public function removeItem($id)
    // {
    //     Cart::remove($id);

    //     if (Cart::isEmpty()) {
    //         return redirect('/');
    //     }
    //     return redirect()->back()->with('message', 'Item removed from cart successfully.');
    // }

    public function clearCart()
    {
        Cart::clear();

        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        $cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();
        // dd(count($cart));

        return view('site.cart', compact('categories', 'wishlist', 'cart'));
    }

    /**
     * Add to cart from btn
     *
     */
    public function add(Request $request, $slug){

        // if (empty($request->slug)) {
        //     return back()->withErrors('Invalid product!');
        // }

        $product = Product::where('slug', $slug)->first();
        if (empty($product)) {
            return back()->withErrors('Invalid product!');
        }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->where('product_id', $product->id)->first();

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + 1;
            if ($product->discount_price) {
                $already_cart->price = $product->discount_price;
            } else {
                // $already_cart->price = $product->price + $already_cart->price ;
                $already_cart->price = $product->price;
            }
            $already_cart->total = $already_cart->price * $already_cart->quantity;
            if ($already_cart->product->quantity < $already_cart->quantity || $already_cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');
            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            if ($product->discount_price) {
                $price = $product->discount_price;
            } else {
                $price = $product->price;
            }
            $cart->price = $price;
            $cart->quantity = 1;
            $cart->total = $price * $cart->quantity;
            if ($cart->product->quantity < $cart->quantity || $cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');
            $cart->save();
        }
        return back()->with('success','Product added to cart.');
    }

    /**
     * Add to cart from single product page
     *
     */
    public function addSingle(Request $request, $slug){
        $request->validate([
            'price'      =>  'required',
            'qty'      =>  'required',
        ]);

        $product = Product::where('slug', $slug)->first();
        // if ( ($request->qty < 1) || empty($product) ) {
        //     return back()->withErrors('Something wrong. Try again!');
        // }

        $already_cart = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->where('product_id', $product->id)->first();

        if($already_cart) {
            $already_cart->quantity = $already_cart->quantity + $request->qty;
            $already_cart->price = $request->price;
            $already_cart->total = $already_cart->price * $already_cart->quantity;

            if ($already_cart->product->quantity < $already_cart->quantity || $already_cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');

            $already_cart->save();

        }else{

            $cart = new Cart;
            $cart->user_id = auth()->user()->id;
            $cart->product_id = $product->id;
            $cart->price = ($request->price);
            $cart->quantity = $request->qty;
            $cart->total = ($request->price * $request->qty);

            if ($cart->product->quantity < $cart->quantity || $cart->product->quantity <= 0) return back()->withErrors('Stock not sufficient!.');

            $cart->save();
        }
        return back()->with('success','Product added to cart.');
    }

    /**
     * Delete item from cart page
     *
     */
    public function removeItem($id){
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            return back()->with('success','Cart removed!');
        }
        return back()->withErrors('Invalid card');
    }

    /**
     * Cart update from cart page
     *
     */
    public function addToUpdate(Request $request, $id){
        if($request->qty){

            $error = array();
            $success = '';

            // foreach ($request->qty as $k=>$qty) {

                // $id = $request->qty_id[$k];
                $qty = $request->qty;

                $cart = Cart::find($id);

                if ($qty>0 && $cart) {
                    $cart->quantity = ($cart->product->quantity > $qty) ? $qty  : $cart->product->quantity;
                    // if ($cart->product->quantity <=0) continue;
                    if ($cart->product->discount_price) {
                        $price = $cart->product->discount_price;
                    } else {
                        $price = $cart->product->price;
                    }
                    // dd($price);
                    $cart->price = $price;
                    $cart->total = $price * $qty;
                    $cart->save();
                    $success = 'Cart updated!';
                }else{
                    $error[] = 'Cart Invalid!';
                }
            // }
            return back()->withErrors($error)->with('success', $success);
        }else{
            return back()->withErrors('Cart Invalid!');
        }
    }

    /**
     * Cart clear
     *
     */
    public function clear() {
        $cart = Cart::where('user_id', Auth::id())->get();
        foreach ($cart as $item) {
            $item->delete();
        }

        return redirect()->back();
    }

    /**
     * Cart checkout
     *
     */
    public function checkout(){

        $orders = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->get();

        if ($orders->isEmpty()) {

           $data = array(
                'orders'=>[],
                'total_price'=> 0.00
            );

        }else{
            $total_price = Cart::where('user_id', auth()->user()->id)->where('order_id', null)->sum('price');
            $data = array(
                'orders'=>$orders,
                'total_price'=> $total_price
            );
        }

        return view('shop.checkout')->with($data);
    }
}
