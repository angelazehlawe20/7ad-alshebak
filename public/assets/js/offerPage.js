document.addEventListener('DOMContentLoaded', function () {
    const categoryFilter = document.getElementById('categoryFilter');

    if (categoryFilter) {
        categoryFilter.addEventListener('change', function () {
            const selectedCategory = this.value;
            const url = new URL(window.location.href.split('?')[0], window.location.origin);

            if (selectedCategory) {
                url.searchParams.set('category', selectedCategory);
            }

            window.location.href = url.toString();
        });
    }
});
