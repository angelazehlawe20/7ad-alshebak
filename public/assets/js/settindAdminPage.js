document.getElementById('editBtn').addEventListener('click', function () {
    const inputs = document.querySelectorAll('#settingsForm input, #settingsForm textarea');
    inputs.forEach(input => {
        input.removeAttribute('readonly');
        input.removeAttribute('disabled');
    });

    document.getElementById('logo').removeAttribute('readonly');
    document.getElementById('logo').removeAttribute('disabled');
    document.getElementById('favicon').removeAttribute('readonly');
    document.getElementById('favicon').removeAttribute('disabled');

    document.getElementById('saveBtn').classList.remove('d-none');
    document.getElementById('cancelBtn').classList.remove('d-none');
    this.classList.add('d-none');
});

document.getElementById('cancelBtn').addEventListener('click', function () {
    window.location.reload();
});

function handleImagePreview(inputId, previewId) {
    document.getElementById(inputId).addEventListener('change', function (event) {
        const [file] = event.target.files;
        if (file) {
            const imgPreview = document.querySelector('#' + previewId);
            imgPreview.src = URL.createObjectURL(file);
            imgPreview.classList.remove('d-none');
        }
    });
}

handleImagePreview('logo', 'logo-preview');
handleImagePreview('favicon', 'favicon-preview');
