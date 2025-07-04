@extends('layouts.app')

@section('title', __('navbar.book'))

@section('content')
<!-- Book A Table Section -->
<section id="book-a-table" class="book-a-table section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <p>
            <span class="description-title">{{ __('book.book_your_table_now') }}</span>
        </p>
    </div>
    <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="POST" class="p-4 rounded-4 bg-white">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        placeholder="{{ __('book.your_name') }}" value="{{ old('name') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        placeholder="{{ __('book.your_email') }}" value="{{ old('email') }}"
                                        maxlength="255">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group" dir="{{ app()->getLocale() == 'ar' ? 'ltr' : 'ltr' }}">
                                        <span class="input-group-text">+963</span>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror" id="phone"
                                            placeholder="{{ __('book.phone') }}" maxlength="9"
                                            value="{{ old('phone') }}" required pattern="9[0-9]{8}">
                                    </div>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="phone-error" class="text-danger mt-1"
                                        style="font-size: 14px; min-height: 18px;"></div>
                                </div>

                                <div class="col-md-6">
    <input type="text" name="booking_date"
        class="form-control @error('booking_date') is-invalid @enderror"
        id="booking_date"
        value="{{ old('booking_date') }}"
        placeholder="{{ __('book.booking_date') }}"
        required>
    @error('booking_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                                <div class="col-md-6">
                                    <input type="time" name="booking_time"
                                        class="form-control @error('booking_time') is-invalid @enderror"
                                        id="booking_time" value="{{ old('booking_time') }}" required>
                                    @error('booking_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="guests_count"
                                        class="form-control @error('guests_count') is-invalid @enderror"
                                        id="guests_count" placeholder="{{ __('book.guests_count') }}"
                                        value="{{ old('guests_count') }}" required min="1" max="50">
                                    @error('guests_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                        rows="4" placeholder="{{ __('book.message_optional') }}"
                                        maxlength="1000">{{ old('message') }}</textarea>

                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn px-4 py-2"
                                    style="background-color: var(--accent-color); color:white; border: none;">{{__('book.book_a_table')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/bookPage.js') }}"></script>
@endpush
