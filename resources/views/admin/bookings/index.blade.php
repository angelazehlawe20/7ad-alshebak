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

                @if(auth('admin')->user()->is_owner)
                <div class="col-sm-12 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.bookings.export.by_date') }}"
                                class="row g-3 align-items-end">

                                {{-- حقل من تاريخ --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="from_date" class="form-label">{{ __('book.from_date') }}</label>
                                        <input type="text" name="from_date" id="from_date"
                                               class="form-control"
                                               placeholder="YYYY-MM-DD"
                                               value="{{ old('from_date') }}">
                                    </div>
                                </div>


                                {{-- حقل إلى تاريخ --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="to_date" class="form-label">{{ __('book.to_date') }}</label>
                                        <input type="text" name="to_date" id="to_date"
                                               class="form-control"
                                               placeholder="YYYY-MM-DD"
                                               value="{{ old('to_date') }}">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-secondry w-100" style="background-color: #8B7355; color: white;">
                                        <i class="fas fa-file-export me-2"></i>{{ __('book.export_to_excel') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            {{-- الفلاتر --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-filter me-2"></i>{{ __('book.filter_by_status') }}
                    </h3>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3 align-items-center">
                        <div class="col">
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
                        <div class="col-auto">
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">
                                {{ __('book.clear_filter') }}
                            </a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>

            {{-- قائمة الحجوزات --}}
            <div class="row g-4" id="booking-list">
                @include('admin.bookings.booking_list', ['bookings' => $bookings])
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
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
