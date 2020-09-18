<section class="ftco-section ftco-category ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6 order-md-last align-items-stretch d-flex">
                        <div class="category-wrap-2 ftco-animate img align-self-stretch d-flex" style="background-image: url({{ asset('frontend/images/category.jpg') }});">
                            <div class="text text-center">
                                <h2>{{ config('settings.name') }}</h2>
                                <p>Protecting the health of every home</p>
                                <p><a href="{{ route('shop') }}" class="btn btn-primary">Shop now</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        @foreach ($categories_asc as $category)
                            <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url({{ asset('storage/media/product/category/'.$category->image) }});">
                                <div class="text px-3 py-1">
                                    <h2 class="mb-0"><a href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</a></h2>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                @foreach ($categories_desc as $category)
                    <div class="category-wrap ftco-animate img mb-4 d-flex align-items-end" style="background-image: url({{ asset('storage/media/product/category/'.$category->image) }});">
                        <div class="text px-3 py-1">
                            <h2 class="mb-0"><a href="{{ route('shop.category', $category->id) }}">{{ $category->name }}</a></h2>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
