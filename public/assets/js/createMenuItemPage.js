document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.querySelector('input[name="image"]');
    const preview = document.getElementById('imagePreview');
    const img = preview?.querySelector('img');

    imageInput?.addEventListener('change', function (e) {
        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(e.target.files[0]);
        } else {
            preview.style.display = 'none';
        }
    });
});
