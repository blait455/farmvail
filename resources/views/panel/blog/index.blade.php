@extends('layouts.panel')

@section('title', 'Blog')

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"></i> Blog</h1>
        </div>
    </div>
    {{-- @include('admin.partials.flash') --}}
    <div class="row user">
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <li class="nav-item"><a class="nav-link active" href="#category" data-toggle="tab">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#post" data-toggle="tab">Posts</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tag" data-toggle="tab">Tags</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="category">
                    @include('panel.blog.categories.index', ['post_categories' => $post_categories])
                </div>
                <div class="tab-pane fade" id="post">
                    @include('panel.blog.posts.index', ['posts' => $posts])
                </div>
                <div class="tab-pane fade" id="tag">
                    @include('panel.blog.tags.index', ['tags' => $tags])
                </div>
            </div>
        </div>
    </div>
@endsection
