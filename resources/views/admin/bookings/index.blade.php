@extends('admin.layouts.app')

@section('title', __('book.book_your_table_now'))

@section('content')
<div class="content-wrapper">
    <div class="container-fluid px-0">
        <div class="row g-4" id="booking-list">
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
                            <h5 class="card-title">{{ $booking->name_ar ?? $booking->name_en }}</h5>
                        </div>
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2">{{ __('book.contact_details') }}</h6>
                            <div><i class="fas fa-phone text-secondary me-2"></i>{{ $booking->phone }}</div>
                            <div><i class="fas fa-envelope text-secondary me-2"></i>{{ $booking->email ?? '-' }}</div>
                        </div>
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2">{{ __('book.booking_information') }}</h6>
                            <div><i class="fas fa-users text-secondary me-2"></i>{{ $booking->guests_count }} {{ __('book.guests') }}</div>
                            <div><i class="fas fa-calendar text-secondary me-2"></i>{{ $booking->booking_date }}</div>
                            <div><i class="fas fa-clock text-secondary me-2"></i>{{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">
                {{ __('book.no_bookings_found') }}
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="//js.pusher.com/7.2/pusher.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script> {{-- هذا إذا ضبطت Laravel Mix --}}

<script>
    window.Echo.private('admin.bookings')
        .listen('.new.booking', (e) => {
            console.log("📢 حجز جديد:", e.booking);

            // بناء كرت الحجز الجديد
            let booking = e.booking;

            let statusColors = {
                pending: 'warning',
                confirmed: 'success',
                cancelled: 'danger'
            };

            let name = booking.name_ar || booking.name_en || '-';
            let email = booking.email || '-';
            let bookingTimeFormatted = new Date('1970-01-01T' + booking.booking_time + 'Z').toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});

            let cardHtml = `
            <div class="col-12 col-md-6 col-lg-4 booking-card" data-id="${booking.id}">
                <div class="card bg-beige card-outline h-100">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <span class="badge bg-${statusColors[booking.status] || 'secondary'}">
                            ${booking.status.charAt(0).toUpperCase() + booking.status.slice(1)}
                        </span>
                    </div>
                    <div class="card-body" style="background-color: #f5f5dc;">
                        <div class="mb-3">
                            <h5 class="card-title">${name}</h5>
                        </div>
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2">Contact Details</h6>
                            <div><i class="fas fa-phone text-secondary me-2"></i>${booking.phone}</div>
                            <div><i class="fas fa-envelope text-secondary me-2"></i>${email}</div>
                        </div>
                        <div class="mb-3">
                            <h6 class="card-subtitle mb-2">Booking Information</h6>
                            <div><i class="fas fa-users text-secondary me-2"></i>${booking.guests_count} Guests</div>
                            <div><i class="fas fa-calendar text-secondary me-2"></i>${booking.booking_date}</div>
                            <div><i class="fas fa-clock text-secondary me-2"></i>${bookingTimeFormatted}</div>
                        </div>
                    </div>
                </div>
            </div>`;

            // نضيف بطاقة الحجز الجديدة في بداية القائمة
            document.getElementById('booking-list').insertAdjacentHTML('afterbegin', cardHtml);
        });
</script>
@endpush
