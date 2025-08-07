@extends('admin.layouts.app')
@section('title', __('offers.offers'))

@section('content')
<style>
    .btn-edit:hover {
        background-color: #8B7355 !important;
        color: white !important;
    }
    .btn-delete:hover {
        background-color: #dc3545 !important;
        color: white !important;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #8B7355"><i class="fas fa-tag"></i>&nbsp; {{ __('offers.management') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-beige card-outline">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h3 class="card-title" style="color: #8B7355"><i class="fas fa-list"></i>&nbsp;{{ __('offers.offers') }}</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.offers.create') }}" class="btn" style="background-color: #8B7355; color: white">
                                    <i class="fas fa-plus"></i>&nbsp; {{ __('offers.add_offer') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body" style="background-color: #f5f5dc;">
                            <div class="mb-4">
                                <form id="filterForm" action="{{ route('admin.offers.filter.category') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category" class="form-label"><strong>{{ __('offers.filter_by_category') }}:</strong></label>
                                                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                                                    <option value="">{{ __('offers.all_categories') }}</option>
                                                    @foreach($categories ?? [] as $category)
                                                    <option value="{{ $category->id }}" {{ request('category')==$category->id ? 'selected' : '' }}>
                                                        {{ app()->getLocale() == 'en' ? $category->name_en : $category->name_ar}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="row g-4">
                                @forelse ($offers as $offer)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 shadow-sm">
                                        <div class="position-relative">
                                            <div class="img-container">
                                                @if($offer->image)
                                                <img src="{{ asset($offer->image) }}" class="w-100 h-100" alt="{{ $offer->title_en }}" loading="lazy" style="object-fit: contain;">
                                                @else
                                                <div class="d-flex h-100 align-items-center justify-content-center">
                                                    <i class="fas fa-image fa-3x text-secondary"></i>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <span class="badge fs-6" style="background-color: #8B7355"><strong>{{ number_format($offer->price) }} {{__('admins.syp')}}</strong></span>
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
                                            <h5 class="card-title" style="color: #8B7355">{{ $offer->title_en }}</h5>
                                            <h6 class="text-muted">{{ $offer->title_ar }}</h6>

                                            <div class="mt-3">
                                                <div class="d-flex align-items-center mb-2">
                                                    <i class="fas fa-tag text-secondary me-2"></i>
                                                    <small class="text-muted">
                                                        {{ $offer->category ? (app()->getLocale() == 'en' ? $offer->category->name_en : $offer->category->name_ar) : '' }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-edit btn-outline flex-grow-1" style="border-color: #8B7355; color: #8B7355; transition: all 0.3s">
                                                    <i class="fas fa-edit"></i>&nbsp; {{ __('offers.edit') }}
                                                </a>
                                                <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('{{ __('offers.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete btn-outline-danger w-100" style="transition: all 0.3s" data-id="{{ $offer->id }}">
                                                        <i class="fas fa-trash"></i>&nbsp; {{ __('offers.delete') }}
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
    </section>
</div>
@endsection
