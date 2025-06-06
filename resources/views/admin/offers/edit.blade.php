@extends('admin.layouts.app')
@section('title', 'Edit Offer')

@section('content')
<h3>Edit Offer</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.offers.update', $offer->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title_ar" class="form-label">Title (Arabic)</label>
        <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar', $offer->title_ar) }}" required>
    </div>
    <div class="mb-3">
        <label for="title_en" class="form-label">Title (English)</label>
        <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en', $offer->title_en) }}" required>
    </div>
    <div class="mb-3">
        <label for="description_ar" class="form-label">Description (Arabic)</label>
        <textarea class="form-control" id="description_ar" name="description_ar" rows="3">{{ old('description_ar', $offer->description_ar) }}</textarea>
    </div>
    <div class="mb-3">
        <label for="description_en" class="form-label">Description (English)</label>
        <textarea class="form-control" id="description_en" name="description_en" rows="3">{{ old('description_en', $offer->description_en) }}</textarea>
    </div>
    <div class="mb-3">
        <label for="active" class="form-label">Active</label>
        <select class="form-select" id="active" name="active" required>
            <option value="1" {{ old('active', $offer->active) == "1" ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('active', $offer->active) == "0" ? 'selected' : '' }}>No</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="valid_until" class="form-label">Valid Until</label>
        <input type="date" class="form-control" id="valid_until" name="valid_until" value="{{ old('valid_until', $offer->valid_until->format('Y-m-d')) }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Offer</button>
    <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
