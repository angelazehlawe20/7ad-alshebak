document.addEventListener('DOMContentLoaded', function () {
    const editModeBtn = document.querySelector('.edit-mode-btn');
    const saveChangesBtn = document.querySelector('.save-changes-btn');
    const formFields = document.querySelectorAll('.form-field');
    const addPointBtns = document.querySelectorAll('.add-point-btn');
    const removeImageBtns = document.querySelectorAll('.remove-image-btn');
    const fileInput = document.getElementById('newGalleryImages');

    // الرسائل من خصائص data-* في الزر
    const confirmDeletePointMsg = editModeBtn?.dataset.confirmDeletePoint || 'Are you sure you want to delete this point?';
    const confirmDeleteMediaMsg = editModeBtn?.dataset.confirmDeleteMedia || 'Are you sure you want to delete this media?';

    let editMode = false;

    editModeBtn?.addEventListener('click', function () {
        editMode = !editMode;

        if (editMode) {
            // تغيير الزر إلى وضع "إلغاء"
            editModeBtn.innerHTML = `<i class="fas fa-times mr-2"></i> ${editModeBtn.dataset.cancelText}`;
            editModeBtn.classList.remove('btn-secondary');
            editModeBtn.classList.add('btn-danger');

            saveChangesBtn.classList.remove('d-none');

            formFields.forEach(field => {
                if (field.type === 'file') {
                    field.disabled = false;
                } else {
                    field.readOnly = false;
                }
            });

            addPointBtns.forEach(btn => btn.disabled = false);
            removeImageBtns.forEach(btn => btn.disabled = false);
        } else {
            // إعادة تحميل الصفحة لإلغاء التعديلات
            location.reload();
        }
    });

    // حذف نقطة
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-point')) {
            if (confirm(confirmDeletePointMsg)) {
                e.target.closest('.input-group').remove();
            }
        }
    });

    // إضافة نقطة
    addPointBtns.forEach(button => {
        button.addEventListener('click', function () {
            const language = this.dataset.language;
            const container = document.getElementById(`why-points-container-${language}`);
            const div = document.createElement('div');
            div.classList.add('input-group', 'mb-2');
            div.innerHTML = `
                <input type="text" class="form-control" name="why_points_${language}[]" ${language === 'ar' ? 'dir="rtl"' : ''}>
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger remove-point">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `;
            container.appendChild(div);
        });
    });

    // حذف صورة/فيديو قديم
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-image-btn')) {
            const btn = e.target.closest('.remove-image-btn');
            if (btn.disabled) return;

            const pathToRemove = btn.dataset.path;
            const wrapper = btn.closest('.existing-image-wrapper');

            if (confirm(confirmDeleteMediaMsg)) {
                wrapper.remove();

                const existingImagesInput = document.getElementById('existingImagesInput');
                if (existingImagesInput) {
                    let images = [];
                    try {
                        images = JSON.parse(existingImagesInput.value || '[]');
                    } catch {
                        images = [];
                    }
                    images = images.filter(img => img !== pathToRemove);
                    existingImagesInput.value = JSON.stringify(images);
                }
            }
        }
    });

    // معاينة الصور والفيديوهات الجديدة
    fileInput?.addEventListener('change', function () {
        const container = document.getElementById('newImagesPreview');
        if (!container) return;
        container.innerHTML = '';

        Array.from(fileInput.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.classList.add('col-md-6', 'mb-2');

                if (file.type.startsWith('video/')) {
                    col.innerHTML = `
                        <video controls class="img-fluid rounded shadow" style="height: 150px; object-fit: cover;">
                            <source src="${e.target.result}" type="${file.type}">
                            ${editModeBtn.dataset.videoNotSupported || 'Video not supported'}
                        </video>
                    `;
                } else if (file.type.startsWith('image/')) {
                    col.innerHTML = `
                        <img src="${e.target.result}" class="img-fluid rounded shadow" style="height: 150px; object-fit: cover;">
                    `;
                }

                container.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    });
});
