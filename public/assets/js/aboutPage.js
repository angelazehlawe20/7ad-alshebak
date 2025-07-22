document.addEventListener('DOMContentLoaded', function () {
    const editModeBtn = document.querySelector('.edit-mode-btn');
    const saveChangesBtn = document.querySelector('.save-changes-btn');
    const formFields = document.querySelectorAll('.form-field');
    const removeImageBtns = document.querySelectorAll('.remove-image-btn');
    const fileInput = document.getElementById('newGalleryImages');
    const previewContainer = document.getElementById('newImagesPreview');

    const confirmDeleteMediaMsg = editModeBtn?.dataset.confirmDeleteMedia || 'Are you sure you want to delete this media?';
    const videoNotSupportedMsg = fileInput?.dataset.videoNotSupported || 'Video not supported';

    let editMode = false;
    let selectedMediaFiles = [];

    // تفعيل / إلغاء وضع التعديل
    editModeBtn?.addEventListener('click', function () {
        editMode = !editMode;

        if (editMode) {
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
            document.querySelectorAll('.remove-point').forEach(btn => btn.disabled = false); // تفعيل أزرار الحذف
        } else {
            location.reload();
        }
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

    // اختيار وسائط جديدة
    fileInput?.addEventListener('change', function () {
        selectedMediaFiles = Array.from(fileInput.files);
        renderMediaPreviews();
    });

    // عرض المعاينة
    function renderMediaPreviews() {
        previewContainer.innerHTML = '';

        selectedMediaFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const col = document.createElement('div');
                col.classList.add('col-md-6', 'mb-3');
                col.id = `preview-${index}`;

                const isVideo = file.type.startsWith('video/');
                const content = isVideo
                    ? `
                        <video controls class="img-fluid rounded shadow w-100" style="height: 150px; object-fit: cover;">
                            <source src="${e.target.result}" type="${file.type}">
                            ${videoNotSupportedMsg}
                        </video>
                    `
                    : `<img src="${e.target.result}" class="img-fluid rounded shadow w-100" style="height: 150px; object-fit: cover;">`;

                col.innerHTML = `
                    <div class="position-relative">
                        ${content}
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2"
                            onclick="removeTempMedia(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;

                previewContainer.appendChild(col);
            };
            reader.readAsDataURL(file);
        });

        updateFileInput();
    }

    // حذف ملف جديد قبل الإرسال
    window.removeTempMedia = function (index) {
        selectedMediaFiles.splice(index, 1);
        renderMediaPreviews();
    }

    // تحديث الملفات داخل الـ input
    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        selectedMediaFiles.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }
});
