@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <!-- Card 1: Total Menu Items -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Menu Items</h5>
                    <p class="card-text display-4">{{ $menuItemsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Card 2: Total Offers -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Offers</h5>
                    <p class="card-text display-4">{{ $offersCount }}</p>
                </div>
            </div>
        </div>

        <!-- Card 3: Total Bookings -->
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Bookings</h5>
                    <p class="card-text display-4">{{ $bookingsCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <p>Welcome to the Admin Dashboard. Use the sidebar to navigate through the management sections.</p>
</div>
@endsection
1
