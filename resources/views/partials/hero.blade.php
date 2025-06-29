<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-2 justify-content-lg-between align-items-center">
            <div class="col-lg-6 col-md-12 order-2 order-lg-1 d-flex flex-column justify-content-start">
                <h1 class="display-4 fw-bold mb-2" data-aos="fade-up" data-aos-once="true">
                    {{ app()->getLocale() === 'ar' ? $heroPage->title_ar : $heroPage->title_en }}
                </h1>
                <p class="lead mb-2" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                    {!! nl2br(e(app()->getLocale() === 'ar' ? $heroPage->main_text_ar : $heroPage->main_text_en)) !!}
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
            <div class="col-lg-5 col-md-12 order-1 order-lg-2 hero-img mt-3 mt-lg-0" data-aos="zoom-out"
                data-aos-once="true">
                <img src="{{ asset( $heroPage->image) }}" class="img-fluid shadow-lg animated"
                    alt="Had AlShebak Ambiance" loading="lazy"
                    style="border-radius: 30px; max-width: 80%; height: auto;">
            </div>
        </div>
    </div>
</section>
