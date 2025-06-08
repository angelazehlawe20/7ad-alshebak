@extends('admin.layouts.app')

@section('title', 'Add New Menu Item')

@section('content')
<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-plus me-1"></i>
                    Add New Menu Item
                </div>
                <div>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-primary btn-sm">
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

            <form action="{{ route('admin.menu.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label required">Category</label>
                        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name_en }} - {{ $category->name_ar }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label required">Price</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" step="0.01" name="price" id="price"
                                class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price') }}" required>
                        </div>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name_en" class="form-label required">Name (English)</label>
                        <input type="text" name="name_en" id="name_en"
                            class="form-control @error('name_en') is-invalid @enderror"
                            value="{{ old('name_en') }}" required>
                        @error('name_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="name_ar" class="form-label required">Name (Arabic)</label>
                        <input type="text" name="name_ar" id="name_ar"
                            class="form-control @error('name_ar') is-invalid @enderror"
                            value="{{ old('name_ar') }}" required>
                        @error('name_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description_en" class="form-label ">Description (English)</label>
                        <textarea name="description_en" id="description_en"
                            class="form-control @error('description_en') is-invalid @enderror"
                            rows="3" >{{ old('description_en') }}</textarea>
                        @error('description_en')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="description_ar" class="form-label ">Description (Arabic)</label>
                        <textarea name="description_ar" id="description_ar"
                            class="form-control @error('description_ar') is-invalid @enderror"
                            rows="3" >{{ old('description_ar') }}</textarea>
                        @error('description_ar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Save Menu Item
                    </button>
                    <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
