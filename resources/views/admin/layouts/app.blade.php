<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ __('messages.admin_panel') }}</title>
    <meta name="description" content="{{ __('messages.admin_panel_description') }}">
    <meta name="author" content="{{ __('messages.admin') }}">

    {{-- Favicon --}}
    @if(!empty($settings->favicon))
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
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/aos/aos.css') }}">

    @php
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
    @endphp
    <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
    <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>

    @stack('styles')
</head>

<body class="bg-light {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <div class="overlay" id="sidebarOverlay"></div>

    <div class="d-flex">
        @include('admin.layouts.sidebar')

        <div class="main-content">
            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg sticky-top shadow-sm">
                <div class="container-fluid px-3">
                    <div class="d-flex align-items-center justify-content-between w-100">
                        <button class="btn btn-link d-md-none text-dark p-1" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>

                        <div class="d-flex align-items-center gap-4 flex-wrap ms-auto">
                            @php
                            $newBookings = \App\Models\Booking::where('status', 'pending')->where('is_notified',
                            false)->latest()->get();
                            $unreadMessages = \App\Models\Contact::where('is_read', false)->where('is_notified',
                            false)->latest()->get();
                            $totalUnread = $newBookings->count() + $unreadMessages->count();
                            @endphp

                            {{-- Notifications --}}
                            <div class="dropdown">
                                <button
                                    class="btn btn-outline-secondary btn-sm dropdown-toggle position-relative px-3 py-1"
                                    type="button" id="notificationDropdownToggle" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    @if($totalUnread > 0)
                                    <span id="notifications-count"
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $totalUnread }}
                                    </span>
                                    @endif
                                </button>

                                <ul id="notificationDropdownMenu" class="dropdown-menu dropdown-menu-end shadow-sm p-2"
                                    style="min-width: 300px;" aria-labelledby="notificationDropdownToggle">

                                    {{-- New Bookings --}}
                                    @foreach($newBookings as $booking)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-start gap-2 py-2"
                                            href="{{ route('admin.bookings.index', ['highlight' => $booking->id]) }}">
                                            <i class="fas fa-calendar-check text-primary mt-1"></i>
                                            <div>
                                                <div class="fw-bold">{{ $booking->name }}</div>
                                                <small class="text-muted">
                                                    {{ __('book.booking_for') }} {{ $booking->guests_count }} {{
                                                    __('book.people') }} <br>
                                                    {{ $booking->booking_date }} {{ $booking->booking_time }} <br>
                                                    {{ $booking->message }}
                                                </small>
                                                <div class="small text-muted">{{ $booking->created_at->diffForHumans()
                                                    }}</div>
                                            </div>
                                        </a>
                                    </li>
                                    @endforeach


                                    {{-- New Messages --}}
                                    @foreach($unreadMessages as $msg)
                                    <li>
                                        <a class="dropdown-item d-flex align-items-start gap-2 py-2"
                                            href="{{ route('admin.contacts.index',['highlight' => $msg['id']]) }}">
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

                                    @if($totalUnread === 0)
                                    <li class="dropdown-menu-empty">
                                        <span class="dropdown-item-text text-muted text-center py-2">
                                            <i class="fas fa-check-circle me-1"></i> {{
                                            __('messages.no_new_notifications') }}
                                        </span>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            {{-- Language Switch --}}
                            <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                                class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                <i class="fas fa-language me-1"></i>
                                <span class="d-none d-sm-inline">
                                    {{ app()->getLocale() === 'ar' ? __('messages.english') : __('messages.arabic') }}
                                </span>
                            </a>

                            {{-- Admin Info --}}
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
                                        <form action="{{ route('admin.logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger py-2">
                                                <i class="fas fa-sign-out-alt me-2"></i> {{ __('messages.logout') }}
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @else
                            <form action="{{ route('admin.logout') }}" method="POST">
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

            {{-- Main Content --}}
            <div class="container-fluid p-4">
                @include('admin.partials.alerts')
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>
    <script src="{{ asset('assets/js/adminAppPage.js') }}"></script>

    @stack('scripts')

    <style>
        .main-content {
            flex: 1;
        }

        .dropdown-menu-empty {
            text-align: center;
            padding: 1rem;
            color: #999;
        }

        .no-scroll {
            overflow: hidden;
        }
    </style>
</body>

</html>
