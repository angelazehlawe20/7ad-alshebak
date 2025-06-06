@extends('layouts.admin')

@section('title', 'Manage Reservations')

@section('content')
<!-- Book A Table Section -->
<section id="book-a-table" class="book-a-table section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Manage Reservations</h2>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.reservations.store') }}" method="POST" class="p-4 rounded-4 bg-white">
                            @csrf
                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                        id="name" placeholder="Customer Name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" id="email" placeholder="Customer Email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text">+963</span>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                            name="phone" id="phone" placeholder="9XXXXXXXX" maxlength="9" 
                                            value="{{ old('phone') }}" required>
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="phone-error" class="text-danger mt-1" style="font-size: 14px; min-height: 18px;"></div>
                                </div>

                                <div class="col-md-6">
                                    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" 
                                        id="date" value="{{ old('date') }}" required>
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="time" class="form-control @error('time') is-invalid @enderror" 
                                        name="time" id="time" value="{{ old('time') }}" required>
                                    @error('time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <input type="number" class="form-control @error('people') is-invalid @enderror" 
                                        name="people" id="people" placeholder="# of people" value="{{ old('people') }}" required>
                                    @error('people')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control @error('message') is-invalid @enderror" 
                                        name="message" rows="4" placeholder="Message (optional)">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">Create Reservation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    const phoneInput = document.getElementById('phone');
    const phoneError = document.getElementById('phone-error');

    function validatePhone() {
        const value = phoneInput.value.replace(/\D/g, '');
        phoneInput.value = value;

        if (value.length !== 9 || !value.startsWith('9')) {
            phoneError.textContent = "Please enter a valid number like 9XXXXXXXX.";
            return false;
        } else {
            phoneError.textContent = "";
            return true;
        }
    }

    phoneInput.addEventListener('input', validatePhone);

    document.querySelector('form').addEventListener('submit', function (e) {
        if (!validatePhone()) {
            e.preventDefault();
        }
    });
</script>

@endsection
