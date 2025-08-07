document.addEventListener('DOMContentLoaded', () => {
    // ✅ AOS + PureCounter + GLightbox + Flatpickr
    AOS.init();
    new PureCounter();
    GLightbox({ selector: '.glightbox', touchNavigation: true, loop: true, autoplayVideos: true });
    flatpickr('.flatpickr-input', { enableTime: true, dateFormat: 'Y-m-d H:i' });

    // ✅ Sidebar toggle
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');
    if (sidebar && overlay && toggleBtn) {
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

    // ✅ Notification dropdown toggle
    const toggle = document.getElementById('notificationDropdownToggle');
    const dropdownMenu = document.getElementById('notificationDropdownMenu');
    if (toggle && dropdownMenu) {
        toggle.addEventListener('show.bs.dropdown', () => {
            document.body.classList.add('no-scroll');
            dropdownMenu.style.maxHeight = '400px';
            dropdownMenu.style.overflowY = 'auto';
        });
        toggle.addEventListener('hide.bs.dropdown', () => {
            document.body.classList.remove('no-scroll');
            dropdownMenu.style.maxHeight = '';
            dropdownMenu.style.overflowY = '';
        });
    }

    // ✅ Highlight by URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const highlightedId = urlParams.get('highlight');
    if (highlightedId) {
        if (highlightedId === 'pending') {
            const pendingCards = document.querySelectorAll('.booking-card');
            pendingCards.forEach(card => {
                const badge = card.querySelector('.badge');
                if (badge && badge.textContent.trim() === 'Pending') {
                    card.classList.add('highlighted');
                    setTimeout(() => card.classList.remove('highlighted'), 20000);
                    if (!document.querySelector('.highlighted')) {
                        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        } else {
            const highlightedElement = document.querySelector(`[data-id="${highlightedId}"]`);
            if (highlightedElement) {
                highlightedElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                highlightedElement.classList.add('highlighted');
                setTimeout(() => highlightedElement.classList.remove('highlighted'), 10000);
            }
        }
    }

    // ✅ التحديث التلقائي للإشعارات
    updateAllCounters();
    setInterval(updateAllCounters, 60000);
});

// ✅ الدوال المساعدة
function updateBadge(selector, count) {
    document.querySelectorAll(selector).forEach(el => {
        el.textContent = count;
        el.style.display = count > 0 ? 'inline-block' : 'none';
    });
}

function truncateText(text, maxLength) {
    return (!text || text.length <= maxLength) ? text : text.substr(0, maxLength) + '...';
}

function escapeHtml(text) {
    return !text ? '' : text.replace(/[&<>"']/g, m => ({
        '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
    }[m]));
}

function updateAllCounters() {
    axios.get('/admin/notifications/counters')
        .then(res => {
            const data = res.data;
            updateBadge('#notifications-count', data.total || 0);
            updateBadge('#sidebar-bookings-count', data.pending_bookings || 0);
            updateBadge('#sidebar-messages-count', data.unread_messages || 0);
            updateNotificationsList(data);
        })
        .catch(err => console.error('Notification update error:', err));
}

function updateNotificationsList(data) {
    const list = document.getElementById('notificationDropdownMenu');
    if (!list) return;

    let html = '';

    if (data.bookings?.length) {
        data.bookings.forEach(b => {
            html += `
            <li>
                <a class="dropdown-item d-flex align-items-start gap-2 py-2" href="/admin/bookings?highlight=${b.id}" data-id="${b.id}">
                    <i class="fas fa-calendar-check text-primary mt-1"></i>
                    <div>
                        <div class="fw-bold">${escapeHtml(b.name)}</div>
                        <small class="text-muted">${b.people} ${translations.people} <br> ${b.date} ${b.time}<br>${escapeHtml(truncateText(b.notes, 40))}</small>
                        <div class="small text-muted">${b.created}</div>
                    </div>
                </a>
            </li>`;
        });
    }

    if (data.messages?.length) {
        data.messages.forEach(m => {
            html += `
            <li>
                <a class="dropdown-item d-flex align-items-start gap-2 py-2" href="/admin/contacts?highlight=${m.id}" data-id="${m.id}">
                    <i class="fas fa-envelope text-success mt-1"></i>
                    <div>
                        <div class="fw-bold">${escapeHtml(m.name)}</div>
                        <small class="text-muted">${escapeHtml(truncateText(m.message, 40))}</small>
                        <div class="small text-muted">${m.time}</div>
                    </div>
                </a>
            </li>`;
        });
    }

    if (!html) {
        html = `
        <li class="dropdown-menu-empty">
            <span class="dropdown-item-text text-muted text-center py-2">
                <i class="fas fa-check-circle me-1"></i> No new notifications
            </span>
        </li>`;
    }

    list.innerHTML = html;
    addNotificationClickListeners();
}

function addNotificationClickListeners() {
    const items = document.querySelectorAll('#notificationDropdownMenu a[data-id]');
    items.forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();

            const targetUrl = this.getAttribute('href');
            const li = this.closest('li');
            if (li) li.remove();

            const countEl = document.querySelector('#notifications-count');
            if (countEl) {
                let count = parseInt(countEl.textContent) || 0;
                updateBadge('#notifications-count', Math.max(0, count - 1));
            }

            const menu = document.getElementById('notificationDropdownMenu');
            if (menu && !menu.querySelector('li')) {
                menu.innerHTML = `
                <li class="dropdown-menu-empty">
                    <span class="dropdown-item-text text-muted text-center py-2">
                        <i class="fas fa-check-circle me-1"></i> No new notifications
                    </span>
                </li>`;
            }

            setTimeout(() => window.location.href = targetUrl, 100);
        });
    });
}
