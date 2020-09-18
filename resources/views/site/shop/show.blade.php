@extends('layouts.site', ['categories' => $categories])
@section('title') {{ $product->name }} @endsection
@section('content')
    <div class="hero-wrap hero-bread" style="background-image: url({{ asset('frontend/images/bg_1.jpg') }});">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span class="mr-2"><a href="index.html">Product</a></span> <span>Product Single</span></p>
                    <h1 class="mb-0 bread">Product Single</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="images/product-1.jpg" class="image-popup"><img src="{{ asset('storage/media/product/'. $product->image) }}" class="img-fluid" alt="{{ $product->name }}"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>Bell Pepper</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                            <a href="#"><span class="ion-ios-star-outline"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">500 <span style="color: #bbb;">Sold</span></a>
                        </p>
                    </div>
                    @if ($product->discount_price)
                        <p class="price"><span class="mr-2 price-dc"><small>&#8358;<del>{{ $product->price }}</del></small></span><span class="price-sale">&#8358;{{ $product->discount_price }}</span></p>
                    @else
                        <p class="price"><span>&#8358;{{ $product->price }}</span></p>
                    @endif
                    <p>{{ $product->description }}</p>
                    <div class="row mt-4">

                        <div class="w-100"></div>
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn"  data-type="minus" data-field=""><i class="ion-ios-remove"></i></button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field=""><i class="ion-ios-add"></i></button>
                            </span>
                        </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;">{{ $product->weight }} kg available</p>
                    </div>
                </div>
                <p><a href="cart.html" class="btn btn-black py-3 px-5">Add to Cart</a></p>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Products</span>
                <h2 class="mb-4">Related Products</h2>
                {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> --}}
            </div>
        </div>
        </div>
        <div class="container">
            <div class="row">
                @foreach ($related as $product)
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
                                        <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                        <a href="#" class="heart d-flex justify-content-center align-items-center ">
                                            <span><i class="ion-ios-heart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('site.inc.newsletter')

@endsection

@push('scripts')

@endpush
