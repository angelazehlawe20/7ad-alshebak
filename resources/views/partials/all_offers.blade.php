@extends('layouts.app')

@section('title', 'All Offers')

@section('content')
<section id="offers" class="offers section light-background py-5">
    <div class="container section-title">
        <p><span>Had AlShebak</span> <span class="description-title">Offers</span></p>
    </div><!-- End Section Title -->
    <!-- Category Filter -->
    <div class="row mb-4">
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

    <div class="row gy-4">
        @forelse($offers as $offer)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 shadow">
                <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top offer-img"
                    alt="{{ $offer->title }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $offer->title }}</h3>
                    <p class="card-text">{{ $offer->description }}</p>
                    <p class="card-price text-danger fw-bold">price: {{ $offer->price }} $</p>
                    <p class="card-category text-muted">
                        <small>Category: {{ $offer->category->name_ar }} - {{ $offer->category->name_en }}</small>
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
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
