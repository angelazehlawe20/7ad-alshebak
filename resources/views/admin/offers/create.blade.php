@extends('admin.layouts.app')
@section('title', 'Create Offer')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-plus me-1"></i>
                    Create New Offer
                </div>
                <div>
                    <a href="{{ route('admin.offers.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.offers.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title_ar" class="form-label required">Title (Arabic)</label>
                        <input type="text" name="title_ar" id="title_ar"
                            class="form-control @error('title_ar') is-invalid @enderror"
                            value="{{ old('title_ar') }}" required>
                        @error('title_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="title_en" class="form-label required">Title (English)</label>
                        <input type="text" name="title_en" id="title_en"
                            class="form-control @error('title_en') is-invalid @enderror"
                            value="{{ old('title_en') }}" required>
                        @error('title_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description_ar" class="form-label">Description (Arabic)</label>
                        <textarea name="description_ar" id="description_ar"
                            class="form-control @error('description_ar') is-invalid @enderror"
                            rows="3">{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description_en" class="form-label">Description (English)</label>
                        <textarea name="description_en" id="description_en"
                            class="form-control @error('description_en') is-invalid @enderror"
                            rows="3">{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="active" class="form-label required">Status</label>
                        <select name="active" id="active"
                            class="form-select @error('active') is-invalid @enderror" required>
                            <option value="1" {{ old('active', '1') == "1" ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active') == "0" ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="valid_until" class="form-label required">Valid Until</label>
                        <input type="date" name="valid_until" id="valid_until"
                            class="form-control @error('valid_until') is-invalid @enderror"
                            value="{{ old('valid_until') }}" required>
                        @error('valid_until')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Create Offer
                    </button>
                    <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
