@extends('layouts.app')

@section('title', __('navbar.contact'))

@section('content')
<!-- Contact Section -->
<section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <p>
            <span class="description-title">{{ __('contact.contact_us')}}</span>
        </p>
    </div><!-- End Section Title -->
    <div class="container px-4">
        <div class="row gy-4">

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3326.273272148186!2d36.2904778!3d33.52028!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e7a7f0f96d6f%3A0xc6ad6001c2bb3dcb!2z2K3Yr9mRINin2YTYtNio2KfZgw!5e0!3m2!1sar!2s!4v1748366629522!5m2!1sar!2s"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="col-md-6">
                <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                    <i class="icon bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h3>
                            {{ __('contact.address') }}</h3>
                        <p>
                            {!! nl2br(app()->getLocale() === 'ar' ? $footer?->address_ar : $footer?->address_en) !!}
                        </p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="300">
                    <i class="icon bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>
                            {{ __('contact.call_us') }}</h3>
                        <p>
                            {{$footer?->phone}}</p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="400">
                    <i class="icon bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>
                            {{ __('contact.email_us') }}</h3>
                        <p>
                            {{$footer?->email}}</p>
                    </div>
                </div>
            </div><!-- End Info Item -->

            <div class="col-md-6">
                <div class="info-item d-flex align-items-center" data-aos="fade-up" data-aos-delay="500">
                    <i class="icon bi bi-clock flex-shrink-0"></i>
                    <div>
                        <h3>
                            {{ __('contact.opening_hours') }}<br></h3>
                        <p>
                            {{$footer?->opening_hours}}</p>
                    </div>
                </div>
            </div><!-- End Info Item -->

        </div>
        <form action="{{route('contact.store')}}" method="POST" class="php-email-form" data-aos="fade-up"
            data-aos-delay="600">
            @csrf
            <div class="row gy-4">

                <div class="col-md-6">
                    <input type="text" name="name" class="form-control ps-3"
                        placeholder="{{ __('contact.your_name') }}" required="">
                </div>

                <div class="col-md-6 ">
                    <input type="email" class="form-control ps-3" name="email"
                        placeholder="{{ __('contact.your_email') }}">
                </div>

                <div class="col-md-12">
                    <input type="text" class="form-control ps-3" name="subject"
                        placeholder="{{ __('contact.subject') }}" required="">
                </div>
                <div class="col-md-12">
                    <textarea class="form-control ps-3" name="message" rows="6"
                        placeholder="{{ __('contact.message') }}" required="" style="white-space: pre-wrap;"></textarea>
                </div>
                <div class="col-md-12 text-center">
                    <div class="loading">
                        {{ __('contact.loading') }}</div>
                    <div class="error-message">
                        {{ __('contact.error_message') }}</div>
                    <div class="sent-message">
                        {{ __('contact.sent_message') }}</div>

                    <button type="submit">
                        {{__('contact.send_message') }}</button>
                </div>

            </div>
        </form><!-- End Contact Form -->
    </div>

</section><!-- /Contact Section -->
@endsection
