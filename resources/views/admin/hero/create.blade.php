@extends('admin.layouts.app')
@section('title', 'Create Hero Section')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create Hero Section</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hero.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
                        @csrf
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
                                    <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Main Text (English)</label>
                                    <textarea name="main_text_en" class="form-control" rows="5" required>{{ old('main_text_en') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">Main Text (Arabic)</label>
                                    <textarea name="main_text_ar" class="form-control" rows="5" required>{{ old('main_text_ar') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Hero Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img src="" alt="Image Preview" class="img-thumbnail" style="max-height: 200px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('admin.hero.indexForAdmin') }}" class="btn btn-light">Cancel</a>
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
