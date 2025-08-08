<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="Had AlShebak - Your trusted source for quality window solutions">
    <meta name="keywords" content="windows, shebak, home improvement, construction">
    <title>@yield('title', config('app.name', 'Had AlShebak'))</title>
    <!-- Favicon -->
    @if(isset($settings->favicon) && file_exists(public_path($settings->favicon)))
    <link rel="icon" type="image/x-icon" href="{{ asset($settings->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset($settings->favicon) }}">
    @else
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    @endif

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.6/dist/css/tempus-dominus.min.css" />


    <!-- Main CSS -->
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
        /* === Fonts === */
        @font-face {
            font-family: 'Sukar';
            src: url('/fonts/SukarRegular.ttf') format('truetype');
            font-display: block;
        }

        @font-face {
            font-family: 'TimeBurner';
            src: url('/fonts/Timeburner-xJB8.ttf') format('truetype');
            font-display: block;
        }

        :root {
            --font-arabic: 'Sukar', sans-serif;
            --font-english: 'TimeBurner', sans-serif;
        }

        /* === Body Font === */
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            width: 100vw;
        }

        body[dir="rtl"] {
            font-family: var(--font-arabic);
            font-size: 24px;
            line-height: 1.9;
            font-weight: 600;
            letter-spacing: 0.4px;
        }

        body[dir="ltr"] {
            font-family: var(--font-english);
            font-size: 18px;
            line-height: 1.6;
        }

        /* === Overflow Fix === */
        html,
        body {
            overflow-x: hidden;
            max-width: 100vw;
        }

        /* === Card content wrapping === */
        .card,
        .card-body,
        .card-text,
        .card p,
        .card span,
        .card a {
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        /* === Header Layout Fix for Mobile === */
        header .container,
        header .container-fluid {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .logo-container {
            order: 1;
        }

        .nav-container {
            order: 2;
        }

        .alert-container {
            position: relative;
            z-index: 9999;
            margin-top: 80px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            header {
                padding: 10px 15px;
            }

            .sidebar-toggle {
                display: block !important;
                z-index: 9999;
                cursor: pointer;
                order: 3;
                margin-left: 10px;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="lang-{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    @include('partials.header')

    <div class="spacer" style="height: 30px;"></div>

    <main>
        <div class="container alert-container">
            @include('admin.partials.alerts')
        </div>
        @yield('content')
    </main>

    @include('partials.footer')
    <!-- JS -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@eonasdan/tempus-dominus@6.9.6/dist/js/tempus-dominus.min.js"></script>

    <script>
        let keepAliveTimeout;

        function keepSessionAlive() {
            clearTimeout(keepAliveTimeout);

            // بعد آخر نشاط، انتظر 2 دقيقة ثم أرسل طلب تجديد
            keepAliveTimeout = setTimeout(function () {
                fetch('/keep-alive', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (!response.ok) {
                        console.error('Failed to keep session alive.');
                    }
                }).catch(error => {
                    console.error('Error while keeping session alive:', error);
                });
            }, 2 * 60 * 1000); // كل 2 دقيقة بعد نشاط المستخدم
        }

        // الأنشطة التي تُعتبر "نشاط مستخدم"
        ['mousemove', 'keydown', 'click', 'scroll'].forEach(function(event) {
            window.addEventListener(event, keepSessionAlive);
        });

        // أرسل أول طلب عند تحميل الصفحة
        keepSessionAlive();
        setInterval(function () {
    fetch('/csrf-token')
        .then(response => response.text())
        .then(data => {
            const meta = document.querySelector('meta[name="csrf-token"]');
            if (meta) {
                meta.setAttribute('content', data);
            }
        });
}, 30 * 60 * 1000); // كل 30 دقيقة

    </script>


    @if(app()->getLocale() == 'ar')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
    @endif

    <script>
        flatpickr("#booking_date", {
            dateFormat: "d-m-Y",
            minDate: "today",
            locale: "{{ app()->getLocale() == 'ar' ? 'ar' : 'default' }}",
            disableMobile: true
        });

        flatpickr("#birth_date", {
            dateFormat: "d-m-Y",
            maxDate: "today",
            locale: "{{ app()->getLocale() == 'ar' ? 'ar' : 'default' }}",
            disableMobile: true
        });
    </script>

    @stack('scripts')
</body>

</html>
