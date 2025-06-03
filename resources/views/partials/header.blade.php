<!-- HEADER -->
<header id="header" class="header sticky-top">
    <div class="container">
        <div class="row align-items-center">

            <!-- Logo -->
            <div class="col-6 col-md-3 d-flex align-items-center">
                <img src="{{ asset('assets/img/logo_7adAlshebak.png') }}" alt="Logo" class="me-2"
                    style="max-height: 40px;">
                <a href="{{route('hero')}}" class="text-decoration-none">
                    <h1 class="sitename m-0 fs-5">Had AlShebak</h1>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="col-md-6 d-none d-md-flex justify-content-center">
                <nav class="d-flex gap-3">
                    <a href="{{route('hero')}}" class="nav-link">Home</a>
                    <a href="{{route('all_offers')}}" class="nav-link">Offers</a>
                    <a href="{{route('menu')}}" class="nav-link">Menu</a>
                    <a href="{{route('book')}}" class="nav-link">Book</a>
                    <a href="{{route('contact')}}" class="nav-link">Contact</a>
                </nav>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="col-6 d-md-none d-flex justify-content-end">
                <button class="btn mobile-nav-toggle w-auto" type="button">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <!-- Language Toggle Button (Desktop) -->
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

<!-- BACKDROP OVERLAY FOR SIDEBAR -->
<div class="mobile-nav-overlay"></div>

<!-- MOBILE SIDEBAR -->
<nav class="mobile-nav-sidebar">
    <ul class="mobile-nav-links">
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
        <li><a href="{{route('hero')}}" class="mobile-nav-link">Home</a></li>
        <li><a href="{{route('all_offers')}}" class="mobile-nav-link">Offers</a></li>
        <li><a href="{{route('menu')}}" class="mobile-nav-link">Menu</a></li>
        <li><a href="{{route('book')}}" class="mobile-nav-link">Book</a></li>
        <li><a href="{{route('contact')}}" class="mobile-nav-link">Contact</a></li>

    </ul>
</nav>

<!-- SCRIPT -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
      const mobileNavToggle = document.querySelector('.mobile-nav-toggle');
      const mobileNavSidebar = document.querySelector('.mobile-nav-sidebar');
      const mobileNavOverlay = document.querySelector('.mobile-nav-overlay');
      const toggleIcon = mobileNavToggle?.querySelector('i');
      const body = document.body;

      const navLinks = document.querySelectorAll(".nav-link");
      const mobileNavLinks = document.querySelectorAll(".mobile-nav-link");

      // Toggle Sidebar
      if (mobileNavToggle && mobileNavSidebar && toggleIcon) {
        mobileNavToggle.addEventListener('click', () => {
          const isActive = mobileNavSidebar.classList.toggle('active');
          body.classList.toggle('mobile-nav-active', isActive);

          toggleIcon.classList.remove(isActive ? 'bi-list' : 'bi-x');
          toggleIcon.classList.add(isActive ? 'bi-x' : 'bi-list');
        });
      }

      // Close Sidebar on overlay click
      mobileNavOverlay?.addEventListener('click', () => {
        mobileNavSidebar.classList.remove('active');
        body.classList.remove('mobile-nav-active');
        toggleIcon?.classList.remove('bi-x');
        toggleIcon?.classList.add('bi-list');
      });

      // Close on link click & prevent reload on same path
      mobileNavLinks.forEach(link => {
        link.addEventListener("click", (e) => {
          const linkPath = new URL(link.href).pathname;
          const currentPath = window.location.pathname;

          if (linkPath === currentPath) {
            e.preventDefault(); // prevent reload if already on the page
          }

          mobileNavSidebar.classList.remove('active');
          body.classList.remove('mobile-nav-active');
          toggleIcon?.classList.remove('bi-x');
          toggleIcon?.classList.add('bi-list');
        });
      });

      // Highlight current page
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

      updateActiveLinkByPath();
    });
</script>