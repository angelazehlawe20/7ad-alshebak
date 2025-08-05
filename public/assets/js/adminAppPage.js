document.addEventListener('DOMContentLoaded', () => {
    // Initialize AOS
    AOS.init();

    // Initialize PureCounter
    new PureCounter();

    // Initialize GLightbox
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: true
    });

    // Initialize Flatpickr
    flatpickr('.flatpickr-input', {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
    });

    // التحقق من وجود عنصر محدد للتمرير إليه
    const urlParams = new URLSearchParams(window.location.search);
    const highlightedId = urlParams.get('highlight');
    if (highlightedId) {
        if (highlightedId === 'pending') {
            // تحديد جميع البطاقات المعلقة
            const pendingCards = document.querySelectorAll('.booking-card');
            pendingCards.forEach(card => {
                const statusBadge = card.querySelector('.badge');
                if (statusBadge && statusBadge.textContent.trim() === 'Pending') {
                    card.classList.add('highlighted');
                    // التمرير إلى أول بطاقة معلقة
                    if (!document.querySelector('.highlighted')) {
                        card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            });
        } else {
            // تحديد بطاقة محددة
            const highlightedElement = document.querySelector(`[data-id="${highlightedId}"]`);
            if (highlightedElement) {
                highlightedElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                highlightedElement.classList.add('highlighted');
            }
        }
    }
    // Sidebar toggle (يمكنك نقل هذا إلى ملف خاص إذا تريده)
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

    // Notification dropdown
    const toggle = document.getElementById('notificationDropdownToggle');
    const dropdown = document.getElementById('notificationDropdownMenu');
    if (toggle && dropdown) {
        const bsDropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);

        toggle.addEventListener('show.bs.dropdown', () => {
            document.body.classList.add('no-scroll');
        });

        toggle.addEventListener('hide.bs.dropdown', () => {
            document.body.classList.remove('no-scroll');
        });
    }

    // تحديث عداد الإشعارات في الجرس
    function updateBadge(selector, count) {
        const el = document.querySelector(selector);
        if (!el) return;
        el.textContent = count;
        el.style.display = count > 0 ? 'inline-block' : 'none';
    }

    // تحديث قائمة الإشعارات في القائمة المنسدلة
    function updateNotificationsList(notifications) {
        const list = document.getElementById('notificationDropdownMenu');
        if (!list) return;

        let itemsHtml = '';

        if ((notifications.pending_bookings || 0) > 0) {
            itemsHtml += `
          <li>
            <a class="dropdown-item d-flex align-items-start gap-2 py-2" href="/admin/bookings?highlight=pending" data-id="booking-group">
              <i class="fas fa-calendar-check text-primary mt-1"></i>
              <div>
                <div class="fw-bold">New Bookings</div>
                <small class="text-muted">${notifications.pending_bookings} new bookings arrived</small>
              </div>
            </a>
          </li>`;
        }

        if ((notifications.unread_messages || 0) > 0) {
            notifications.messages.forEach(msg => {
                itemsHtml += `
            <li>
              <a class="dropdown-item d-flex align-items-start gap-2 py-2" href="/admin/contacts?highlight=${msg.id}" data-id="${msg.id}">
                <i class="fas fa-envelope text-success mt-1"></i>
                <div>
                  <div class="fw-bold">${escapeHtml(msg.name)}</div>
                  <small class="text-muted">${escapeHtml(truncateText(msg.message, 40))}</small>
                  <div class="small text-muted">${msg.created_at_diff}</div>
                </div>
              </a>
            </li>`;
            });
        }

        if (!itemsHtml) {
            itemsHtml = `
          <li class="dropdown-menu-empty">
            <span class="dropdown-item-text text-muted text-center py-2">
              <i class="fas fa-check-circle me-1"></i> No new notifications
            </span>
          </li>`;
        }

        list.innerHTML = itemsHtml;
    }

    // دالة مساعدة لتقصير النص
    function truncateText(text, maxLength) {
        if (!text) return '';
        return text.length > maxLength ? text.substr(0, maxLength) + '...' : text;
    }

    // دالة مساعدة لتعقيم النص لمنع XSS
    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>"']/g, function (m) {
            return ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            })[m];
        });
    }

    // جلب البيانات من السيرفر وتحديث الواجهة
    function updateAllCounters() {
        axios.get('/admin/notifications/count')
            .then(response => {
                const data = response.data;

                // هنا نفترض أن JSON الذي يعيده السيرفر يشبه هذا:
                // {
                //   pending_bookings: 2,
                //   unread_messages: 3,
                //   total: 5,
                //   messages: [{ id, name, message, created_at_diff }, ...]
                // }

                updateBadge('#notifications-count', data.total || 0);
                updateNotificationsList(data);
            })
            .catch(error => {
                console.error("Notification update error:", error);
            });
    }

    // تحديث تلقائي عند تحميل الصفحة
    updateAllCounters();

    // تحديث كل 60 ثانية
    setInterval(updateAllCounters, 60000);

});
