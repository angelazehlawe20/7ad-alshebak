@extends('admin.layouts.app')
@section('title', 'Edit Offer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Edit Offer</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.offers.update', $offer->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Title Fields --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Title (English)</label>
                                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $offer->title_en) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Title (Arabic)</label>
                                    <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $offer->title_ar) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Description Fields --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Description (English)</label>
                                    <textarea name="description_en" class="form-control" rows="4">{{ old('description_en', $offer->description_en) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Description (Arabic)</label>
                                    <textarea name="description_ar" class="form-control" rows="4">{{ old('description_ar', $offer->description_ar) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Status Field --}}
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="active" class="form-select" required>
                                        <option value="1" {{ old('active', $offer->active) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('active', $offer->active) ? '' : 'selected' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            {{-- Price Field --}}
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Price</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $offer->price) }}" required>
                                    </div>
                                </div>
                            </div>
                            {{-- Valid Until Field --}}
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Valid Until</label>
                                    <input type="datetime-local" name="valid_until" class="form-control" value="{{ old('valid_until', $offer->valid_until->format('Y-m-d\TH:i')) }}" required>
                                </div>
                            </div>
                            {{-- Image Field --}}
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: {{ $offer->image ? 'block' : 'none' }};">
                                        <img src="{{ $offer->image ? asset($offer->image) : '' }}"
                                             alt="Offer Image" class="img-thumbnail" style="max-height: 100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Offer
                            </button>
                            <a href="{{ route('admin.offers.index') }}" class="btn btn-light">
                                <i class="fas fa-times"></i> Cancel
                            </a>
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
