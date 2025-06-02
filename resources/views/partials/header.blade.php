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
                <button class="btn btn-transparent mobile-nav-toggle w-auto" type="button">
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
    const mobileNavIcon = document.querySelector('.mobile-nav-toggle i');
    const mobileNavSidebar = document.querySelector('.mobile-nav-sidebar');
    const body = document.querySelector('body');

    if (mobileNavToggle && mobileNavSidebar) {
      // Open mobile sidebar
      mobileNavToggle.addEventListener('click', function() {
        mobileNavSidebar.classList.add('active');
        body.classList.add('mobile-nav-active');
        // Change icon to X when sidebar is open
        mobileNavIcon.classList.remove('bi-list');
        mobileNavIcon.classList.add('bi-x');
      });

      // Close mobile sidebar when clicking on a link
      document.querySelectorAll('.mobile-nav-link').forEach(link => {
        link.addEventListener('click', function() {
          mobileNavSidebar.classList.remove('active');
          body.classList.remove('mobile-nav-active');
          // Change icon back to hamburger when sidebar is closed
          mobileNavIcon.classList.remove('bi-x');
          mobileNavIcon.classList.add('bi-list');
        });
      });

      // Close mobile sidebar when clicking outside
      document.addEventListener('click', function(event) {
        if (body.classList.contains('mobile-nav-active') &&
            !mobileNavSidebar.contains(event.target) &&
            !mobileNavToggle.contains(event.target)) {
          mobileNavSidebar.classList.remove('active');
          body.classList.remove('mobile-nav-active');
          // Change icon back to hamburger when sidebar is closed
          mobileNavIcon.classList.remove('bi-x');
          mobileNavIcon.classList.add('bi-list');
        }
      });
    }
</script>
