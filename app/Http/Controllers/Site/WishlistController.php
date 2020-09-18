<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Wishlist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = Auth::id();
        // $items = Cart::content();
        $categories = Category::all();
        $wishlist = Wishlist::where('user_id', Auth::id())->get();

        // $user_list = Wishlist::where('user_id', $user)->first();
        // $den = $user_list->products;
        // dd($den);

        return view('site.wishlist', compact('items', 'categories', 'wishlist', 'setting'));
    }

    public function add($id) {
        $user = Auth::id();
        $wish = new Wishlist;
        $check = Wishlist::where('user_id', $user)->where('product_id', $id)->first();


        if (Auth::Check()) {
            if ($check) {

                // return \Response::json(['error' =>  'Product already on wishlist']);
            } else {
                $wish->user_id = $user;
                $wish->product_id = $id;
                $wish->save();

                return redirect()->back();
                // return \Response::json(['success' =>  'Product added to wishlist']);
            }
        } else {

            // return \Response::json(['error' =>  'Login is required']);
        }
    }

    public function remove($id) {
        $list_item = Wishlist::find($id);
        $list_item->delete();

        $notification = [
            'message'   =>  'Product removed from wishlist',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }
}
