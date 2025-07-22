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
            <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none text-dark" id="sidebarToggle">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="d-flex align-items-center ms-auto gap-2">
                        @php
                        $newBookings = \App\Models\Booking::where('status', 'pending')
                        ->whereDate('created_at', \Carbon\Carbon::today())
                        ->where('is_notified', false)
                        ->count();

                        $unreadMessages = \App\Models\Contact::where('is_read', false)
                        ->whereDate('created_at', \Carbon\Carbon::today())
                        ->where('is_notified', false)
                        ->count();
                        @endphp

                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle position-relative"
                                type="button" id="notificationsDropdown" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fas fa-bell"></i>
                                <span id="contact-unread-badge"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="display: none;"></span>
                            </button>

                            <ul id="messages-dropdown-list" class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="notificationsDropdown">
                                @if($newBookings > 0 || $unreadMessages > 0)
                                @if($newBookings > 0)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.bookings.index') }}"
                                        onclick="markBookingsAsNotified()">
                                        <i class="fas fa-calendar-check me-2"></i>
                                        {{ $newBookings }} {{ __('messages.new_bookings') }}
                                    </a>
                                </li>
                                @endif
                                @if($unreadMessages > 0)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.contacts.index') }}"
                                        onclick="markMessagesAsNotified()">
                                        <i class="fas fa-envelope me-2"></i>
                                        {{ $unreadMessages }} {{ __('messages.new_messages') }}
                                    </a>
                                </li>
                                @endif
                                @else
                                <li class="dropdown-menu-empty">
                                    <span class="dropdown-item-text text-muted text-center">
                                        {{ __('messages.no_new_notifications') }}
                                    </span>
                                </li>
                                @endif
                            </ul>
                        </div>

                        <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                            class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-language me-1"></i>
                            {{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}
                        </a>

                        @php $admin = auth()->guard('admin')->user(); @endphp

                        @if($admin->is_owner)
                        <div class="dropdown">
                            <button class="btn btn-light rounded-pill dropdown-toggle" type="button" id="userDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-2"></i>
                                <span>{{ __('messages.admin') }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.profile.index') }}">
                                        <i class="fas fa-user-cog me-2"></i> {{ __('messages.profile') }}</a></li>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        function updateNotifications() {
    Promise.all([
        fetch('{{ route("admin.notifications.messages") }}'),
        fetch('{{ route("admin.contacts.fetch") }}')
    ])
    .then(responses => Promise.all(responses.map(res => res.json())))
    .then(([messagesData, contactsData]) => {
        // تحديث شارة الإشعارات
        const badge = document.getElementById('contact-unread-badge');
        const dropdownList = document.getElementById('messages-dropdown-list');
        const messagesList = document.getElementById('messages-list');

        if (!badge || !dropdownList) {
            console.error('Elements not found: #contact-unread-badge or #messages-dropdown-list');
            return;
        }

        // تحديث عدد الرسائل غير المقروءة
        if (messagesData.unread_count > 0) {
            badge.textContent = messagesData.unread_count;
            badge.style.display = 'inline-block';
        } else {
            badge.style.display = 'none';
        }

        // تحديث قائمة الإشعارات
        dropdownList.innerHTML = '';
        if (messagesData.messages.length > 0) {
            messagesData.messages.forEach(msg => {
                const li = document.createElement('li');
                li.classList.add('dropdown-item');
                li.innerHTML = `
                    <div class="fw-bold">${msg.name}</div>
                    <div class="text-muted small">${msg.subject}</div>
                    <div class="text-muted smaller">${new Date(msg.created_at).toLocaleString()}</div>
                `;
                li.onclick = () => {
                    window.location.href = '{{ route("admin.contacts.index") }}';
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

        // تحديث قائمة الرسائل في الصفحة إذا كانت موجودة
        if (messagesList && contactsData.messages_html) {
            messagesList.innerHTML = contactsData.messages_html;

            // إعادة تفعيل أزرار الحذف
            const newDeleteForms = messagesList.querySelectorAll('.delete-form');
            newDeleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: deleteConfirmTitle,
                        text: deleteConfirmText,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: deleteConfirmYes
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        }
    })
    .catch(error => {
        console.error('Error updating notifications:', error);
    });
}

// تحديث كل 5 دقائق
const REFRESH_INTERVAL = 5 * 60 * 1000; // 5 دقائق بالميلي ثانية
setInterval(updateNotifications, REFRESH_INTERVAL);

// تحديث عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', updateNotifications);
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
