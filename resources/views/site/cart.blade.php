@extends('layouts.site', ['categories' => $categories, 'wishlist' => $wishlist])
@section('title') Cart @endsection
<script language="JavaScript" type="text/javascript">
    function getform( )
    {
      document.subform1.submit() ;
    }
</script>
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('frontend/images/bg_1.jpg') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Cart</span></p>
                    <h1 class="mb-0 bread">My Cart</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            @if (count($cart) > 0)
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr class="text-center">
                                            <td class="product-remove"><a href="{{ route('cart.remove', $item->id) }}"><span class="ion-ios-close"></span></a></td>

                                            <td class="image-prod"><div class="img" style="background-image:url({{ asset('storage/media/product/'. $item->product->image) }});"></div></td>

                                            <td class="product-name">
                                                <h3>{{ $item->product->name }}</h3>
                                                <p>{{ $item->product->description }}</p>
                                            </td>

                                            <td class="price">&#8358;{{ $item->price }}</td>

                                            <form action="{{ route('cart.update', $item->id) }}" method="post">
                                                @csrf
                                                <td class="quantity">
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="qty" class="quantity form-control input-number" value="{{ $item->quantity }}" min="1" max="100">
                                                    </div>
                                                </td>

                                                <td class="total">&#8358;{{ $item->total }}</td>
                                                <input type="hidden" name="qty_id">
                                                <td><button type="submit" class="btn btn-sm btn-white">update</button></td>
                                            </form>

                                        </tr><!-- END TR-->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Coupon Code</h3>
                            <p>Enter your coupon code if you have one</p>
                            <form name="subform1" action="{{ route('coupon') }}" class="info" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Coupon code</label>
                                    <input type="text" name="code" class="form-control text-left px-3" placeholder="">
                                </div>
                            </form>
                        </div>
                        <p><a href="javascript:getform()" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Estimate shipping and tax</h3>
                            <p>Enter your destination to get a shipping estimate</p>
                            <form action="#" class="info">
                                <div class="form-group">
                                    <label for="">Country</label>
                                    <input type="text" class="form-control text-left px-3" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="country">State/Province</label>
                                    <input type="text" class="form-control text-left px-3" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="country">Zip/Postal Code</label>
                                    <input type="text" class="form-control text-left px-3" placeholder="">
                                </div>
                            </form>
                        </div>
                        <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
                    </div>
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Cart Totals</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span>&#8358;{{ $sum_total }}</span>
                            </p>
                            <p class="d-flex">
                                <span>Delivery</span>
                                <span>&#8358;{{ config('settings.shipping_fee') }}</span>
                            </p>
                            <p class="d-flex">
                                @if (Session::has('discount'))
                                    <span>Discount</span>
                                    <span>&#8358;{{Session::get('discount')['value']}}</span>
                                    <p class="d-flex"> <span>Coupon</span><span> {{ Session::get('discount')['code'] }} <a href="{{ route('coupon.remove') }}"class="ion-ios-close"></a></span></p>
                                @endif
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                @if (Session::has('discount'))
                                    <span>&#8358;{{ $sum_total + config('settings.shipping_fee') - Session::get('discount')['value']}}</span>
                                @else
                                    <span>&#8358;{{ $sum_total + config('settings.shipping_fee')}}</span>
                                @endif
                            </p>
                        </div>
                        <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                    </div>
                </div>
            @else
                <p class="alert alert-warning">Your shopping cart is empty.</p>
            @endif

        </div>
    </section>

    @include('site.inc.newsletter')

@endsection
