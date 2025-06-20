@extends('admin.layouts.app')

@section('title', 'Settings')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-cogs"></i>&nbsp;&nbsp;Site Settings</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('admin.settings.update') }}" method="POST" id="settingsForm"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-address-card mr-2"></i>&nbsp;&nbsp;Contact
                                    Information</h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="form-group mb-4">
                                    <label for="address"><i
                                            class="fas fa-map-marker-alt mr-2"></i>&nbsp;&nbsp;<strong>Address</strong></label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                        name="address" readonly rows="3"
                                        style="resize: vertical;">{{ old('address', $settings->address ?? '') }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="email"><i
                                            class="fas fa-envelope mr-2"></i>&nbsp;&nbsp;<strong>Email</strong></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" readonly
                                        value="{{ old('email', $settings->email ?? '') }}">
                                    @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="phone"><i
                                            class="fas fa-phone mr-2"></i>&nbsp;&nbsp;<strong>Phone</strong></label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" readonly
                                        value="{{ old('phone', $settings->phone ?? '') }}">
                                    @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="opening_hours"><i
                                            class="fas fa-clock mr-2"></i>&nbsp;&nbsp;<strong>Opening
                                            Hours</strong></label>
                                    <input type="text" class="form-control @error('opening_hours') is-invalid @enderror"
                                        id="opening_hours" name="opening_hours" readonly
                                        value="{{ old('opening_hours', $settings->opening_hours ?? '') }}">
                                    @error('opening_hours')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-share-alt mr-2"></i>&nbsp;&nbsp;Social Media &
                                    Logo</h3>
                            </div>
                            <div class="card-body pt-4">
                                <div class="form-group mb-4">
                                    <label for="facebook_url"><i
                                            class="fab fa-facebook mr-2"></i>&nbsp;&nbsp;<strong>Facebook
                                            URL</strong></label>
                                    <input type="url" class="form-control @error('facebook_url') is-invalid @enderror"
                                        id="facebook_url" name="facebook_url" readonly
                                        value="{{ old('facebook_url', $settings->facebook_url ?? '') }}">
                                    @error('facebook_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="instagram_url"><i
                                            class="fab fa-instagram mr-2"></i>&nbsp;&nbsp;<strong>Instagram
                                            URL</strong></label>
                                    <input type="url" class="form-control @error('instagram_url') is-invalid @enderror"
                                        id="instagram_url" name="instagram_url" readonly
                                        value="{{ old('instagram_url', $settings->instagram_url ?? '') }}">
                                    @error('instagram_url')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="whatsapp"><i
                                            class="fab fa-whatsapp mr-2"></i>&nbsp;&nbsp;<strong>WhatsApp</strong></label>
                                    <input type="text" class="form-control @error('whatsapp') is-invalid @enderror"
                                        id="whatsapp" name="whatsapp" readonly
                                        value="{{ old('whatsapp', $settings->whatsapp ?? '') }}">
                                    @error('whatsapp')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label for="logo"><i
                                            class="fas fa-image mr-2"></i>&nbsp;&nbsp;<strong>Logo</strong></label>
                                    <input type="file" class="form-control @error('logo') is-invalid @enderror"
                                        id="logo" name="logo" readonly disabled>
                                    @error('logo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if($settings->logo)
                                    <img id="logo-preview" src="{{ asset('uploads/settings/' . $settings->logo) }}"
                                        alt="Logo" class="mt-2" style="max-height: 50px">
                                    @else
                                    <img id="logo-preview" src="#" alt="Logo Preview" class="mt-2 d-none"
                                        style="max-height: 50px">
                                    @endif
                                </div>

                                <div class="form-group mb-4">
                                    <label for="favicon"><i
                                            class="fas mr-2"></i>&nbsp;&nbsp;<strong>Favicon</strong></label>
                                    <input type="file" class="form-control @error('favicon') is-invalid @enderror"
                                        id="favicon" name="favicon" readonly disabled>
                                    @error('favicon')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    @if($settings->logo)
                                    <img id="favicon-preview" src="{{ asset('uploads/settings/' . $settings->favicon) }}"
                                        alt="Favicon" class="mt-2" style="max-height: 50px">
                                    @else
                                    <img id="favicon-preview" src="#" alt="Favicon Preview" class="mt-2 d-none"
                                        style="max-height: 50px">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-primary btn-lg">
                            <i class="fas fa-edit mr-2"></i>&nbsp;&nbsp;Edit Settings
                        </button>

                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none mx-2">
                            <i class="fas fa-save mr-2"></i>&nbsp;&nbsp;Save Changes
                        </button>

                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times mr-2"></i>&nbsp;&nbsp;Cancel
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

<script>
    // Function to handle image preview
    function handleImagePreview(inputId, previewId) {
        document.getElementById(inputId).addEventListener('change', function(event) {
            const [file] = event.target.files;
            if (file) {
                const imgPreview = document.querySelector('#' + previewId);
                imgPreview.src = URL.createObjectURL(file);
                imgPreview.classList.remove('d-none');
            }
        });
    }
    // Initialize preview handlers for both logo and favicon
    handleImagePreview('logo', 'logo-preview');
    handleImagePreview('favicon', 'favicon-preview');
</script>
    
@endsection