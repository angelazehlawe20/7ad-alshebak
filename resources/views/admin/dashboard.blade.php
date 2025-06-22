@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid px-3">
    <div class="d-flex align-items-center mb-4">

        <h1 class="h2 mb-0">Dashboard</h1>
    </div>
    <p class="small">Welcome to the Admin Dashboard. Use the sidebar to navigate through the management sections.</p>

    <div class="row g-3">
        <!-- Card 1: Total Menu Items -->
        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-primary h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Menu Items</h5>
                    <p class="card-text h2">{{ $menuItemsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-success h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Offers</h5>
                    <p class="card-text h2">{{ $offersCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-primary h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Bookings</h5>
                    <p class="card-text h2">{{ $bookingsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-success h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Confirmed</h5>
                    <p class="card-text h2">{{ $confirmedBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-warning h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Pending</h5>
                    <p class="card-text h2">{{ $pendingBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-danger h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Cancelled</h5>
                    <p class="card-text h2">{{ $cancelledBookings }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-info h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Total Messages</h5>
                    <p class="card-text h2">{{ $contactsCount }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-warning h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Unread Messages</h5>
                    <p class="card-text h2">{{ $unreadMessages }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-lg-4">
            <div class="card card-warning h-100">
                <div class="card-body">
                    <h5 class="card-title h6">Read Messages</h5>
                    <p class="card-text h2">{{ $readMessages }}</p>
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
<style>

:root{
    --default-color: #4C4C4C;
    --accent-color: #AC8C64;
    --surface-color: #e8c095;
    --contrast-color: #ffffff;
}
    /* بطاقة ذات خلفية رئيسية مخصصة */

.card-primary {
    background-color: var(--accent-color);
    color: var(--contrast-color);
}

/* بطاقة ذات خلفية ثانوية (مثل النجاح) */
.card-success {
    background-color: var(--surface-color);
    color: var(--default-color);
}

/* بطاقة ذات خلفية تحذيرية */
.card-warning {
    background-color: #f0c36d; /* يمكنك تعديلها لتتناسب مع ألوانك */
    color: var(--default-color);
}

/* بطاقة ذات خلفية معلومات */
.card-info {
    background-color: #a3c4bc; /* أو لون مناسب من ألوانك */
    color: var(--default-color);
}

/* بطاقة ذات خلفية خطأ/تحذير */
.card-danger {
    background-color: #d66a6a; /* أو لون مناسب */
    color: var(--contrast-color);
}
</style>

@endsection
