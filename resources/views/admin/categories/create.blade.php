@extends('admin.layouts.app')

@section('title', __('category.add_new_category'))

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-plus me-1"></i> {{ __('category.add_new_category') }}
            </div>
            <div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-list me-1"></i> {{ __('category.back_to_list') }}
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" id="categoryForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name_ar" class="form-label required">
                            <i class="fas fa-language"></i> {{ __('category.name_arabic') }}
                        </label>
                        <input type="text"
                               name="name_ar"
                               id="name_ar"
                               class="form-control @error('name_ar') is-invalid @enderror"
                               value="{{ old('name_ar') }}"
                               required>
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name_en" class="form-label required">
                            <i class="fas fa-language"></i> {{ __('category.name_english') }}
                        </label>
                        <input type="text"
                               name="name_en"
                               id="name_en"
                               class="form-control @error('name_en') is-invalid @enderror"
                               value="{{ old('name_en') }}"
                               required>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> {{ __('category.create_category') }}
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> {{ __('category.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
