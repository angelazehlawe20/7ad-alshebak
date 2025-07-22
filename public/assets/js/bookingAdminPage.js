document.addEventListener('DOMContentLoaded', function () {
    const REFRESH_INTERVAL = 300000; // 5 minutes in milliseconds

    async function fetchBookings() {
        try {
            const response = await fetch('/admin/bookings/list', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            const bookingList = document.getElementById('booking-list');
            if (bookingList) {
                bookingList.innerHTML = data.html;
                attachEventListeners();
            }

            // Update the pending bookings counter in sidebar
            const pendingBookingsCounter = document.getElementById('pending-bookings-counter');
            if (pendingBookingsCounter) {
                pendingBookingsCounter.textContent = data.pending_count;
            }

            // Update notifications
            await updateNotifications();
        } catch (error) {
            console.error('Error fetching bookings:', error);
        }
    }

    async function updateNotifications() {
        try {
            const response = await fetch('/admin/notifications/unread', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();

            // Update notification badge
            const notificationBadge = document.getElementById('notification-badge');
            if (notificationBadge) {
                notificationBadge.textContent = data.unread_count;
            }

            // Update notification dropdown
            const notificationList = document.getElementById('notification-list');
            if (notificationList && data.notifications) {
                notificationList.innerHTML = data.notifications.map(notification => `
                    <a href="${notification.link}" class="dropdown-item">
                        <i class="fas fa-calendar-check me-2"></i>${notification.message}
                        <span class="float-end text-muted text-sm">${notification.time_ago}</span>
                    </a>
                `).join('');
            }
        } catch (error) {
            console.error('Error updating notifications:', error);
        }
    }

    function attachEventListeners() {
        // Attach event listeners to status update forms
        document.querySelectorAll('.booking-card form').forEach(form => {
            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const bookingId = this.closest('.booking-card').dataset.id;
                const status = this.querySelector('input[name="status"]').value;
                const confirmMessage = status === 'confirmed' ?
                    translations.confirmBooking :
                    translations.rejectBooking;

                const result = await Swal.fire({
                    title: translations.areYouSure,
                    text: confirmMessage,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: status === 'confirmed' ? '#28a745' : '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: translations.yes,
                    cancelButtonText: translations.no
                });

                if (result.isConfirmed) {
                    try {
                        const response = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                status: status,
                                _method: 'PUT'
                            })
                        });

                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }

                        await fetchBookings();

                        Swal.fire({
                            title: translations.success,
                            text: translations.statusUpdated,
                            icon: 'success'
                        });
                    } catch (error) {
                        console.error('Error updating booking status:', error);
                        Swal.fire({
                            title: translations.error,
                            text: translations.errorUpdatingStatus,
                            icon: 'error'
                        });
                    }
                }
            });
        });
    }

    // Initial fetch
    fetchBookings();

    // Set up automatic refresh
    setInterval(fetchBookings, REFRESH_INTERVAL);

    // Listen for new booking events
    window.Echo.private('admin.bookings')
        .listen('.new.booking', () => {
            fetchBookings();
        });

    // Attach initial event listeners
    attachEventListeners();
});
