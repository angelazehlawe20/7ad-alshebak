document.addEventListener('DOMContentLoaded', function () {
    // Handle edit mode toggle
    const editModeBtn = document.querySelector('.edit-mode-btn');
    const saveChangesBtn = document.querySelector('.save-changes-btn');
    const formFields = document.querySelectorAll('.form-field');
    const addPointBtns = document.querySelectorAll('.add-point-btn');
    const removePointBtns = document.querySelectorAll('.remove-point');

    editModeBtn?.addEventListener('click', function () {
        // Show save button, hide edit button
        editModeBtn.classList.add('d-none');
        saveChangesBtn.classList.remove('d-none');

        // Enable all form fields
        formFields.forEach(field => {
            if (field.type === 'file') {
                field.disabled = false;
            } else {
                field.readOnly = false;
            }
        });

        // Enable add/remove point buttons
        addPointBtns.forEach(btn => btn.disabled = false);
        removePointBtns.forEach(btn => btn.disabled = false);

        // Enable remove image buttons
        document.querySelectorAll('.remove-image-btn').forEach(btn => btn.disabled = false);
    });

    // حذف نقاط النصوص
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-point')) {
            if (confirm('Are you sure you want to delete this point?')) {
                e.target.closest('.input-group').remove();
            }
        }
    });

    // إضافة نقاط جديدة للنصوص
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

    // حذف الصور والفيديوهات من الصور القديمة
    document.addEventListener('click', function (e) {
        if (e.target.closest('.remove-image-btn')) {
            const btn = e.target.closest('.remove-image-btn');
            if (btn.disabled) return;
            const pathToRemove = btn.dataset.path;
            const wrapper = btn.closest('.existing-image-wrapper');

            if (confirm('Are you sure you want to delete this media?')) {
                // حذف العنصر من DOM
                wrapper.remove();

                // تحديث الحقل المخفي بقائمة الصور بعد الحذف
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

    // معاينة الصور والفيديوهات الجديدة المختارة للرفع
    const fileInput = document.getElementById('newGalleryImages');
    fileInput?.addEventListener('change', function () {
        const container = document.getElementById('newImagesPreview');
        if (!container) return;
        container.innerHTML = ''; // تفريغ المعاينة القديمة

        Array.from(fileInput.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.classList.add('col-md-6', 'mb-2');

                if (file.type.startsWith('video/')) {
                    col.innerHTML = `
                        <video controls class="img-fluid rounded shadow" style="height: 150px; object-fit: cover;">
                            <source src="${e.target.result}" type="${file.type}">
                            الفيديو غير مدعوم
                        </video>
                    `;
                } else if (file.type.startsWith('image/')) {
                    col.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded shadow" style="height: 150px; object-fit: cover;">`;
                }

                container.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    });
});
