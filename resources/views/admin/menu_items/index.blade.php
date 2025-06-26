@extends('admin.layouts.app')

@section('title', __('menu.menu'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">{{ __('menu.menu') }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> {{ __('menu.add_menu_item') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- فلتر التصنيف --}}
                    <div class="mb-4">
                        <form id="filterForm" action="{{ route('admin.menu.filter') }}" method="GET"
                            class="d-flex align-items-center gap-2">
                            <div class="form-group flex-grow-1 mb-0">
                                <label for="category_id" class="form-label">{{ __('menu.filter_by_category') }}:</label>
                                <select name="category_id" id="category_id" class="form-select"
                                    onchange="this.form.submit()">
                                    <option value="">{{ __('menu.all_categories') }}</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id')==$category->id ?
                                        'selected' : '' }}>
                                        {{ app()->getLocale() == 'en' ? $category->name_en : $category->name_ar }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @if(request('category_id'))
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary mt-4">{{
                                __('menu.clear_filter') }}</a>
                            @endif
                        </form>
                    </div>
                    <div class="row g-4">
                        @forelse ($items as $item)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                <div class="position-relative img-container">
                                    @if($item->image)
                                    <img src="{{ asset($item->image) }}" class="card-img-top w-100 h-100"
                                        alt="{{ $item->name_en }}" loading="lazy">
                                    @else
                                    <div
                                        class="bg-light text-center p-4 w-100 h-100 d-flex flex-column justify-content-center align-items-center">
                                        <i class="fas fa-image fa-3x text-secondary"></i>
                                        <p class="mt-2 text-secondary">{{ __('menu.no_image') }}</p>
                                    </div>
                                    @endif
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-primary fs-6">{{ number_format($item->price) }} $</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $item->name_en }}</h5>
                                    <h6 class="text-muted">{{ $item->name_ar }}</h6>
                                    <p class="card-text small text-truncate" title="{{ $item->description_en }}">
                                        {{ $item->description_en }}
                                    </p>
                                    <p class="card-text small text-truncate" title="{{ $item->description_ar }}">
                                        {{ $item->description_ar }}
                                    </p>
                                    <div class="d-flex align-items-center mt-2">
                                        <i class="fas fa-tag text-secondary me-2"></i>
                                        <small class="text-muted">
                                            {{ $item->category->name_en }} | {{ $item->category->name_ar }}
                                        </small>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.menu.edit', $item->id) }}"
                                            class="btn btn-outline-primary flex-grow-1">
                                            <i class="fas fa-edit"></i> {{ __('menu.edit') }}
                                        </a>
                                        <form action="{{ route('admin.menu.destroy', $item->id) }}" method="POST"
                                            class="flex-grow-1"
                                            onsubmit="return confirm('{{ __('menu.confirm_delete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="fas fa-trash"></i> {{ __('menu.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <div class="text-center py-5">
                                <i class="fas fa-utensils fa-4x text-secondary mb-3"></i>
                                <h4 class="text-secondary">{{ __('menu.no_items') }}</h4>
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