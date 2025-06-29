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
            <form action="{{ route('admin.about.update') }}" method="POST" id="aboutForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row gy-4">
                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-images mr-2"></i>&nbsp;{{ __('about.gallery_images') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="gallery-preview mb-3">
                                    @forelse(json_decode($about->gallery_images ?? '[]') as $image)
                                        <div class="col-md-6 mb-2">
                                            <img src="{{ asset($image) }}" class="img-fluid rounded shadow gallery-image"
                                                style="width: 100%; height: 150px; object-fit: cover;">
                                        </div>
                                    @empty
                                        <p class="text-muted">{{ __('about.no_gallery_images') }}</p>
                                    @endforelse
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="uploadImagesBtn">
                                        <i class="fas fa-edit"></i>&nbsp;{{ __('about.edit') }}
                                    </button>
                                    <input type="file" class="d-none" name="gallery_images[]" id="newGalleryImages"
                                        multiple accept="image/*">
                                    <div id="imagePreviewContainer" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>&nbsp;{{ __('about.about_content') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('about.main_text_en') }}</strong></label>
                                    <textarea class="form-control" name="main_text_en" disabled rows="3">{{ $about->main_text_en ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.main_text_ar') }}</strong></label>
                                    <textarea class="form-control" name="main_text_ar" disabled rows="3">{{ $about->main_text_ar ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_title_en') }}</strong></label>
                                    <input type="text" class="form-control" name="why_title_en" disabled
                                        value="{{ $about->why_title_en ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_title_ar') }}</strong></label>
                                    <input type="text" class="form-control" name="why_title_ar" disabled
                                        value="{{ $about->why_title_ar ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_points_en') }}</strong></label>
                                    <div id="why-points-container-en">
                                        @forelse(json_decode($about->why_points_en ?? '[]') as $point)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="why_points_en[]" disabled value="{{ $point }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-point d-none">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">{{ __('about.no_points') }}</p>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary d-none add-point-btn" data-language="en">
                                        <i class="fas fa-plus"></i> {{ __('about.add_point_en') }}
                                    </button>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('about.why_points_ar') }}</strong></label>
                                    <div id="why-points-container-ar">
                                        @forelse(json_decode($about->why_points_ar ?? '[]') as $point)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="why_points_ar[]" disabled value="{{ $point }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-danger remove-point d-none">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-muted">{{ __('about.no_points') }}</p>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary d-none add-point-btn" data-language="ar">
                                        <i class="fas fa-plus"></i> {{ __('about.add_point_ar') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-secondary btn-lg" style="background-color: #8B7355;">
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
<script src="{{ asset('assets/js/aboutPage.js') }}"></script>
@endsection
