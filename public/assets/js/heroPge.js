document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const uploadBtn = document.getElementById('uploadImagesBtn');
    const fileInput = document.getElementById('newHeroImage');
    const deleteButtons = document.querySelectorAll('.delete-image');

    function enableEditMode() {
        document.querySelectorAll('#heroForm input:not([type="hidden"]), #heroForm textarea').forEach(input => {
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
        editBtn.classList.add('d-none');
        uploadBtn.classList.remove('d-none');
        deleteButtons.forEach(btn => btn.classList.remove('d-none'));
    }

    editBtn.addEventListener('click', enableEditMode);

    uploadBtn.addEventListener('click', () => fileInput.click());

    window.previewImage = function(input) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                container.innerHTML = `
                    <div class="card">
                        <img src="${e.target.result}" class="card-img-top" alt="Preview"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-body p-2">
                            <p class="card-text small text-muted mb-0">${input.files[0].name}</p>
                        </div>
                    </div>
                `;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to delete this image?')) {
                const imageToDelete = this.dataset.image;
                const galleryPreview = this.closest('.gallery-preview');

                // Send AJAX request to delete the image
                fetch('/admin/hero/delete-image', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        image: imageToDelete
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        galleryPreview.remove();
                    } else {
                        alert('Failed to delete image. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while deleting the image.');
                });
            }
        });
    });

    cancelBtn.addEventListener('click', () => window.location.reload());
});

