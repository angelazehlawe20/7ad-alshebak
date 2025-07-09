<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Had AlShebak')</title>
    @if(isset($settings->favicon) && file_exists(public_path($settings->favicon)))
    <link href="{{ asset($settings->favicon) }}" rel="icon">
    <link href="{{ asset($settings->favicon) }}" rel="apple-touch-icon">
    @else
    <link href="{{ asset('assets/img/favicons/favicon.ico') }}" rel="icon">
    <link href="{{ asset('assets/img/favicons/favicon.ico') }}" rel="apple-touch-icon">
    @endif

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">



    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/base.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/layout.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/variables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/mobile-nav.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/language-toggle.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet">

    <style>
        @font-face {
            font-family: 'Sukar';
            src: url('/fonts/SukarRegular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: block;
        }

        @font-face {
            font-family: 'TimeBurner';
            src: url('/fonts/Timeburner-xJB8.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: block;
        }

        /* === 2. تعيين الخطوط للغات === */
        :root {
            --font-arabic: 'Sukar', sans-serif;
            --font-english: 'TimeBurner', sans-serif;
        }

        /* === INCREASED FONT SIZES FOR ARABIC === */
        body[dir="rtl"] {
            font-family: var(--font-arabic);
            font-size: 24px;
            /* Increased from 22px */
            line-height: 1.9;
            font-weight: 600;
            letter-spacing: 0.4px;
        }

        /* === INCREASED FONT SIZES FOR ENGLISH === */
        body[dir="ltr"] {
            font-family: var(--font-english);
            font-size: 18px;
            /* Increased from 16px */
            line-height: 1.6;
        }

        /* === INCREASED HEADING SIZES FOR ARABIC === */
        body[dir="rtl"] h1 {
            font-size: 4rem !important;
            /* Increased from 2.2rem */
            font-weight: 600;
        }

        body[dir="rtl"] h2 {
            font-size: 3.2rem !important;
            /* Increased from 2.8rem */
            font-weight: 700;
        }

        body[dir="rtl"] h3 {
            font-size: 2.8rem !important;
            /* Increased from 2.4rem */
            font-weight: 600;
        }

        /* === INCREASED TEXT SIZES FOR FORM ELEMENTS AND PARAGRAPHS === */
        body[dir="rtl"] p,
        body[dir="rtl"] button,
        body[dir="rtl"] input,
        body[dir="rtl"] select,
        body[dir="rtl"] textarea {
            font-size: 24px !important;
            /* Increased from 20px */
        }

        /* === INCREASED FONT SIZES FOR ENGLISH HEADINGS === */
        body[dir="ltr"] h1 {
            font-size: 4rem !important;
            font-weight: 600;
        }

        body[dir="ltr"] .section-title p .description-title {
            font-size: 2em !important;
            /* Make description title 10% larger than the rest of the title */
            font-weight: 600;
        }

        /* === INCREASED SECTION TITLE SIZES === */
        .section-title p {
            font-size: 56px !important;
            /* Increased from 48px */
        }

        body[dir="rtl"] .section-title p {
            font-size: 3.2rem !important;
            /* Increased from 2.7rem */
        }

        body[dir="rtl"] .section-title p .description-title {
            font-size: 1em !important;
            /* Make description title 10% larger than the rest of the title */
            font-weight: 600;
        }

        /* Responsive adjustments for section titles */
        @media (max-width: 991px) {
            .section-title p {
                font-size: 50px !important;
                /* Increased from 42px */
            }

            body[dir="rtl"] .section-title p {
                font-size: 2.9rem !important;
            }
        }

        @media (max-width: 767px) {
            .section-title p {
                font-size: 44px !important;
                /* Increased from 36px */
            }

            body[dir="rtl"] .section-title p {
                font-size: 2.6rem !important;
            }
        }

        @media (max-width: 575px) {
            .section-title p {
                font-size: 36px !important;
                /* Increased from 28px */
            }

            body[dir="rtl"] .section-title p {
                font-size: 2.3rem !important;
            }
        }

        body[dir="ltr"] h2 {
            font-size: 1.8rem !important;
            font-weight: 700;
        }

        body[dir="ltr"] h3 {
            font-size: 1.5rem !important;
            font-weight: 600;
        }

        /* === INCREASED TEXT SIZES FOR ENGLISH ELEMENTS === */
        body[dir="ltr"] p,
        body[dir="ltr"] button,
        body[dir="ltr"] input,
        body[dir="ltr"] select,
        body[dir="ltr"] textarea {
            font-size: 18px !important;
        }

        /* === NAVIGATION ELEMENTS === */
        .navmenu a {
            font-size: 20px !important;
        }

        /* === FOOTER ELEMENTS === */
        footer p,
        footer a,
        footer span {
            font-size: 18px !important;
        }

        /* === SMALL TEXT ELEMENTS === */
        .small,
        small,
        .text-muted {
            font-size: 90% !important;
        }

        /* === RESPONSIVE ADJUSTMENTS === */
        @media (max-width: 768px) {
            body[dir="rtl"] {
                font-size: 22px;
            }

            body[dir="ltr"] {
                font-size: 16px;
            }

            body[dir="rtl"] p,
            body[dir="rtl"] button,
            body[dir="rtl"] input,
            body[dir="rtl"] select,
            body[dir="rtl"] textarea {
                font-size: 22px !important;
            }

            body[dir="ltr"] p,
            body[dir="ltr"] button,
            body[dir="ltr"] input,
            body[dir="ltr"] select,
            body[dir="ltr"] textarea {
                font-size: 16px !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="lang-{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    @include('partials.header')

    <main>
        @include('admin.partials.alerts')
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>




    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @if(app()->getLocale() == 'ar')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
    @endif

    <script>
        flatpickr("#booking_date",  {
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1),
        locale: "{{ app()->getLocale() == 'ar' ? 'ar' : 'default' }}",
        disableMobile: true
    });
    </script>

    @stack('scripts')
</body>

</html>