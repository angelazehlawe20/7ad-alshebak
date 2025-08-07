document.addEventListener('DOMContentLoaded', function () {
    const fetchInterval = 60000; // كل 60 ثانية

    // SweetAlert للعميات (تأكيد أو رفض)
    function bindActionConfirmations() {
        const actionForms = document.querySelectorAll('.booking-action-form');

        actionForms.forEach(form => {
            form.removeEventListener('submit', actionFormHandler); // إزالة القديم
            form.addEventListener('submit', actionFormHandler);    // ربط الجديد
        });
    }

    function actionFormHandler(e) {
        e.preventDefault();

        const form = e.target;
        const actionType = form.dataset.action; // "confirm" أو "reject"
        let title, confirmText;

        if (actionType === 'confirm') {
            title = 'هل تريد تأكيد هذا الحجز؟';
            confirmText = 'نعم، تأكيد';
        } else if (actionType === 'reject') {
            title = 'هل تريد رفض هذا الحجز؟';
            confirmText = 'نعم، رفض';
        } else {
            form.submit(); // fallback
            return;
        }

        Swal.fire({
            title: title,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
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

                    // بعد التحديث، ربط تأكيدات العمليات
                    bindActionConfirmations();
                }
            })
            .catch(error => {
                console.error('حدث خطأ أثناء تحديث الحجوزات:', error);
            });
    }

    // أول تحميل
    fetchUpdatedBookings();

    // كل دقيقة
    setInterval(fetchUpdatedBookings, fetchInterval);

    // تفعيل SweetAlert لأول مرة
    bindActionConfirmations();
});
