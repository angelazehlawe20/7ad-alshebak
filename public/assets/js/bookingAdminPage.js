document.addEventListener('DOMContentLoaded', function () {
    const fetchInterval = 60000; // كل 60 ثانية

    function fetchUpdatedBookings() {
        const status = document.getElementById('status')?.value || '';
        const url = `/admin/bookings/list${status ? '?status=' + status : ''}`;

        axios.get(url)
            .then(response => {
                const bookingList = document.getElementById('booking-list');
                if (bookingList) {
                    bookingList.innerHTML = response.data;
                }
            })
            .catch(error => {
                console.error('حدث خطأ أثناء تحديث الحجوزات:', error);
            });
    }

    // أول مرة
    fetchUpdatedBookings();

    // كل دقيقة
    setInterval(fetchUpdatedBookings, fetchInterval);
});
