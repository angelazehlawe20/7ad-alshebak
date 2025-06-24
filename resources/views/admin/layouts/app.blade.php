<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ __('messages.admin_panel_description') }}">
    <meta name="author" content="{{ __('messages.admin') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ __('messages.admin_panel') }}</title>

    @if(isset($settings->favicon) && file_exists(public_path($settings->favicon)))
    <link href="{{ asset($settings->favicon) }}" rel="icon">
    <link href="{{ asset($settings->favicon) }}" rel="apple-touch-icon">
    @else
    <link href="{{ asset('assets/img/favicons/favicon.ico') }}" rel="icon">
    <link href="{{ asset('assets/img/favicons/favicon.ico') }}" rel="apple-touch-icon">
    @endif

    {{-- Bootstrap --}}
    @if(app()->getLocale() === 'ar')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    @else
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    @endif

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    {{-- Custom Styles --}}
    <style>
        :root {
            --sidebar-bg: #8B7355;
            --sidebar-hover: rgba(139, 115, 85, 0.15);
            --sidebar-active: #6B4423;
            --main-bg: #F5F5DC;
            --text-color: #2F1810;
            --btn-primary: #8B4513;
            --btn-hover: #654321;
            --nav-bg: #F5F5DC;
        }

        body {
            overflow-x: hidden;
            color: var(--text-color);
        }

        body.no-scroll {
            overflow: hidden !important;
        }

        body.ltr {
            direction: ltr;
            text-align: left;
        }

        body.rtl {
            direction: rtl;
            text-align: right;
        }

        .sidebar {
            position: sticky;
            top: 0;
            height: 100vh;
            background: var(--sidebar-bg);
            color: #fff;
            width: 250px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 12px 15px;
            margin: 3px 10px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: start;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: var(--sidebar-hover);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background: var(--sidebar-active);
        }

        body.ltr .sidebar .nav-link i {
            margin-right: 8px;
            margin-left: 0;
        }

        body.rtl .sidebar .nav-link i {
            margin-left: 8px;
            margin-right: 0;
        }

        body.ltr .badge {
            margin-left: 8px;
        }

        body.rtl .badge {
            margin-right: 8px;
        }

        .main-content {
            background: var(--main-bg);
            width: calc(100% - 250px);
        }

        .navbar {
            background-color: var(--nav-bg);
        }

        .btn-outline-secondary {
            border-color: var(--btn-primary);
            color: var(--btn-primary);
        }

        .btn-outline-secondary:hover {
            background-color: var(--btn-primary);
            border-color: var(--btn-primary);
            color: #fff;
        }

        .btn-light {
            border-color: var(--btn-primary);
        }

        .dropdown-item:hover {
            background-color: var(--sidebar-hover);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -250px;
                z-index: 1050;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                width: 100%;
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(47, 24, 16, 0.5);
                z-index: 1040;
            }

            .overlay.show {
                display: block;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-light {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        @include('admin.layouts.sidebar')

        <div class="main-content">
            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none text-dark" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="d-flex align-items-center ms-auto gap-2">
                        <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                            class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-language me-1"></i>
                            {{ app()->getLocale() === 'ar' ? 'English' : 'Arabic' }}
                        </a>

                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>
                                <span>{{ __('messages.admin') }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-cog me-2"></i> {{ __('messages.profile') }}
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Main Content --}}
            <div class="container-fluid p-4">
                @include('admin.partials.alerts')
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <script>
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
    sidebar.classList.toggle('show');
    overlay.classList.toggle('show');

    if (sidebar.classList.contains('show')) {
        document.body.classList.add('no-scroll');
    } else {
        document.body.classList.remove('no-scroll');
    }
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('show');
    overlay.classList.remove('show');
    document.body.classList.remove('no-scroll');
});


        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    </script>

    @stack('scripts')
    @yield('scripts')
</body>
{{-- --}}

</html>
