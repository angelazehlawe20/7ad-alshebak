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
                <div class="container-fluid px-3">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <button class="btn btn-link d-md-none text-dark p-1" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>

                        <div class="d-flex align-items-center gap-2 flex-wrap ms-auto">
                            @php
                            // الحجوزات الجديدة غير المُعلنة
                            $newBookings = \App\Models\Booking::where('status', 'pending')
                            ->where('is_notified', false)
                            ->count();

                            // الرسائل غير المقروءة وغير المُعلنة
                            $unreadMessages = \App\Models\Contact::where('is_read', false)
                            ->where('is_notified', false)
                            ->latest()
                            ->get();

                            $totalUnread = $newBookings + $unreadMessages->count();
                            @endphp

                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm dropdown-toggle position-relative p-2"
                                    type="button" id="notificationsDropdown" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    <span id="notifications-count"
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="{{ $totalUnread > 0 ? 'display: block;' : 'display: none;' }}">
                                        {{ $totalUnread }}
                                    </span>
                                </button>

                                <ul id="messages-dropdown-list" class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                                    style="min-width: 320px;" aria-labelledby="notificationsDropdown">

                                    {{-- الحجوزات --}}
                                    @if($newBookings > 0)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-start gap-2 py-2"
                                            href="{{ route('admin.bookings.index') }}"
                                            onclick="markBookingsAsNotified()">
                                            <i class="fas fa-calendar-check text-primary mt-1"></i>
                                            <div>
                                                <div class="fw-bold">{{ __('messages.new_bookings') }}</div>
                                                <small class="text-muted">{{ $newBookings }} {{
                                                    __('messages.new_bookings_arrived') }}</small>
                                            </div>
                                        </a>
                                    </li>
                                    @endif

                                    {{-- الرسائل --}}
                                    @if($unreadMessages->count() > 0)
                                    @foreach($unreadMessages as $msg)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-start gap-2 py-2"
                                            href="{{ route('admin.contacts.index') }}"
                                            onclick="markMessagesAsNotified()">
                                            <i class="fas fa-envelope text-success mt-1"></i>
                                            <div>
                                                <div class="fw-bold">{{ $msg->name }}</div>
                                                <small class="text-muted">{{
                                                    \Illuminate\Support\Str::limit($msg->message, 40) }}</small>
                                                <div class="small text-muted">{{ $msg->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach
                                    @endif

                                    {{-- لا يوجد إشعارات --}}
                                    @if($newBookings == 0 && $unreadMessages->count() == 0)
                                    <li class="dropdown-menu-empty">
                                        <span class="dropdown-item-text text-muted text-center py-2">
                                            <i class="fas fa-check-circle me-1"></i> {{
                                            __('messages.no_new_notifications') }}
                                        </span>
                                    </li>
                                    @endif

                                </ul>
                            </div>


                            <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                                class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                <i class="fas fa-language me-1"></i>
                                <span class="d-none d-sm-inline">
                                    {{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}
                                </span>
                            </a>

                            @php $admin = auth()->guard('admin')->user(); @endphp

                            @if($admin->is_owner)
                            <div class="dropdown">
                                <button
                                    class="btn btn-light rounded-pill dropdown-toggle d-flex align-items-center gap-2"
                                    type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle"></i>
                                    <span class="d-none d-sm-inline">{{ __('messages.admin') }}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.profile.index') }}">
                                            <i class="fas fa-user-cog me-2"></i> {{ __('messages.profile') }}
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('admin.logout') }}" method="POST" class="d-inline w-100">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger py-2">
                                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('messages.logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @else
                            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit"
                                    class="btn btn-outline-danger btn-sm d-flex align-items-center gap-2">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="d-none d-sm-inline">{{ __('messages.logout') }}</span>
                                </button>
                            </form>
                            @endif
                        </div>
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
            fetch('{{ route("admin.bookings.markAsNotified") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin'
            }).then(() => {
                updateAllCounters(); // تحديث العدادات بعد وضع علامة "تم الإخطار"
            });
        }

        function markMessagesAsNotified() {
            fetch('{{ route("admin.contacts.markAsNotified") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                credentials: 'same-origin'
            }).then(() => {
                updateAllCounters(); // تحديث العدادات بعد وضع علامة "تم الإخطار"
            });
        }
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
        async function updateSidebarCounters() {
        try {
            const response = await fetch('/admin/sidebar-counters', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                throw new Error("Response is not JSON");
            }

            const data = await response.json();

            const contactCounter = document.getElementById('unread-contacts-counter');
            const bookingCounter = document.getElementById('pending-bookings-counter');

            if (contactCounter) {
                contactCounter.textContent = data.unread_contacts;
            }

            if (bookingCounter) {
                bookingCounter.textContent = data.pending_bookings;
            }

        } catch (error) {
            console.error('Error updating sidebar counters:', error);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateSidebarCounters();                     // تشغيل مباشر
        setInterval(updateSidebarCounters, 60000);   // كل دقيقة (للتطوير)
    });
    </script>




    {{-- Extra custom scripts --}}
    @stack('scripts')
    @yield('scripts')

    <script>
        function updateAllCounters() {
        // تحديث عداد الشريط الجانبي والقوائم
        Promise.all([
            fetch('{{ route("admin.contacts.notifications.messages") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin'
            }),
            fetch('{{ route("admin.contacts.refresh") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin'
            }),
            fetch('{{ route("admin.bookings.pending") }}', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                credentials: 'same-origin'
            })
        ])
        .then(responses => Promise.all(responses.map(res => res.json())))
        .then(([messagesData, contactsData, bookingsData]) => {
            // تحديث عداد زر الجرس
            const notificationsCount = document.getElementById('notifications-count');
            const dropdownList = document.getElementById('messages-dropdown-list');
            const totalUnread = (messagesData.unread_count || 0) + (bookingsData.pending_count || 0);

            if (notificationsCount) {
                if (totalUnread > 0) {
                    notificationsCount.textContent = totalUnread;
                    notificationsCount.style.display = 'block';
                } else {
                    notificationsCount.style.display = 'none';
                }
            }

            // تحديث القائمة المنسدلة
            if (dropdownList) {
                let dropdownContent = '';

                if (bookingsData.pending_count > 0 || messagesData.unread_count > 0) {
                    if (bookingsData.pending_count > 0) {
                        dropdownContent += `
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('admin.bookings.index') }}" onclick="markBookingsAsNotified()">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    ${bookingsData.pending_count} {{ __('messages.new_bookings') }}
                                </a>
                            </li>`;
                    }
                    if (messagesData.unread_count > 0) {
                        dropdownContent += `
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('admin.contacts.index') }}" onclick="markMessagesAsNotified()">
                                    <i class="fas fa-envelope me-2"></i>
                                    ${messagesData.unread_count} {{ __('messages.new_messages') }}
                                </a>
                            </li>`;
                    }
                } else {
                    dropdownContent = `
                        <li class="dropdown-menu-empty">
                            <span class="dropdown-item-text text-muted text-center py-2">
                                {{ __('messages.no_new_notifications') }}
                            </span>
                        </li>`;
                }

                dropdownList.innerHTML = dropdownContent;
            }

            // تحديث عداد الشريط الجانبي
            const sidebarBookingBadge = document.getElementById('booking-pending-badge');
            const sidebarContactBadge = document.getElementById('contact-unread-badge');

            if (sidebarBookingBadge) {
                if (bookingsData.pending_count > 0) {
                    sidebarBookingBadge.textContent = bookingsData.pending_count;
                    sidebarBookingBadge.style.display = '';
                } else {
                    sidebarBookingBadge.style.display = 'none';
                }
            }

            if (sidebarContactBadge) {
                if (messagesData.unread_count > 0) {
                    sidebarContactBadge.textContent = messagesData.unread_count;
                    sidebarContactBadge.style.display = '';
                } else {
                    sidebarContactBadge.style.display = 'none';
                }
            }

            // تحديث قائمة الرسائل في الصفحة إذا كانت موجودة
            const messagesList = document.getElementById('messages-list');
            if (messagesList && contactsData.messages_html) {
                messagesList.innerHTML = contactsData.messages_html;
            }
        })
        .catch(error => {
            console.error('Error updating notifications:', error);
        });
    }

    // تحديث العدادات عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', updateAllCounters);

    // تحديث العدادات كل دقيقة
    setInterval(updateAllCounters, 60000);
    </script>

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
</body>
