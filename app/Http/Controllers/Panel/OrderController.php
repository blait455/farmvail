<?php

namespace App\Http\Controllers\Panel;

use Auth;
use Session;
use App\Cart;
use App\Order;
use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $orders = Order::all();
        // if(Auth::check()) {
        //     if ($user_id == '') $user_id = auth()->user()->id;
        //     return Cart::where('user_id', $user_id)->where('order_id', $id)->sum('quantity');
        // }

        return view('panel.order.index', compact('orders'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'first_name'      =>  'required',
        //     'last_name'      =>  'required',
        //     'address'      =>  'required',
        //     'state'      =>  'required',
        //     'town'      =>  'required|string',
        //     'post_code'      =>  'required',
        //     'phone'      =>  'required',
        //     // 'shipping'      =>  'required',
        //     'payment'      =>  'required|in:cash,transfer,paystack',
        //     // 'transectionId'      =>  'string|min:3',
        // ]);

        if ( empty(Cart::where('user_id', auth()->user()->id)->where('order_id', null)->first()) ) {
            return back()->withErrors('Cart empty!');
        }

        $payment_method = $request->payment;
        // $transectionId = null;

        if ($payment_method == 'transfer') {
            return view('site.payment.transfer', compact('cart', 'request', 'categories', 'settings', 'wishlist'));
        } elseif ($payment_method == 'paystack') {
            return view('site.payment.paystack', compact('request'));
        }

        $order = new Order;
        $order->order_number = 'ORD-'.strtoupper(uniqid());
        $order->user_id = auth()->user()->id;

        $order->status = 'pending';

        // $order->shipping_id = $request->shipping;

        // if(empty(auth()->user()->address)){
        //     $address = new Address;
        //     $address->user_id = auth()->user()->id;
        //     $address->first_name = $request->first_name;
        //     $address->last_name = $request->last_name;
        //     $address->address = $request->address;
        //     $address->city_id = $request->city;
        //     $address->country = $request->country;
        //     $address->post_code = $request->post_code;
        //     $address->phone_number = $request->phone_number;
        //     $address->save();
        // }

        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->address = $request->address;
        $order->city_id = $request->state;
        $order->state = $request->town;
        $order->post_code = $request->post_code;
        $order->phone_number = $request->phone;
        // $order->email = $request->email;
        $order->notes = $request->notes;
        if(Session::has('discount')){
            $order->coupon_id = Session::get('discount')['id'];
            Session::forget('discount');
        }

        $order->save();
        // dd($order);

        Cart::where('user_id', auth()->user()->id)->where('order_id', null)->update(['order_id' => $order->id]);

        $transactionId = $order->order_number;

        $payment = new Payment;
        $payment->user_id = auth()->user()->id;
        $payment->order_id = $order->id;

        $payment->payment_method = $payment_method;
        $payment->transaction_id = $transactionId;
        $payment->status = 'unpaid';
        $payment->save();
        Order::find($order->id)->where('user_id', auth()->user()->id)->update(['payment_id' => $payment->id]);

        // $users = User::where('is_admin', 1)->get();
        // $details = [
        //     'title' => 'New order created!',
        //     'actionURL' => route('admin.product.order.show', $order->id),
        //     'fas' => 'fa-file-alt'
        // ];
        // Notification::send($users, new ShopNotification($details));

        return redirect()->route('shop')->with('success','Your order success!.');
    }

    public function edit($id) {
        $order = Order::find($id);

        return view('panel.order.edit', compact('order'));
    }

    public function paid($id) {
        $order = Order::find($id);
        $payment = Payment::where('order_id', $id)->first();
        $payment->status = 'paid';
        $order->status = 'processing';

        $payment->update();
        $order->update();

        $notification = [
            'message'       =>  'payment confirmed successfully. order is processing',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function unpay($id) {
        $order = Order::find($id);
        $payment = Payment::where('order_id', $id)->first();
        $payment->status = 'unpaid';
        if ($order->status != 'completed') {
            $payment->update();

            $notification = [
                'message'       =>  'Payment declined',
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message'       =>  'Order is completed already !!',
                'alert-type'    =>  'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function processing($id) {
        $order = Order::find($id);
        $order->status = 'processing';
        $order->update();

        $notification = [
            'message'       =>  'Order is processing',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function completed($id) {
        $order = Order::find($id);
        $payment = Payment::where('order_id', $id)->first();
        $order->status = 'completed';
        // dd($payment->status);
        // ($payment->status == 'paid') ? 'completed'  : '' ;
        if ($payment->status == 'paid') {
            $order->update();

            $notification = [
                'message'       =>  'Order confirmed successfully',
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message'       =>  'Payment not completed yet !!',
                'alert-type'    =>  'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function decline($id) {
        $order = Order::find($id);
        $order->status = 'decline';
        $order->update();

        $notification = [
            'message'       =>  'Order confirmed successfully',
            'alert-type'    =>  'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function delete($id) {
        $order = Order::find($id);
        $order->delete();

        return redirect()->back();
    }
}
