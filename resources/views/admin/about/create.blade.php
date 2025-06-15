@extends('admin.layouts.app')
@section('title', 'Create About Page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create About Page</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.about.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Main Text</label>
                                    <textarea name="main_text" class="form-control" rows="5" required>{{ old('main_text') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Why Choose Title</label>
                                    <input type="text" name="why_title" class="form-control" value="{{ old('why_title') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Why Choose Points (One point per line)</label>
                                    <textarea name="why_points" class="form-control" rows="5" placeholder="Write each point on a new line" required>{{ old('why_points') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Gallery Images (Multiple images allowed)</label>
                                    <input type="file" name="gallery_images[]" class="form-control" multiple accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img src="" alt="Image Preview" class="img-thumbnail" style="max-height: 100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.about.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[name="gallery_images[]"]').addEventListener('change', function(e) {
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
