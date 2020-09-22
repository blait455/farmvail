@extends('layouts.site', ['categories' => $categories, 'wishlist' => $wishlist, 'cart' => $cart])
@section('title') Home @endsection
@section('content')
    @include('site.inc.banner', ['banners' => $banners])
    @include('site.inc.services')
    @include('site.inc.category', ['categories_asc' => $categories_asc, 'categories_desc' => $categories_desc, 'category' => $category])
    @include('site.inc.featured', ['products' => $products])
    @include('site.inc.deal')
    @include('site.inc.testimonial', ['testimonies' => $testimonies])
    <hr>
    @include('site.inc.partners', ['partners' => $partners])
    @include('site.inc.newsletter')
@endsection
