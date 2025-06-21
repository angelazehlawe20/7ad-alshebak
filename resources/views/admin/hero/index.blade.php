@extends('admin.layouts.app')

@section('title', 'Hero')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-home"></i> Hero Section</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.hero.update') }}" method="POST" id="heroForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-image mr-2"></i>Hero Images</h3>
                            </div>
                            <div class="card-body">
                                <div class="gallery-preview mb-3">
                                    @if($heroPage && $heroPage->image && file_exists(public_path($heroPage->image)))
                                    <img src="{{ asset($heroPage->image) }}"
                                        class="img-fluid rounded shadow gallery-image" alt="Hero Image"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                    <button type="button" class="btn btn-danger btn-sm delete-image d-none"
                                        data-image="{{ $heroPage->image }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="uploadImagesBtn">
                                        <i class="fas fa-edit"></i>&nbsp;Edit Image
                                    </button>
                                    <input type="file" class="d-none" name="image" id="newHeroImage" accept="image/*"
                                        onchange="previewImage(this)">
                                    <div id="imagePreviewContainer" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>Hero Content</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label><strong>English Title</strong></label>
                                    <input type="text" class="form-control" name="title_en"
                                        value="{{ $heroPage->title_en ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>Arabic Title</strong></label>
                                    <input type="text" class="form-control" name="title_ar"
                                        value="{{ $heroPage->title_ar ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>English Main Text</strong></label>
                                    <textarea class="form-control" name="main_text_en"
                                        rows="3">{{ $heroPage->main_text_en ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>Arabic Main Text</strong></label>
                                    <textarea class="form-control" name="main_text_ar"
                                        rows="3">{{ $heroPage->main_text_ar ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-primary btn-lg">
                            <i class="fas fa-edit mr-2"></i> Edit Hero
                        </button>

                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>

                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times mr-2"></i> Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('scripts')

<script>
    window.routes = {
        deleteImage: "{{ route('admin.hero.deleteImage') }}",
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const uploadBtn = document.getElementById('uploadImagesBtn');
        const fileInput = document.getElementById('newHeroImage');
        const deleteButtons = document.querySelectorAll('.delete-image');

        function enableEditMode() {
            document.querySelectorAll('#heroForm input:not([type="hidden"]), #heroForm textarea').forEach(input => {
                input.removeAttribute('readonly');
                input.removeAttribute('disabled');
            });
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
            editBtn.classList.add('d-none');
            uploadBtn.classList.remove('d-none');
            deleteButtons.forEach(btn => btn.classList.remove('d-none'));
        }

        editBtn.addEventListener('click', enableEditMode);

        uploadBtn.addEventListener('click', () => fileInput.click());

        window.previewImage = function(input) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = '';

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    container.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" alt="Preview"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body p-2">
                                <p class="card-text small text-muted mb-0">${input.files[0].name}</p>
                            </div>
                        </div>
                    `;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        deleteButtons.forEach(btn => {
    btn.addEventListener('click', handleDeleteImage, { once: true });
});

function handleDeleteImage(event) {
    event.stopPropagation(); // <--- أضف هذا السطر

    if (confirm('Are you sure you want to delete this image?')) {
        const btn = event.currentTarget;
        const imageToDelete = btn.dataset.image;
        const galleryPreview = btn.closest('.gallery-preview');

        fetch(window.routes.deleteImage, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ image: imageToDelete })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                galleryPreview.remove();
            } else {
                alert('Failed to delete image. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the image.');
        });
    }
}


        cancelBtn.addEventListener('click', () => window.location.reload());
    });
</script>

@endsection
