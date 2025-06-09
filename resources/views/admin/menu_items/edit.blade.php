@extends('admin.layouts.app')

@section('title', 'Edit Menu Item')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Menu Item</h5>
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

                    <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- Category Selection --}}
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) == $category->id ? 'selected' : '' }}>
                                        @if($category->id == $menuItem->category_id)
                                            {{ $menuItem->category->name_en }} ({{ $menuItem->category->name_ar }}) [Current]
                                        @else
                                            {{ $category->name_en }} - {{ $category->name_ar }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            {{-- Name Fields --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Name (English)</label>
                                    <input type="text" name="name_en" class="form-control" value="{{ old('name_en', $menuItem->name_en) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Name (Arabic)</label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar', $menuItem->name_ar) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Description Fields --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Description (English)</label>
                                    <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $menuItem->description_en) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Description (Arabic)</label>
                                    <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar', $menuItem->description_ar) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Price Field --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $menuItem->price) }}" required>
                                    </div>
                                </div>
                            </div>
                            {{-- Image Field --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" id="imageInput" onchange="previewImage(this)">
                                    @if($menuItem->image)
                                        <div class="mt-2" id="imagePreview">
                                            <img src="{{ asset('storage/' . $menuItem->image) }}" alt="Current Menu Item Image" class="img-thumbnail" style="max-height: 100px">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Update Item</button>
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            if (!preview) {
                const newPreview = document.createElement('div');
                newPreview.className = 'mt-2';
                newPreview.id = 'imagePreview';
                input.parentElement.appendChild(newPreview);
            }
            preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-height: 100px">`;
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush

@endsection
