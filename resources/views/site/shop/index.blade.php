@extends('layouts.site', ['categories' => $categories, 'wishlist' => $wishlist])
@section('title') Shop @endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('frontend/images/bg_1.jpg') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Products</span></p>
                    <h1 class="mb-0 bread">Products</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5 text-center">
                    <ul class="product-category">
                        <li><a href="{{ route('shop') }}" class="active">All</a></li>
                        @foreach ($categories as $category)
                            @if ($category->id != 1)
                                <li><a href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="{{ route('shop.single', $product->slug) }}" class="img-prod"><img class="img-fluid" src="{{ asset('storage/media/product/'. $product->image) }}" alt="Colorlib Template">
                                @if ($product->discount_price)
                                    <span class="status">-{{ intval($product->price - $product->discount_price) }}%</span>
                                @endif
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="{{ route('shop.single', $product->slug) }}">{{ $product->name }}</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        @if ($product->discount_price)
                                            <p class="price"><span class="mr-2 price-dc">&#8358;{{ $product->price }}</span><span class="price-sale">&#8358;{{ $product->discount_price }}</span></p>
                                        @else
                                            <p class="price"><span>&#8358;{{ $product->price }}</span></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="{{ route('shop.single', $product->slug) }}" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a href="{{ route('cart.add', $product->slug) }}" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a href="{{ route('wishlist.add', $product->id) }}" class="heart d-flex justify-content-center align-items-center ">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row mt-5">
            <div class="col text-center">
            <div class="block-27">
                <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
                </ul>
            </div>
            </div>
        </div>
        </div>
    </section>

    @include('site.inc.newsletter')

@endsection
