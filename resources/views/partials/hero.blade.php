<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between align-items-center">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">Had AlShebak</h1>
                <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                    Welcome to Had AlShebak – Where Flavor Meets Atmosphere. Experience our carefully crafted menu featuring
                    delicious food, signature drinks, and exquisite desserts in an inviting atmosphere.
                    Immerse yourself in the perfect blend of relaxation with premium shisha, great company, and vibrant
                    live entertainment.
                    Your premier destination for memorable moments.
                </p>

                <div class="d-flex gap-3" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{route('book')}}" class="btn btn-primary btn-lg btn-get-started">
                        <i class="fas fa-calendar-check me-2"></i>Book a Table
                    </a>
                    <a href="{{route('menu')}}" class="btn btn-outline-primary btn-lg btn-get-started">
                        <i class="fas fa-utensils me-2"></i>View Menu
                    </a>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img
                    src="{{ asset('assets/img/hero-img.jpg') }}"
                    class="img-fluid shadow-lg animated"
                    alt="Had AlShebak Ambiance"
                    loading="lazy"
                    style="border-radius: 30px;"
                >
            </div>
        </div>
    </div>
</section>
