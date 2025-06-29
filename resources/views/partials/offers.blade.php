<!-- Offers Section -->
<section id="offers" class="offers section light-background py-5">
    <!--Section Title -->
    <div class="container section-title">
        @if(app()->getLocale() == 'ar')
        <p>
            <span>{{ __('offers.offers') }}</span>
            <span class="description-title">{{ __('offers.brand_name') }}</span>
        </p>
        @else
        <p>
            <span>{{ __('offers.brand_name') }}</span>
            <span class="description-title">{{ __('offers.offers') }}</span>
        </p>
        @endif

    </div><!-- End Section Title -->
    <div class="container">
        <div class="row gy-4">
            @forelse($offers->take(3) as $offer)
            <div class="col-lg-4 col-md-6 col-6">
                <div class="card h-100 shadow">
                    <img src="{{ asset( $offer->image) }}" class="card-img-top offer-img img-fluid"
                        alt="{{ app()->getLocale() == 'ar' ? $offer->title_ar : $offer->title_en }}">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <h3 class="card-title h4 mb-2">
                                {{ app()->getLocale() == 'ar' ? $offer->title_ar : $offer->title_en }}</h3>
                        </div>
                        <p class="card-text">
                            {{ app()->getLocale() == 'ar' ? $offer->description_ar : $offer->description_en }}</p>

                        @if($offer->valid_until)
                        <div class="text-muted mb-1">
                            <p class="mb-0">
                                <i class="far fa-calendar-alt me-2"></i>
                                {{ __('offers.valid_until') }}:<br> {{ $offer->valid_until->format('Y-m-d') }}
                            </p>
                            <p class="mb-1 ms-4">
                                {{ $offer->valid_until->format('h:i:s A') }}
                            </p>
                        </div>
                        @endif

                        <p class="text-muted mb-1">
                            <i class="fas fa-tag me-2"></i>
                            {{ __('offers.category') }}:
                            {{ app()->getLocale() == 'ar' ? $offer->category->name_ar : $offer->category->name_en }}
                        </p>

                        <p class="card-price fw-bold fs-4 mt-auto"
                            style="color: #AC8C64;">
                            {{ number_format($offer->price, 0) }}$</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tag fa-4x text-secondary mb-3"></i>
                    <h4 class="text-secondary">
                        {{ __('offers.no_offers') }}</h4>
                </div>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('all_offers') }}" class="btn btn-lg px-5 py-3"
                style="background-color: var(--accent-color); color:white;">
                {{ __('offers.see_all_offers') }}
            </a>
        </div>
    </div>
</section> <!-- End Offers Section -->
