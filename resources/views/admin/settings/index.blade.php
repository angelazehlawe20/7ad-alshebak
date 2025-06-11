@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-cogs"></i> Site Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}" class="text-dark text-decoration-none hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active text-danger">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.settings.update') }}" method="POST" id="settingsForm">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-address-card mr-2"></i>Contact Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="site_name"><i class="fas fa-building mr-2"></i><strong>Site Name</strong></label>
                                    <input type="text" class="form-control @error('site_name') is-invalid @enderror"
                                        id="site_name" name="site_name" readonly
                                        value="{{ old('site_name', $settings['site_name'] ?? '') }}">
                                    @error('site_name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="contact_email"><i class="fas fa-envelope mr-2"></i><strong>Contact Email</strong></label>
                                    <input type="email" class="form-control @error('contact_email') is-invalid @enderror"
                                        id="contact_email" name="contact_email" readonly
                                        value="{{ old('contact_email', $settings['contact_email'] ?? '') }}">
                                    @error('contact_email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number"><i class="fas fa-phone mr-2"></i><strong>Phone Number</strong></label>
                                    <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                                        id="phone_number" name="phone_number" readonly
                                        value="{{ old('phone_number', $settings['phone_number'] ?? '') }}">
                                    @error('phone_number')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>About Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="about_ar"><i class="fas fa-language mr-2"></i><strong>About (Arabic)</strong></label>
                                    <textarea class="form-control @error('about_ar') is-invalid @enderror"
                                        id="about_ar" name="about_ar" rows="5" dir="rtl" readonly>{{ old('about_ar', $settings['about_ar'] ?? '') }}</textarea>
                                    @error('about_ar')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="about_en"><i class="fas fa-language mr-2"></i><strong>About (English)</strong></label>
                                    <textarea class="form-control @error('about_en') is-invalid @enderror"
                                        id="about_en" name="about_en" rows="5" dir="ltr" readonly>{{ old('about_en', $settings['about_en'] ?? '') }}</textarea>
                                    @error('about_en')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-primary btn-lg">
                            <i class="fas fa-edit mr-2"></i>Edit Settings
                        </button>

                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </button>

                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times mr-2"></i>Cancel
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
document.getElementById('editBtn').addEventListener('click', function() {
    const inputs = document.querySelectorAll('#settingsForm input, #settingsForm textarea');
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
    });

    // Show Save & Cancel buttons
    document.getElementById('saveBtn').classList.remove('d-none');
    document.getElementById('cancelBtn').classList.remove('d-none');
    this.classList.add('d-none');
});

// Cancel button logic
document.getElementById('cancelBtn').addEventListener('click', function () {
    window.location.reload(); // Reload to discard changes
});
</script>
@endsection
