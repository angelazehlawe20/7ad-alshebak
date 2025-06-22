@extends('layouts.app')

@section('title', 'All Offers')

@section('content')
<section id="offers" class="offers section">
    <div id="offers-content"></div>
    <div class="container section-title" data-aos="fade-up">
        <p><span>Had AlShebak</span> <span class="description-title">Offers</span></p>
    </div>

    <div class="container">
        <!-- Category Filter -->
        <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-md-6 mx-auto">
                <select class="form-select" id="categoryFilter">
                    <option value=""> -- All Categories -- </option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                        {{ $category->name_ar }} - {{ $category->name_en }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
            @forelse($offers as $offer)
            <div class="col-lg-4 col-md-6">
                <div class="menu-card h-100">
                    <div class="menu-image-wrapper" style="height: 250px; overflow: hidden;">
                        <a href="{{ asset($offer->image ? 'storage/' . $offer->image : 'assets/img/placeholder.jpg') }}" class="glightbox">
                            <img src="{{ asset($offer->image ? 'storage/' . $offer->image : 'assets/img/placeholder.jpg') }}"
                                class="menu-img img-fluid w-100 h-100"
                                style="object-fit: contain;"
                                alt="{{ $offer->title }}">
                        </a>
                    </div>
                    <div class="menu-content d-flex flex-column h-100">
                        <div class="menu-header">
                            <h4 class="menu-title">{{ $offer->title }}</h4>
                        </div>
                        <div class="flex-grow-1">
                            <p class="menu-description">{{ $offer->description }}</p>
                        </div>
                        <div class="menu-footer mt-auto">
                            <span class="menu-price">{{ number_format($offer->price, 2) }} $</span>
                            <small class="text-muted d-block mt-2">
                                Category: {{ $offer->category->name_ar }} - {{ $offer->category->name_en }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="no-items-message text-center">
                    No offers available at the moment.
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
