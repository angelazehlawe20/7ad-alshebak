document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const uploadBtn = document.getElementById('uploadImagesBtn');
    const fileInput = document.getElementById('newHeroImage');

    function enableEditMode() {
        document.querySelectorAll('#heroForm input:not([type="hidden"]), #heroForm textarea').forEach(input => {
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
        editBtn.classList.add('d-none');
        uploadBtn.classList.remove('d-none');
    }

    editBtn?.addEventListener('click', enableEditMode);
    uploadBtn?.addEventListener('click', () => fileInput?.click());

    window.previewImage = function (input) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        const galleryPreview = document.querySelector('.gallery-preview');
        if (galleryPreview) {
            galleryPreview.style.display = 'none';
        }

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                container.innerHTML = `
                    <div class="card">
                        <img src="${e.target.result}" class="card-img-top" alt="Preview"
                            style="height: 200px; object-fit: contain;">
                        <div class="card-body p-2">
                            <p class="card-text small text-muted mb-0">${input.files[0].name}</p>
                        </div>
                    </div>
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    };

    cancelBtn?.addEventListener('click', () => window.location.reload());
});
