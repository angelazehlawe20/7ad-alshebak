(function () {
    "use strict";

    /** ------------------------------
     * 1. Scroll - Add .scrolled to <body>
    --------------------------------- */
    function toggleScrolled() {
        const body = document.querySelector('body');
        const header = document.querySelector('#header');
        if (!header.classList.contains('scroll-up-sticky') &&
            !header.classList.contains('sticky-top') &&
            !header.classList.contains('fixed-top')) return;
        body.classList.toggle('scrolled', window.scrollY > 100);
    }
    window.addEventListener('scroll', toggleScrolled);
    window.addEventListener('load', toggleScrolled);

    /** ------------------------------
     * 2. Mobile Navigation
    --------------------------------- */
    const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');
    const mobileNavCloseBtn = document.querySelector('.mobile-nav-close');

    function mobileNavToggle() {
        document.body.classList.toggle('mobile-nav-active');
        mobileNavToggleBtn.classList.toggle('bi-list');
        mobileNavToggleBtn.classList.toggle('bi-x');
    }

    function mobileNavClose() {
        document.body.classList.remove('mobile-nav-active');
        if (mobileNavToggleBtn.classList.contains('bi-x')) {
            mobileNavToggleBtn.classList.remove('bi-x');
            mobileNavToggleBtn.classList.add('bi-list');
        }
    }

    if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener('click', mobileNavToggle);
    }
    if (mobileNavCloseBtn) {
        mobileNavCloseBtn.addEventListener('click', mobileNavClose);
    }

    // Close mobile nav on internal link click
    document.querySelectorAll('#navmenu a').forEach(link => {
        link.addEventListener('click', () => {
            if (document.body.classList.contains('mobile-nav-active')) {
                mobileNavClose();
            }
        });
    });

    // Toggle dropdowns inside mobile nav
    document.querySelectorAll('.navmenu .toggle-dropdown').forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();
            this.parentNode.classList.toggle('active');
            const dropdown = this.parentNode.nextElementSibling;
            if (dropdown) dropdown.classList.toggle('dropdown-active');
            e.stopImmediatePropagation();
        });
    });

    /** ------------------------------
     * 3. Preloader
    --------------------------------- */
    const preloader = document.querySelector('#preloader');
    if (preloader) {
        window.addEventListener('load', () => preloader.remove());
    }

    /** ------------------------------
     * 4. Animate on Scroll (AOS)
    --------------------------------- */
    function aosInit() {
        AOS.init({
            duration: 600,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    }
    window.addEventListener('DOMContentLoaded', aosInit);

    /** ------------------------------
     * 5. GLightbox Init
    --------------------------------- */
    GLightbox({ selector: '.glightbox' });

    /** ------------------------------
     * 6. PureCounter Init
    --------------------------------- */
    new PureCounter();

    /** ------------------------------
     * 7. Swiper Init
    --------------------------------- */
    function initSwiper() {
        document.querySelectorAll(".init-swiper").forEach(swiperEl => {
            let config = JSON.parse(swiperEl.querySelector(".swiper-config").innerHTML.trim());
            if (swiperEl.classList.contains("swiper-tab")) {
                initSwiperWithCustomPagination(swiperEl, config); // افترض أنها معرفة مسبقًا
            } else {
                new Swiper(swiperEl, config);
            }
        });
    }
    window.addEventListener("load", initSwiper);

    /** ------------------------------
     * 8. Smooth scroll to hash on page load
    --------------------------------- */
    window.addEventListener('load', () => {
        if (window.location.hash && document.querySelector(window.location.hash)) {
            setTimeout(() => {
                const section = document.querySelector(window.location.hash);
                const marginTop = parseInt(getComputedStyle(section).scrollMarginTop || 0);
                window.scrollTo({
                    top: section.offsetTop - marginTop,
                    behavior: 'smooth'
                });
            }, 100);
        }
    });

    /** ------------------------------
     * 9. Scrollspy Navigation
    --------------------------------- */
    const navLinks = document.querySelectorAll('.navmenu a');
    function navmenuScrollspy() {
        const scrollY = window.scrollY + 200;
        navLinks.forEach(link => {
            if (!link.hash) return;
            const section = document.querySelector(link.hash);
            if (!section) return;

            const inSection = scrollY >= section.offsetTop && scrollY <= section.offsetTop + section.offsetHeight;
            link.classList.toggle('active', inSection);
        });
    }
    window.addEventListener('load', navmenuScrollspy);
    document.addEventListener('scroll', navmenuScrollspy);

    /** ------------------------------
     * 10. External page to section
    --------------------------------- */
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            if (window.location.pathname !== "/") {
                e.preventDefault();
                const section = this.getAttribute('href');
                window.location.href = "/" + section;
            }
        });
    });

})();
