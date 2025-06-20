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

                                <div class="gallery-preview mb-3 row">
                                    @forelse($gallery as $image)
                                        @if(file_exists(public_path($image)))
                                        <div class="gallery-item col-md-6 position-relative mb-2">
                                            <a class="glightbox" data-gallery="images-gallery" href="{{ asset($image) }}">
                                                <img src="{{ asset($image) }}"
                                                    class="img-fluid rounded shadow gallery-image" alt="Gallery Image"
                                                    style="width: 100%; height: 150px; object-fit: cover;">
                                            </a>

                                            <button type="button"
                                                class="btn btn-warning btn-sm position-absolute top-0 start-0 m-1 edit-image d-none"
                                                data-image="{{ $image }}">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <button type="button"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image d-none"
                                                data-image="{{ $image }}">
                                                <i class="fas fa-trash"></i>
                                            </button>

                                            <input type="file" class="d-none replace-image-input" accept="image/*"
                                                data-image="{{ $image }}">
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
                                        multiple accept="image/*" onchange="previewImages(this)">
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
                                {{-- النص الرئيسي --}}
                                <div class="form-group">
                                    <label><i class="fas fa-paragraph mr-2"></i><strong>Main Text</strong></label>
                                    <textarea class="form-control" name="main_text" rows="4" readonly>{{ $about->main_text ?? '' }}</textarea>
                                </div>

                                {{-- عنوان Why Choose Us --}}
                                <div class="form-group">
                                    <label><i class="fas fa-heading mr-2"></i><strong>Why Choose Us Title</strong></label>
                                    <input type="text" class="form-control" name="why_title" value="{{ $about->why_title ?? 'Why Choose Us' }}" readonly>
                                </div>

                                {{-- النقاط --}}
                                <div class="form-group">
                                    <label><i class="fas fa-list-ul mr-2"></i><strong>Why Choose Us Points</strong></label>
                                    <div id="why-points-container">
                                        @forelse(json_decode($about->why_points ?? '[]') as $point)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="why_points[]" value="{{ $point }}" readonly>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-point d-none">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="why_points[]" readonly>
                                            </div>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="addPointBtn">
                                        <i class="fas fa-plus"></i> Add Point
                                    </button>
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
    window.routes = {
        updateImage: "{{ route('admin.about.updateImage') }}",
        deleteImage: "{{ route('admin.about.deleteImage') }}"
    };
</script>

<script src="{{ asset('assets/js/aboutPage.js') }}"></script>
@endsection
 <style>
.glightbox-close {
    display: block !important;  /* اجبر ظهور زر الإغلاق */
    position: fixed !important;
    top: 20px !important;
    right: 20px !important;
    z-index: 1050 !important;
    width: 40px !important;
    height: 40px !important;
    background: rgba(0,0,0,0.5) url('https://cdn.jsdelivr.net/npm/glightbox/dist/images/close.svg') center center no-repeat !important;
    background-size: 18px 18px !important;
    border-radius: 50% !important;
    cursor: pointer !important;
}
</style>
