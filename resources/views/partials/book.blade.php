@extends('layouts.app')

@section('title', __('navbar.book'))

@section('content')
<section id="book-a-table" class="book-a-table section">
    <div class="container section-title">
        <p>
            <span class="description-title">{{ __('book.book_your_table_now') }}</span>
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

                                <!-- الاسم -->
                                <div class="col-md-6">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.your_name') }}</h3>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" >
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- الإيميل -->
                                <div class="col-md-6">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.your_email') }}</h3>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror" maxlength="255">
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- رقم الهاتف -->
                                <div class="col-md-6">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.phone') }}</h3>
                                    <div class="input-group phone-group" dir="ltr">
                                        <span class="input-group-text small">+963</span>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone') }}"
                                            class="form-control form-control-sm @error('phone') is-invalid @enderror"
                                            maxlength="9" required oninput="validatePhone(this)"
                                            placeholder="9XXXXXXXX">
                                        <div class="invalid-feedback x-small" id="phone-feedback"
                                            style="display: none; text-align: start; font-size: 0.75rem;">
                                            {{ __('book.phone_must_start_with_9') }}
                                        </div>
                                    </div>
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- تاريخ الحجز -->
                                <div class="col-md-6">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.booking_date') }}</h3>
                                    <input type="date" name="booking_date" id="booking_date" dir="ltr"
                                        value="{{ old('booking_date') }}"
                                        class="form-control @error('booking_date') is-invalid @enderror"
                                        min="{{ date('d-m-Y') }}">
                                    @error('booking_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- وقت الحجز -->
                                <div class="col-md-6">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.booking_time') }}</h3>
                                    <select name="booking_time" id="booking_time"
                                        class="form-select @error('booking_time') is-invalid @enderror" >
                                        <option value="">{{ __('book.select_time') }}</option>
                                        @php
                                        $start = strtotime('00:00');
                                        $end = strtotime('23:55');
                                        @endphp
                                        @for ($time = $start; $time <= $end; $time +=300) @php $value=date("H:i",
                                            $time); $displayTime=date("h:i A", $time); @endphp <option
                                            value="{{ $value }}" {{ old('booking_time')==$value ? 'selected' : '' }}>
                                            {{ $displayTime }}
                                            </option>
                                            @endfor
                                    </select>
                                    @error('booking_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- عدد الضيوف -->
                                <div class="col-md-6">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.guests_count') }}</h3>
                                    <input type="number" name="guests_count" id="guests_count"
                                        value="{{ old('guests_count') }}"
                                        class="form-control @error('guests_count') is-invalid @enderror" min="1"
                                        max="50" >
                                    @error('guests_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- تاريخ الميلاد -->
                                <div class="col-md-6">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.birth_date') }}</h3>
                                    <input type="date" name="birth_date" id="birth_date" dir="ltr"
                                        value="{{ old('birth_date') }}"
                                        class="form-control @error('birth_date') is-invalid @enderror"
                                        max="{{ date('d-m-Y') }}">
                                    @error('birth_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- رسالة إضافية -->
                                <div class="col-12">
                                    <h3 class="h6 mb-2 fw-bold">{{ __('book.message_optional') }}</h3>
                                    <textarea name="message" id="message" rows="4" maxlength="1000"
                                        class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                                    @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>

                                <!-- زر الإرسال -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn px-4 py-2"
                                        style="background-color: #8B7355; color: white;">
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
        font-size: 0.875rem;
    }
</style>
@endpush

@push('scripts')
<script>
    function validatePhone(input) {
        const feedback = document.getElementById('phone-feedback');

        // إذا الحقل فارغ، إخفاء الخطأ
        if (input.value === '') {
            input.classList.remove('is-invalid');
            feedback.style.display = 'none';
            return true;
        }

        // تحقق إذا بدأ الرقم بـ 9
        if (input.value.startsWith('9')) {
            input.classList.remove('is-invalid');
            feedback.style.display = 'none';
            return true;
        }

        // في حالة الرقم لا يبدأ بـ 9
        input.classList.add('is-invalid');
        feedback.style.display = 'block';
        return false;
    }

    // تفعيل التحقق فقط عند محاولة الإرسال
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form.needs-validation');
        const phoneInput = document.getElementById('phone');

        phoneInput.addEventListener('input', () => {
            if (phoneInput.classList.contains('is-invalid')) {
                validatePhone(phoneInput);
            }
        });

        form.addEventListener('submit', function (event) {
            if (!validatePhone(phoneInput)) {
                event.preventDefault();
                event.stopPropagation();
                phoneInput.focus();
            }

            form.classList.add('was-validated');
        });

        // باقي الكود لتحديث أوقات الحجز حسب التاريخ
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
