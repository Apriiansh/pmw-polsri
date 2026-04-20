self.addEventListener('push', function(event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    let data = {};
    if (event.data) {
        try {
            data = event.data.json();
        } catch (e) {
            data = {
                title: 'Pengumuman Baru',
                body: event.data.text(),
                icon: '/assets/img/logo-polsri.png'
            };
        }
    }

    const title = data.title || 'PMW Polsri';
    const options = {
        body: data.body || 'Ada informasi terbaru untuk Anda.',
        icon: data.icon || '/assets/img/logo-polsri.png',
        badge: data.badge || '/assets/img/logo-polsri.png',
        data: {
            url: data.url || '/'
        },
        vibrate: [100, 50, 100],
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.openWindow(event.notification.data.url)
    );
});
