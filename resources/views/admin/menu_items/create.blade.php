@extends('admin.layouts.app')

@section('title', 'Add New Menu Item')

@section('content')
    <h3>Add New Menu Item</h3>

    {{-- Display Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu-items.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="" disabled selected>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name_en }} - {{ $category->name_ar }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name_en" class="form-label">Name (English)</label>
            <input type="text" name="name_en" id="name_en" class="form-control" value="{{ old('name_en') }}" required>
        </div>

        <div class="mb-3">
            <label for="name_ar" class="form-label">Name (Arabic)</label>
            <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
        </div>

        <div class="mb-3">
            <label for="description_en" class="form-label">Description (English)</label>
            <textarea name="description_en" id="description_en" class="form-control" rows="3" required>{{ old('description_en') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description_ar" class="form-label">Description (Arabic)</label>
            <textarea name="description_ar" id="description_ar" class="form-control" rows="3" required>{{ old('description_ar') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Add</button>
        <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
