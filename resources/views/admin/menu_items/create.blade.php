@extends('admin.layouts.app')

@section('title', 'Create Menu Item')

@section('content')
<div class="container">
    <h3>Add New Menu Item</h3>
    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- تحديد التصنيف --}}
        @if(isset($category))
            <input type="hidden" name="category_id" value="{{ $category->id }}">
            <div class="form-group">
                <label>Category:</label>
                <p><strong>{{ $category->name_en }} ({{ $category->name_ar }})</strong></p>
            </div>
        @else
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name_en }} - {{ $cat->name_ar }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        {{-- الاسم --}}
        <div class="form-group">
            <label>Name (English)</label>
            <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}" required>
        </div>

        <div class="form-group">
            <label>Name (Arabic)</label>
            <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}" required>
        </div>

        {{-- الوصف --}}
        <div class="form-group">
            <label>Description (English)</label>
            <textarea name="description_en" class="form-control">{{ old('description_en') }}</textarea>
        </div>

        <div class="form-group">
            <label>Description (Arabic)</label>
            <textarea name="description_ar" class="form-control">{{ old('description_ar') }}</textarea>
        </div>

        {{-- السعر --}}
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price') }}" required>
        </div>

        {{-- الصورة --}}
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-success mt-3">Create Item</button>
    </form>
</div>
@endsection
