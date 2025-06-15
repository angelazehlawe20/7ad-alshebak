@extends('admin.layouts.app')
@section('title', 'Create Offer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create New Offer</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.offers.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                                            {{ $category->name_en }} - {{ $category->name_ar }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price') }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Title (English)</label>
                                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Title (Arabic)</label>
                                    <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Description (English)</label>
                                    <textarea name="description_en" class="form-control" rows="4">{{ old('description_en') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Description (Arabic)</label>
                                    <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="active" class="form-select" required>
                                        <option value="1" {{ old('active', '1')=="1" ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('active')=="0" ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Valid Until</label>
                                    <input type="datetime-local" name="valid_until" class="form-control"
                                        value="{{ old('valid_until') ? \Carbon\Carbon::parse(old('valid_until'))->format('Y-m-d\TH:i') : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img src="" alt="Image Preview" class="img-thumbnail" style="max-height: 100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Create Offer</button>
                            <a href="{{ route('admin.offers.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const img = preview.querySelector('img');

        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection
