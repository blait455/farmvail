@extends('layouts.site', ['categories' => $categories, 'wishlist' => $wishlist])
@section('title') Wishlist @endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('frontend/images/bg_1.jpg') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Wishlist</span></p>
                    <h1 class="mb-0 bread">My Wishlist</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        @if (count($wishlist) > 0)
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th>&nbsp;</th>
                                        <th>Product List</th>
                                        <th>&nbsp;</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlist as $item)
                                        <tr class="text-center">
                                            <td class="product-remove"><a href="{{ route('wishlist.remove', $item->id) }}"><span class="ion-ios-close"></span></a></td>

                                            <td class="image-prod"><div class="img" style="background-image:url({{ asset('storage/media/product/'. $item->product->image) }});"></div></td>

                                            <td class="product-name">
                                                <h3>{{ $item->product->name }}</h3>
                                                <p>{{ $item->product->description }}</p>
                                            </td>

                                            @if ($item->product->discount_price)
                                                <td class="price">&#8358;{{ $item->product->discount_price }}</td>
                                            @else
                                                <td class="price">&#8358;{{ $item->product->price }}</td>
                                            @endif

                                            <td class="quantity">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                                </div>
                                            </td>

                                            <td class="total">$4.90</td>
                                        </tr><!-- END TR-->
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="text-center">
                                <h3>Your wishlist is empty</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('site.inc.newsletter')

@endsection
