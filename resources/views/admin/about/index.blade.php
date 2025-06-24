@extends('admin.layouts.app')

@section('title', __('navbar.hero_section'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-home"></i> {{ __('messages.hero_section') }}</h1>
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
                                <h3 class="card-title"><i class="fas fa-image mr-2"></i>{{ __('messages.hero_images') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="gallery-preview mb-3">
                                    @if($heroPage && $heroPage->image && file_exists(public_path($heroPage->image)))
                                    <img src="{{ asset($heroPage->image) }}"
                                        class="img-fluid rounded shadow gallery-image" alt="Hero Image"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="uploadImagesBtn">
                                        <i class="fas fa-edit"></i>&nbsp;{{ __('messages.edit_image') }}
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
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>{{ __('messages.hero_content') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label><strong>{{ __('messages.english_title') }}</strong></label>
                                    <input type="text" class="form-control" name="title_en"
                                        value="{{ $heroPage->title_en ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('messages.arabic_title') }}</strong></label>
                                    <input type="text" class="form-control" name="title_ar"
                                        value="{{ $heroPage->title_ar ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('messages.english_text') }}</strong></label>
                                    <textarea class="form-control" name="main_text_en"
                                        rows="3">{{ $heroPage->main_text_en ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('messages.arabic_text') }}</strong></label>
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
                            <i class="fas fa-edit mr-2"></i> {{ __('messages.edit_hero') }}
                        </button>

                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none">
                            <i class="fas fa-save mr-2"></i> {{ __('messages.save_changes') }}
                        </button>

                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times mr-2"></i> {{ __('messages.cancel') }}
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
    document.addEventListener('DOMContentLoaded', function() {
        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const uploadBtn = document.getElementById('uploadImagesBtn');
        const fileInput = document.getElementById('newHeroImage');

        function enableEditMode() {
            document.querySelectorAll('#heroForm input:not([type="hidden"]), #heroForm textarea').forEach(input => {
                input.removeAttribute('readonly');
                input.removeAttribute('disabled');
            });
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
            editBtn.classList.add('d-none');
            uploadBtn.classList.remove('d-none');
        }

        editBtn.addEventListener('click', enableEditMode);
        uploadBtn.addEventListener('click', () => fileInput.click());

        window.previewImage = function(input) {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = '';

            const galleryPreview = document.querySelector('.gallery-preview');
            if (galleryPreview) {
                galleryPreview.style.display = 'none';
            }

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    container.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" alt="Preview"
                                style="height: 200px; object-fit: contain;">
                            <div class="card-body p-2">
                                <p class="card-text small text-muted mb-0">${input.files[0].name}</p>
                            </div>
                        </div>
                    `;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        cancelBtn.addEventListener('click', () => window.location.reload());
    });
</script>
@endsection
