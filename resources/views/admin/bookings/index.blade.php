@extends('admin.layouts.app')

@section('title', 'Bookings')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Bookings Management</h3>
                </div>
                <div class="card-body">
                    {{-- Status Filter --}}
                    <div class="mb-4">
                        <form method="GET" action="{{ route('admin.bookings.index') }}"
                            class="d-flex align-items-center gap-2">
                            <div class="form-group flex-grow-1 mb-0">
                                <label for="status" class="form-label">Filter by Status:</label>
                                <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                                    <option value=""> -- All Statuses -- </option>
                                    @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if(request('status'))
                                <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary mt-4">Clear Filter</a>
                            @endif
                        </form>
                    </div>

                    <div class="table-responsive">
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
                                            <div><i class="fas fa-phone text-secondary me-1"></i> {{ $booking->phone }}</div>
                                            <div><i class="fas fa-envelope text-secondary me-1"></i> {{ $booking->email }}</div>
                                        </td>
                                        <td>
                                            <div><i class="fas fa-users text-secondary me-1"></i> {{ $booking->guests_count }} guests</div>
                                            <div><i class="fas fa-calendar text-secondary me-1"></i> {{ $booking->booking_date }}</div>
                                            <div><i class="fas fa-clock text-secondary me-1"></i> {{ $booking->booking_time }}</div>
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
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="flex-grow-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button type="submit" class="btn btn-outline-success btn-sm w-100">
                                                        <i class="fas fa-check"></i> Confirm
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="flex-grow-1">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center py-5">
                                                <i class="fas fa-calendar-times fa-4x text-secondary mb-3"></i>
                                                <h4 class="text-secondary">No bookings found</h4>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $bookings->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
