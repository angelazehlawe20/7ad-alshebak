if ('serviceWorker' in navigator && 'PushManager' in window) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/sw.js')
            .then(function(registration) {
                console.log('ServiceWorker registration successful');
                
                // Request notification permission
                Notification.requestPermission().then(function(permission) {
                    if (permission === 'granted') {
                        console.log('Notification permission granted');
                    }
                });
            })
            .catch(function(err) {
                console.log('ServiceWorker registration failed: ', err);
            });
    });

    // Listen for push messages
    Echo.private('App.Models.User.' + userId)
        .notification((notification) => {
            const options = {
                body: notification.message,
                icon: '/assets/img/logos/web-app-manifest-512x512.png',
                badge: '/assets/img/logos/web-app-manifest-512x512.png',
                data: {
                    url: notification.url || '/admin/bookings'
                }
            };

            if ('showNotification' in ServiceWorkerRegistration.prototype) {
                navigator.serviceWorker.ready.then(registration => {
                    registration.showNotification('7ad Alshebak', options);
                });
            } else {
                new Notification('7ad Alshebak', options);
            }
        });
}