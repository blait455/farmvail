@extends('layouts.site', ['categories' => $categories])
@section('title') {{ $post->title }} @endsection
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
                <h2 class="mb-3">{{ $post->title }}</h2>
                <p>{!! $post->body !!}</p>
                <div class="tag-widget post-tag-container mb-5 mt-5">
                    <div class="tagcloud">
                        @foreach ($post->tags as $tag)
                            <a href="#" class="tag-cloud-link">{{ $tag->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="about-author d-flex p-4 bg-light">
                    <div class="bio align-self-md-center mr-4">
                        {{-- <img src="{{ asset('storage/media/user/'.$post->user->picture) }}" alt="{{ $post->user->name }}" class="img-fluid mb-4"> --}}
                        <img src="images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
                    </div>
                    <div class="desc align-self-md-center">
                        <h3>{{ $post->user->name }}</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
                        {{-- <p>{{ $post->user->bio }}</p> --}}
                    </div>
                </div>


                <div class="pt-5 mt-5">
                    @include('site.blog.comment_list')
                    <!-- END comment-list -->

                    @include('site.blog.comment')
                </div>
            </div> <!-- .col-md-8 -->
            @include('site.blog.sidebar', ['post_categories' => $post_categories, 'recents' => $recents, 'tags' => $tags])
        </div>
    </div>
</section>
@endsection
