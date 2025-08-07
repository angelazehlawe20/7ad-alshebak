@forelse ($bookings as $booking)
<div class="col-12 col-md-6 col-lg-4 booking-card" data-id="{{ $booking->id }}">
    <div class="card bg-beige card-outline h-100">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            @php
            $statusColors = [
            'pending' => 'warning',
            'confirmed' => 'success',
            'cancelled' => 'danger'
            ];
            @endphp
            <span class="badge bg-{{ $statusColors[$booking->status] }}">
                {{ __('book.status_' . $booking->status) }}
            </span>
        </div>
        <div class="card-body" style="background-color: #f5f5dc;">
            <div class="mb-3">
                <h4 class="card-title">{{ __('book.guest_information') }}</h5>
                    <div><strong>{{ __('book.name') }}:</strong> {{ $booking->name }}</div>
                    <div><strong>{{ __('book.birth_date') }}:</strong> {{ $booking->birth_date }}</div>
            </div>
            <div class="mb-3">
                <h4 class="card-subtitle mb-2">{{ __('book.contact_details') }}</h6>
                    <div><i class="fas fa-phone text-secondary me-2"></i>{{ $booking->phone }}</div>
                    <div><i class="fas fa-envelope text-secondary me-2"></i>{{ $booking->email ?? '-' }}
                    </div>
            </div>
            <div class="mb-3">
                <h4 class="card-subtitle mb-2">{{ __('book.booking_information') }}</h6>
                    <div><i class="fas fa-users text-secondary me-2"></i>{{ $booking->guests_count }} {{
                        __('book.guests') }}</div>
                    <div><i class="fas fa-calendar text-secondary me-2"></i>{{ $booking->booking_date }}
                    </div>
                    <div><i class="fas fa-clock text-secondary me-2"></i>{{
                        \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</div>
            </div>
            @if($booking->message)
            <div class="mb-3">
                <h6 class="card-subtitle mb-2">{{ __('book.message') }}</h6>
                <div class="text-muted small">{{ $booking->message }}</div>
            </div>
            @endif
        </div>
        <div class="card-footer" style="background-color: #f5f5dc;">
            <div class="d-flex gap-2">
                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="booking-action-form flex-grow-1" data-action="confirm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="confirmed">
                    <button type="submit" class="btn btn-outline-success btn-sm w-100">
                        <i class="fas fa-check me-1"></i>{{ __('book.confirm') }}
                    </button>
                </form>
                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="booking-action-form flex-grow-1" data-action="reject">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="cancelled">
                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                        <i class="fas fa-times me-1"></i>{{ __('book.reject') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@empty
<div class="col-12">
    <div class="text-center py-5">
        <i class="fas fa-calendar-times fa-4x text-secondary mb-3"></i>
        <h4 class="text-secondary">{{ __('book.no_bookings_found')}}</h4>
    </div>
</div>
@endforelse
<style>
    .highlighted {
        box-shadow: 0 0 10px 3px #0d6efd;
        background-color: #f8f9fa;
        border-radius: 5px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }
</style>
