@extends('admin.layouts.app')
@section('title', 'View Offer')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h5 class="mb-0">Offer Details</h5>
            <a href="{{ route('admin.offers.index') }}" class="btn btn-light btn-sm">Back</a>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $offer->image) }}"
                     alt="{{ $offer->title_en }}"
                     class="img-fluid"
                     style="max-height: 300px;">
            </div>
            <h3 class="text-primary">{{ $offer->title_en }}</h3>
            <h5 class="text-muted">{{ $offer->title_ar }}</h5>
            <p><strong>Description (EN):</strong> {{ $offer->description_en }}</p>
            <p><strong>Description (AR):</strong> {{ $offer->description_ar }}</p>
            <p><strong>Category:</strong> {{ $offer->category->name_en }}</p>
            <p><strong>Price:</strong> ${{ number_format($offer->price, 2) }}</p>
            <p><strong>Status:</strong>
                @if($offer->active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </p>
            <p><strong>Valid Until:</strong> {{ $offer->valid_until->format('Y-m-d') }}</p>
        </div>
    </div>
</div>
@endsection
