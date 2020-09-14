<section class="ftco-section ftco-partner">
    <div class="container">
        <div class="row">
            @foreach ($partners as $partner)
                <div class="col-sm ftco-animate">
                    <a href="#" class="partner"><img src="{{ asset('storage/media/partner/'. $partner->logo) }}" class="img-fluid" alt="{{ $partner->name }}"></a>
                </div>
            @endforeach
        </div>
    </div>
</section>
