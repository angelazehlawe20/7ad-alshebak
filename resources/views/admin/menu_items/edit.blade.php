@extends('admin.layouts.app')
@section('title', __('menu.edit_menu_item'))
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-utensils"></i>&nbsp;&nbsp;{{ __('menu.edit_menu_item') }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid px-0">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-image"></i>&nbsp;&nbsp;{{ __('menu.item_image') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: {{ $menuItem->image ? 'block' : 'none' }};">
                                        <img src="{{ $menuItem->image ? asset($menuItem->image) : '' }}"
                                            alt="{{ __('menu.item_image') }}" class="img-fluid rounded shadow"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card bg-beige card-outline mt-4">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-tag"></i>&nbsp;&nbsp;{{ __('menu.category_and_price') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('menu.category') }}</strong></label>
                                    <select name="category_id" class="form-select">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name_en }} - {{ $category->name_ar }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('menu.price') }}</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><strong>{{ __('admins.syp') }}</strong></span>
                                        <input type="text" name="price" class="form-control fw-bold" value="{{ round(old('price', $menuItem->price)) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-align-left"></i>&nbsp;&nbsp;{{ __('menu.item_content') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('menu.name_en') }}</strong></label>
                                    <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $menuItem->name_en) }}">
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('menu.name_ar') }}</strong></label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $menuItem->name_ar) }}">
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('menu.description_en') }}</strong></label>
                                    <textarea name="description_en" class="form-control" rows="3">{{ old('description_en', $menuItem->description_en) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('menu.description_ar') }}</strong></label>
                                    <textarea name="description_ar" class="form-control" rows="3">{{ old('description_ar', $menuItem->description_ar) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save"></i>&nbsp;&nbsp;{{ __('menu.update_item') }}
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i>&nbsp;&nbsp;{{ __('menu.cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/editMenuItemPage.js') }}"></script>
@endpush
