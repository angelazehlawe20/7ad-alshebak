<!-- About Section -->
<section id="about" class="about section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <p><span>Who</span> <span class="description-title">We Are</span></p>
    </div><!-- End Section Title -->

    <div class="container">

      <!-- Swiper Gallery -->
      <div data-aos="fade-up" data-aos-delay="100">
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "centeredSlides": true,
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 0
                },
                "768": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                },
                "1200": {
                  "slidesPerView": 5,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <!-- Gallery Images -->
            @for ($i = 1; $i <= 8; $i++)
            <div class="swiper-slide">
              <a class="glightbox" data-gallery="images-gallery"
                 href="{{ asset('assets/img/gallery/gallery-' . $i . '.jpg') }}">
                <img src="{{ asset('assets/img/gallery/gallery-' . $i . '.jpg') }}" class="img-fluid" alt="">
              </a>
            </div>
            @endfor
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

      <!-- Content + Why Box -->
      <div class="row gy-4 align-items-center mt-5">

        <!-- العمود الأيسر - النص -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
          <div class="content ps-0 ps-lg-5">
            <p class="text-center">
              We are a locally inspired café that brings people together through great food, warm hospitality,
              and a cozy atmosphere.<br><br>
              At Had AlShebak, every detail matters — because our guests deserve the best.
            </p>
          </div>
        </div>

        <!-- العمود الأيمن - الـ Box -->
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
          <div class="why-box"
               style="background-color: #44432b; border-radius: 10px; padding: 20px;">
            <h3 class="section-title" style= "color:white">Why Choose Had AlShebak</h3>
            <ul class="list-unstyled" style= "color:white">
              <li>Cozy and authentic atmosphere</li>
              <li>High-quality food and drinks</li>
              <li>Friendly and welcoming staff</li>
              <li>Great offers and seasonal menus</li>
              <li>Central location with great view</li>
            </ul>
          </div>
        </div>

      </div>
    </div>

  </section><!-- /About Section -->
