<section id="about" class="about section">
    <div class="container section-title" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
        <p><span>{{ __('about.who') }}</span> <span class="description-title">{{ __('about.we_are') }}</span></p>
    </div>

    {{-- Prepare Images --}}
    @php
    $images = json_decode($about->gallery_images ?? '[]');
    $count = count($images);
    $minSlides = 4;

    if ($count > 0 && $count < $minSlides) {
        $repeatFactor = ceil($minSlides / $count);
        $images = array_merge(...array_fill(0, $repeatFactor, $images));
    }
    @endphp

    {{-- Gallery Slider --}}
    <div class="mt-5" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
        <div class="swiper init-swiper gallery-swiper">
            <div class="swiper-wrapper align-items-center">
                @foreach($images as $image)
                <div class="swiper-slide d-flex justify-content-center align-items-center">
                    <div class="image-wrapper overflow-hidden rounded shadow" style="width: 300px; height: 300px;">
                        <a class="glightbox d-block w-100 h-100" data-gallery="images-gallery"
                            href="{{ asset($image) }}">
                            <img src="{{ asset($image) }}" alt="Gallery Image" loading="lazy"
                                style="width: 100%; height: 100%; object-fit: contain;">
                        </a>
                    </div>
                </div>
                @endforeach

                @if($count === 0)
                <div class="swiper-slide">
                    <p class="text-center text-muted">{{ __('about.no_images') }}</p>
                </div>
                @endif
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container mt-5">
        <div class="row gy-4 align-items-center">
            {{-- About Text --}}
            <div class="col-lg-6">
                <div class="content ps-0 ps-lg-5">
                    <p class="text-center lead">
                        {{ app()->getLocale() === 'ar' ? ($about->main_text_ar ?? __('about.no_about')) : ($about->main_text_en ?? __('about.no_about')) }}
                    </p>
                </div>
            </div>

            {{-- Why Choose Us --}}
            <div class="col-lg-6">
                <div class="why-box bg-dark text-white rounded p-4">
                    <h3 class="section-title mb-4">
                        {{ app()->getLocale() === 'ar' ? ($about->why_title_ar ?? __('about.why_choose_us')) : ($about->why_title_en ?? __('about.why_choose_us')) }}
                    </h3>
                    <ul class="list-unstyled why-list">
                        @php
                            $points = app()->getLocale() === 'ar' ?
                                json_decode($about->why_points_ar ?? '[]') :
                                json_decode($about->why_points_en ?? '[]');
                        @endphp
                        @forelse($points as $point)
                        <li class="mb-3"><i class="bi bi-check-circle me-2"></i>{{ $point }}</li>
                        @empty
                        <li class="text-muted">{{__('about.no_points')}}.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Load Swiper Configuration --}}
<script src="{{ asset('assets/js/aboutPage.js') }}"></script>
