<footer id="footer" class="footer dark-background py-3">
    <div class="container">
        <div class="row gy-3">
            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-geo-alt icon"></i>
                <div class="address">
                    <p>
                        {!! nl2br(app()->getLocale() === 'ar' ? $footer?->address_ar : $footer?->address_en) !!}
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-envelope icon"></i>
                <div>
                    <p>
                        {{ $footer?->email }}
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-telephone icon"></i>
                <div>
                    <p>
                        {{ $footer?->phone }}
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-clock icon"></i>
                <div>
                    <p>
                        {!! $footer?->opening_hours !!}</p>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center mt-4">
                <div class="social-links d-flex gap-4">
                    <a href="{{ $footer?->facebook_url }}" class="facebook"
                        style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); margin: 0 10px;"><i
                            class="bi bi-facebook"></i></a>
                    <a href="{{ $footer?->instagram_url }}" class="instagram"
                        style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); margin: 0 10px;"><i
                            class="bi bi-instagram"></i></a>
                    @if($footer?->whatsapp)
                    <a href="{{ $footer?->whatsapp }}" class="whatsapp"
                        style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 0 10px rgba(255, 255, 255, 0.5); margin: 0 10px;"><i
                            class="bi bi-whatsapp"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.1);">
                <p class="text-center text-white-50 mb-0">
                    {{__('footer.designed_by')}}: <a href="#" class="text-white-50 text-decoration-none">  </a>
                </p>
            </div>
        </div>
    </div>
</footer>