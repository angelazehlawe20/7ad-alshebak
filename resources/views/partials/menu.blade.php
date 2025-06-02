@extends('layouts.app')

@section('title', 'Menu')

@section('content')

<section id="menu" class="menu section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <p><span>Had AlShebak</span> <span class="description-title">Menu</span></p>
    </div><!-- End Section Title -->

    <div class="menu-categories sticky-top py-3 bg-white" style="top: 80px; z-index: 1000;">
    <div class="row justify-content-center">
        <div class="col-6 col-sm-auto text-center">
            <a href="#starters" class="menu-btn active">Starters</a>
            <a href="#breakfast" class="menu-btn">Breakfast</a>
            <a href="#lunch" class="menu-btn">Lunch</a>
            <a href="#dinner" class="menu-btn">Dinner</a>
            <a href="#drinks" class="menu-btn">Drinks</a>
            <a href="#dessert" class="menu-btn">Dessert</a>
        </div>
    </div>
    </div> <!-- end row div -->

    <section id="starters">
        <div class="container text-center">
            <h2>Starters</h2>
          <div class="swiper mySwiper">
            <div class=" swiper-wrapper">

              <!-- Slide 1: يحتوي على 6 كروت -->
        <div class="swiper-slide">
            <div class="row">
              <!-- كرر الكارد 6 مرات داخل كل slide -->
              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 1</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 15 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 2</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 15 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 3</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 15 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 4</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 15 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 5</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 15 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 6</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 15 $</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Slide 2: يحتوي على 6 كروت جديدة -->
          <div class="swiper-slide">
            <div class="row">
              <!-- كرر كروت جديدة 6 مرات -->
              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 7</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 18 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 8</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 18 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 9</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 18 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 10</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 18 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 11</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 18 $</p>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-6 col-6 mb-4">
                <div class="card h-100 shadow">
                  <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
                  <div class="card-body">
                    <h3 class="card-title">Offer 12</h3>
                    <p class="card-text">Description</p>
                    <p class="card-price text-danger fw-bold">price: 18 $</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Navigation arrows -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </div>
  </section> <!-- End Starters section -->

  <section id="breakfast">
    <div class="container text-center">
        <h2>Breakfast</h2>
      <div class="swiper mySwiper">
        <div class=" swiper-wrapper">

          <!-- Slide 1: يحتوي على 6 كروت -->
    <div class="swiper-slide">
        <div class="row">
          <!-- كرر الكارد 6 مرات داخل كل slide -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 1</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 2</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 3</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 4</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 5</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 6</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2: يحتوي على 6 كروت جديدة -->
      <div class="swiper-slide">
        <div class="row">
          <!-- كرر كروت جديدة 6 مرات -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 7</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 8</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 9</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 10</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 11</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 12</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
</section> <!-- End Breakfast section -->

<section id="lunch">
    <div class="container text-center">
        <h2>Lunch</h2>
      <div class="swiper mySwiper">
        <div class=" swiper-wrapper">

          <!-- Slide 1: يحتوي على 6 كروت -->
    <div class="swiper-slide">
        <div class="row">
          <!-- كرر الكارد 6 مرات داخل كل slide -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 1</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 2</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 3</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 4</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 5</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 6</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2: يحتوي على 6 كروت جديدة -->
      <div class="swiper-slide">
        <div class="row">
          <!-- كرر كروت جديدة 6 مرات -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 7</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 8</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 9</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 10</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 11</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 12</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
</section> <!-- End Lunch section -->

<section id="dinner">
    <div class="container text-center">
        <h2>Dinner</h2>
      <div class="swiper mySwiper">
        <div class=" swiper-wrapper">

          <!-- Slide 1: يحتوي على 6 كروت -->
    <div class="swiper-slide">
        <div class="row">
          <!-- كرر الكارد 6 مرات داخل كل slide -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 1</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 2</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 3</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 4</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 5</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 6</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2: يحتوي على 6 كروت جديدة -->
      <div class="swiper-slide">
        <div class="row">
          <!-- كرر كروت جديدة 6 مرات -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 7</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 8</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 9</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 10</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 11</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 12</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
</section> <!-- End Dinner section -->

<section id="drinks">
    <div class="container text-center">
        <h2>Drinks</h2>
      <div class="swiper mySwiper">
        <div class=" swiper-wrapper">

          <!-- Slide 1: يحتوي على 6 كروت -->
    <div class="swiper-slide">
        <div class="row">
          <!-- كرر الكارد 6 مرات داخل كل slide -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 1</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 2</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 3</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 4</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 5</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 6</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2: يحتوي على 6 كروت جديدة -->
      <div class="swiper-slide">
        <div class="row">
          <!-- كرر كروت جديدة 6 مرات -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 7</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 8</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 9</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 10</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 11</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 12</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
</section> <!-- End Drinks section -->

<section id="dessert">
    <div class="container text-center">
        <h2>Dessert</h2>
      <div class="swiper mySwiper">
        <div class=" swiper-wrapper">

          <!-- Slide 1: يحتوي على 6 كروت -->
    <div class="swiper-slide">
        <div class="row">
          <!-- كرر الكارد 6 مرات داخل كل slide -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 1</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 2</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 3</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 4</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 5</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 6</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 15 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2: يحتوي على 6 كروت جديدة -->
      <div class="swiper-slide">
        <div class="row">
          <!-- كرر كروت جديدة 6 مرات -->
          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 7</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 8</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 9</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 10</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 11</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 col-6 mb-4">
            <div class="card h-100 shadow">
              <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid" alt="Offer Image">
              <div class="card-body">
                <h3 class="card-title">Offer 12</h3>
                <p class="card-text">Description</p>
                <p class="card-price text-danger fw-bold">price: 18 $</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>
</div>
</section> <!-- End Dessert section -->

</section><!-- End Menu Section -->
@endsection

<script>
    document.querySelectorAll('.menu-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        document.querySelectorAll('.menu-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
      });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper(".mySwiper", {
    loop: false,
    slidesPerView: 1,
    slidesPerGroup: 1,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
      const sections = document.querySelectorAll("section[id]");
      const navLinks = document.querySelectorAll(".menu-btn");

      function activateLinkOnScroll() {
        let scrollPosition = window.scrollY + 200;

        sections.forEach(section => {
          const top = section.offsetTop;
          const height = section.offsetHeight;
          const id = section.getAttribute("id");

          if (scrollPosition >= top && scrollPosition < top + height) {
            if (window.location.hash !== `#${id}`) {
              history.replaceState(null, null, `#${id}`);
            }

            navLinks.forEach(link => {
              link.classList.remove("active");
              if (link.getAttribute("href") === `#${id}`) {
                link.classList.add("active");
              }
            });
          }
        });
      }

      window.addEventListener("scroll", activateLinkOnScroll);

      if (window.location.hash) {
        const targetSection = document.querySelector(window.location.hash);
        if (targetSection) {
          targetSection.scrollIntoView();
        }
      }
    });
</script>


