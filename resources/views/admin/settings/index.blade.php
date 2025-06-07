@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <i class="fas fa-cogs"></i> Site Settings
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right" style="background: transparent; margin-bottom: 0; padding: 0;">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" style="color: black; text-decoration: none; transition: color 0.2s;">
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item active" style="color: #c32d2d;">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @include('admin.partials.alerts')

            <form action="{{ route('admin.settings.update') }}" method="POST" id="settingsForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-address-card"></i> Contact Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="site_name"><i class="fas fa-building"></i> Site Name</label>
                                    <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                        id="site_name" name="site_name"
                                        value="{{ old('site_name', $settings['site_name'] ?? '') }}" disabled>
                                    @error('site_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="contact_email"><i class="fas fa-envelope"></i> Contact Email</label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                        id="contact_email" name="contact_email"
                                        value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" disabled>
                                    @error('contact_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number"><i class="fas fa-phone"></i> Phone Number</label>
                                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $settings['phone_number'] ?? '') }}"
                                        pattern="[0-9+\-\s]+" disabled>
                                    @error('phone_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info-circle"></i> About Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="about_ar"><i class="fas fa-language"></i> About (Arabic)</label>
                                    <textarea name="about_ar" id="about_ar"
                                        class="form-control @error('about_ar') is-invalid @enderror" rows="5"
                                        dir="rtl" disabled>{{ old('about_ar', $settings['about_ar'] ?? '') }}</textarea>
                                    @error('about_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="about_en"><i class="fas fa-language"></i> About (English)</label>
                                    <textarea name="about_en" id="about_en"
                                        class="form-control @error('about_en') is-invalid @enderror" rows="5"
                                        dir="ltr" disabled>{{ old('about_en', $settings['about_en'] ?? '') }}</textarea>
                                    @error('about_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center gap-4 my-4">
                            <button type="button" class="btn btn-primary px-5 py-3 rounded-pill fs-5" id="editBtn">
                                <i class="fas fa-edit me-2"></i>
                                <span>Edit Settings</span>
                            </button>

                            <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fs-5 d-none" id="saveBtn">
                                <i class="fas fa-save me-2"></i>
                                <span>Save Changes</span>
                            </button>

                            <button type="button" class="btn btn-light px-5 py-3 rounded-pill fs-5 d-none" id="cancelBtn">
                                <i class="fas fa-times me-2"></i>
                                <span>Cancel</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@push('scripts')
<script>
    $(function() {
        const form = $('#settingsForm');
        const editBtn = $('#editBtn');
        const saveBtn = $('#saveBtn');
        const cancelBtn = $('#cancelBtn');
        const inputs = $('#settingsForm input, #settingsForm textarea');
        let originalValues = {};

        // Store original values
        inputs.each(function() {
            originalValues[$(this).attr('name')] = $(this).val();
        });

        // Handle edit button click
        editBtn.on('click', function() {
            inputs.prop('disabled', false);
            saveBtn.removeClass('d-none');
            cancelBtn.removeClass('d-none');
            $(this).addClass('d-none');

            // Enable CKEditor instances if they exist
            if (typeof CKEDITOR !== 'undefined') {
                Object.values(CKEDITOR.instances).forEach(instance => {
                    instance.setReadOnly(false);
                });
            }
        });

        // Handle cancel button click
        cancelBtn.on('click', function() {
            // Reset form values and disable inputs
            inputs.each(function() {
                const name = $(this).attr('name');
                $(this).val(originalValues[name]).prop('disabled', true);
            });

            // Reset CKEditor content if it exists
            if (typeof CKEDITOR !== 'undefined') {
                Object.entries(CKEDITOR.instances).forEach(([name, instance]) => {
                    instance.setData(originalValues[name]);
                    instance.setReadOnly(true);
                });
            }

            // Toggle buttons visibility
            saveBtn.addClass('d-none');
            $(this).addClass('d-none');
            editBtn.removeClass('d-none');
        });

        // Handle form submission
        form.on('submit', function(e) {
            e.preventDefault();

            // Update CKEditor instances before submit
            if (typeof CKEDITOR !== 'undefined') {
                Object.values(CKEDITOR.instances).forEach(instance => {
                    instance.updateElement();
                });
            }

            // Show loading state
            saveBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

            // Submit the form
            this.submit();
        });

        // Initialize CKEditor if it exists
        if (typeof CKEDITOR !== 'undefined') {
            const editorConfig = {
                toolbar: [
                    ['Bold', 'Italic', 'Underline'],
                    ['NumberedList', 'BulletedList'],
                    ['Link', 'Unlink'],
                    ['Source']
                ],
                height: 200,
                removePlugins: 'elementspath',
                resize_enabled: false
            };

            CKEDITOR.replace('about_ar', {
                ...editorConfig,
                contentsLangDirection: 'rtl',
                language: 'ar',
                readOnly: true
            });

            CKEDITOR.replace('about_en', {
                ...editorConfig,
                contentsLangDirection: 'ltr',
                language: 'en',
                readOnly: true
            });
        }
    });
</script>
@endpush

@endsection
