<section id="about" class="about section">
    <!-- عنوان القسم -->
    <div class="container section-title" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
        <p>
            <span class="description-title">{{ __('about.who_we_are') }}</span>
        </p>
    </div>

    <!-- محتوى التعريف -->
    <div class="container mt-5">
        <div class="row gy-4 justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="content">
                    <p class="lead">
                        {!! app()->getLocale() === 'ar'
                        ? nl2br(e($about->main_text_ar ?? __('about.no_about')))
                        : nl2br(e($about->main_text_en ?? __('about.no_about'))) !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    @php
    $mediaItems = json_decode($about->gallery_images ?? '[]');
    $count = count($mediaItems);
    if ($count > 0 && $count < 4) { $repeatFactor=ceil(4 / $count); $mediaItems=array_merge(...array_fill(0,
        $repeatFactor, $mediaItems)); } @endphp <!-- السلايدر -->
        <div class="mt-5" data-aos="fade-up" data-aos-duration="700" data-aos-delay="100">
            <div class="swiper init-swiper gallery-swiper">
                <div class="swiper-wrapper align-items-center">
                    @forelse($mediaItems as $media)
                    <div class="swiper-slide d-flex justify-content-center align-items-center">
                        <div class="media-wrapper overflow-hidden rounded shadow"
                            style="width: 300px; height: 300px; position: relative;">
                            @php $ext = pathinfo($media, PATHINFO_EXTENSION); @endphp
                            @if(in_array(strtolower($ext), ['mp4', 'webm', 'ogg']))
                            <div class="video-thumbnail"
                                style="cursor:pointer; width:100%; height:100%; display:flex; justify-content:center; align-items:center; background:#000;">
                                <video muted playsinline preload="metadata"
                                    style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    <source src="{{ asset($media) }}" type="video/{{ strtolower($ext) }}">
                                    {{ __('about.video_not_supported') }}
                                </video>
                                <div class="play-button"
                                    style="position:absolute; font-size: 3rem; color: rgba(255,255,255,0.8); pointer-events:none;">
                                    &#9658;
                                </div>
                            </div>
                            @else
                            <a class="glightbox d-block w-100 h-100" data-gallery="images-gallery"
                                href="{{ asset($media) }}">
                                <img src="{{ asset($media) }}" alt="Gallery Media" loading="lazy"
                                    style="width: 100%; height: 100%; object-fit: contain;">
                            </a>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <p class="text-center text-muted">{{ __('about.no_images') }}</p>
                    </div>
                    @endforelse
                </div>

                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        <!-- مودال الفيديو -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content bg-transparent border-0">
                    <div class="modal-body p-0 position-relative">
                        <!-- زر إغلاق -->
                        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                            data-bs-dismiss="modal" aria-label="Close"></button>

                        <!-- Loader -->
                        <div id="videoLoader"
                            class="position-absolute top-50 start-50 translate-middle text-white d-none">
                            <div class="spinner-border" role="status"></div>
                        </div>

                        <!-- الفيديو -->
                        <video id="modalVideo" controls muted playsinline
                            style="width: 100%; height: auto; max-height: 80vh; background: #000; position: relative; z-index: 1;">
                            <source src="" type="">
                            {{ __('about.video_not_supported') }}
                        </video>
                    </div>
                </div>
            </div>
        </div>


        <!-- سكريبتات -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
            const gallerySwiper = new Swiper('.gallery-swiper', {
                loop: true,
                centeredSlides: true,
                slidesPerView: 1,
                spaceBetween: 20,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    576: { slidesPerView: 2 },
                    768: { slidesPerView: 3 },
                    992: { slidesPerView: 4 },
                }
            });

            const videos = document.querySelectorAll('.gallery-swiper video');
            function pauseAllVideos() {
                videos.forEach(video => {
                    video.pause();
                    video.currentTime = 0;
                });
            }

            videos.forEach(video => {
                video.addEventListener('play', () => gallerySwiper.autoplay.stop());
                video.addEventListener('pause', () => gallerySwiper.autoplay.start());
                video.addEventListener('ended', () => gallerySwiper.autoplay.start());
            });

            gallerySwiper.on('slideChangeTransitionEnd', () => {
                pauseAllVideos();
                const activeSlide = gallerySwiper.slides[gallerySwiper.activeIndex];
                const video = activeSlide.querySelector('video');
                if (video) {
                    video.muted = true;
                    video.play().catch(() => {});
                }
            });

            gallerySwiper.init();

            // المودال
            const modalElement = document.getElementById('videoModal');
            const modalVideo = document.getElementById('modalVideo');
            const videoLoader = document.getElementById('videoLoader');
            const videoModal = new bootstrap.Modal(modalElement);

            document.querySelectorAll('.video-thumbnail').forEach(thumbnail => {
                thumbnail.addEventListener('click', function () {
                    const source = this.querySelector('source');
                    modalVideo.src = source.src;
                    modalVideo.type = source.type;
                    modalVideo.muted = false;
                    videoLoader.classList.remove('d-none');
                    videoModal.show();

                    // تشغيل الفيديو بعد فتح المودال
                    setTimeout(() => {
                        modalVideo.play().catch(e => console.log('Autoplay failed:', e));
                    }, 300);
                });
            });

            modalVideo.addEventListener('waiting', () => {
                videoLoader.classList.remove('d-none');
            });

            modalVideo.addEventListener('playing', () => {
                videoLoader.classList.add('d-none');
            });

            modalElement.addEventListener('hidden.bs.modal', () => {
                modalVideo.pause();
                modalVideo.currentTime = 0;
                modalVideo.src = '';
                videoLoader.classList.add('d-none');
                gallerySwiper.autoplay.start();
            });
        });
        </script>


        <!-- تضمين Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- ستايل خاص -->
        <style>
            .modal .btn-close {
                z-index: 10;
                pointer-events: auto;
            }

            #modalVideo {
                z-index: 1;
                position: relative;
            }

            #videoLoader {
                z-index: 5;
            }
        </style>
</section>
