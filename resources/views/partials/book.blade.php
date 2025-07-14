@extends('layouts.app')

@section('title', __('navbar.book'))

@section('content')
<section id="book-a-table" class="book-a-table section">
    <div class="container section-title">
        <p><span class="description-title">{{ __('book.book_your_table_now') }}</span></p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST" class="p-4 needs-validation" novalidate>
                            @csrf
                            <div class="row g-4">

                                <!-- الاسم -->
                                <div class="col-md-6">
                                    <label for="name" class="form-label">{{ __('book.your_name') }}</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- الإيميل -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">{{ __('book.your_email') }}</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" maxlength="255">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- رقم الهاتف -->
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">{{ __('book.phone') }}</label>
                                    <div class="input-group phone-group" dir="ltr">
                                        <span class="input-group-text">+963</span>
                                        <input type="tel" name="phone" id="phone"
                                            value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            pattern="9[0-9]{8}" maxlength="9" required>
                                    </div>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- تاريخ الحجز -->
                                <div class="col-md-6">
                                    <label for="booking_date" class="form-label">{{ __('book.booking_date') }}</label>
                                    <input type="date" name="booking_date" id="booking_date"
                                        value="{{ old('booking_date') }}"
                                        class="form-control @error('booking_date') is-invalid @enderror"
                                        required min="{{ date('Y-m-d') }}">
                                    @error('booking_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- وقت الحجز -->
                                <div class="col-md-6">
                                    <label for="booking_time" class="form-label">{{ __('book.booking_time') }}</label>
                                    <select name="booking_time" id="booking_time" 
                                        class="form-select @error('booking_time') is-invalid @enderror" required>
                                        <option value="">{{ __('book.select_time') }}</option>
                                        @php
                                            $start = strtotime('00:00');
                                            $end = strtotime('23:55');
                                        @endphp
                                        @for ($time = $start; $time <= $end; $time += 300)
                                            @php
                                                $value = date("H:i", $time);
                                                $displayTime = date("h:i A", $time);
                                            @endphp
                                            <option value="{{ $value }}" {{ old('booking_time') == $value ? 'selected' : '' }}>
                                                {{ $displayTime }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('booking_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- عدد الضيوف -->
                                <div class="col-md-6">
                                    <label for="guests_count" class="form-label">{{ __('book.guests_count') }}</label>
                                    <input type="number" name="guests_count" id="guests_count"
                                        value="{{ old('guests_count') }}"
                                        class="form-control @error('guests_count') is-invalid @enderror"
                                        min="1" max="50" required>
                                    @error('guests_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- رسالة إضافية -->
                                <div class="col-12">
                                    <label for="message" class="form-label">{{ __('book.message_optional') }}</label>
                                    <textarea name="message" id="message" rows="4" maxlength="1000"
                                        class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- زر الإرسال -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn px-4 py-2" style="background-color: #8B7355; color: white;">
                                        {{ __('book.book_a_table') }}
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
    .phone-group>.form-control,
    .phone-group>.input-group-text {
        border-radius: 0.375rem !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const bookingTimeSelect = document.getElementById('booking_time');
        const bookingDateInput = document.getElementById('booking_date');

        function updateTimeSlots() {
            const selectedDate = new Date(bookingDateInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (selectedDate.getTime() === today.getTime()) {
                const now = new Date();
                const currentHour = now.getHours();
                const currentMinutes = now.getMinutes();

                Array.from(bookingTimeSelect.options).forEach(option => {
                    if (option.value) {
                        const [hours, minutes] = option.value.split(':').map(Number);
                        if (hours < currentHour || (hours === currentHour && minutes <= currentMinutes)) {
                            option.disabled = true;
                        } else {
                            option.disabled = false;
                        }
                    }
                });
            } else {
                Array.from(bookingTimeSelect.options).forEach(option => {
                    option.disabled = false;
                });
            }
        }

        bookingDateInput.addEventListener('change', updateTimeSlots);
        updateTimeSlots();
    });
</script>
@endpush
