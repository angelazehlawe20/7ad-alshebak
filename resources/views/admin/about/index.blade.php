@extends('admin.layouts.app')

@section('title', __('about.about_section'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-info-circle"></i> {{ __('about.about_section') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" id="aboutForm">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Images --}}
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-images mr-2"></i> {{ __('about.gallery_images') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="row gallery-preview mb-3">
                                    @forelse(json_decode($about->gallery_images ?? '[]') as $image)
                                        <div class="col-md-6 mb-2">
                                            <img src="{{ asset($image) }}" class="img-fluid rounded shadow" style="height: 150px; object-fit: cover;">
                                        </div>
                                    @empty
                                        <p class="text-muted">{{ __('about.no_gallery_images') }}</p>
                                    @endforelse
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="uploadImagesBtn">
                                        <i class="fas fa-edit"></i>&nbsp;{{ __('about.edit') }}
                                    </button>
                                    <input type="file" class="d-none" name="gallery_images[]" id="newGalleryImages" multiple accept="image/*">
                                    <div id="imagePreviewContainer" class="row mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Content Fields --}}
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i> {{ __('about.about_section') }}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label><strong>{{ __('about.main_text_en') }}</strong></label>
                                    <textarea class="form-control" name="main_text_en" rows="3" readonly>{{ $about->main_text_en ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.main_text_ar') }}</strong></label>
                                    <textarea class="form-control" name="main_text_ar" rows="3" readonly dir="rtl">{{ $about->main_text_ar ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_title_en') }}</strong></label>
                                    <input type="text" class="form-control" name="why_title_en" value="{{ $about->why_title_en ?? '' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_title_ar') }}</strong></label>
                                    <input type="text" class="form-control" name="why_title_ar" value="{{ $about->why_title_ar ?? '' }}" readonly dir="rtl">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_points_en') }}</strong></label>
                                    <div id="why-points-container-en">
                                        @forelse(json_decode($about->why_points_en ?? '[]') as $point)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="why_points_en[]" value="{{ $point }}" readonly>
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-point d-none"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">{{ __('about.no_points') }}</p>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary d-none add-point-btn" data-language="en">
                                        <i class="fas fa-plus"></i> {{ __('about.add_image') }}
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_points_ar') }}</strong></label>
                                    <div id="why-points-container-ar">
                                        @forelse(json_decode($about->why_points_ar ?? '[]') as $point)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="why_points_ar[]" value="{{ $point }}" readonly dir="rtl">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-point d-none"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">{{ __('about.no_points') }}</p>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary d-none add-point-btn" data-language="ar">
                                        <i class="fas fa-plus"></i> {{ __('about.add_image') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-primary btn-lg">
                            <i class="fas fa-edit mr-2"></i> {{ __('about.edit_about') }}
                        </button>

                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none">
                            <i class="fas fa-save mr-2"></i> {{ __('about.save_changes') }}
                        </button>

                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times mr-2"></i> {{ __('about.cancel') }}
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
        const uploadBtn = document.getElementById('uploadImagesBtn');
        const fileInput = document.getElementById('newGalleryImages');

        function enableEditMode() {
            document.querySelectorAll('#aboutForm input:not([type="hidden"]), #aboutForm textarea').forEach(input => {
                input.removeAttribute('readonly');
                input.removeAttribute('disabled');
            });
            document.querySelectorAll('.remove-point, .add-point-btn').forEach(btn => btn.classList.remove('d-none'));
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
            editBtn.classList.add('d-none');
            uploadBtn.classList.remove('d-none');
        }

        editBtn.addEventListener('click', enableEditMode);
        uploadBtn.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', function () {
            const container = document.getElementById('imagePreviewContainer');
            container.innerHTML = '';
            Array.from(fileInput.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const col = document.createElement('div');
                    col.classList.add('col-md-6', 'mb-2');
                    col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded shadow" style="height: 150px; object-fit: cover;">`;
                    container.appendChild(col);
                }
                reader.readAsDataURL(file);
            });
        });

        cancelBtn.addEventListener('click', () => window.location.reload());

        document.querySelectorAll('.add-point-btn').forEach(button => {
            button.addEventListener('click', function () {
                const language = this.dataset.language;
                const container = document.getElementById(`why-points-container-${language}`);
                const div = document.createElement('div');
                div.classList.add('input-group', 'mb-2');
                div.innerHTML = `
                    <input type="text" class="form-control" name="why_points_${language}[]" ${language === 'ar' ? 'dir="rtl"' : ''}>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-point"><i class="fas fa-trash"></i></button>
                    </div>
                `;
                container.appendChild(div);
            });
        });

        document.addEventListener('click', function (e) {
            if (e.target.closest('.remove-point')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
@endsection
