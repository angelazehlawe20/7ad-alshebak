document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const fileInput = document.getElementById('newHeroImage');

    function enableEditMode() {
        document.querySelectorAll('#heroForm input:not([type="hidden"]), #heroForm textarea').forEach(input => {
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });
        document.querySelectorAll('.delete-btn').forEach(btn => btn.classList.remove('d-none'));
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
        editBtn.classList.add('d-none');
        fileInput.classList.remove('d-none');
    }

    editBtn?.addEventListener('click', enableEditMode);

    window.previewImages = function (input) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewCard = document.createElement('div');
                    previewCard.className = 'col-md-4';
                    previewCard.innerHTML = `
                        <div class="position-relative" style="height: 200px;">
                            <img src="${e.target.result}" class="img-fluid rounded shadow w-100 h-100"
                                alt="Preview" style="object-fit: cover;">
                            <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                                onclick="removePreview(${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    container.appendChild(previewCard);
                };
                reader.readAsDataURL(file);
            });
        }
    };

    window.removePreview = function(index) {
        const container = document.getElementById('imagePreviewContainer');
        container.children[index]?.remove();
    };

    window.deleteImage = function(imageId) {
        if (confirm('Are you sure you want to delete this image?')) {
            fetch(`/admin/hero/delete-image`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ image_id: imageId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`[onclick="deleteImage(${imageId})"]`)
                        .closest('.col-md-4').remove();
                }
            })
            .catch(error => console.error('Error:', error));
        }
    };

    cancelBtn?.addEventListener('click', () => window.location.reload());
});
