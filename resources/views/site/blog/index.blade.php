@extends('layouts.site', ['categories' => $categories])
@section('title') Blog @endsection
@section('content')
<div class="hero-wrap hero-bread" style="background-image: url({{ asset('frontend/images/bg_1.jpg') }});">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Blog</span></p>
          <h1 class="mb-0 bread">Blog</h1>
        </div>
      </div>
    </div>
  </div>

<section class="ftco-section ftco-degree-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-md-12 d-flex ftco-animate">
                            <div class="blog-entry align-self-stretch d-md-flex">
                                <a href="{{ route('post.single', $post->slug) }}" class="block-20" style="background-image: url({{ asset('storage/media/blog/post/'.$post->image) }});"></a>
                                <div class="text d-block pl-md-4">
                                    <div class="meta mb-3">
                                        <div><a href="#">{{date_format($post->created_at,"d M, Y")}}</a></div>
                                        <div><a href="#">{{ $post->user->name }}</a></div>
                                        <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                    </div>
                                    <h3 class="heading"><a href="{{ route('post.single', $post->slug) }}">{{ $post->title }}</a></h3>
                                    <p>{!! \Illuminate\Support\Str::limit($post->body, 200, ' ...') !!}</p>
                                    <p><a href="{{ route('post.single', $post->slug) }}" class="btn btn-primary py-2 px-3">Read more</a></p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @include('site.blog.sidebar', ['post_categories' => $post_categories, 'recents' => $recents, 'tags' => $tags])
        </div>
    </div>
</section>
@endsection
