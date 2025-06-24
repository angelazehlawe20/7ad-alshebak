<!-- HEADER -->
<header id="header" class="header">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-6 col-md-3">
                <div class="logo d-flex align-items-center gap-2">
                    {{-- عرض الشعار مع صورة افتراضية في حال عدم وجوده --}}
                    @if(isset($settings->logo) && file_exists(public_path($settings->logo)))
    <img src="{{ asset($settings->logo) }}" alt="Logo" style="width: 80px; height: auto;">
@else
    <img src="{{ asset('assets/img/logos/web-app-manifest-512x512.png') }}" alt="Default Logo"
        style="width: 80px; height: auto;">
@endif

                  <a href="{{ route('hero') }}" class="text-decoration-none">
    <h1 class="sitename" style="font-size: 1.5rem;">
        @if(app()->getLocale() == 'ar')
            {{ $heroPage?->title_ar ?? 'حد الشباك' }}
        @else
            {{ $heroPage?->title_en ?? 'Had AlShebak' }}
        @endif
    </h1>
</a>

                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="col-md-6 d-none d-md-flex justify-content-center">
                <nav class="d-flex gap-3">
                    <a href="{{ route('hero') }}" class="nav-link">{{ __('navbar.home') }}</a>
                    <a href="{{ route('all_offers') }}" class="nav-link">{{ __('navbar.offers') }}</a>
                    <a href="{{ route('menu') }}" class="nav-link">{{ __('navbar.menu') }}</a>
                    <a href="{{ route('book') }}" class="nav-link">{{ __('navbar.book') }}</a>
                    <a href="{{ route('contact') }}" class="nav-link">{{ __('navbar.contact') }}</a>

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
                <a href="{{ route('lang.switch', 'ar') }}" class="btn btn-light language-btn">
                    <img src="{{ asset('assets/img/flags/ar.png') }}" alt="Arabic" class="flag-icon" width="20"> AR
                </a>
                @else
                <a href="{{ route('lang.switch', 'en') }}" class="btn btn-light language-btn">
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
        <li><a href="{{ route('hero') }}" class="nav-link">{{ __('navbar.home') }}</a></li>
        <li><a href="{{ route('all_offers') }}" class="nav-link">{{ __('navbar.offers') }}</a></li>
        <li><a href="{{ route('menu') }}" class="nav-link">{{ __('navbar.menu') }}</a></li>
        <li><a href="{{ route('book') }}" class="nav-link">{{ __('navbar.book') }}</a></li>
        <li><a href="{{ route('contact') }}" class="nav-link">{{ __('navbar.contact') }}</a></li>

    </ul>
</nav>

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
</script>
