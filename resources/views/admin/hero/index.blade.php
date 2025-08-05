@extends('admin.layouts.app')

@section('title', __('hero.hero_section'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-home"></i>&nbsp;{{ __('hero.hero_section') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.hero.update') }}" method="POST" id="heroForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row gy-4">
                    <!-- Images Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-image mr-2"></i>&nbsp;{{ __('hero.hero_images')
                                    }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="gallery-preview mb-3">
                                    <div class="row g-3">
                                        @if($heroPage && $heroPage->images->isNotEmpty())
                                        @foreach($heroPage->images as $image)
                                        <div class="col-md-4">
                                            <div class="position-relative" style="height: 200px;">
                                                <img src="{{ asset($image->image_path) }}"
                                                    class="img-fluid rounded shadow w-100 h-100" alt="Hero Image"
                                                    style="object-fit: cover;">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 d-none delete-btn"
                                                    onclick="deleteImage({{ $image->id }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="col-12">
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="height: 200px;">
                                                <img src="{{ asset('assets/img/background.png') }}" class="img-fluid"
                                                    alt="Default Hero" style="max-height: 180px;">
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="file" class="form-control d-none" name="images[]" id="newHeroImage"
                                        accept="image/*" multiple onchange="previewImages(this)">
                                    <div id="imagePreviewContainer" class="mt-2 row g-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Text Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>&nbsp;{{
                                    __('hero.hero_content') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('hero.english_title') }}</strong></label>
                                    <input type="text" class="form-control" name="title_en" disabled
                                        value="{{ $heroPage->title_en ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('hero.arabic_title') }}</strong></label>
                                    <input type="text" class="form-control" name="title_ar" disabled
                                        value="{{ $heroPage->title_ar ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-secondary btn-lg"
                            style="background-color: #8B7355; outline: none; border: none;">
                            <i class="fas fa-edit mr-2"></i> {{ __('hero.edit_hero') }}
                        </button>

                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none">
                            <i class="fas fa-save mr-2"></i> {{ __('hero.save_changes') }}
                        </button>

                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times mr-2"></i> {{ __('hero.cancel') }}
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
    window.translations =
    {
        confirmDeleteImage: @json(__('hero.confirm_delete_image')),
    };
</script>
@endsection
