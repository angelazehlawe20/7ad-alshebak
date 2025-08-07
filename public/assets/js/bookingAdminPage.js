document.addEventListener('DOMContentLoaded', function () {
    flatpickr('#from_date', { enableTime: true, dateFormat: 'Y-m-d H:i' });
    flatpickr('#to_date', { enableTime: true, dateFormat: 'Y-m-d H:i' });
    const fetchInterval = 60000; // كل 60 ثانية

    function bindActionConfirmations() {
        const actionForms = document.querySelectorAll('.booking-action-form');

        actionForms.forEach(form => {
            form.removeEventListener('submit', actionFormHandler);
            form.addEventListener('submit', actionFormHandler);
        });
    }

    function actionFormHandler(e) {
        e.preventDefault();

        const form = e.target;
        const actionType = form.dataset.action;
        let title, confirmText;

        if (actionType === 'confirm') {
            title = translations.confirmBooking;
            confirmText = translations.confirm;
        } else if (actionType === 'reject') {
            title = translations.rejectBooking;
            confirmText = translations.reject;
        } else {
            form.submit();
            return;
        }

        Swal.fire({
            title: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: translations.cancel,
            confirmButtonText: confirmText
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function fetchUpdatedBookings() {
        const status = document.getElementById('status')?.value || '';
        const url = `/admin/bookings/list${status ? '?status=' + status : ''}`;

        axios.get(url)
            .then(response => {
                const bookingList = document.getElementById('booking-list');
                if (bookingList) {
                    bookingList.innerHTML = response.data;

                    bindActionConfirmations();
                }
            })
            .catch(error => {
                console.error(translations.errorUpdatingStatus, error);
            });
    }

    fetchUpdatedBookings();
    setInterval(fetchUpdatedBookings, fetchInterval);
    bindActionConfirmations();
});
