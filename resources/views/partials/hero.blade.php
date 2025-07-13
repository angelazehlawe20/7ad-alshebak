<!-- Hero Section -->
<section id="hero" class="hero section position-relative" style="min-height: 100vh;">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.background-swiper', {
                loop: true,
                effect: 'fade',
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    </script>
    <div class="swiper background-swiper position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 0;">
        <div class="swiper-wrapper">
            @foreach ($heroPage->images->take(4) as $image)
            <div class="swiper-slide"
                style="background-image: url('{{ asset($image->image_path) }}'); background-size: cover; background-position: center;">
                <div class="overlay position-absolute w-100 h-100"
                    style="background: rgba(0, 0, 0, 0.5); top: 0; left: 0;"></div>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next" style="opacity: 0; transition: opacity 0.3s;"></div>
        <div class="swiper-button-prev" style="opacity: 0; transition: opacity 0.3s;"></div>
        <style>
            .swiper-initialized .swiper-button-next,
            .swiper-initialized .swiper-button-prev {
                opacity: 1 !important;
            }
        </style>
    </div>
    <div class="container position-relative h-100 d-flex align-items-center" style="z-index: 2;">
        <div class="row w-100 justify-content-center align-items-center py-4">
            <div class="col-12 col-lg-6 order-2 order-lg-1 text-center text-lg-start px-4 px-lg-0">
                <h1 class="display-4 fw-bold mb-4 text-white"
                    style="font-size: clamp(2rem, 5vw, 4rem); line-height: 1.2;" data-aos="fade-up"
                    data-aos-once="true">
                    {{ app()->getLocale() == 'en' ? ($heroPage->title_en ?? 'Had alshebak') : ($heroPage->title_ar ??
                    'حدّ الشباك') }}
                </h1>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start"
                    style="margin-top: clamp(1.5rem, 4vw, 3rem);" data-aos="zoom-out" data-aos-once="true">
                    <a href="{{route('book')}}" class="btn btn-get-started text-black fw-bold px-4 py-3 w-100 w-sm-auto"
                        style="font-size: clamp(1rem, 2vw, 1.2rem); border-radius: 30px; transition: all 0.3s ease;"
                        data-aos="zoom-out">
                        <i class="fas fa-calendar-check me-2"></i>{{ __('navbar.book') }}
                    </a>
                    <a href="{{route('menu')}}" class="btn btn-get-started text-black fw-bold px-4 py-3 w-100 w-sm-auto"
                        style="font-size: clamp(1rem, 2vw, 1.2rem); border-radius: 30px; transition: all 0.3s ease;"
                        data-aos="zoom-out">
                        <i class="fas fa-utensils me-2"></i>{{ __('navbar.view_menu') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 order-1 order-lg-2" data-aos="zoom-out" data-aos-once="true"></div>
        </div>
    </div>
</section>
