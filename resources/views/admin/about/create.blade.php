@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <h2>Create About Page</h2>

    <form action="{{ route('admin.about.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="main_text" class="form-label">Main Text</label>
            <textarea name="main_text" id="main_text" class="form-control" rows="5" required>{{ old('main_text') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="why_title" class="form-label">Why Choose Title</label>
            <input type="text" name="why_title" id="why_title" class="form-control" value="{{ old('why_title') }}" required>
        </div>

        <div class="mb-3">
            <label for="why_points" class="form-label">Why Choose Points (One point per line)</label>
            <textarea name="why_points" id="why_points" class="form-control" rows="5" placeholder="Write each point on a new line" required>{{ old('why_points') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gallery_images" class="form-label">Gallery Images (Multiple images allowed)</label>
            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control" multiple accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
