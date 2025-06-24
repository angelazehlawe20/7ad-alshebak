document.addEventListener('DOMContentLoaded', function () {
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const addPointBtn = document.getElementById('addPointBtn');
    const fileInput = document.querySelector('input[type="file"][name="new_gallery_images[]"]');

    // زر تعديل عام
    if (editBtn) {
        editBtn.addEventListener('click', () => {
            // إزالة readonly من النصوص
            document.querySelectorAll('#aboutForm textarea, #aboutForm input[type="text"]').forEach(input => {
                input.removeAttribute('readonly');
            });
            if (fileInput) fileInput.removeAttribute('disabled');

            // إظهار أزرار الحفظ والإلغاء والإضافة
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
            addPointBtn.classList.remove('d-none');

            // إخفاء زر التعديل
            editBtn.classList.add('d-none');

            // إظهار أزرار حذف وتعديل الصور
            document.querySelectorAll('.remove-point, .delete-image, .edit-image').forEach(btn => {
                btn.classList.remove('d-none');
            });

            // إظهار زر رفع الصور الجديدة
            document.getElementById('uploadImagesBtn')?.classList.remove('d-none');
        });
    }

    // إلغاء التعديلات (إعادة تحميل الصفحة)
    cancelBtn?.addEventListener('click', () => window.location.reload());

    // إضافة نقطة جديدة
    addPointBtn?.addEventListener('click', function () {
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

    // حذف نقطة عند الضغط على زر الحذف
    document.getElementById('why-points-container')?.addEventListener('click', function (e) {
        const removeBtn = e.target.closest('.remove-point');
        if (removeBtn) {
            removeBtn.closest('.input-group').remove();
        }
    });

    // حذف صورة من المعرض
    document.querySelectorAll('.delete-image').forEach(btn => {
        btn.addEventListener('click', function () {
            const imageToDelete = this.dataset.image;
            if (!confirm('Are you sure you want to delete this image?')) return;

            fetch(window.routes.deleteImage, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ image: imageToDelete }),
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.gallery-item').remove();

                        const existingImagesInput = document.getElementById('existingImages');
                        let existingImages = JSON.parse(existingImagesInput.value);
                        existingImages = existingImages.filter(img => img !== imageToDelete);
                        existingImagesInput.value = JSON.stringify(existingImages);
                    } else {
                        alert('Failed to delete image.');
                    }
                })
                .catch(() => alert('Error deleting image.'));
        });
    });


    // فتح نافذة اختيار ملف لتبديل الصورة عند الضغط على أيقونة التعديل
    document.querySelectorAll('.edit-image').forEach(editBtn => {
        editBtn.addEventListener('click', function () {
            const fileInput = this.parentElement.querySelector('.replace-image-input');
            if (fileInput) {
                fileInput.click();
            }
        });
    });

    // رفع صورة جديدة بدل القديمة تلقائياً عند اختيار ملف جديد
    document.querySelectorAll('.replace-image-input').forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (!file) return;

            const oldImage = this.dataset.image;
            const formData = new FormData();
            formData.append('image', file);
            formData.append('original_image', oldImage);

            fetch(window.routes.updateImage, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // تحديث الصورة المعروضة (تحديث src مع إضافة Timestamp لمنع الكاش)
                        const img = this.parentElement.querySelector('img.gallery-image');
                        if (img) {
                            img.src = '/' + data.newImage + '?' + new Date().getTime();
                        }

                        // تحديث data-image في أزرار التعديل والحذف و input الملف
                        this.dataset.image = data.newImage;
                        this.parentElement.querySelector('.edit-image').dataset.image = data.newImage;
                        this.parentElement.querySelector('.delete-image').dataset.image = data.newImage;

                        // تحديث الحقل المخفي الخاص بالصور الموجودة
                        const existingImagesInput = document.getElementById('existingImages');
                        let existingImages = JSON.parse(existingImagesInput.value);
                        const idx = existingImages.indexOf(oldImage);
                        if (idx !== -1) {
                            existingImages[idx] = data.newImage;
                            existingImagesInput.value = JSON.stringify(existingImages);
                        }
                    } else {
                        alert('Failed to update image.');
                    }
                })
                .catch(() => alert('Error uploading image.'));
        });
    });

    // تحقق من الحقول الفارغة قبل حفظ النموذج
    document.getElementById('aboutForm')?.addEventListener('submit', function (e) {
        const whyPoints = document.querySelectorAll('input[name="why_points[]"]');
        let hasEmpty = false;
        whyPoints.forEach(input => {
            if (!input.value.trim()) {
                hasEmpty = true;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (hasEmpty) {
            e.preventDefault();
            alert('Please fill in all Why Choose Us points or remove empty ones.');
        }
    });

    // معاينة الصور الجديدة المرفوعة (عند رفع صور جديدة في زر Add New Images)
    window.previewImages = function (input) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-2';

                reader.onload = function (e) {
                    col.innerHTML = `
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" alt="Preview" style="height: 150px; object-fit: contain;">
                            <div class="card-body p-2">
                                <p class="card-text small text-muted mb-0">${file.name}</p>
                            </div>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
                container.appendChild(col);
            });
        }
    };

    // عرض أسماء الملفات الجديدة المختارة
    window.handleFileSelect = function (input) {
        const selectedFiles = document.getElementById('selectedFiles');
        selectedFiles.innerHTML = '';

        if (input.files.length > 0) {
            const list = document.createElement('ul');
            list.className = 'list-unstyled';

            Array.from(input.files).forEach(file => {
                const li = document.createElement('li');
                li.textContent = file.name;
                list.appendChild(li);
            });

            selectedFiles.appendChild(list);
        }
    };
});

document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper(".gallery-swiper", {
        loop: true,
        speed: 800,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            waitForTransition: false,
        },
        slidesPerView: 50,  // رقم ثابت بدلاً من "auto" للتجربة
        centeredSlides: true,
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            320: { slidesPerView: 1, spaceBetween: 10 },
            576: { slidesPerView: 2, spaceBetween: 20 },
            768: { slidesPerView: 3, spaceBetween: 30 },
            1200: { slidesPerView: 4, spaceBetween: 40 },
        },
    });

    const lightbox = GLightbox({
        selector: '.glightbox',
        closeButton: true
    });

});
