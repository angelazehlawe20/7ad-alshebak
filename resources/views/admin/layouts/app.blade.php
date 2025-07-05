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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}" />
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
                            {{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}
                        </a>

                        @php
                        $admin = auth()->guard('admin')->user();
                        @endphp

                        @if($admin->is_owner)
                        {{-- Dropdown (مالك) --}}
                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>
                                <span>{{ __('messages.admin') }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                                        <i class="fas fa-user-cog me-2"></i> {{ __('messages.profile') }}
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @else
                        {{-- زر مباشر (أدمن عادي) --}}
                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i> {{ __('messages.logout') }}
                            </button>
                        </form>
                        @endif
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

    <style>
        body.rtl {
            font-size: 22px;
            line-height: 1.8;
        }

        body.ltr {
            font-size: 16px;
            line-height: 1.6;
        }

        .sidebar .nav-link {
            font-size: 18px !important;
        }

        table th,
        table td {
            font-size: 16px !important;
        }

        .form-control,
        .form-select,
        .btn,
        label {
            font-size: 16px !important;
        }

        h1,
        .h1 {
            font-size: 2.2rem !important;
        }

        h2,
        .h2 {
            font-size: 1.8rem !important;
        }

        h3,
        .h3 {
            font-size: 1.5rem !important;
        }

        body.rtl .sidebar .nav-link {
            font-size: 20px !important;
        }

        body.rtl table th,
        body.rtl table td {
            font-size: 18px !important;
        }

        body.rtl .form-control,
        body.rtl .form-select,
        body.rtl .btn,
        body.rtl label {
            font-size: 18px !important;
        }

        body.rtl h1,
        body.rtl .h1 {
            font-size: 2.5rem !important;
        }

        body.rtl h2,
        body.rtl .h2 {
            font-size: 2.2rem !important;
        }

        body.rtl h3,
        body.rtl .h3 {
            font-size: 1.8rem !important;
        }

        .small,
        small,
        .text-muted {
            font-size: 90% !important;
        }

        @media (max-width: 768px) {
            body.rtl {
                font-size: 20px;
            }

            body.rtl .sidebar .nav-link,
            body.rtl .form-control,
            body.rtl .form-select,
            body.rtl .btn,
            body.rtl label {
                font-size: 16px !important;
            }
        }
    </style>

    <script>
        const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        document.body.classList.toggle('no-scroll', sidebar.classList.contains('show'));
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

</html>
