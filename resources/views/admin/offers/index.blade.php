@extends('admin.layouts.app')
@section('title', __('offers.offers'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">{{ __('offers.management') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> {{ __('offers.add_offer') }}
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <form id="filterForm" action="{{ route('admin.offers.filter.category') }}" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="form-label">{{ __('offers.filter_by_category')
                                            }}:</label>
                                        <select name="category" id="category" class="form-select"
                                            onchange="this.form.submit()">
                                            <option value="">{{ __('offers.all_categories') }}</option>
                                            @foreach($categories ?? [] as $category)
                                            <option value="{{ $category->id }}" {{ request('category')==$category->id ?
                                                'selected' : '' }}>
                                                {{ app()->getLocale() == 'en' ? $category->name_en :
                                                $category->name_ar}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row g-4 pt-4">
                        @forelse ($offers as $offer)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                <div class="position-relative">
                                    <div class="img-container">
                                        @if($offer->image)
                                        <img src="{{ asset('storage/' . $offer->image) }}" class="w-100 h-100"
                                            alt="{{ $offer->title_en }}" loading="lazy">
                                        @else
                                        <div class="d-flex h-100 align-items-center justify-content-center">
                                            <i class="fas fa-image fa-3x text-secondary"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-primary fs-6">{{ number_format($offer->price) }} $</span>
                                    </div>
                                    <div class="position-absolute top-0 start-0 m-2">
                                        @if($offer->active)
                                        <span class="badge bg-success">{{ __('offers.active') }}</span>
                                        @else
                                        <span class="badge bg-secondary">{{ __('offers.inactive') }}</span>
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
                                                {{ app()->getLocale() == 'en' ? $category->name_en :
                                                $category->name_ar}}
                                            </small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-calendar-alt text-secondary me-2"></i>
                                            <small class="text-muted">
                                                {{ __('offers.valid_until') }}: {{ $offer->valid_until->format('M d, Y
                                                h:i A') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.offers.edit', $offer->id) }}"
                                            class="btn btn-outline-primary flex-grow-1">
                                            <i class="fas fa-edit"></i> {{ __('offers.edit') }}
                                        </a>
                                        <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST"
                                            class="flex-grow-1"
                                            onsubmit="return confirm('{{ __('offers.confirm_delete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100"
                                                data-id="{{ $offer->id }}">
                                                <i class="fas fa-trash"></i> {{ __('offers.delete') }}
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
                                <h4 class="text-secondary">{{ __('offers.no_offers') }}</h4>
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