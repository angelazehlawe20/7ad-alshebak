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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


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

                        <div class="d-flex align-items-center gap-4 flex-wrap ms-auto">
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
                                <button
                                    class="btn btn-outline-secondary btn-sm dropdown-toggle position-relative px-3 py-1"
                                    type="button" id="notificationDropdownToggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    <span id="notifications-count"
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="{{ $totalUnread > 0 ? 'display: block;' : 'display: none;' }}">
                                        {{ $totalUnread }}
                                    </span>
                                </button>

                                <ul id="notificationDropdownMenu" class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                                    style="min-width: 300px;" aria-labelledby="notificationDropdownToggle">

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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="{{asset('assets/js/adminAppPage.js')}}"></script>


    {{-- Optional style overrides --}}
    <style>
        .no-scroll {
            overflow: hidden !important;
        }

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

        .notification-item {
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .notification-item.new {
            background-color: #f0f9ff;
            border-left: 4px solid #0d6efd;
        }

        #messages-dropdown-list {
            max-height: 500px;
            /* عدل القيمة حسب ما يناسبك */
            overflow-y: auto;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }
    </style>
</body>

</html>
@stack('scripts')
</body>
