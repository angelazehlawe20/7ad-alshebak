document.addEventListener('DOMContentLoaded', function () {
    const phoneInput = document.getElementById('phone');
    const phoneError = document.getElementById('phone-error');
    const currentLocale = document.documentElement.lang || 'en';

    function validatePhone() {
        const value = phoneInput.value.replace(/\D/g, '');
        phoneInput.value = value;

        if (value.length !== 9 || !value.startsWith('9')) {
            phoneError.textContent = currentLocale === 'ar'
                ? "الرجاء إدخال رقم صالح مثل 9XXXXXXXX"
                : "Please enter a valid number like 9XXXXXXXX.";
            return false;
        } else {
            phoneError.textContent = "";
            return true;
        }
    }

    if (phoneInput) {
        phoneInput.addEventListener('input', validatePhone);

        const form = document.querySelector('form');
        form.addEventListener('submit', function (e) {
            if (!validatePhone()) {
                e.preventDefault();
            }
        });
    }
});
