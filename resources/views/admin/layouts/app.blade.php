<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ __('messages.admin_panel') }}</title>
    <meta name="description" content="{{ __('messages.admin_panel_description') }}">
    <meta name="author" content="{{ __('messages.admin') }}">

    {{-- Favicon --}}
    @if(isset($settings->favicon) && file_exists(public_path($settings->favicon)))
    <link rel="icon" href="{{ asset($settings->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset($settings->favicon) }}">
    @else
    <link rel="icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/favicon.ico') }}">
    @endif

    {{-- Styles --}}
    @if(app()->getLocale() === 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@next/dist/aos.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-light {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        @include('admin.layouts.sidebar')

        <div class="main-content">
            {{-- Navbar --}}
            @include('admin.layouts.navbar')

            {{-- Main content --}}
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

    {{-- Sidebar toggle --}}
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

    {{-- Notifications --}}
    <script>
        function markBookingsAsNotified() {
            $.post('{{ route("admin.bookings.markAsNotified") }}', {
                _token: '{{ csrf_token() }}'
            });
        }

        function markMessagesAsNotified() {
            $.post('{{ route("admin.contacts.markAsNotified") }}', {
                _token: '{{ csrf_token() }}'
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            function waitForEcho(retries = 10) {
                if (window.Echo && typeof window.Echo.channel === 'function') {
                    window.Echo.channel('admin.contacts')
                        .listen('ContactMessageReceived', (e) => {
                            const badge = document.querySelector('#contact-unread-badge');
                            if (badge) {
                                badge.textContent = e.unreadCount;
                                badge.style.display = e.unreadCount > 0 ? 'inline-block' : 'none';
                            }
                        });
                } else if (retries > 0) {
                    setTimeout(() => waitForEcho(retries - 1), 300);
                } else {
                    console.error('Echo not ready');
                }
            }

            waitForEcho();
        });
    </script>

    {{-- Keep session alive --}}
    <script>
        let keepAliveTimeout;

        function keepSessionAlive() {
            clearTimeout(keepAliveTimeout);
            keepAliveTimeout = setTimeout(() => {
                fetch('/keep-alive', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).catch(console.error);
            }, 2 * 60 * 1000);
        }

        ['mousemove', 'keydown', 'click', 'scroll'].forEach(event => {
            window.addEventListener(event, keepSessionAlive);
        });

        keepSessionAlive();

        setInterval(() => {
            fetch('/csrf-token')
                .then(res => res.text())
                .then(token => {
                    document.querySelector('meta[name="csrf-token"]').setAttribute('content', token);
                });
        }, 30 * 60 * 1000);
    </script>

    <script>
        function loadUnreadMessages() {
        fetch('{{ route('admin.notifications.messages') }}')
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('contact-unread-badge');
                if (data.unread_count > 0) {
                    badge.textContent = data.unread_count;
                    badge.style.display = 'inline-block';
                } else {
                    badge.style.display = 'none';
                }
    
                const dropdownList = document.getElementById('messages-dropdown-list');
                dropdownList.innerHTML = '';
    
                if (data.messages.length > 0) {
                    data.messages.forEach(msg => {
                        const li = document.createElement('li');
                        li.classList.add('dropdown-item');
                        li.innerHTML = `<strong>${msg.name}</strong><br><small>${msg.subject}</small>`;
                        li.onclick = () => {
                            window.location.href = `/admin/contacts`;
                        };
                        dropdownList.appendChild(li);
                    });
                    const viewAll = document.createElement('li');
                    viewAll.innerHTML = `<a href="{{ route('admin.contacts.index') }}" class="dropdown-item text-center text-primary">
                        {{ __('messages.view_all') }}</a>`;
                    dropdownList.appendChild(viewAll);
                } else {
                    dropdownList.innerHTML = `<li class="dropdown-item-text text-muted text-center">
                        {{ __('messages.no_new_messages') }}</li>`;
                }
            })
            .catch(err => console.error('Error loading messages', err));
    }
    
    setInterval(loadUnreadMessages, 30000); // كل 30 ثانية
    document.addEventListener('DOMContentLoaded', loadUnreadMessages);
    </script>


    {{-- Extra custom scripts --}}
    @stack('scripts')
    @yield('scripts')

    {{-- Optional style overrides --}}
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
</body>

</html>