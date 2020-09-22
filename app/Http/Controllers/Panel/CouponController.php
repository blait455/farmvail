<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $coupons = Coupon::all();

        return view('panel.coupon.index', compact('coupons'));
    }

    public function create() {
        return view('panel.coupon.create');
    }

    public function store(Request $request) {
        $coupon = new Coupon;
        $coupon->code = $request->input('code');
        $coupon->value = $request->input('value');
        $coupon->save();

        $notification = [
            'message'       =>  'Coupon added successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->route('panel.coupon.index')->with($notification);
    }

    public function edit($id) {
        $coupon = Coupon::find($id);

        return view('panel.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id) {
        $coupon = Coupon::find($id);
        $coupon->code = $request->input('code');
        $coupon->value = $request->input('value');
        $coupon->type = $request->input('type');
        $coupon->update();

        $notification = [
            'message'       =>  'Coupon updated successfully',
            'alert-type'    =>  'success'
        ];

        return redirect(route('panel.coupon.index'))->with($notification);
    }

    public function delete($id) {
        $coupon = Coupon::find($id);
        $coupon->delete();

        $notification = [
            'message'       =>  'Coupon deleted successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

}
