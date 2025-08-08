@extends('admin.layouts.app')
@section('title', __('offers.edit') . ' ' . __('offers.offers'))

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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin.offers.update', $offer->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')
                <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">
                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-image"></i>&nbsp;&nbsp;{{ __('offers.image') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: {{ $offer->image ? 'block' : 'none' }};">
                                        <img src="{{ $offer->image ? asset($offer->image) : '' }}"
                                            alt="{{ __('offers.image') }}" class="img-fluid rounded shadow"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-beige card-outline mt-4">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-cog"></i>&nbsp;&nbsp;{{ __('offers.settings') }}</h3>
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
                                        <span class="input-group-text"><strong>{{ __('admins.syp') }}</strong></span>
                                        <input type="text" name="price" class="form-control fw-bold"
                                            value="{{ round(old('price', $offer->price)) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-align-left"></i>&nbsp;&nbsp;{{ __('offers.content') }}</h3>
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
                            <i class="fas fa-save"></i>&nbsp;&nbsp;{{ __('offers.update_offer') }}
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
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
<script src="{{ asset('assets/js/editOfferPage.js') }}"></script>
@endpush
