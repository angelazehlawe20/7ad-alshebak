@extends('admin.layouts.app')
@section('title', __('offers.edit') . ' ' . __('offers.offers'))

@php
function formatArabicNumber($number) {
    $westernNumbers = ['0','1','2','3','4','5','6','7','8','9'];
    $arabicNumbers = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
    return str_replace($westernNumbers, $arabicNumbers, $number);
}
@endphp

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-tag"></i>&nbsp;&nbsp;{{ __('offers.edit') }} {{ __('offers.offers') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.offers.update', $offer->id) }}" method="POST" id="offerForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row gy-4"> <!-- Added gy-4 class for vertical gutters -->
                    <div class="col-md-6">
                        <div class="card bg-beige card-outline mb-4"> <!-- Added mb-4 margin bottom -->
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-image mr-2"></i>&nbsp;&nbsp;{{ __('offers.image') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="gallery-preview mb-3">
                                    @if($offer->image && file_exists(public_path($offer->image)))
                                        <img src="{{ asset($offer->image) }}" class="img-fluid rounded shadow gallery-image" alt="Offer Image" style="width: 100%; height: 100%; object-fit: contain;">
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-cog mr-2"></i>&nbsp;&nbsp;{{ __('offers.settings') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('offers.status') }}</strong></label>
                                    <select name="active" class="form-select">
                                        <option value="1" {{ old('active', $offer->active) == 1 ? 'selected' : '' }}>{{ __('offers.active') }}</option>
                                        <option value="0" {{ old('active', $offer->active) == 0 ? 'selected' : '' }}>{{ __('offers.inactive') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('offers.price') }}</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><strong>{{__('admins.syp')}}</strong></span>
                                        <input type="text" name="price" class="form-control fw-bold"
                                            value="{{
                                                app()->getLocale() === 'ar'
                                                ? formatArabicNumber(round(old('price', $offer->price)))
                                                : round(old('price', $offer->price))
                                            }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>&nbsp;&nbsp;{{ __('offers.content') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('offers.title_en') }}</strong></label>
                                    <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $offer->title_en) }}">
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('offers.title_ar') }}</strong></label>
                                    <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $offer->title_ar) }}">
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('offers.description_en') }}</strong></label>
                                    <textarea name="description_en" class="form-control" rows="3">{{ old('description_en', $offer->description_en) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label><strong>{{ __('offers.description_ar') }}</strong></label>
                                    <textarea name="description_ar" class="form-control" rows="3">{{ old('description_ar', $offer->description_ar) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save mr-2"></i>&nbsp;&nbsp;{{ __('offers.update_offer') }}
                        </button>
                        <a href="{{ route('admin.offers.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times mr-2"></i>&nbsp;&nbsp;{{ __('offers.cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/admin/editOfferPage.js') }}"></script>
@endsection
