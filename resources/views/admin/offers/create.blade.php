@extends('admin.layouts.app')
@section('title', __('offers.add_offer'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-tag"></i>&nbsp;&nbsp;{{ __('offers.add_offer') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.offers.store') }}" method="POST" class="needs-validation"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row gy-4">
                    <!-- Added gy-4 class for vertical spacing -->
                    <div class="col-md-6">
                        <div class="card bg-beige card-outline h-100">
                            <!-- Added h-100 to match heights -->
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;{{
                                    __('offers.basic_info') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('offers.filter_by_category') }}</strong></label>
                                    <select name="category_id" class="form-select">
                                        <option value="">{{ __('offers.all_categories') }}</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ?
                                            'selected' : '' }}>
                                            {{ $category->name_en }} - {{ $category->name_ar }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Please select a category.</div>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('offers.price') }}</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><strong>{{__('admins.syr')}}</strong></span>
                                        <input type="number" name="price" step="0.01" class="form-control fw-bold"
                                            value="{{ old('price') }}">
                                    </div>
                                    <div class="invalid-feedback">{{__('errors.enter_the_price')}}</div>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('offers.status') }}</strong></label>
                                    <select name="active" class="form-select">
                                        <option value="1" {{ old('active', '1' )=="1" ? 'selected' : '' }}>{{
                                            __('offers.active') }}</option>
                                        <option value="0" {{ old('active')=="0" ? 'selected' : '' }}>{{
                                            __('offers.inactive') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-beige card-outline h-100">
                            <!-- Added h-100 to match heights -->
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-image"></i>&nbsp;&nbsp;{{
                                    __('offers.offer_content') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('offers.title_en') }}</strong></label>
                                    <input type="text" name="title_en" class="form-control"
                                        value="{{ old('title_en') }}">
                                    <div class="invalid-feedback">Please enter the English title.</div>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('offers.title_ar') }}</strong></label>
                                    <input type="text" name="title_ar" class="form-control"
                                        value="{{ old('title_ar') }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('offers.description_en') }}</strong></label>
                                    <textarea name="description_en" class="form-control"
                                        rows="3">{{ old('description_en') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('offers.description_ar') }}</strong></label>
                                    <textarea name="description_ar" class="form-control"
                                        rows="3">{{ old('description_ar') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('offers.image') }}</strong></label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img src="" alt="Image Preview" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-lg" style="background-color: #8B7355; color: white;">
                            <i class="fas fa-plus"></i>&nbsp;&nbsp;{{ __('offers.add_offer') }}
                        </button>
                        <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i>&nbsp;&nbsp;{{ __('offers.cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/createOfferPage.js') }}"></script>
@endpush
