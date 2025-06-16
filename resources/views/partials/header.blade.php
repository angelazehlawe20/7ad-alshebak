<!-- HEADER -->
<header id="header" class="header cky-tostip">
  <div class="container">
    <div class="row align-items-center">

      <!-- Logo -->
      <div class="col-6 col-md-3 d-flex align-items-center">
        <img src="{{ asset('assets/img/logo_7adAlshebak.png') }}" alt="Logo" class="me-2" style="max-height: 60px;">
        <a href="{{ route('hero') }}" class="text-decoration-none">
          <h1 class="sitename m-0 fs-5">Had AlShebak</h1>
        </a>
      </div>

      <!-- Desktop Navigation -->
      <div class="col-md-6 d-none d-md-flex justify-content-center sticky-nav">
        <nav class="d-flex gap-3">
          <a href="{{ route('hero') }}" class="nav-link">Home</a>
          <a href="{{ route('all_offers') }}" class="nav-link">Offers</a>
          <a href="{{ route('menu') }}" class="nav-link">Menu</a>
          <a href="{{ route('book') }}" class="nav-link">Book</a>
          <a href="{{ route('contact') }}" class="nav-link">Contact</a>
        </nav>
      </div>

      <!-- Mobile Menu Toggle Button -->
      <div class="col-6 d-md-none d-flex justify-content-end">
        <button class="btn mobile-nav-toggle w-auto" type="button">
          <i class="bi bi-list"></i>
        </button>
      </div>

      <!-- Language Toggle -->
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

<!-- BACKDROP OVERLAY -->
<div class="mobile-nav-overlay"></div>

<!-- MOBILE SIDEBAR -->
<nav class="mobile-nav-sidebar">
  <div class="@if(app()->getLocale() == 'ar') text-start @else text-end @endif p-3 d-md-none">
    <button id="closeSidebarBtn" class="btn btn-sm">
      <i class="bi bi-x-lg"></i>
    </button>
  </div>
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
    <li><a href="{{ route('hero') }}" class="mobile-nav-link">Home</a></li>
    <li><a href="{{ route('all_offers') }}" class="mobile-nav-link">Offers</a></li>
    <li><a href="{{ route('menu') }}" class="mobile-nav-link">Menu</a></li>
    <li><a href="{{ route('book') }}" class="mobile-nav-link">Book</a></li>
    <li><a href="{{ route('contact') }}" class="mobile-nav-link">Contact</a></li>
  </ul>
</nav>

<!-- Add padding to main content -->
<style>
  main {
    padding-top: 150px;
    /* Increased padding for better spacing */
  }

  /* Additional styles for cleaner layout */
  .header {
    height: 80px;
    background: #fff;
  }

  body {
    padding-top: 0;
    /* Remove body padding to prevent scrolling issues */
    overflow-x: hidden;
    /* Prevent horizontal scrolling */
  }

  /* Ensure smooth transition when header becomes fixed */
  #header {
    transition: all 0.3s ease-in-out;
  }
</style>

<script>
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

      // Make header fixed at top with improved styling
      window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        header.style.position = 'fixed';
        header.style.top = '0';
        header.style.width = '100%';
        header.style.backgroundColor = '#fff';
        header.style.boxShadow = scrollTop > 50  // Reduced scroll threshold
          ? '0 2px 15px rgba(0, 0, 0, 0.1)'
          : 'none';
        header.style.zIndex = '1000';
      });

      function closeSidebar() {
        mobileNavSidebar.classList.remove("active");
        body.classList.remove("mobile-nav-active");
        toggleIcon?.classList.remove("bi-x");
        toggleIcon?.classList.add("bi-list");
        // Restore scrolling when sidebar is closed
        document.body.style.position = '';
        document.body.style.overflow = '';
        document.body.style.width = '';
        document.body.style.height = '';
        document.body.style.top = '';
        document.body.style.left = '';
        document.body.style.touchAction = '';
      }

      mobileNavToggle?.addEventListener('click', () => {
        const isActive = mobileNavSidebar.classList.toggle('active');
        body.classList.toggle('mobile-nav-active', isActive);

        if (isActive) {
          toggleIcon?.classList.remove('bi-list');
          toggleIcon?.classList.add('bi-x');
          // Prevent scrolling when sidebar is open
          document.body.style.position = 'fixed';
          document.body.style.overflow = 'hidden';
          document.body.style.width = '100%';
          document.body.style.height = '100%';
          document.body.style.top = '0';
          document.body.style.left = '0';
          document.body.style.touchAction = 'none';
        } else {
          toggleIcon?.classList.remove('bi-x');
          toggleIcon?.classList.add('bi-list');
          // Restore scrolling when sidebar is closed
          document.body.style.position = '';
          document.body.style.overflow = '';
          document.body.style.width = '';
          document.body.style.height = '';
          document.body.style.top = '';
          document.body.style.left = '';
          document.body.style.touchAction = '';
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

      updateActiveLinkByPath();
    });
</script>
