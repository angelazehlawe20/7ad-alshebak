@extends('admin.layouts.app')
@section('title', 'Offers')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Offers Management</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Offer
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <form id="filterForm" action="{{ route('admin.offers.filter.category') }}" method="GET">
                            <div class="row">
                                <div class="row">
                                    <!-- نموذج فلترة حسب الفئة -->
                                    <div class="col-md-6">
                                        <form action="{{ route('admin.offers.filter.category') }}" method="GET">
                                            <div class="form-group">
                                                <label for="category" class="form-label">Filter by Category:</label>
                                                <select name="category" id="category" class="form-select"
                                                    onchange="this.form.submit()">
                                                    <option value="">-- All Categories --</option>
                                                    @foreach($categories ?? [] as $category)
                                                    <option value="{{ $category->id }}" {{
                                                        request('category')==$category->id ? 'selected' : '' }}>
                                                        {{ $category->name_en }} | {{ $category->name_ar }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- نموذج فلترة حسب الحالة -->
                                    <div class="col-md-6">
                                        <form action="{{ route('admin.offers.filter.status') }}" method="GET">
                                            <div class="form-group">
                                                <label for="status" class="form-label">Filter by Status:</label>
                                                <select name="status" id="status" class="form-select"
                                                    onchange="this.form.submit()">
                                                    <option value="">-- All Status --</option>
                                                    <option value="1" {{ request('status')=='1' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ request('status')=='0' ? 'selected' : '' }}>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                        </form>
                    </div>

                    <div class="row g-4 pt-4">
                        @forelse ($offers as $offer)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                <div class="position-relative">
                                    <div style="height: 300px; background-color: #f8f9fa; padding: 10px;">
                                        @if($offer->image)
                                        <img src="{{ asset('storage/' . $offer->image) }}" class="card-img-top h-100"
                                            alt="{{ $offer->title_en }}" loading="lazy" style="object-fit: contain;">
                                        @else
                                        <div class="d-flex h-100 align-items-center justify-content-center">
                                            <i class="fas fa-image fa-3x text-secondary"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-primary fs-6">${{ number_format($offer->price, 2)
                                            }}</span>
                                    </div>
                                    <div class="position-absolute top-0 start-0 m-2">
                                        @if($offer->active)
                                        <span class="badge bg-success">Active</span>
                                        @else
                                        <span class="badge bg-secondary">Inactive</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $offer->title_en }}</h5>
                                    <h6 class="text-muted">{{ $offer->title_ar }}</h6>

                                    <div class="mt-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="fas fa-tag text-secondary me-2"></i>
                                            <small class="text-muted">
                                                {{ $offer->category->name_en }} | {{ $offer->category->name_ar }}
                                            </small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-secondary me-2"></i>
                                            <small class="text-muted">
                                                Valid until: {{ $offer->valid_until->format('M d, Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.offers.edit', $offer->id) }}"
                                            class="btn btn-outline-primary flex-grow-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST"
                                            class="flex-grow-1" onsubmit="return confirm('Are you sure you want to delete this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100"
                                                data-id="{{ $offer->id }}">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-tag fa-4x text-secondary mb-3"></i>
                                <h4 class="text-secondary">No offers found</h4>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
