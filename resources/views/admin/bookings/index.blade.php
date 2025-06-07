@extends('admin.layouts.app')

@section('title', 'Bookings')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="mb-3">Bookings Management</h3>

                <!-- Filter -->
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.bookings.index') }}" class="d-flex align-items-center gap-2" style="max-width: 400px;">
                            <select name="status" onchange="this.form.submit()" class="form-select">
                                <option value="">All Statuses</option>
                                @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @if(request('status'))
                                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Reset</a>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="card mt-4">
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Contact Info</th>
                                    <th>Booking Details</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->name }}</td>
                                        <td>
                                            <div>📱 {{ $booking->phone }}</div>
                                            <div>📧 {{ $booking->email }}</div>
                                        </td>
                                        <td>
                                            <div>👥 {{ $booking->guests_count }} guests</div>
                                            <div>📅 {{ $booking->booking_date }}</div>
                                            <div>⏰ {{ $booking->booking_time }}</div>
                                        </td>
                                        <td>
                                            <div class="text-wrap" style="max-width: 200px;">
                                                {{ $booking->message }}
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'confirmed' => 'success',
                                                    'cancelled' => 'danger'
                                                ];
                                            @endphp
                                            <span class="badge bg-{{ $statusColors[$booking->status] }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                    @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                                                        <option value="{{ $status }}" {{ $booking->status == $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-calendar-times fa-3x mb-3"></i>
                                                <div>No bookings found</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $bookings->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
