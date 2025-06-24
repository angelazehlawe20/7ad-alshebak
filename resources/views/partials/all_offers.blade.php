@extends('layouts.app')

@section('title', __('navbar.offers'))

@section('content')
<section id="offers" class="offers section light-background py-5">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
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
    </div>

    <div class="container">
        <!-- Category Filter -->
        <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-6 mx-auto">
                <select class="form-select" id="categoryFilter">
                    <option value="">{{ __('offers.all_categories') }}</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                        {{ $category->name_ar }} - {{ $category->name_en }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Offers Grid -->
        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
            @forelse($offers as $offer)
            <div class="col-lg-4 col-md-6 col-6">
                <div class="card h-100 shadow">
                    <img src="{{ asset($offer->image ? $offer->image : 'assets/img/placeholder.jpg') }}"
                         class="card-img-top offer-img img-fluid"
                         alt="{{ app()->getLocale() == 'ar' ? $offer->title_ar : $offer->title_en }}">

                    <div class="card-body d-flex flex-column">
                        <h3 class="card-title h5 mb-2">
                            {{ app()->getLocale() == 'ar' ? $offer->title_ar : $offer->title_en }}
                        </h3>

                        <p class="card-text mb-2">
                            {{ app()->getLocale() == 'ar' ? $offer->description_ar : $offer->description_en }}
                        </p>

                        @if($offer->valid_until)
                        <p class="text-muted mb-1">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{ __('offers.valid_until') }}: {{ $offer->valid_until->format('Y-m-d h:i A') }}
                        </p>
                        @endif

                        <p class="text-muted mb-1">
                            <i class="fas fa-tag me-2"></i>
                            {{ __('offers.category') }}:
                            {{ app()->getLocale() == 'ar' ? $offer->category->name_ar : $offer->category->name_en }}
                        </p>

                        <p class="card-price fw-bold fs-5 mt-auto" style="color: #AC8C64;">
                            {{ number_format($offer->price) }} $
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-tag fa-4x text-secondary mb-3"></i>
                    <h4 class="text-secondary">{{ __('offers.no_offers') }}</h4>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.getElementById('categoryFilter').addEventListener('change', function () {
        const selectedCategory = this.value;
        const url = new URL("{{ route('all_offers') }}", window.location.origin);

        if (selectedCategory) {
            url.searchParams.set('category', selectedCategory);
        }

        window.location.href = url.toString();
    });
</script>
@endpush

@endsection
