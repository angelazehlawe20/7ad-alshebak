document.addEventListener('DOMContentLoaded', function () {

    // ✅ جزء 1: SweetAlert لحذف الرسائل
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: deleteConfirmTitle,
                text: deleteConfirmText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: deleteConfirmYes
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // ✅ جزء 2: التحديث التلقائي لقائمة الرسائل
    const messageFetchInterval = 60000; // كل 60 ثانية

    const refreshMessagesRoute = "{{ route('admin.contacts.refresh') }}";
    function fetchUpdatedMessages() {
        axios.get(refreshMessagesRoute)
            .then(response => {
                const messageList = document.querySelector('.message-list-wrapper');
                if (messageList) {
                    messageList.innerHTML = response.data;

                    // ⚠️ مهم: بعد التحديث، نعيد تفعيل SweetAlert لأن العناصر تغيرت
                    rebindDeleteConfirmations();
                }
            })
            .catch(error => {
                console.error('حدث خطأ أثناء تحديث الرسائل:', error);
            });
    }


    // ✅ وظيفة لتفعيل SweetAlert مرة أخرى بعد التحديث
    function rebindDeleteConfirmations() {
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: deleteConfirmTitle,
                    text: deleteConfirmText,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: deleteConfirmYes
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    }

    // أول تحميل
    fetchUpdatedMessages();

    // تحديث كل دقيقة
    setInterval(fetchUpdatedMessages, messageFetchInterval);
});
