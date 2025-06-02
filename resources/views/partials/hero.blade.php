@section('title', 'Home')

<!-- Hero Section -->
<section id="hero" class="hero section light-background">
    <div class="container">
        <div class="row gy-4 justify-content-center justify-content-lg-between">
            <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">Had AlShebak</h1><br>
                <p data-aos="fade-up" data-aos-delay="100">
                    Welcome to Had AlShebak – Where Flavor Meets Atmosphere Enjoy delicious food, signature drinks, and
                    sweet desserts in a cozy setting.
                    Relax with a shisha, unwind with friends, and experience live music and entertainment nights.
                    Your favorite café, where every visit feels special.
                </p><br>

                <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{route('book')}}" class="btn-get-started img-fluid animated">Book a Table</a>
                    <a href="{{route('menu')}}" class="btn-get-started img-fluid animated ms-3">View Menu</a>
                </div>
            </div>
            <div class="col-lg-5 order-1 order-lg-2 hero-img d-flex gap-2" data-aos="zoom-out">
                <img src="{{ asset('assets/img/hero-img.jpg') }}" class="img-fluid animated" alt=""
                    style="border-radius: 30px;">
            </div>
        </div>
    </div>
</section>


