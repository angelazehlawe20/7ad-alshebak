document.addEventListener('DOMContentLoaded', function () {
    const { updateUrl, csrfToken } = window.aboutPageConfig || {};

    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const uploadBtn = document.getElementById('uploadImagesBtn');
    const fileInput = document.getElementById('newGalleryImages');

    function enableEditMode() {
        document.querySelectorAll('#aboutForm input:not([type="hidden"]), #aboutForm textarea').forEach(input => {
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });
        document.querySelectorAll('.remove-point, .add-point-btn').forEach(btn => btn.classList.remove('d-none'));
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
        editBtn.classList.add('d-none');
        uploadBtn.classList.remove('d-none');
    }

    editBtn?.addEventListener('click', enableEditMode);

    uploadBtn?.addEventListener('click', () => fileInput?.click());

    fileInput?.addEventListener('change', function () {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';
        Array.from(fileInput.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.classList.add('col-md-6', 'mb-2');
                col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded shadow" style="height: 150px; object-fit: cover;">`;
                container.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    });

    cancelBtn?.addEventListener('click', () => window.location.reload());

    document.querySelectorAll('.add-point-btn').forEach(button => {
        button.addEventListener('click', function () {
            const language = this.dataset.language;
            const container = document.getElementById(`why-points-container-${language}`);
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" class="form-control" name="why_points_${language}[]" ${language === 'ar' ? 'dir="rtl"' : ''}>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-point"><i class="fas fa-trash"></i></button>
                </div>
            `;
            container.appendChild(div);
        });
    });

    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-point')) {
            e.target.closest('.input-group').remove();
        }
    });
});
