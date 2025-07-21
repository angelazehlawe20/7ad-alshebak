document.addEventListener('DOMContentLoaded', function () {
    // SweetAlert الحذف
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

    // التحديث التلقائي للرسائل
    function fetchContacts() {
        fetch(window.location.href, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newCards = doc.querySelector('.row.g-4');
            const target = document.querySelector('.row.g-4');

            if (newCards && target) {
                target.innerHTML = newCards.innerHTML;
            }
        })
        .catch(err => console.error('Error fetching contacts:', err));
    }

    // حدث كل 5 دقائق (300000ms)
    setInterval(fetchContacts, 300000);
});
