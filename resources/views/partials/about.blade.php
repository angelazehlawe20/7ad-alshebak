<section id="about" class="about section">
    <div class="container section-title" data-aos="fade-up">
            <p><span>Who</span> <span class="description-title">We Are</span></p>
    </div>

    <div class="container">
        {{-- Gallery Slider Section --}}
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper gallery-swiper">
                {{-- Swiper Configuration --}}
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
                            "320": {"slidesPerView": 1, "spaceBetween": 10},
                            "576": {"slidesPerView": 2, "spaceBetween": 20},
                            "768": {"slidesPerView": 3, "spaceBetween": 30},
                            "1200": {"slidesPerView": 4, "spaceBetween": 40}
                        }
                    }
                </script>

                {{-- Gallery Images --}}
                <div class="swiper-wrapper align-items-center">
                    @forelse(json_decode($about->gallery_images ?? '[]') as $image)
                    <div class="swiper-slide">
                        <a class="glightbox" data-gallery="images-gallery" href="{{ asset('storage/' . $image) }}">
                            <img src="{{ asset('storage/' . $image) }}" class="img-fluid rounded shadow gallery-image"
                                alt="Gallery Image" loading="lazy" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <p class="text-center text-muted">No images available.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Swiper Navigation --}}
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="row gy-4 align-items-center mt-5">
            {{-- About Text --}}
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                <div class="content ps-0 ps-lg-5">
                    <p class="text-center lead">
                        {{ $about->main_text ?? 'No about text available.' }}
                    </p>
                </div>
            </div>

            {{-- Why Choose Us --}}
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                <div class="why-box bg-dark text-white rounded p-4">
                    <h3 class="section-title mb-4">
                        {{ $about->why_title ?? 'Why Choose Us' }}
                    </h3>
                    <ul class="list-unstyled why-list">
                        @forelse(json_decode($about->why_points ?? '[]') as $point)
                        <li class="mb-3"><i class="bi bi-check-circle me-2"></i>{{ $point }}</li>
                        @empty
                        <li class="text-muted">No points available.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
