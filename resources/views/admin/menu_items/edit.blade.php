@extends('admin.layouts.app')

@section('title', 'Edit Menu Item')

@section('content')
    <h3>Edit Menu Item</h3>

    {{-- عرض أخطاء التحقق --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.menu-items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="" disabled>Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name_en }} - {{ $category->name_ar }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name_en" class="form-label">Name (English)</label>
            <input type="text" name="name_en" id="name_en" class="form-control"
                value="{{ old('name_en', $item->name_en) }}" required>
        </div>

        <div class="mb-3">
            <label for="name_ar" class="form-label">Name (Arabic)</label>
            <input type="text" name="name_ar" id="name_ar" class="form-control"
                value="{{ old('name_ar', $item->name_ar) }}" required>
        </div>

        <div class="mb-3">
            <label for="description_en" class="form-label">Description (English)</label>
            <textarea name="description_en" id="description_en" class="form-control" rows="3" required>{{ old('description_en', $item->description_en) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description_ar" class="form-label">Description (Arabic)</label>
            <textarea name="description_ar" id="description_ar" class="form-control" rows="3" required>{{ old('description_ar', $item->description_ar) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control"
                value="{{ old('price', $item->price) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.menu-items.index') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
