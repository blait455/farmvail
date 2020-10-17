@extends('layouts.site', ['categories' => $categories, 'wishlist' => $wishlist])
@section('title') Checkout @endsection
<script language="JavaScript" type="text/javascript">
    function getform( )
    {
      document.subform.submit() ;
    }
</script>
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('frontend/images/bg_1.jpg') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Checkout</span></p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <form name="subform" action="{{ route('panel.order.store') }}" class="billing-form" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-xl-7 ftco-animate">
                            <h3 class="mb-4 billing-heading">Billing Details</h3>
                            <div class="row align-items-end">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="firstname">Firt Name</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lastname">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="country">State </label>
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">France</option>
                                                <option value="">Italy</option>
                                                <option value="">Philippines</option>
                                                <option value="">South Korea</option>
                                                <option value="">Hongkong</option>
                                                <option value="">Japan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="streetaddress">Street Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="House number and street name">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="towncity">Town / City</label>
                                        <input type="text" class="form-control" name="town" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="postcodezip">Postcode / ZIP *</label>
                                        <input type="text" class="form-control" name="post_code" placeholder="">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="emailaddress">Email Address</label>
                                        <input type="text" class="form-control" name="email" placeholder="">
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                {{-- <div class="col-md-12">
                                    <div class="form-group mt-4">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                                            <label><input type="radio" name="optradio"> Ship to different address</label>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <div class="col-xl-5">
                            <div class="row mt-5 pt-3">
                                <div class="col-md-12 d-flex mb-5">
                                    <div class="cart-detail cart-total p-3 p-md-4">
                                        <h3 class="billing-heading mb-4">Cart Total</h3>
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
                                </div>
                                <div class="col-md-12">
                                    <div class="cart-detail p-3 p-md-4">
                                        <h3 class="billing-heading mb-4">Payment Method</h3>
                                        {{-- <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="payment" value="transfer" class="mr-2"> Direct Bank Tranfer</label>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="payment" value="cash" class="mr-2"> Cash on Delivery</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="radio">
                                                    <label><input type="radio" name="payment" value="paystack" class="mr-2"> Paystack</label>
                                                </div>
                                            </div>
                                        </div>
                                        <p><a href="javascript:getform()"class="btn btn-primary py-3 px-4">Place an order</a></p>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .col-md-8 -->
                    </div>
                </form>
            </div>
        </div>
    </section> <!-- .section -->

    @include('site.inc.newsletter')

@endsection
