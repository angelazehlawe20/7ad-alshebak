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
                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-image mr-2"></i>&nbsp;{{ __('hero.hero_images') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="gallery-preview mb-3">
                                    @if($heroPage && $heroPage->image && file_exists(public_path($heroPage->image)))
                                    <img src="{{ asset($heroPage->image) }}"
                                        class="img-fluid rounded shadow gallery-image" alt="Hero Image"
                                        style="width: 100%; height: 100%; object-fit: contain;">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="uploadImagesBtn">
                                        <i class="fas fa-edit"></i>&nbsp;{{ __('hero.edit_image') }}
                                    </button>
                                    <input type="file" class="d-none" name="image" id="newHeroImage" accept="image/*"
                                        onchange="previewImage(this)">
                                    <div id="imagePreviewContainer" class="mt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>&nbsp;{{ __('hero.hero_content') }}</h3>
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

                                <div class="form-group">
                                    <label><strong>{{ __('hero.english_text') }}</strong></label>
                                    <textarea class="form-control" name="main_text_en" disabled
                                        rows="3">{{ $heroPage->main_text_en ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('hero.arabic_text') }}</strong></label>
                                    <textarea class="form-control" name="main_text_ar" disabled
                                        rows="3">{{ $heroPage->main_text_ar ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-secondary btn-lg" style="background-color: #8B7355;">
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
<script src="{{ asset('assets/js/heroAdminPage.js') }}"></script>
@endsection
