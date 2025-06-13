@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-3">
    <div class="d-flex align-items-center mb-4">
        <button class="btn btn-link d-lg-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="h2 mb-0">Dashboard</h1>
    </div>
    <p class="small">Welcome to the Admin Dashboard. Use the sidebar to navigate through the management sections.</p>

    <div class="row g-3">
        <!-- Card 1: Total Menu Items -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Menu Items</h5>
                    <p class="card-text h2">{{ $menuItemsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Offers -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Offers</h5>
                    <p class="card-text h2">{{ $offersCount }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Bookings -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Bookings</h5>
                    <p class="card-text h2">{{ $bookingsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Confirmed</h5>
                    <p class="card-text h2">{{ $confirmedBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Pending</h5>
                    <p class="card-text h2">{{ $pendingBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Cancelled</h5>
                    <p class="card-text h2">{{ $cancelledBookings }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Total Contact Messages -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-bg-info h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Messages</h5>
                    <p class="card-text h2">{{ $contactsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Unread Messages -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Unread Messages</h5>
                    <p class="card-text h2">{{ $unreadMessages }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Read Messages</h5>
                    <p class="card-text h2">{{ $
                    readMessages }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas Sidebar for Mobile -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="adminSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @include('admin.layouts.sidebar')
    </div>
</div>
@endsection
