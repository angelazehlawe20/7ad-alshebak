document.addEventListener('DOMContentLoaded', () => {
    // Flatpickr Init
    flatpickr("#from_date", {
        dateFormat: "Y-m-d",
        locale: document.documentElement.lang === 'ar' ? 'ar' : 'default',
        disableMobile: true
    });

    flatpickr("#to_date", {
        dateFormat: "Y-m-d",
        locale: document.documentElement.lang === 'ar' ? 'ar' : 'default',
        disableMobile: true
    });

    initSidebarToggle();
    initNotificationDropdown(); // ⬅️ استخدام bootstrap API صحيح
    updateAllCounters();
    setInterval(updateAllCounters, 60000); // تحديث كل دقيقة

    setupKeepAlive();
    setupCSRFRefresh();
});

function initSidebarToggle() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');

    if (!sidebar || !overlay || !toggleBtn) return;

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        document.body.classList.toggle('no-scroll', sidebar.classList.contains('show'));
    });

    overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        document.body.classList.remove('no-scroll');
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            document.body.classList.remove('no-scroll');
        }
    });
}

function initNotificationDropdown() {
    const toggle = document.getElementById('notificationDropdownToggle');
    const dropdown = document.getElementById('notificationDropdownMenu');

    if (toggle && dropdown) {
        // الحصول على instance من dropdown bootstrap
        const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);

        // استماع لحدث الفتح
        toggle.addEventListener('show.bs.dropdown', () => {
            document.body.classList.add('no-scroll');
        });

        // استماع لحدث الإغلاق
        toggle.addEventListener('hide.bs.dropdown', () => {
            document.body.classList.remove('no-scroll');
        });

        // لا حاجة لتعطيل الفعل الافتراضي أو التعامل يدوياً مع class show
    }
}

function updateAllCounters() {
    axios.get('/admin/notifications/count')
        .then(({ data }) => {
            updateBadge('#notifications-count', (data.bell_pending_bookings || 0) + (data.bell_unread_messages || 0));
            updateBadge('#booking-pending-badge', data.pending_bookings || 0);
            updateBadge('#contact-unread-badge', data.unread_messages || 0);

            updateNotificationsList(data.notifications || {});
        })
        .catch(error => console.error('فشل في جلب الإشعارات:', error));
}

function updateMessageList() {
    axios.get('/admin/contacts/refresh')
        .then(response => {
            const container = document.getElementById('message-list-container');
            if (container) {
                container.innerHTML = response.data;
            }
        })
        .catch(error => console.error('فشل في تحديث قائمة الرسائل:', error));
}


function updateBadge(selector, count) {
    const el = document.querySelector(selector);
    if (!el) return;
    el.textContent = count;
    el.style.display = count > 0 ? 'inline-block' : 'none';
}

function updateNotificationsList(notifications) {
    const list = document.getElementById('messages-dropdown-list');
    if (!list) return;

    const items = [];

    (notifications.bookings || []).forEach(booking => {
        items.push({
            type: 'booking',
            id: booking.id,
            name: booking.name || '',
            created_at_diff: booking.created_at_diff || '',
            created_at: booking.created_at,
            is_new: !booking.is_notified
        });
    });

    (notifications.messages || []).forEach(msg => {
        items.push({
            type: 'message',
            id: msg.id,
            name: msg.name || msg.sender_name || '',
            message: msg.message || msg.content || '',
            created_at_diff: msg.created_at_diff || '',
            created_at: msg.created_at,
            is_new: !msg.is_read
        });
    });

    items.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));

    if (items.length === 0) {
        list.innerHTML = `<li class="text-muted text-center">لا توجد إشعارات جديدة</li>`;
        return;
    }

    list.innerHTML = items.map(item => {
        const url = item.type === 'message'
            ? `/admin/contacts/${item.id}`
            : `/admin/bookings/${item.id}`;

        return `
            <li class="notification-item ${item.is_new ? 'new' : ''}">
                <a href="${url}" class="d-block text-decoration-none text-dark"
                   onclick="event.preventDefault(); markAsNotified('${item.type}', ${item.id}, '${url}')">
                    <strong>${item.name}</strong>: ${item.message}
                    <br><small>${item.created_at_diff}</small>
                </a>
            </li>
        `;
    }).join('');
}

window.markAsNotified = function (type, id, redirectUrl) {
    let url = '';
    let dataKey = '';

    if (type === 'message') {
        url = '/admin/contacts/mark-as-notified';
        dataKey = 'contact_id';
    } else if (type === 'booking') {
        url = '/admin/bookings/mark-as-notified';
        dataKey = 'booking_id';
    } else {
        window.location.href = redirectUrl;
        return;
    }

    const payload = {};
    payload[dataKey] = id;

    axios.post(url, payload)
        .then(() => {
            const bell = document.querySelector('#notifications-count');
            const current = parseInt(bell.textContent) || 0;
            const newCount = Math.max(current - 1, 0);
            bell.textContent = newCount;
            bell.style.display = newCount > 0 ? 'inline-block' : 'none';

            const item = document.querySelector(`a[href="${redirectUrl}"]`);
            if (item && item.closest('.notification-item')) {
                item.closest('.notification-item').remove();
            }

            const list = document.getElementById('messages-dropdown-list');
            if (list && list.children.length === 0) {
                list.innerHTML = `<li class="text-muted text-center">لا توجد إشعارات جديدة</li>`;
            }
        })
        .catch(err => console.error('فشل في تعليم كمقروء:', err))
        .finally(() => {
            window.location.href = redirectUrl;
        });
};

function setupKeepAlive() {
    let timeout;
    const resetTimer = () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            axios.get('/keep-alive').catch(console.error);
        }, 2 * 60 * 1000);
    };

    ['mousemove', 'keydown', 'click', 'scroll'].forEach(evt =>
        window.addEventListener(evt, resetTimer)
    );

    resetTimer();
}

function setupCSRFRefresh() {
    setInterval(() => {
        axios.get('/csrf-token')
            .then(res => {
                const token = res.data;
                document.querySelector('meta[name="csrf-token"]').setAttribute('content', token);
                axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
            })
            .catch(console.error);
    }, 30 * 60 * 1000);
}
