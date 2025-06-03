@extends('layouts.app')

@section('title', 'Menu')

@section('content')

<section id="menu" class="menu section">

    <!-- Section Title -->
    <div id="menu-content"></div>
    <div class="container section-title" data-aos="fade-up">
        <p><span>Had AlShebak</span> <span class="description-title">Menu</span></p>
    </div><!-- End Section Title -->
    <div class="menu-categories sticky-top py-3 bg-white" style="top: 80px; z-index: 1000;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="d-flex justify-content-center flex-wrap">
                        <a href="#starters" class="menu-btn mx-2"
                            onclick="scrollToSection('starters'); return false;">Starters</a>
                        <a href="#breakfast" class="menu-btn mx-2"
                            onclick="scrollToSection('breakfast'); return false;">Breakfast</a>
                        <a href="#lunch" class="menu-btn mx-2"
                            onclick="scrollToSection('lunch'); return false;">Lunch</a>
                        <a href="#dinner" class="menu-btn mx-2"
                            onclick="scrollToSection('dinner'); return false;">Dinner</a>
                        <a href="#drinks" class="menu-btn mx-2"
                            onclick="scrollToSection('drinks'); return false;">Drinks</a>
                        <a href="#dessert" class="menu-btn mx-2"
                            onclick="scrollToSection('dessert'); return false;">Dessert</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to scroll to a specific section
        function scrollToSection(sectionId) {
            // Check if we're on the menu page
            const isMenuPage = window.location.pathname.includes('/menu');

            if (!isMenuPage) {
                // If not on menu page, redirect to menu page with hash
                window.location.href = '{{ route("menu") }}#' + sectionId;
                return;
            }

            // If we're already on the menu page, just scroll to the section
            const element = document.getElementById(sectionId);
            if (element) {
                // Smooth scroll to element
                element.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }

        // Handle hash in URL when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Check if there's a hash in the URL
            if (window.location.hash) {
                // Get the section ID from the hash (remove the # symbol)
                const sectionId = window.location.hash.substring(1);

                // Add a small delay to ensure the page is fully loaded
                setTimeout(function() {
                    // Scroll to the section
                    const element = document.getElementById(sectionId);
                    if (element) {
                        element.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });

                        // Update active button
                        updateActiveButton(sectionId);
                    }
                }, 300);
            }
        });

        // Function to update active button
        function updateActiveButton(sectionId) {
            // Remove active class from all buttons
            document.querySelectorAll('.menu-btn').forEach(function(btn) {
                btn.classList.remove('active');
            });

            // Add active class to the button corresponding to the current section
            const activeButton = document.querySelector('.menu-btn[href="#' + sectionId + '"]');
            if (activeButton) {
                activeButton.classList.add('active');
            }
        }

        // Update active button when scrolling
        window.addEventListener('scroll', function() {
            // Get all section elements
            const sections = ['starters', 'breakfast', 'lunch', 'dinner', 'drinks', 'dessert'];

            // Find the section that is currently in view
            for (let i = 0; i < sections.length; i++) {
                const section = document.getElementById(sections[i]);
                if (section) {
                    const rect = section.getBoundingClientRect();

                    // Check if section is in viewport (with some buffer for better UX)
                    if (rect.top <= 150 && rect.bottom >= 150) {
                        updateActiveButton(sections[i]);
                        break;
                    }
                }
            }
        });
    </script>

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
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 1</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 2</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 3</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 4</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 5</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 7</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 8</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 9</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 10</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 11</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 1</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 2</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 3</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 4</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 5</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 7</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 8</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 9</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 10</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 11</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 1</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 2</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 3</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 4</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 5</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 7</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 8</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 9</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 10</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 11</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 1</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 2</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 3</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 4</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 5</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 7</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 8</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 9</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 10</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 11</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 1</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 2</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 3</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 4</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 5</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 7</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 8</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 9</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 10</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 11</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 1</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 2</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 3</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 4</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 5</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 15 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer1.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 7</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 8</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 9</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 10</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
                                    <div class="card-body">
                                        <h3 class="card-title">Offer 11</h3>
                                        <p class="card-text">Description</p>
                                        <p class="card-price text-danger fw-bold">price: 18 $</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 shadow">
                                    <img src="assets/img/offer/offer3.jpg" class="card-img-top offer-img img-fluid"
                                        alt="Offer Image">
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
