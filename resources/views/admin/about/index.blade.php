@extends('admin.layouts.app')

@section('title', 'About Page')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-info-circle"></i> About Page</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.about.update') }}" method="POST" id="aboutForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- قسم الصور --}}
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-image mr-2"></i>Gallery Images</h3>
                            </div>
                            <div class="card-body">
                                @php $gallery = json_decode($about->gallery_images ?? '[]'); @endphp

                                <div class="gallery-preview mb-3 row" id="galleryPreview">
                                    @forelse($gallery as $image)
                                        @if(file_exists(public_path($image)))
                                        <div class="gallery-item col-md-6 position-relative mb-2" data-path="{{ $image }}">
                                            <a class="glightbox" data-gallery="images-gallery" href="{{ asset($image) }}">
                                                <img src="{{ asset($image) }}"
                                                    class="img-fluid rounded shadow gallery-image"
                                                    style="width: 100%; height: 150px; object-fit: contain;">
                                            </a>
                                            <button type="button"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image d-none"
                                                data-image="{{ $image }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        @endif
                                    @empty
                                        <div class="text-center text-muted col-12">No images available.</div>
                                    @endforelse
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="uploadImagesBtn"
                                        onclick="document.getElementById('newGalleryImages').click()">
                                        <i class="fas fa-upload"></i>&nbsp;Add New Images
                                    </button>
                                    <input type="file" class="d-none" name="new_gallery_images[]" id="newGalleryImages"
                                        multiple accept="image/*">
                                    <input type="hidden" name="existing_images" id="existingImages"
                                        value="{{ $about->gallery_images ?? '[]' }}">
                                    <div class="row mt-2" id="imagePreviewContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- قسم النصوص --}}
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>Main Content</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label><strong>Main Text (EN)</strong></label>
                                    <textarea class="form-control" name="main_text_en" rows="4" readonly>{{ $about->main_text_en ?? '' }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>Main Text (AR)</strong></label>
                                    <textarea class="form-control" name="main_text_ar" rows="4" readonly>{{ $about->main_text_ar ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>Why Title (EN)</strong></label>
                                    <input type="text" class="form-control" name="why_title_en" value="{{ $about->why_title_en ?? '' }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label><strong>Why Title (AR)</strong></label>
                                    <input type="text" class="form-control" name="why_title_ar" value="{{ $about->why_title_ar ?? '' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label><strong>Why Points (EN)</strong></label>
                                    @foreach(json_decode($about->why_points_en ?? '[]') as $point)
                                        <input type="text" class="form-control mb-2" name="why_points_en[]" value="{{ $point }}" readonly>
                                    @endforeach
                                </div>

                                <div class="form-group">
                                    <label><strong>Why Points (AR)</strong></label>
                                    @foreach(json_decode($about->why_points_ar ?? '[]') as $point)
                                        <input type="text" class="form-control mb-2" name="why_points_ar[]" value="{{ $point }}" readonly>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- أزرار التحكم --}}
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-primary btn-lg">
                            <i class="fas fa-edit mr-2"></i> Edit About
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
document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const uploadImagesBtn = document.getElementById('uploadImagesBtn');
    const newGalleryImages = document.getElementById('newGalleryImages');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const existingImagesInput = document.getElementById('existingImages');
    const galleryPreview = document.getElementById('galleryPreview');

    // تفعيل التعديل
    editBtn.addEventListener('click', function () {
        editBtn.classList.add('d-none');
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
        uploadImagesBtn.classList.remove('d-none');
        document.querySelectorAll('.delete-image').forEach(btn => btn.classList.remove('d-none'));
        document.querySelectorAll('input[readonly], textarea[readonly]').forEach(el => el.removeAttribute('readonly'));
    });

    // إلغاء التعديل
    cancelBtn.addEventListener('click', function () {
        location.reload();
    });

    // اختيار الصور
    newGalleryImages.addEventListener('change', function () {
        previewImages(this);
    });

    function previewImages(input) {
        imagePreviewContainer.innerHTML = '';
        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.classList.add('col-md-4', 'mb-2');
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-fluid', 'rounded', 'shadow');
                    img.style.height = '150px';
                    img.style.objectFit = 'cover';
                    div.appendChild(img);
                    imagePreviewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    // حذف الصور من المعاينة
    galleryPreview.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-image') || e.target.closest('.delete-image')) {
            const button = e.target.closest('.delete-image');
            const imagePath = button.getAttribute('data-image');

            const item = button.closest('.gallery-item');
            item.remove();

            // تحديث حقل existing_images
            const remaining = Array.from(galleryPreview.querySelectorAll('.gallery-item')).map(item =>
                item.getAttribute('data-path')
            );
            existingImagesInput.value = JSON.stringify(remaining);
        }
    });
});
</script>
@endsection
