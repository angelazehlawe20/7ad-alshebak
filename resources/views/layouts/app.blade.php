<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
            font-family: 'Shekari';
            src: url('/fonts/Shekari-Font.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'TimeBurner';
            src: url('/fonts/Timeburner-xJB8.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        /* === 2. تعيين الخطوط للغات === */
        :root {
            --font-arabic: 'Shekari', sans-serif;
            --font-english: 'TimeBurner', sans-serif;
        }

        body[dir="rtl"] {
    font-family: var(--font-arabic);
    font-size: 22px;          /* حجم أكبر للنص العادي */
    line-height: 1.9;
    font-weight: 600;
    letter-spacing: 0.4px;
}

body[dir="ltr"] {
    font-family: var(--font-english);
    font-size: 16px;
    line-height: 1.6;
}

/* تكبير العناوين والنصوص المهمة بشكل متدرج */
body[dir="rtl"] h1 {
    font-size: 3.2rem !important;  /* عنوان رئيسي كبير */
    font-weight: 700;
}

body[dir="rtl"] h2 {
    font-size: 2.8rem !important;  /* عنوان فرعي */
    font-weight: 700;
}

body[dir="rtl"] h3 {
    font-size: 2.4rem !important;  /* عنوان ثالث */
    font-weight: 600;
}

body[dir="rtl"] p,
body[dir="rtl"] button,
body[dir="rtl"] input,
body[dir="rtl"] select,
body[dir="rtl"] textarea {
    font-size: 20px !important;  /* نصوص وزرار ونماذج */
}
    </style>

    @stack('styles')
</head>

<body dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')
</body>

</html>
