<!-- Hero Section -->
<section id="hero" class="hero section position-relative" style="min-height: 100vh; padding: 5px;">
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

    <div class="swiper background-swiper position-absolute" style="top: 5px; left: 5px; right: 5px; bottom: 5px; z-index: 0;">
        <div class="swiper-wrapper">
            @if(isset($heroPage) && $heroPage->images && $heroPage->images->count() > 0)
                @foreach ($heroPage->images->take(4) as $image)
                    <div class="swiper-slide"
                        style="background-image: url('{{ asset($image->image_path) }}'); background-size: cover; background-position: center; border-radius: 10px;">
                        <div class="overlay position-absolute w-100 h-100"
                            style="background: rgba(0, 0, 0, 0.0); top: 0; left: 0; border-radius: 10px;"></div>
                    </div>
                @endforeach
            @else
                <div class="swiper-slide"
                    style="background-image: url('{{ asset('/assets/img/hexagons/background.png') }}'); background-size: cover; background-position: center; border-radius: 10px;">
                    <div class="overlay position-absolute w-100 h-100"
                        style="background: rgba(0, 0, 0, 0.2); top: 0; left: 0; border-radius: 10px;"></div>
                </div>
            @endif
        </div>

        <div class="swiper-pagination"></div>
        <div class="swiper-button-next d-none d-md-flex" style="opacity: 0; transition: opacity 0.3s;"></div>
        <div class="swiper-button-prev d-none d-md-flex" style="opacity: 0; transition: opacity 0.3s;"></div>
        <style>
            .swiper-initialized .swiper-button-next,
            .swiper-initialized .swiper-button-prev {
                opacity: 1 !important;
            }
            @media (max-width: 576px) {
                .swiper-pagination {
                    bottom: 5px !important;
                }
                .swiper-pagination-bullet {
                    width: 6px !important;
                    height: 6px !important;
                }
            }
        </style>
    </div>

    <div class="container position-relative h-100 d-flex align-items-center" style="z-index: 2;">
        <div class="row w-100 justify-content-center align-items-center py-2 py-md-4">
            <div class="col-12 col-lg-6 order-2 order-lg-1 text-center text-lg-start px-2 px-sm-4 px-lg-0">
                <h1 class="display-4 fw-bold mb-3 mb-md-4 text-white"
                    style="font-size: clamp(1.5rem, 4vw, 4rem); line-height: 1.2; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); text-align: {{ app()->getLocale() == 'ar' ? 'right' : 'left' }};"
                    data-aos="fade-up"
                    data-aos-once="true">
                    {{ app()->getLocale() == 'en' ? ($heroPage->title_en ?? 'Had alshebak') : ($heroPage->title_ar ?? 'حدّ الشباك') }}
                </h1>
                <div class="d-flex flex-column flex-sm-row gap-2 gap-sm-3 justify-content-center justify-content-lg-start"
                    style="margin-top: clamp(1rem, 3vw, 3rem);" data-aos="zoom-out" data-aos-once="true">
                    <a href="{{route('book')}}" class="btn btn-get-started text-black fw-bold px-3 py-2 w-100 w-sm-auto"
                        style="font-size: clamp(0.875rem, 1.5vw, 1.2rem); border-radius: 25px; transition: all 0.3s ease;"
                        data-aos="zoom-out">
                        <i class="fas fa-calendar-check me-2"></i>{{ __('navbar.book') }}
                    </a>
                    <a href="{{route('menu')}}" class="btn btn-get-started text-black fw-bold px-3 py-2 w-100 w-sm-auto"
                        style="font-size: clamp(0.875rem, 1.5vw, 1.2rem); border-radius: 25px; transition: all 0.3s ease;"
                        data-aos="zoom-out">
                        <i class="fas fa-utensils me-2"></i>{{ __('navbar.view_menu') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 order-1 order-lg-2" data-aos="zoom-out" data-aos-once="true"></div>
        </div>
    </div>
</section>
