@extends('admin.layouts.app')

@section('title', __('about.about_section'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-info-circle"></i>&nbsp;{{ __('about.about_section') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" id="aboutForm">
                @csrf
                @method('PUT')

                <!-- حقل مخفي يحتوي الصور والفيديوهات الموجودة -->
                <input type="hidden" name="existing_images" id="existingImagesInput"
                    value="{{ $about->gallery_images }}">

                <div class="row gy-4">
                    <!-- معرض الصور والفيديوهات -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-images mr-2"></i>&nbsp;{{
                                    __('about.gallery_images') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="gallery-preview mb-3 row" id="existingGallery">
                                    @php use Illuminate\Support\Str; @endphp
                                    @forelse(json_decode($about->gallery_images ?? '[]') as $media)
                                    <div class="col-md-6 mb-2 existing-image-wrapper">
                                        @if(Str::endsWith($media, ['.mp4', '.webm', '.ogg']))
                                        <video class="img-fluid rounded shadow gallery-image"
                                            style="width: 100%; height: 150px; object-fit: cover;" controls>
                                            <source src="{{ asset($media) }}">
                                            {{ __('about.video_not_supported') }}
                                        </video>
                                        @else
                                        <img src="{{ asset($media) }}" class="img-fluid rounded shadow gallery-image"
                                            style="width: 100%; height: 150px; object-fit: cover;">
                                        @endif
                                        <button type="button" class="btn btn-sm btn-danger mt-1 remove-image-btn"
                                            data-path="{{ $media }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    @empty
                                    <p class="text-muted">{{ __('about.no_gallery_images') }}</p>
                                    @endforelse
                                </div>

                                <!-- مكان عرض معاينة الصور والفيديوهات الجديدة -->
                                <div class="gallery-preview row mt-3" id="newImagesPreview"></div>

                                <div class="form-group mt-3">
                                    <input type="file" name="gallery_images[]" class="form-control form-field" id="newGalleryImages" disabled multiple
                                        accept="image/*,video/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- النصوص -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>&nbsp;{{
                                    __('about.about_content') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('about.main_text_en') }}</strong></label>
                                    <textarea class="form-control form-field" name="main_text_en" readonly
                                        rows="3">{{ $about->main_text_en ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.main_text_ar') }}</strong></label>
                                    <textarea class="form-control form-field" name="main_text_ar" readonly
                                        rows="3">{{ $about->main_text_ar ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_title_en') }}</strong></label>
                                    <input type="text" class="form-control form-field" name="why_title_en" readonly
                                        value="{{ $about->why_title_en ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_title_ar') }}</strong></label>
                                    <input type="text" class="form-control form-field" name="why_title_ar" readonly
                                        value="{{ $about->why_title_ar ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_points_en') }}</strong></label>
                                    <div id="why-points-container-en">
                                        @forelse(json_decode($about->why_points_en ?? '[]') as $point)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control form-field" name="why_points_en[]" readonly
                                                value="{{ $point }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-point" disabled>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="text-muted">{{ __('about.no_points') }}</p>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary add-point-btn" disabled
                                        data-language="en">
                                        <i class="fas fa-plus"></i> {{ __('about.add_point_en') }}
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_points_ar') }}</strong></label>
                                    <div id="why-points-container-ar">
                                        @forelse(json_decode($about->why_points_ar ?? '[]') as $point)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control form-field" name="why_points_ar[]" readonly
                                                value="{{ $point }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-point" disabled>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @empty
                                        <p class="text-muted">{{ __('about.no_points') }}</p>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary add-point-btn" disabled
                                        data-language="ar">
                                        <i class="fas fa-plus"></i> {{ __('about.add_point_ar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- أزرار الحفظ -->
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-primary btn-lg edit-mode-btn">
                            <i class="fas fa-edit mr-2"></i> {{ __('about.edit') }}
                        </button>
                        <button type="submit" class="btn btn-success btn-lg save-changes-btn d-none">
                            <i class="fas fa-save mr-2"></i> {{ __('about.save_changes') }}
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
    const messages = {
        confirmDeleteFile: "{{ __('about.confirm_delete_file') }}",
        deleteFileFailed: "{{ __('about.delete_file_failed') }}",
        deleteFileError: "{{ __('about.delete_file_error') }}",
    };
</script>
<script src="{{ asset('assets/js/aboutPage.js') }}"></script>
@endsection
