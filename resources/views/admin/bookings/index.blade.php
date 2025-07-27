@extends('admin.layouts.app')

@section('title', __('book.book_your_table_now'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <i class="fas fa-calendar-check me-2"></i>{{ __('book.bookings_management') }}
                    </h1>
                </div>
                <div class="row pt-3">
                    @if(auth('admin')->user()->is_owner)
                    <div class="d-flex flex-row gap-2 justify-content-center">
                        <!-- Export by date form -->
                        <form method="GET" action="{{ route('admin.bookings.export.by_date') }}" class="d-flex flex-row gap-1 align-items-center">
                            <div class="d-flex align-items-center position-relative me-4">
                                <label class="me-2" style="min-width: 85px;">{{ __('book.from_date') }}</label>
                                <input type="text" name="from_date" class="form-control flatpickr" required id="from_date" placeholder={{__('book.y_m_d')}} readonly>
                                <i class="fas fa-calendar-alt position-absolute"
                                   style="{{ app()->getLocale() === 'ar' ? 'left: 10px;' : 'right: 10px;' }} top: 50%; transform: translateY(-50%); cursor: pointer;"
                                   onclick="document.getElementById('from_date')._flatpickr.open()"
                                   role="button"></i>
                            </div>

                            <div class="d-flex align-items-center position-relative">
                                <label class="me-2" style="min-width: 85px;">{{ __('book.to_date') }}</label>
                                <input type="text" name="to_date" class="form-control flatpickr" required id="to_date" placeholder={{__('book.y_m_d')}} readonly>
                                <i class="fas fa-calendar-alt position-absolute"
                                   style="{{ app()->getLocale() === 'ar' ? 'left: 10px;' : 'right: 10px;' }} top: 50%; transform: translateY(-50%); cursor: pointer;"
                                   onclick="document.getElementById('to_date')._flatpickr.open()"
                                   role="button"></i>
                            </div>

                            <button type="submit" class="btn text-white" style="background-color: #8B7355; padding: 6px 12px; border: none; border-radius: 4px;">
                                <i class="fas fa-file-export me-2"></i>{{ __('book.export_to_excel') }}
                            </button>
                        </form>

                    </div>
                    @endif
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
                                <option value="">{{ __('book.all_statuses') }}</option>
                                @foreach(['pending', 'confirmed', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>
                                    {{ __('book.status_' . $status) }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @if(request('status'))
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                            {{ __('book.clear_filter') }}
                        </a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="row g-4" id="booking-list">
                @include('admin.bookings.booking_list', ['bookings' => $bookings])
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
@vite(['resources/js/app.js'])

<!-- Flatpickr CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- اللغة العربية -->
@if(app()->getLocale() === 'ar')
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d",
            locale: "{{ app()->getLocale() === 'ar' ? 'ar' : 'default' }}",
            allowInput: true,
            clickOpens: true
        });
    });
</script>

<script>
    const translations = {
        status: {
            pending: "{{ __('book.status_pending') }}",
            confirmed: "{{ __('book.status_confirmed') }}",
            cancelled: "{{ __('book.status_cancelled') }}"
        },
        guestInfo: "{{ __('book.guest_information') }}",
        contactDetails: "{{ __('book.contact_details') }}",
        bookingInfo: "{{ __('book.booking_information') }}",
        guests: "{{ __('book.guests') }}",
        confirm: "{{ __('book.confirm') }}",
        reject: "{{ __('book.reject') }}",
        areYouSure: "{{ __('messages.are_you_sure') }}",
        confirmBooking: "{{ __('book.confirm_booking_message') }}",
        rejectBooking: "{{ __('book.reject_booking_message') }}",
        yes: "{{ __('messages.yes') }}",
        no: "{{ __('messages.no') }}",
        success: "{{ __('messages.success') }}",
        error: "{{ __('messages.error') }}",
        statusUpdated: "{{ __('book.status_updated_successfully') }}",
        errorUpdatingStatus: "{{ __('book.error_updating_status') }}"
    };
</script>
<script src="{{ asset('assets/js/bookingAdminPage.js') }}"></script>
@endpush
