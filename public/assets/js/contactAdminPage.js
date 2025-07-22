document.addEventListener('DOMContentLoaded', function () {
    // Delete confirmation with SweetAlert
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

    // Function to fetch and update contacts
    async function fetchContacts() {
        try {
            const response = await fetch('/admin/contacts/fetch', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            // Update messages list
            const container = document.querySelector('#messages-list');
            if (container && data.messages_html) {
                container.innerHTML = data.messages_html;

                // Reattach event listeners to new delete forms
                const newDeleteForms = container.querySelectorAll('.delete-form');
                newDeleteForms.forEach(form => {
                    form.addEventListener('submit', handleDeleteSubmit);
                });
            }

            // Update unread messages counter
            const counter = document.querySelector('#unread-count');
            if (counter) {
                counter.textContent = data.unread_count;
            }
        } catch (error) {
            console.error('Error fetching contacts:', error);
        }
    }

    // Handle delete form submission
    function handleDeleteSubmit(e) {
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
                this.submit();
            }
        });
    }

    // Initial fetch
    fetchContacts();

    const refreshInterval = 30000;
    setInterval(fetchContacts, refreshInterval);
});
