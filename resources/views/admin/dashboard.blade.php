@extends('admin.layouts.app')

@section('title', __('dashboard.dashboard'))

@section('content')
<div class="container-fluid px-3">
    <div class="d-flex align-items-center mb-4">
        <h1 class="h2 mb-0 text-start">{{ __('dashboard.dashboard') }}</h1>
    </div>
    <p class="small">{{ __('dashboard.welcome_dashboard') }}</p>

    <div class="row g-3">
        <!-- Card 1 -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-primary h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.total_menu_items') }}</h5>
                    <p class="card-text h2">{{ $menuItemsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-success h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.total_offers') }}</h5>
                    <p class="card-text h2">{{ $offersCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-primary h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.total_bookings') }}</h5>
                    <p class="card-text h2">{{ $bookingsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-success h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.confirmed') }}</h5>
                    <p class="card-text h2">{{ $confirmedBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-warning h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.pending') }}</h5>
                    <p class="card-text h2">{{ $pendingBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-danger h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.cancelled') }}</h5>
                    <p class="card-text h2">{{ $cancelledBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-info h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.total_messages') }}</h5>
                    <p class="card-text h2">{{ $contactsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-warning h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.unread_messages') }}</h5>
                    <p class="card-text h2">{{ $unreadMessages }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-warning h-100">
                <div class="card-body text-start">
                    <h5 class="card-title h6">{{ __('dashboard.read_messages') }}</h5>
                    <p class="card-text h2">{{ $readMessages }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Sidebar for Mobile -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">{{ __('dashboard.menu') }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @include('admin.layouts.sidebar')
    </div>
</div>


@endsection