@extends('layouts.app')

@section('title', 'Book a table')

@section('content')
<!-- Book A Table Section -->
<section id="book-a-table" class="book-a-table section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <p><span>Book A Table</span> <span class="description-title">Now</span></p>
    </div>
    <!-- End Section Title -->

    <div class="container">
        <div class="row align-items-center" data-aos="fade-up" data-aos-delay="100">

            <!-- Left Image Column -->
            <div class="col-lg-5 mb-4 mb-lg-0">
                <img src="{{asset('assets/img/reservation.jpg')}}" alt="Reservation" class="img-fluid rounded-4 shadow">
            </div>

            <!-- Right Form Column -->
            <div class="col-lg-7">
                <form action="forms/book-a-table.php" method="post" role="form"
                    class="php-email-form p-4 rounded-4 shadow bg-white">
                    <div class="row gy-3">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                                required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">+963</span>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="9XXXXXXXX"
                                    maxlength="9" required>
                            </div>

                            <!-- الخطأ يظهر هنا -->
                            <div id="phone-error" class="text-danger mt-1" style="font-size: 14px; min-height: 18px;">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <input type="date" name="date" class="form-control" id="date" required>
                        </div>
                        <div class="col-md-6">
                            <input type="time" class="form-control" name="time" id="time" required>
                        </div>
                        <div class="col-md-6">
                            <input type="number" class="form-control" name="people" id="people"
                                placeholder="# of people" required>
                        </div>
                        <div class="col-12">
                            <textarea class="form-control" name="message" rows="4"
                                placeholder="Message (optional)"></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2">Book a Table</button>
                    </div>

                    <!-- Form Messages -->
                    <div class="loading mt-3">Loading</div>
                    <div class="error-message mt-2"></div>
                    <div class="sent-message mt-2">Your booking request was sent. Thank you!</div>

                </form>
            </div>

        </div>
    </div>

</section> <!-- End Book A Table Section -->

<script>
    const phoneInput = document.getElementById('phone');
    const phoneError = document.getElementById('phone-error');

    function validatePhone() {
      const value = phoneInput.value.replace(/\D/g, ''); // إزالة كل غير الأرقام
      phoneInput.value = value; // تحديث القيمة داخل الحقل

      if (value.length !== 9 || !value.startsWith('9')) {
        phoneError.textContent = "Please enter a valid number like 9XXXXXXXX.";
        return false;
      } else {
        phoneError.textContent = "";
        return true;
      }
    }

    // عند الكتابة
    phoneInput.addEventListener('input', validatePhone);

    // عند الإرسال
    document.querySelector('form').addEventListener('submit', function (e) {
      if (!validatePhone()) {
        e.preventDefault(); // إيقاف الإرسال إن كان الرقم غير صالح
      }
    });
</script>

@endsection
