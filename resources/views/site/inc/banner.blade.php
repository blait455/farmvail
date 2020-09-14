<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        @foreach ($banners as $banner)
            <div class="slider-item" style="background-image: url({{ asset('storage/media/banner/'. $banner->image) }});">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">
                        <div class="col-md-12 ftco-animate text-center">
                            <h1 class="mb-2">{{ $banner->title }}</h1>
                            <h2 class="subheading mb-4">{{ $banner->description }}</h2>
                            <p><a href="{{ $banner->link }}" class="btn btn-primary">View Details</a></p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
