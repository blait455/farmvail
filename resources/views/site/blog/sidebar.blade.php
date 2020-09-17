<div class="col-lg-4 sidebar ftco-animate">
    <div class="sidebar-box">
        <form action="{{ route('post.search') }}" method="GET" class="search-form">
            @csrf
            <div class="form-group">
                <span class="icon ion-ios-search"></span>
                <input type="text" class="form-control" name="search" placeholder="Search...">
            </div>
        </form>
    </div>
    <div class="sidebar-box ftco-animate">
        <h3 class="heading">Categories</h3>
        <ul class="categories">
            @foreach ($post_categories as $category)
                <li><a href="{{ route('post.category', $category->id) }}">{{ $category->name }} <span>(12)</span></a></li>
            @endforeach
        </ul>
    </div>

    <div class="sidebar-box ftco-animate">
        <h3 class="heading">Recent Blog</h3>
        @foreach ($recents as $post)
            <div class="block-21 mb-4 d-flex">
                <a href="{{ route('post.single', $post->slug) }}" class="blog-img mr-4" style="background-image: url({{ asset('storage/media/blog/post/'.$post->image) }});"></a>
                <div class="text">
                    <h3 class="heading-1"><a href="{{ route('post.single', $post->slug) }}">{{ $post->title }}</a></h3>
                    <div class="meta">
                        <div><a href="#"><span class="icon-calendar"></span> {{date_format($post->created_at,"d M, Y")}}</a></div>
                        <div><a href="#"><span class="icon-person"></span> {{ $post->user->name }}</a></div>
                        <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="sidebar-box ftco-animate">
        <h3 class="heading">Tag Cloud</h3>
        <div class="tagcloud">
            @foreach ($tags as $tag)
                <a href="{{ route('post.tag', $tag->slug) }}" class="tag-cloud-link">{{ $tag->name }}</a>
            @endforeach
        </div>
    </div>
</div>
