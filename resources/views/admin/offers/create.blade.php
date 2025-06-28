@extends('admin.layouts.app')
@section('title', __('offers.add_offer'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('offers.add_offer') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.offers.store') }}" method="POST" class="needs-validation"
                        enctype="multipart/form-data" novalidate>
                        @csrf

                        <div class="row">
                            {{-- Category --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="category_id" class="form-label">{{ __('offers.filter_by_category')
                                        }}</label>
                                    <select name="category_id" class="form-select" required>
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
                            </div>

                            {{-- Price --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.price') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="price" step="0.01" class="form-control"
                                            value="{{ old('price') }}" required>
                                        <div class="invalid-feedback">Please enter the price.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Title English --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.title_en') }}</label>
                                    <input type="text" name="title_en" class="form-control"
                                        value="{{ old('title_en') }}" required>
                                    <div class="invalid-feedback">Please enter the English title.</div>
                                </div>
                            </div>

                            {{-- Title Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.title_ar') }}</label>
                                    <input type="text" name="title_ar" class="form-control"
                                        value="{{ old('title_ar') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Description English --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.description_en') }}</label>
                                    <textarea name="description_en" class="form-control"
                                        rows="4">{{ old('description_en') }}</textarea>
                                </div>
                            </div>

                            {{-- Description Arabic --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.description_ar') }}</label>
                                    <textarea name="description_ar" class="form-control"
                                        rows="4">{{ old('description_ar') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.status') }}</label>
                                    <select name="active" class="form-select" required>
                                        <option value="1" {{ old('active', '1' )=="1" ? 'selected' : '' }}>{{
                                            __('offers.active') }}</option>
                                        <option value="0" {{ old('active')=="0" ? 'selected' : '' }}>{{
                                            __('offers.inactive') }}</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Valid Until --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.valid_until') }}</label>
                                    <input type="datetime-local" name="valid_until" class="form-control"
                                        value="{{ old('valid_until') ? \Carbon\Carbon::parse(old('valid_until'))->format('Y-m-d\TH:i') : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- Image --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('offers.image') }}</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img src="" alt="Image Preview" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">{{ __('offers.add_offer') }}</button>
                            <a href="{{ route('admin.offers.index') }}" class="btn btn-light">{{ __('offers.cancel')
                                }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/createOfferPage.js') }}"></script>
@endpush
