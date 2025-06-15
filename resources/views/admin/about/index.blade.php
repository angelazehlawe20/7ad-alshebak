@extends('admin.layouts.app')

@section('title', 'About Page')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-info-circle"></i> About Page</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.about.update') }}" method="POST" id="aboutForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-image mr-2"></i>Gallery Images</h3>
                            </div>
                            <div class="card-body">
                                <div class="gallery-preview mb-3">
                                    @php
                                    $gallery = json_decode($about->gallery_images ?? '[]');
                                    @endphp

                                    @forelse($gallery as $image)
                                    @if(Storage::disk('public')->exists($image))
                                    <div class="gallery-item">
                                        <a class="glightbox" data-gallery="images-gallery"
                                            href="{{ asset('storage/' . $image) }}">
                                            <img src="{{ asset('storage/' . $image) }}"
                                                class="img-fluid rounded shadow gallery-image" alt="Gallery Image"
                                                loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-image d-none"
                                            data-image="{{ $image }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    @endif
                                    @empty
                                    <div class="text-center text-muted">No images available.</div>
                                    @endforelse
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="uploadImagesBtn" onclick="document.getElementById('newGalleryImages').click()">
                                        <i class="fas fa-upload"></i>&nbsp;Add New Images
                                    </button>
                                    <input type="file" class="d-none" name="new_gallery_images[]" id="newGalleryImages" multiple
                                        accept="image/*" onchange="previewImages(this)">
                                    <input type="hidden" name="existing_images" id="existingImages"
                                        value="{{ $about->gallery_images ?? '[]' }}">
                                    <div id="selectedFiles" class="mt-2">
                                        <div class="row" id="imagePreviewContainer"></div>
                                    </div>
                                </div>

                                <script>
                                function previewImages(input) {
                                    const container = document.getElementById('imagePreviewContainer');
                                    container.innerHTML = '';
                                    
                                    if (input.files && input.files.length > 0) {
                                        Array.from(input.files).forEach(file => {
                                            const reader = new FileReader();
                                            const col = document.createElement('div');
                                            col.className = 'col-md-4 mb-2';
                                            
                                            reader.onload = function(e) {
                                                col.innerHTML = `
                                                    <div class="card">
                                                        <img src="${e.target.result}" class="card-img-top" alt="Preview" style="height: 150px; object-fit: cover;">
                                                        <div class="card-body p-2">
                                                            <p class="card-text small text-muted mb-0">${file.name}</p>
                                                        </div>
                                                    </div>
                                                `;
                                            }
                                            
                                            reader.readAsDataURL(file);
                                            container.appendChild(col);
                                        });
                                    }
                                }
                                </script>

                                <script>
                                function handleFileSelect(input) {
                                    const selectedFiles = document.getElementById('selectedFiles');
                                    selectedFiles.innerHTML = '';
                                    
                                    if (input.files.length > 0) {
                                        const fileList = document.createElement('ul');
                                        fileList.className = 'list-unstyled';
                                        
                                        Array.from(input.files).forEach(file => {
                                            const li = document.createElement('li');
                                            li.textContent = file.name;
                                            fileList.appendChild(li);
                                        });
                                        
                                        selectedFiles.appendChild(fileList);
                                    }
                                }
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fas fa-align-left mr-2"></i>Main Content</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label><i class="fas fa-paragraph mr-2"></i><strong>Main Text</strong></label>
                                    <textarea class="form-control" name="main_text" rows="4"
                                        readonly>{{ $about->main_text ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><i class="fas mr-2"></i><strong>Why Choose Us Title</strong></label>
                                    <input type="text" class="form-control" name="why_title"
                                        value="{{ $about->why_title ?? 'Why Choose Us' }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label><i class="fas fa-list mr-2"></i><strong>Why Choose Us Points</strong></label>
                                    <div id="why-points-container">
                                        @forelse(json_decode($about->why_points ?? '[]') as $point)
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="why_points[]"
                                                value="{{ $point }}" readonly>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-danger remove-point d-none">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="why_points[]" readonly>
                                        </div>
                                        @endforelse
                                    </div>
                                    <button type="button" class="btn btn-sm btn-secondary d-none" id="addPointBtn">
                                        <i class="fas fa-plus"></i> Add Point
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="button" id="editBtn" class="btn btn-primary btn-lg">
                            <i class="fas fa-edit mr-2"></i> Edit About
                        </button>

                        <button type="submit" id="saveBtn" class="btn btn-success btn-lg d-none">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>

                        <button type="button" id="cancelBtn" class="btn btn-secondary btn-lg d-none">
                            <i class="fas fa-times mr-2"></i> Cancel
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
document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const addPointBtn = document.getElementById('addPointBtn');
    const fileInput = document.querySelector('input[type="file"]');
    const deleteButtons = document.querySelectorAll('.delete-image');

    function enableEditMode() {
    document.querySelectorAll('#aboutForm input:not([type="hidden"]), #aboutForm textarea').forEach(input => {
        input.removeAttribute('readonly');
    });
    fileInput.removeAttribute('disabled');
    saveBtn.classList.remove('d-none');
    cancelBtn.classList.remove('d-none');
    addPointBtn.classList.remove('d-none');
    editBtn.classList.add('d-none');
    document.getElementById('uploadImagesBtn').classList.remove('d-none'); // ← هذا السطر أضفناه
    document.querySelectorAll('.remove-point, .delete-image').forEach(btn => {
        btn.classList.remove('d-none');
    });
}

    editBtn.addEventListener('click', enableEditMode);

    addPointBtn.addEventListener('click', function() {
        const container = document.getElementById('why-points-container');
        const newInput = document.createElement('div');
        newInput.className = 'input-group mb-2';
        newInput.innerHTML = `
            <input type="text" class="form-control" name="why_points[]">
            <div class="input-group-append">
                <button type="button" class="btn btn-danger remove-point">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(newInput);
    });

    document.getElementById('why-points-container').addEventListener('click', function(e) {
        const removeButton = e.target.closest('.remove-point');
        if (removeButton) {
            removeButton.closest('.input-group').remove();
        }
    });

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const imageToDelete = this.dataset.image;
            const existingImagesInput = document.getElementById('existingImages');
            const existingImages = JSON.parse(existingImagesInput.value);

            if (confirm('Are you sure you want to delete this image?')) {
                fetch("{{ route('admin.about.deleteImage') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ image: imageToDelete })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        existingImagesInput.value = JSON.stringify(
                            existingImages.filter(img => img !== imageToDelete)
                        );
                        this.closest('.gallery-item').remove();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });

    cancelBtn.addEventListener('click', () => window.location.reload());

    document.getElementById('aboutForm').addEventListener('submit', function(e) {
        const whyPoints = document.querySelectorAll('input[name="why_points[]"]');
        let isEmpty = false;

        whyPoints.forEach(input => {
            if (!input.value.trim()) {
                isEmpty = true;
                input.classList.add('is-invalid');
            }
        });

        if (isEmpty) {
            e.preventDefault();
            alert('Please fill in all Why Choose Us points or remove empty ones.');
        }
    });
});
</script>
@endsection
