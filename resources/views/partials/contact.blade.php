@extends('layouts.app')

@section('title', 'Contact-Us')

@section('content')
<!-- Contact Section -->
<section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <p><span>Contact</span> <span class="description-title">Us</span></p>
    </div><!-- End Section Title -->
    <div class="row gy-4">

        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3326.273272148186!2d36.2904778!3d33.52028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e7a7f0f96d6f%3A0xc6ad6001c2bb3dcb!2z2K3Yr9mRINin2YTYtNio2KfZgw!5e0!3m2!1sar!2s!4v1748366629522!5m2!1sar!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                <i class="icon bi bi-geo-alt flex-shrink-0"></i>
                <div>
                    <h3>Address</h3>
                    <p>{{$footer?->address}}</p>
                </div>
            </div>
        </div><!-- End Info Item -->

        <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                <i class="icon bi bi-telephone flex-shrink-0"></i>
                <div>
                    <h3>Call Us</h3>
                    <p>{{$footer?->phone}}</p>
                </div>
            </div>
        </div><!-- End Info Item -->

        <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="400">
                <i class="icon bi bi-envelope flex-shrink-0"></i>
                <div>
                    <h3>Email Us</h3>
                    <p>{{$footer?->email}}</p>
                </div>
            </div>
        </div><!-- End Info Item -->

        <div class="col-md-6">
            <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
                <i class="icon bi bi-clock flex-shrink-0"></i>
                <div>
                    <h3>Opening Hours<br></h3>
                    <p>{{$footer?->opening_hours}}</p>
                </div>
            </div>
        </div><!-- End Info Item -->

    </div>

    <form action={{route('contact.store')}} method="POST" class="php-email-form" data-aos="fade-up" data-aos-delay="600">
        @csrf
        <div class="row gy-4">

            <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
            </div>

            <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
            </div>

            <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
            </div>

            <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
            </div>

            <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
            </div>

        </div>
    </form><!-- End Contact Form -->

    </div>

</section><!-- /Contact Section -->
@endsection
