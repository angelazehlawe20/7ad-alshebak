<!-- Offers Section -->
<section id="offers" class="offers section light-background py-5">
    <!--Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <p><span>Had AlShebak</span> <span class="description-title">Offers</span></p>
    </div><!-- End Section Title -->
    <div class="container">
        <div class="row gy-4">
            @forelse($offers->take(3) as $offer)
                <div class="col-lg-4 col-md-6 col-6">
                    <div class="card h-100 shadow">
                        <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top offer-img img-fluid" alt="{{ $offer->title }}">
                        <div class="card-body">
                            <div class="mb-3">
                                <h3 class="card-title h4 mb-2">{{ $offer->title_en }}</h3>
                                <h3 class="card-title h4 text-secondary">{{ $offer->title_ar }}</h3>
                            </div>
                            <p class="card-text">{{ $offer->description_en }}</p>
                            <p class="card-text">{{ $offer->description_ar }}</p>
                            <p class="card-text"><i class="far fa-calendar-alt me-2"></i>Valid until: {{ $offer->valid_until }}</p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-tag me-2"></i>Category: {{ $offer->category->name_en }} - {{ $offer->category->name_ar }}</small></p>
                            <p class="card-price text-danger fw-bold fs-4">{{ $offer->price }} $</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-tag fa-4x text-secondary mb-3"></i>
                        <h4 class="text-secondary">No offers found at the moment.</h4>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('all_offers') }}" class="btn btn-lg px-5 py-3" style="background-color:#ec1111; color:white;">
                See All Offers
            </a>
        </div>
    </div>
</section> <!-- End Offers Section -->
