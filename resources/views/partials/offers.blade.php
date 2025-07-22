<!-- Offers Section -->
<section id="offers" class="offers section light-background py-5">
    <!--Section Title -->
    <div class="container section-title">
        <p style="margin-top: 70px;">
            <span class="description-title">{{ __('offers.brand_name_offers') }}</span>
        </p>

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
                        @if(app()->getLocale() == 'ar' ? $offer->description_ar : $offer->description_en)
                        <div class="border rounded p-3 bg-light mb-3">
                            <p class="card-text">
                                {!! nl2br(e(app()->getLocale() == 'ar' ? $offer->description_ar : $offer->description_en)) !!}
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
                            {{ number_format($offer->price) }}&nbsp;{{__('admins.syr')}}</p>
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
