<!-- Offers Section -->
<section id="offers" class="offers section light-background py-5">
    <!--Section Title -->
    <div class="container section-title">
        @if(app()->getLocale() == 'ar')
        <p style="font-family: var(--arabic-font)">
            <span>{{ __('offers.offers') }}</span>
            <span class="description-title">{{ __('offers.brand_name') }}</span>
        </p>
        @else
        <p style="font-family: var(--english-font)">
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
                    <div class="card-body">
                        <div class="mb-3">
                            <h3 class="card-title h4 mb-2"
                                style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                                {{ app()->getLocale() == 'ar' ? $offer->title_ar : $offer->title_en }}</h3>
                        </div>
                        <p class="card-text"
                            style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            {{ app()->getLocale() == 'ar' ? $offer->description_ar : $offer->description_en }}</p>
                        <p class="card-text"
                            style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            <i class="far fa-calendar-alt me-2"></i>{{ __('offers.valid_until') }}:
                            {{ $offer->valid_until->format('Y-m-d h:i A') }}
                        </p>
                        <p class="card-text"><small class="text-muted"
                                style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}"><i
                                    class="fas fa-tag me-2"></i>{{
                                __('offers.category') }}: {{ app()->getLocale() == 'ar' ? $offer->category->name_ar :
                                $offer->category->name_en }}</small></p>
                        <p class="card-price fw-bold fs-4"
                            style="color: #AC8C64; font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            {{ $offer->price }} $</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tag fa-4x text-secondary mb-3"></i>
                    <h4 class="text-secondary"
                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                        {{ __('offers.no_offers') }}</h4>
                </div>
            </div>
            @endforelse
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('all_offers') }}" class="btn btn-lg px-5 py-3"
                style="background-color: var(--accent-color); color:white; font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                {{ __('offers.see_all_offers') }}
            </a>
        </div>
    </div>
</section> <!-- End Offers Section -->
