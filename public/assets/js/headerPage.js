document.addEventListener("DOMContentLoaded", () => {
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const mobileNavSidebar = document.querySelector('.mobile-nav-sidebar');
    const mobileNavOverlay = document.querySelector('.mobile-nav-overlay');
    const toggleIcon = mobileNavToggle?.querySelector('i');
    const closeSidebarBtn = document.getElementById("closeSidebarBtn");
    const body = document.body;
    const navLinks = document.querySelectorAll(".nav-link");
    const mobileNavLinks = document.querySelectorAll(".mobile-nav-link");
    const header = document.getElementById('header');

    function restoreScroll() {
        body.style.overflow = '';
        body.style.position = '';
        body.style.height = '';
        body.style.touchAction = '';
    }

    function disableScroll() {
        body.style.overflow = 'hidden';
        body.style.position = 'fixed';
        body.style.height = '100%';
        body.style.touchAction = 'none';
    }

    function closeSidebar() {
        mobileNavSidebar.classList.remove("active");
        body.classList.remove("mobile-nav-active");
        restoreScroll();
        toggleIcon?.classList.remove("bi-x");
        toggleIcon?.classList.add("bi-list");
    }

    mobileNavToggle?.addEventListener('click', () => {
        const isActive = mobileNavSidebar.classList.toggle('active');
        body.classList.toggle('mobile-nav-active', isActive);

        if (isActive) {
            toggleIcon?.classList.remove('bi-list');
            toggleIcon?.classList.add('bi-x');
            disableScroll();
        } else {
            closeSidebar();
        }
    });

    mobileNavOverlay?.addEventListener('click', closeSidebar);

    mobileNavLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            const linkPath = new URL(link.href).pathname;
            const currentPath = window.location.pathname;
            if (linkPath === currentPath) {
                e.preventDefault();
            }
            closeSidebar();
        });
    });

    closeSidebarBtn?.addEventListener("click", () => {
        closeSidebar();
        setTimeout(() => {
            location.reload();
        }, 80);
    });

    function updateActiveLinkByPath() {
        const currentPath = window.location.pathname;
        navLinks.forEach(link => {
            const linkPath = new URL(link.href).pathname;
            link.classList.toggle("active", linkPath === currentPath);
        });
        mobileNavLinks.forEach(link => {
            const linkPath = new URL(link.href).pathname;
            link.classList.toggle("active", linkPath === currentPath);
        });
    }

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        header.classList.toggle('header-fixed', scrollTop > 50);
    });

    updateActiveLinkByPath();
});
