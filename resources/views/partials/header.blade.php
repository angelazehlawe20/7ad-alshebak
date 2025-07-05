<!-- HEADER -->
<header id="header" class="header w-100">
    <div class="container-fluid px-3 px-md-5">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-6 col-sm-4 col-md-3">
                <div class="logo d-flex align-items-center gap-2">
                    {{-- عرض الشعار مع صورة افتراضية في حال عدم وجوده --}}
                    <a href="{{ route('hero') }}">
                        @if(isset($settings->logo) && file_exists(public_path($settings->logo)))
                        <img src="{{ asset($settings->logo) }}" alt="Logo" class="img-fluid" style="max-width: 60px;">
                    </a>
                    @else
                    <a href="{{ route('hero') }}">
                        <img src="{{ asset('assets/img/logos/web-app-manifest-512x512.png') }}" alt="Default Logo"
                            class="img-fluid" style="max-width: 60px;">
                    </a>
                    @endif
                    <a href="{{ route('hero') }}" class="text-decoration-none">
                        <span class="sitename mb-0 text-nowrap">
                            {{ app()->getLocale() == 'ar' ? ($heroPage?->title_ar ?? 'حدّ الشباك') :
                            ($heroPage?->title_en ?? 'Had AlShebak') }}
                        </span>
                    </a>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center">
                <nav class="d-flex flex-wrap gap-5 justify-content-center w-100">
                    <a href="{{ route('hero') }}" class="nav-link px-2 text-center">
                        {{ __('navbar.home')}}</a>
                    <a href="{{ route('all_offers') }}" class="nav-link px-2 text-center">
                        {{__('navbar.offers')}}</a>
                    <a href="{{ route('menu') }}" class="nav-link px-2 text-center">
                        {{__('navbar.menu')}}</a>
                    <a href="{{ route('book') }}" class="nav-link px-2 text-center">
                        {{__('navbar.book')}}</a>
                    <a href="{{ route('contact') }}" class="nav-link px-2 text-center">
                        {{__('navbar.contact')}}</a>
                </nav>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <div class="col-6 col-sm-8 d-md-none d-flex justify-content-end">
                <button class="btn mobile-nav-toggle bg-white" type="button" aria-label="Toggle Navigation">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </div>
            <!-- Language Toggle -->
            <div class="col-3 col-sm-4 col-md-3 d-none d-md-flex justify-content-end">
                @if(app()->getLocale() == 'en')
                <a href="{{ route('lang.switch', 'ar') }}" class="btn btn-light language-btn">
                    <img src="{{ asset('assets/img/flags/ar.png') }}" alt="Arabic" class="flag-icon" width="20">
                    <span class="d-none d-sm-inline">AR</span>
                </a>
                @else
                <a href="{{ route('lang.switch', 'en') }}" class="btn btn-light language-btn">
                    <img src="{{ asset('assets/img/flags/en.png') }}" alt="English" class="flag-icon" width="20">
                    <span class="d-none d-sm-inline">EN</span>
                </a>
                @endif
            </div>
        </div>
    </div>
</header>
<!-- BACKDROP OVERLAY -->
<div class="mobile-nav-overlay backdrop-blur"></div>
<!-- MOBILE SIDEBAR -->
<nav class="mobile-nav-sidebar rounded-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }} shadow-lg">
    <div class="mobile-nav-links p-0">
        {{-- Language Switcher --}}
        <div
            class="pt-4 px-4 d-flex {{ app()->getLocale() == 'ar' ? 'justify-content-start' : 'justify-content-end' }}">
            @php
            $currentLocale = app()->getLocale();
            $targetLocale = $currentLocale === 'en' ? 'ar' : 'en';
            $targetLabel = strtoupper($targetLocale);
            @endphp

            <a href="{{ route('lang.switch', $targetLocale) }}" class="btn btn-light language-btn hover-scale"
                aria-label="Switch to {{ $targetLocale === 'ar' ? 'Arabic' : 'English' }}">
                <img src="{{ asset(" assets/img/flags/{$targetLocale}.png") }}"
                    alt="{{ $targetLocale === 'ar' ? 'Arabic' : 'English' }} flag" class="flag-icon rounded-circle"
                    width="24">
                <span class="ms-2 fw-medium">{{ $targetLabel }}</span>
            </a>
        </div>

        {{-- Navigation Links Container --}}
        <div class="nav-links-container px-4 mt-4">
            @php
            $navItems = [
            ['route' => 'hero', 'icon' => 'house-door', 'text' => 'home'],
            ['route' => 'all_offers', 'icon' => 'tag', 'text' => 'offers'],
            ['route' => 'menu', 'icon' => 'journal-text', 'text' => 'menu'],
            ['route' => 'book', 'icon' => 'calendar-check', 'text' => 'book'],
            ['route' => 'contact', 'icon' => 'envelope', 'text' => 'contact']
            ];
            @endphp
            @foreach($navItems as $item)
            <div class="nav-item py-2">
                <a href="{{ route($item['route']) }}"
                    class="nav-link d-flex align-items-center rounded-pill p-2 {{ request()->routeIs($item['route']) ? 'active px-4' : 'px-3' }}"
                    aria-current="{{ request()->routeIs($item['route']) ? 'page' : 'false' }}">
                    <i class="bi bi-{{ $item['icon'] }} {{ app()->getLocale() == 'ar' ? 'ms-4' : 'me-4' }}"
                        aria-hidden="true"></i>
                    <span>{{ __("navbar.{$item['text']}") }}</span>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</nav>
<script src="{{ asset('assets/js/headerPage.js') }}"></script>
