document.addEventListener("DOMContentLoaded", () => {
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const mobileNavSidebar = document.querySelector('.mobile-nav-sidebar');
    const mobileNavOverlay = document.querySelector('.mobile-nav-overlay');
    const body = document.body;
    const navLinks = document.querySelectorAll(".nav-link");
    const header = document.getElementById('header');

    // Only proceed if we have the necessary elements
    if (!mobileNavToggle || !mobileNavSidebar || !mobileNavOverlay) return;

    // Function to disable scrolling when sidebar is open
    function disableScroll() {
        body.style.overflow = 'hidden';
    }

    // Function to restore scrolling when sidebar is closed
    function restoreScroll() {
        body.style.overflow = '';
    }

    // Function to open the sidebar
    function openSidebar() {
        mobileNavSidebar.classList.add("active");
        mobileNavOverlay.classList.add("active");
        body.classList.add("mobile-nav-active");

        // Get the inner icon element
        const innerIcon = mobileNavToggle.querySelector('i');
        if (innerIcon) {
            // Remove all icon classes and add only the X icon
            innerIcon.classList.remove("bi-list");
            innerIcon.classList.add("bi-x");
        }

        disableScroll();
    }

    // Function to close the sidebar
    function closeSidebar() {
        mobileNavSidebar.classList.remove("active");
        mobileNavOverlay.classList.remove("active");
        body.classList.remove("mobile-nav-active");

        // Get the inner icon element
        const innerIcon = mobileNavToggle.querySelector('i');
        if (innerIcon) {
            // Remove all icon classes and add only the list icon
            innerIcon.classList.remove("bi-x");
            innerIcon.classList.add("bi-list");
        }

        restoreScroll();
    }

    // Toggle sidebar when clicking the menu button
    mobileNavToggle.addEventListener('click', (e) => {
        e.preventDefault();
        if (mobileNavSidebar.classList.contains('active')) {
            closeSidebar();
        } else {
            openSidebar();
        }
    });

    // Close sidebar when clicking the overlay
    mobileNavOverlay.addEventListener('click', closeSidebar);

    // Close sidebar when clicking a navigation link
    navLinks.forEach(link => {
        link.addEventListener("click", () => {
            if (mobileNavSidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
    });

    // Add fixed header on scroll
    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        header.classList.toggle('header-fixed', scrollTop > 50);
    });

    // Update active link based on current path
    function updateActiveLinkByPath() {
        const currentPath = window.location.pathname;
        navLinks.forEach(link => {
            if (!link.href) return;
            const linkPath = new URL(link.href, window.location.origin).pathname;
            link.classList.toggle("active", linkPath === currentPath);
        });
    }

    // Initialize active links
    updateActiveLinkByPath();

    // Handle ESC key to close sidebar
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && mobileNavSidebar.classList.contains('active')) {
            closeSidebar();
        }
    });

    // Initialize the button state - ensure it starts with the correct icon
    if (mobileNavSidebar.classList.contains('active')) {
        openSidebar();
    } else {
        closeSidebar();
    }
});
