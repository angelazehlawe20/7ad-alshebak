@extends('admin.layouts.app')

@section('title', __('settings.site_settings'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-cogs me-2"></i> {{ __('settings.site_settings') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.settings.update') }}" method="POST" id="settingsForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row gy-4">
                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-address-card me-2"></i> {{ __('settings.contact_information') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('settings.address_ar') }}</strong></label>
                                    <textarea class="form-control editable-field @error('address_ar') is-invalid @enderror" id="address_ar" name="address_ar" rows="3" disabled>{{ old('address_ar', $settings->address_ar ?? '') }}</textarea>
                                    @error('address_ar')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.address_en') }}</strong></label>
                                    <textarea class="form-control editable-field @error('address_en') is-invalid @enderror" id="address_en" name="address_en" rows="3" disabled>{{ old('address_en', $settings->address_en ?? '') }}</textarea>
                                    @error('address_en')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.email') }}</strong></label>
                                    <input type="email" class="form-control editable-field @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $settings->email ?? '') }}" disabled>
                                    @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.phone') }}</strong></label>
                                    <input type="tel" class="form-control editable-field @error('phone') is-invalid @enderror" id="phone" name="phone" maxlength="10" value="{{ old('phone', $settings->phone ?? '') }}" disabled>
                                    @error('phone')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.opening_hours') }}</strong></label>
                                    <input type="text" class="form-control editable-field @error('opening_hours') is-invalid @enderror" id="opening_hours" name="opening_hours" value="{{ old('opening_hours', $settings->opening_hours ?? '') }}" disabled>
                                    @error('opening_hours')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-share-alt me-2"></i> {{ __('settings.social_media_logo') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('settings.facebook_url') }}</strong></label>
                                    <input type="url" class="form-control editable-field @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings->facebook_url ?? '') }}" disabled>
                                    @error('facebook_url')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.instagram_url') }}</strong></label>
                                    <input type="url" class="form-control editable-field @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings->instagram_url ?? '') }}" disabled>
                                    @error('instagram_url')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.whatsapp') }}</strong></label>
                                    <input type="text" class="form-control editable-field @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $settings->whatsapp ?? '') }}" disabled>
                                    @error('whatsapp')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.logo') }}</strong></label>
                                    <input type="file" class="form-control editable-field @error('logo') is-invalid @enderror" id="logo" name="logo" disabled>
                                    @error('logo')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    @php $logoPath = isset($settings) && $settings->logo ? asset($settings->logo) : asset('assets/img/logos/web-app-manifest-512x512.png'); @endphp
                                    <img id="logo-preview" src="{{ $logoPath }}" alt="Logo" class="mt-2 img-thumbnail" style="max-height: 50px">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('settings.favicon') }}</strong></label>
                                    <input type="file" class="form-control editable-field @error('favicon') is-invalid @enderror" id="favicon" name="favicon" disabled>
                                    @error('favicon')<span class="invalid-feedback">{{ $message }}</span>@enderror
                                    @php $faviconPath = isset($settings) && $settings->favicon ? asset($settings->favicon) : asset('assets/img/logos/web-app-manifest-512x512.png'); @endphp
                                    <img id="favicon-preview" src="{{ $faviconPath }}" alt="Favicon" class="mt-2 img-thumbnail" style="max-height: 50px">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-lg" style="background-color: #8B7355; color: white;">
                            <i class="fas fa-edit me-2"></i> {{ __('settings.edit_settings') }}
                        </button>
                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none">
                            <i class="fas fa-save me-2"></i> {{ __('settings.save_changes') }}
                        </button>
                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times me-2"></i> {{ __('settings.cancel') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        const fields = document.querySelectorAll('.editable-field');
        const originalValues = {};

        fields.forEach(field => {
            if (field.type !== 'file') {
                originalValues[field.name] = field.value;
            }
        });

        editBtn.addEventListener('click', () => {
            fields.forEach(field => field.disabled = false);
            editBtn.classList.add('d-none');
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
        });

        cancelBtn.addEventListener('click', () => {
            fields.forEach(field => {
                field.disabled = true;
                if (originalValues[field.name] !== undefined && field.type !== 'file') {
                    field.value = originalValues[field.name];
                }
            });
            editBtn.classList.remove('d-none');
            saveBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');
        });
    });
</script>
@endpush
