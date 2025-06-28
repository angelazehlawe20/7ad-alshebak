@extends('layouts.app')

@section('title', __('navbar.offers'))

@section('content')
<section id="offers" class="offers section light-background py-5">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
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
    </div>

    <div class="container">
        <!-- Category Filter -->
        <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-6 mx-auto">
                <select class="form-select" id="categoryFilter"
                    style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                    <option value=""
                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                        {{ __('offers.all_categories') }}</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}
                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)'
                        }}">
                        {{ app()->getLocale() == 'ar' ? $category->name_ar : $category->name_en }}
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
                        <h3 class="card-title h5 mb-2"
                            style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            {{ app()->getLocale() == 'ar' ? $offer->title_ar : $offer->title_en }}
                        </h3>

                        <p class="card-text mb-2"
                            style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            {{ app()->getLocale() == 'ar' ? $offer->description_ar : $offer->description_en }}
                        </p>

                        @if($offer->valid_until)
                        <p class="text-muted mb-1"
                            style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{ __('offers.valid_until') }}: {{ $offer->valid_until->format('Y-m-d h:i A') }}
                        </p>
                        @endif

                        <p class="text-muted mb-1"
                            style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            <i class="fas fa-tag me-2"></i>
                            {{ __('offers.category') }}:
                            {{ app()->getLocale() == 'ar' ? $offer->category->name_ar : $offer->category->name_en }}
                        </p>

                        <p class="card-price fw-bold fs-5 mt-auto"
                            style="color: #AC8C64; font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            {{ number_format($offer->price) }} $
                        </p>
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
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/offerPage.js') }}"></script>
@endpush
