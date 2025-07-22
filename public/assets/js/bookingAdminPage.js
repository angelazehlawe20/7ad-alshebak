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
});
