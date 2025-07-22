if ('serviceWorker' in navigator && 'PushManager' in window) {
    window.addEventListener('load', function () {
        navigator.serviceWorker.register('/sw.js')
            .then(function (registration) {
                console.log('ServiceWorker registration successful');

                // طلب صلاحية الإشعارات
                Notification.requestPermission().then(function (permission) {
                    if (permission === 'granted') {
                        console.log('Notification permission granted');

                        // مثال لإظهار إشعار يدوي بعد منح الإذن
                        const options = {
                            body: 'شكراً لمنح الإذن! سيتم إرسال الإشعارات هنا.',
                            icon: '/assets/img/logos/web-app-manifest-512x512.png',
                            badge: '/assets/img/logos/web-app-manifest-512x512.png',
                            data: {
                                url: '/admin/bookings' // مسار يمكن فتحه عند الضغط
                            }
                        };

                        registration.showNotification('7ad Alshebak', options);
                    }
                });
            })
            .catch(function (err) {
                console.log('ServiceWorker registration failed: ', err);
            });
    });

}
