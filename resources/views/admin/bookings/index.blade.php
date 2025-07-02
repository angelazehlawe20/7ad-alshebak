@extends('admin.layouts.app')

@section('title', __('book.book_your_table'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-calendar-check me-2"></i>{{ __('book.bookings_management') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            {{-- Status Filter --}}
            <div class="card bg-beige card-outline mb-4">
                <div class="card-header bg-light">
                    <h3 class="card-title"><i class="fas fa-filter me-2"></i>{{ __('book.filter_by_status') }}</h3>
                </div>
                <div class="card-body" style="background-color: #f5f5dc;">
                    <form method="GET" action="{{ route('admin.bookings.index') }}"
                        class="d-flex align-items-center gap-2">
                        <div class="form-group flex-grow-1 mb-0">
                            <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                                <option value="">{{ __('book.all_statuses') ?? 'All Statuses' }}</option>
                                @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>
                                    {{ __('book.status_' . $status) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @if(request('status'))
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">{{ __('book.clear_filter') ?? 'Clear Filter' }}</a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="row g-4">
                @forelse ($bookings as $booking)
                <div class="col-12 col-md-6 col-lg-4">
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
                                <h5 class="card-title">{{ __('book.guest_information') }}</h5>
                                @if($booking->name_ar)
                                <div><strong>{{ __('book.arabic_name') ?? 'Arabic Name' }}:</strong> {{ $booking->name_ar }}</div>
                                @endif
                                @if($booking->name_en)
                                <div><strong>{{ __('book.english_name') ?? 'English Name' }}:</strong> {{ $booking->name_en }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <h6 class="card-subtitle mb-2">{{ __('book.contact_details') ?? 'Contact Details' }}</h6>
                                <div><i class="fas fa-phone text-secondary me-2"></i>{{ $booking->phone }}</div>
                                <div><i class="fas fa-envelope text-secondary me-2"></i>{{ $booking->email }}</div>
                            </div>

                            <div class="mb-3">
                                <h6 class="card-subtitle mb-2">{{ __('book.booking_information') ?? 'Booking Information' }}</h6>
                                <div><i class="fas fa-users text-secondary me-2"></i>{{ $booking->guests_count }} {{ __('book.guests') }}</div>
                                <div><i class="fas fa-calendar text-secondary me-2"></i>{{ $booking->booking_date }}</div>
                                <div><i class="fas fa-clock text-secondary me-2"></i>{{ \Carbon\Carbon::createFromFormat('H:i:s', $booking->booking_time)->format('h:i A') }}</div>
                            </div>

                            @if($booking->message_ar || $booking->message_en)
                            <div class="mb-3">
                                <h6 class="card-subtitle mb-2">{{ __('book.message') ?? 'Message' }}</h6>
                                @if($booking->message_ar)
                                <div class="text-muted small">{{ $booking->message_ar }}</div>
                                @endif
                                @if($booking->message_en)
                                <div class="text-muted small">{{ $booking->message_en }}</div>
                                @endif
                            </div>
                            @endif
                        </div>
                        <div class="card-footer" style="background-color: #f5f5dc;">
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="confirmed">
                                    <button type="submit" class="btn btn-outline-success btn-sm w-100">
                                        <i class="fas fa-check me-1"></i>{{ __('book.confirm') ?? 'Confirm' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="flex-grow-1">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="cancelled">
                                    <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                                        <i class="fas fa-times me-1"></i>{{ __('book.reject') ?? 'Reject' }}
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
            </div>

            <div class="mt-4">
                {{ $bookings->withQueryString()->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
