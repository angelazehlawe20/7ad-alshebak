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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.offers.update', $offer->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_ar" class="form-label">Title (Arabic)</label>
                                    <input type="text" class="form-control" id="title_ar" name="title_ar"
                                           value="{{ old('title_ar', $offer->title_ar) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_en" class="form-label">Title (English)</label>
                                    <input type="text" class="form-control" id="title_en" name="title_en"
                                           value="{{ old('title_en', $offer->title_en) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="description_ar" class="form-label">Description (Arabic)</label>
                                    <textarea class="form-control" id="description_ar" name="description_ar"
                                              rows="4">{{ old('description_ar', $offer->description_ar) }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="description_en" class="form-label">Description (English)</label>
                                    <textarea class="form-control" id="description_en" name="description_en"
                                              rows="4">{{ old('description_en', $offer->description_en) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="active" class="form-label">Status</label>
                                    <select class="form-select" id="active" name="active">
                                        <option value="1" {{ old('active', $offer->active) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('active', $offer->active) ? '' : 'selected' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="valid_until" class="form-label">Valid Until</label>
                                    <input type="date" class="form-control" id="valid_until" name="valid_until"
                                           value="{{ old('valid_until', $offer->valid_until->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    @if($offer->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $offer->image) }}" alt="Current Offer Image" class="img-thumbnail" style="max-height: 100px">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Update Offer</button>
                            <a href="{{ route('admin.offers.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
