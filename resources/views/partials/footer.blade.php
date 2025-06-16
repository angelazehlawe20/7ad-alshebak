<footer id="footer" class="footer dark-background py-5">
    <div class="container">
        <div class="row gy-3">
            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-geo-alt icon"></i>
                <div class="address">
                    <h4 class="mb-2">Address</h4>
                    <p>{!! nl2br($footer?->address) !!}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-telephone icon"></i>
                <div>
                    <h4 class="mb-2">Contact</h4>
                    <p>
                        <strong>Phone:</strong> <span>{{ $footer?->phone }}</span><br>
                        <strong>Email:</strong> <span>{{ $footer?->email }}</span><br>
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-clock icon"></i>
                <div>
                    <h4 class="mb-2">Opening Hours</h4>
                    <p>{!! $footer?->opening_hours !!}</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <h4 class="mb-3">Follow Us</h4>
                <div class="social-links d-flex gap-2">
                    <a href="{{ $footer?->facebook_url }}" class="facebook 1" style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="bi bi-facebook"></i></a>
                    <a href="{{ $footer?->instagram_url }}" class="instagram " style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="bi bi-instagram"></i></a>
                    @if($footer?->whatsapp)
                        <a href="{{ $footer?->whatsapp }}" class="whatsapp " style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i class="bi bi-whatsapp"></i></a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</footer>
