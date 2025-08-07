document.addEventListener('DOMContentLoaded', function () {

    // نصوص SweetAlert (يمكنك تعديلها أو وضعها من السيرفر)
    const deleteConfirmTitle = window.translations.delete_confirm_title
    const deleteConfirmText = window.translations.delete_confirm_text
    const deleteConfirmYes = window.translations.delete_confirm_yes
    const cancel = window.translations.cancel

    // تفعيل SweetAlert عند حذف الرسالة
    function bindDeleteConfirmations() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            // إزالة المعالج السابق ثم إضافته من جديد
            form.removeEventListener('submit', deleteFormHandler); // احترازي فقط
            form.addEventListener('submit', deleteFormHandler);
        });
    }

    function deleteFormHandler(e) {
        e.preventDefault();
        Swal.fire({
            title: deleteConfirmTitle,
            text: deleteConfirmText,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText : cancel,
            confirmButtonText: deleteConfirmYes,
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit();
            }
        });
    }

    // جلب الرسائل وتحديث العدادات
    const messageFetchInterval = 60000; // كل 60 ثانية

    function fetchUpdatedMessages() {
        axios.get('/admin/contacts/refresh', {
            headers: { 'Cache-Control': 'no-cache' },
            params: { t: new Date().getTime() }
        })
            .then(response => {
                const messageList = document.getElementById('messages-list');
                if (messageList) {
                    messageList.innerHTML = response.data;
                    bindDeleteConfirmations(); // تفعيل الحذف من جديد
                }
            })
            .catch(error => {
                console.error('حدث خطأ أثناء تحديث الرسائل:', error);
            });

        axios.get('/admin/notifications/counters')
            .then(res => {
                const data = res.data;
                const sidebarMessagesCount = document.getElementById('contact-unread-badge');
                if (sidebarMessagesCount) {
                    sidebarMessagesCount.textContent = data.unread_messages || 0;
                    sidebarMessagesCount.style.display = data.unread_messages > 0 ? '' : 'none';
                }
            })
            .catch(err => console.error('خطأ في تحديث العدادات:', err));
    }

    // أول تحميل
    fetchUpdatedMessages();

    // تحديث دوري
    setInterval(fetchUpdatedMessages, messageFetchInterval);

    // التفعيل الأولي لأزرار الحذف
    bindDeleteConfirmations();
});
