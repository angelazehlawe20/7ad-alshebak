<header id="header" class="header sticky-top">
    <div class="container">
        <div class="row align-items-center">

            <!-- Logo -->
            <div class="col-6 col-md-3 d-flex align-items-center">
                <img src="{{ asset('assets/img/logo_7adAlshebak.png') }}" alt="Logo" class="me-2"
                    style="max-height: 40px;">
                <a href="#hero" class="text-decoration-none">
                    <h1 class="sitename m-0 fs-5">Had AlShebak</h1>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="col-md-6 d-none d-md-flex justify-content-center">
                <nav class="d-flex gap-3">
                    <a href="{{route('hero')}}" class="nav-link active col-6 col-sm-auto text-center">Home</a>
                    <a href="{{route('all_offers')}}" class="nav-link col-6 col-sm-auto text-center">Offers</a>
                    <a href="{{route('menu')}}" class="nav-link col-6 col-sm-auto text-center">Menu</a>
                    <a href="{{route('book')}}" class="nav-link col-6 col-sm-auto text-center">Book</a>
                    <a href="{{route('contact')}}" class="nav-link col-6 col-sm-auto text-center">Contact</a>
                </nav>
            </div>

            <!-- Mobile Menu Button -->
            <div class="col-6 d-md-none d-flex justify-content-end">
                <button class="btn btn-primary mobile-nav-toggle w-auto" type="button">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <!-- Language Toggle Button (Desktop Only) -->
            <div class="col-6 col-md-3 d-none d-md-flex justify-content-end">
                @if(app()->getLocale() == 'en')
                <a href="?lang=ar" class="btn btn-light language-btn">
                    <img src="{{ asset('assets/img/flags/ar.png') }}" alt="Arabic" class="flag-icon" width="20"> AR
                </a>
                @else
                <a href="?lang=en" class="btn btn-light language-btn">
                    <img src="{{ asset('assets/img/flags/en.png') }}" alt="English" class="flag-icon" width="20"> EN
                </a>
                @endif
            </div>

        </div>
    </div>
</header>

<!-- Mobile Navigation Sidebar -->
<div class="mobile-nav-sidebar">
    <div class="mobile-nav-close">
        <i class="bi bi-x"></i>
    </div>
    <nav class="mobile-nav">
        <ul class="mobile-nav-links">
            <li><a href="{{route('hero')}}" class="mobile-nav-link active">Home</a></li>
            <li><a href="{{route('all_offers')}}" class="mobile-nav-link">Offers</a></li>
            <li><a href="{{route('menu')}}" class="mobile-nav-link">Menu</a></li>
            <li><a href="{{route('book')}}" class="mobile-nav-link">Book</a></li>
            <li><a href="{{route('contact')}}" class="mobile-nav-link">Contact</a></li>
            <!-- Language Toggle Button (Mobile Only) -->
            <li class="mt-3 d-flex justify-content-center">
                @if(app()->getLocale() == 'en')
                <a href="?lang=ar" class="btn btn-light language-btn">
                    <img src="{{ asset('assets/img/flags/ar.png') }}" alt="Arabic" class="flag-icon" width="20"> AR
                </a>
                @else
                <a href="?lang=en" class="btn btn-light language-btn">
                    <img src="{{ asset('assets/img/flags/en.png') }}" alt="English" class="flag-icon" width="20"> EN
                </a>
                @endif
            </li>
        </ul>
    </nav>
</div>

<script>
    // Mobile Navigation Toggle
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
    const mobileNavSidebar = document.querySelector('.mobile-nav-sidebar');
    const mobileNavClose = document.querySelector('.mobile-nav-close');
    const body = document.querySelector('body');

    if (mobileNavToggle && mobileNavSidebar && mobileNavClose) {
      // Open mobile sidebar
      mobileNavToggle.addEventListener('click', function() {
        mobileNavSidebar.classList.add('active');
        body.classList.add('mobile-nav-active');
      });

      // Close mobile sidebar
      mobileNavClose.addEventListener('click', function() {
        mobileNavSidebar.classList.remove('active');
        body.classList.remove('mobile-nav-active');
      });

      // Close mobile sidebar when clicking on a link
      document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', function() {
          mobileNavSidebar.classList.remove('active');
          body.classList.remove('mobile-nav-active');
        });
      });
    }
</script>

<script>
    const navLinks = document.querySelectorAll('.nav-link');

    function updateActiveLink() {
      const hash = window.location.hash || '#hero';
      navLinks.forEach(link => {
        if (link.getAttribute('href') === hash) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      });
    }

    navLinks.forEach(link => {
      link.addEventListener('click', () => {
        updateActiveLink();
      });
    });

    window.addEventListener('DOMContentLoaded', updateActiveLink);
    window.addEventListener('hashchange', updateActiveLink);
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
      const sections = document.querySelectorAll("section[id]");
      const navLinks = document.querySelectorAll(".nav-link");
      const mobileNavLinks = document.querySelectorAll(".mobile-nav-link");

      function activateLinkOnScroll() {
        let scrollPosition = window.scrollY + 200;

        sections.forEach(section => {
          const top = section.offsetTop;
          const height = section.offsetHeight;
          const id = section.getAttribute("id");

          if (scrollPosition >= top && scrollPosition < top + height) {
            if (window.location.hash !== `#${id}`) {
              history.replaceState(null, null, `#${id}`);
            }

            // Update desktop nav links
            navLinks.forEach(link => {
              link.classList.remove("active");
              if (link.getAttribute("href") === `#${id}`) {
                link.classList.add("active");
              }
            });

            // Update mobile nav links
            mobileNavLinks.forEach(link => {
              link.classList.remove("active");
              if (link.getAttribute("href") === `#${id}`) {
                link.classList.add("active");
              }
            });
          }
        });
      }

      window.addEventListener("scroll", activateLinkOnScroll);

      if (window.location.hash) {
        const targetSection = document.querySelector(window.location.hash);
        if (targetSection) {
          targetSection.scrollIntoView();
        }
      }
    });
</script>
