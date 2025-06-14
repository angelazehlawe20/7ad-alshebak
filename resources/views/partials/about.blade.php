{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('content')
<section id="about" class="about section">

    <div class="container section-title" data-aos="fade-up">
        <p><span>Who</span> <span class="description-title">We Are</span></p>
    </div>

    <div class="container">
        {{-- الصور (gallery) --}}
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper gallery-swiper">
                <script type="application/json" class="swiper-config">
                    {
                        "loop": true,
                        "speed": 800,
                        "autoplay": {
                            "delay": 5000,
                            "disableOnInteraction": false
                        },
                        "slidesPerView": "auto",
                        "centeredSlides": true,
                        "pagination": {
                            "el": ".swiper-pagination",
                            "type": "bullets",
                            "clickable": true
                        },
                        "navigation": {
                            "nextEl": ".swiper-button-next",
                            "prevEl": ".swiper-button-prev"
                        },
                        "breakpoints": {
                            "320": {
                                "slidesPerView": 1,
                                "spaceBetween": 10
                            },
                            "576": {
                                "slidesPerView": 2,
                                "spaceBetween": 20
                            },
                            "768": {
                                "slidesPerView": 3,
                                "spaceBetween": 30
                            },
                            "1200": {
                                "slidesPerView": 4,
                                "spaceBetween": 40
                            }
                        }
                    }
                </script>
                <div class="swiper-wrapper align-items-center">
                    @if($about && $about->gallery_images)
                        @foreach(json_decode($about->gallery_images) as $image)
                            <div class="swiper-slide">
                                <a class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/' . $image) }}">
                                    <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded shadow" alt="Gallery Image" style="object-fit: cover; height: 300px; width: 100%;">
                                </a>
                            </div>
                        @endforeach
                    @else
                        <p>No images available.</p>
                    @endif
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        {{-- المحتوى والنقاط --}}
        <div class="row gy-4 align-items-center mt-5">
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <div class="content ps-0 ps-lg-5">
                    <p class="text-center">
                        {{ $about ? $about->main_text : 'No about text available.' }}
                    </p>
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="why-box" style="background-color: #44432b; border-radius: 10px; padding: 20px;">
                    <h3 class="section-title" style="color:white">
                        {{ $about ? $about->why_title : 'Why Choose Us' }}
                    </h3>
                    <ul class="list-unstyled" style="color:white">
                        @if($about && $about->why_points)
                            @foreach(json_decode($about->why_points) as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        @else
                            <li>No points available.</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
