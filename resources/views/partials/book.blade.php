@extends('layouts.app')

@section('title', __('navbar.book'))

@section('content')
<section id="book-a-table" class="book-a-table section">
    <div class="container section-title">
        <p>
            <span class="description-title">{{__('book.book_your_table_now') }}</span>
        </p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST" class="p-4 needs-validation" novalidate>
                            @csrf
                            <div class="row g-4">
                                <!-- Personal Information -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">{{ __('book.your_name') }}</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('book.your_email') }}</label>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        value="{{ old('email') }}" maxlength="255">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ __('book.phone') }}</label>
                                    <div class="input-group phone-group" dir="ltr">
                                        <span class="input-group-text">+963</span>
                                        <input type="tel" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            value="{{ old('phone') }}" required pattern="9[0-9]{8}" maxlength="9">
                                    </div>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="phone-error" class="text-danger small mt-1"></div>
                                </div>

                                <!-- Booking Details -->
                                <div class="col-md-6">
                                    <label for="booking_date" class="form-label">{{ __('book.booking_date') }}</label>
                                    <input type="date" name="booking_date"
                                        class="form-control @error('booking_date') is-invalid @enderror"
                                        id="booking_date" value="{{ old('booking_date') }}" required
                                        min="{{ date('Y-m-d') }}">
                                    @error('booking_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="booking_time" class="form-label">{{ __('book.booking_time') }}</label>
                                <div class="input-group" id="timepicker" data-td-target-input="nearest">
                                    <input type="text" name="booking_time" class="form-control" id="booking_time" data-td-target="#timepicker" required>
                                    <span class="input-group-text" data-td-target="#timepicker" data-td-toggle="datetimepicker">
                                        <i class="fa fa-clock"></i>
                                    </span>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <label for="guests_count" class="form-label">{{ __('book.guests_count') }}</label>
                                    <input type="number" name="guests_count"
                                        class="form-control @error('guests_count') is-invalid @enderror"
                                        id="guests_count" value="{{ old('guests_count') }}" required min="1" max="50">
                                    @error('guests_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label for="message" class="form-label">{{ __('book.message_optional') }}</label>
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                        id="message" rows="4" maxlength="1000">{{ old('message') }}</textarea>
                                    @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        {{__('book.book_a_table')}}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* توحيد الزوايا لحقل الهاتف */
    .phone-group>.form-control,
    .phone-group>.input-group-text {
        border-radius: 0.375rem !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const timeInput = document.getElementById('booking_time');
        timeInput.addEventListener('click', function () {
            this.showPicker && this.showPicker(); // modern browsers
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new tempusDominus.TempusDominus(document.getElementById('timepicker'), {
            display: {
                components: {
                    calendar: false,
                    hours: true,
                    minutes: true,
                    seconds: false,
                    useTwentyfourHour: false
                }
            },
            localization: {
                locale: "{{ app()->getLocale() === 'ar' ? 'ar' : 'en' }}",
                hourCycle: "{{ app()->getLocale() === 'ar' ? 'h12' : 'h12' }}"
            }
        });
    });
</script>
<script src="{{ asset('assets/js/bookPage.js') }}"></script>
@endpush
