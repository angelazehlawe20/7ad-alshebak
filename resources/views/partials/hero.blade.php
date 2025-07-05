<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-2 justify-content-lg-between align-items-center">
            <div class="col-lg-6 col-md-12 order-2 order-lg-1 d-flex flex-column justify-content-start">
                <h1 class="display-4 fw-bold mb-2 mt-4 mt-lg-0" data-aos="fade-up" data-aos-once="true">
                    {{ app()->getLocale() == 'en' ? ($heroPage->title_en ?? 'Had alshebak') : ($heroPage->title_ar ??
                    'حدّ الشباك') }}
                </h1>
                <p class="lead mb-2" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                    {!! nl2br(e(app()->getLocale() === 'ar' ? ($heroPage->main_text_ar ?? '') :
                    (($heroPage->main_text_en ?? '')))) !!}
                </p>

                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-start mt-2" data-aos="zoom-out"
                    data-aos-once="true">
                    <a href="{{route('book')}}" class="btn btn-get-started" data-aos="zoom-out">
                        <i class="fas fa-calendar-check me-2"></i>{{ __('navbar.book') }}
                    </a>
                    <a href="{{route('menu')}}" class="btn btn-get-started" data-aos="zoom-out">
                        <i class="fas fa-utensils me-2"></i>{{ __('navbar.view_menu') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 order-1 order-lg-2 hero-img mt-3 mt-lg-0 mb-3 mb-lg-0" data-aos="zoom-out"
                data-aos-once="true">
                <!-- Fullscreen Image Slider -->
                <div class="col-lg-5 col-md-12 order-1 order-lg-2 hero-img mt-3 mt-lg-0 mb-3 mb-lg-0"
                    data-aos="zoom-out" data-aos-once="true">
                    <div class="swiper background-swiper position-relative rounded-4 shadow overflow-hidden"
                        style="height: 400px;">
                        <div class="swiper-wrapper">
                            @foreach (explode(',', $heroPage->images ?? $heroPage->image) as $image)
                            <div class="swiper-slide bg-cover"
                                style="background-image: url('{{ asset($image) }}'); background-size: cover; background-position: center; width: 100%; height: 100%;">
                            </div>
                            @endforeach
                        </div>
                        <!-- Optional pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
