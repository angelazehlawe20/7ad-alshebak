self.addEventListener('push', function(event) {
    if (event.data) {
        const data = event.data.json();
        const options = {
            body: data.message,
            icon: '/assets/img/logos/web-app-manifest-512x512.png',
            badge: '/assets/img/logos/web-app-manifest-512x512.png',
            data: {
                url: data.url || '/admin/bookings'
            }
        };

        event.waitUntil(
            self.registration.showNotification('7ad Alshebak', options)
        );
    }
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});