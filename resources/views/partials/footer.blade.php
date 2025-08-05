<footer id="footer" class="footer py-1 pt-4">
    <div class="container">
        <div class="row gy-1">
            <div class="col-12 col-md-6 d-flex">
                <div class="footer-info hover-effect w-100 h-100">
                    <div class="d-flex gap-2 align-items-start justify-content-center justify-content-md-start">
                        <div class="icon-wrapper">
                            <i class="bi bi-geo-alt icon"></i>
                        </div>
                        <div class="info-container">
                            <p class="mb-0 footer-text">
                                {!! nl2br(app()->getLocale() === 'ar' ? $footer?->address_ar : $footer?->address_en) !!}
                            </p>
                        </div>
                    </div>

                    <div class="mt-1">
                        <div class="d-flex gap-2 align-items-start justify-content-center justify-content-md-start">
                            <div class="icon-wrapper">
                                <i class="bi bi-envelope icon"></i>
                            </div>
                            <div class="info-container">
                                <p class="mb-0 footer-text">
                                    {{ $footer?->email }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 d-flex">
                <div class="footer-info hover-effect w-100 h-100 d-flex flex-column justify-content-between">
                    <div class="d-flex gap-2 align-items-start justify-content-center justify-content-md-start">
                        <div class="icon-wrapper">
                            <i class="bi bi-telephone icon"></i>
                        </div>
                        <div class="info-container">
                            <p class="mb-0 footer-text">
                                {{ $footer?->phone }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-1">
                        <div class="d-flex gap-2 align-items-start justify-content-center justify-content-md-start">
                            <div class="icon-wrapper">
                                <i class="bi bi-clock icon"></i>
                            </div>
                            <div class="info-container">
                                <p class="mb-0 footer-text">
                                    {!! $footer?->opening_hours !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="social-links d-flex gap-3 justify-content-center mt-1">
                    <a href="{{ $footer?->facebook_url }}" class="social-icon" target="_blank">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="{{ $footer?->instagram_url }}" class="social-icon" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                    @if($footer?->whatsapp)
                    <a href="{{ $footer?->whatsapp }}" class="social-icon" target="_blank">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                    @endif
                </div>
            </div>

            <div class="col-12 text-center">
                <hr class="footer-divider my-1">
                <p class="copyright-text" style="font-family: 'Tajawal', sans-serif; font-size: 1rem;">
                    {{ __('footer.developed_by') }}: {{__('footer.eng_angel')}}
                    <a href="https://wa.me/963932296001" class="developer-link ms-2" target="_blank"
                        rel="noopener noreferrer" title="Contact via WhatsApp">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </p>
            </div>

        </div>
    </div>
</footer>

<style>
    .footer {
        background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9));
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        position: relative;
    }

    .footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    }

    .footer-info {
        color: #fff;
        padding: 8px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
        min-height: 100%;
    }

    .footer-info.hover-effect:hover {
        transform: translateY(-3px);
        box-shadow: 0 3px 10px rgba(255, 255, 255, 0.1);
    }

    .icon-wrapper {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .icon {
        font-size: 1rem;
        color: #fff;
    }

    .footer-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .info-container {
        flex: 1;
        word-wrap: break-word;
    }

    .social-link {
        width: 35px;
        height: 35px;
        font-size: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        text-decoration: none;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        transform: translateY(-3px);
        color: #fff;
        background: rgba(255, 255, 255, 0.2);
        box-shadow: 0 3px 10px rgba(255, 255, 255, 0.1);
    }

    .footer-divider {
        border-color: rgba(255, 255, 255, 0.1);
        margin: 0.5rem 0;
    }

    .copyright-text {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.8rem;
    }

    .developer-link {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .developer-link:hover {
        color: #fff;
    }

    @media (max-width: 768px) {
        .footer-info {
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .info-container {
            text-align: center;
        }

        .social-link {
            width: 32px;
            height: 32px;
            font-size: 16px;
        }
    }

    @media (max-width: 576px) {
        .footer {
            padding: 1rem 0;
        }

        .social-link {
            width: 30px;
            height: 30px;
            font-size: 15px;
        }

        .footer-text {
            font-size: 0.8rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
