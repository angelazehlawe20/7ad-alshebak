<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between align-items-center">
            <div class="col-lg-6 col-md-12 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up" data-aos-once="true" style="font-size: calc(1.8rem + 1.5vw);">
                    {{ $heroPage->title_en }} - {{ $heroPage->title_ar }}
                </h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100" data-aos-once="true" style="font-size: calc(1rem + 0.5vw);">
                    {{ $heroPage->main_text_en }} <br><br> {{ $heroPage->main_text_ar }}
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start" data-aos="zoom-out" data-aos-once="true">
                    <a href="{{route('book')}}" class="btn btn-get-started btn-lg btn-get-started border-0 shadow-lg animated w-100 w-sm-auto" style="border-radius: 30px; font-size: calc(0.9rem + 0.3vw);">
                        <i class="fas fa-calendar-check me-2"></i>Book a Table
                    </a>
                    <a href="{{route('menu')}}" class="btn btn-get-startedy btn-lg btn-get-started border-0 shadow-lg animated w-100 w-sm-auto" style="border-radius: 30px; font-size: calc(0.9rem + 0.3vw);">
                        <i class="fas fa-utensils me-2"></i>View Menu
                    </a>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 order-1 order-lg-2 hero-img text-center" data-aos="zoom-out" data-aos-once="true">
                <img
                    src="{{ asset( $heroPage->image) }}"
                    class="img-fluid shadow-lg animated"
                    alt="Had AlShebak Ambiance"
                    loading="lazy"
                    style="border-radius: 30px; max-width: 100%; height: auto;"
                >
            </div>
        </div>
    </div>
</section>
