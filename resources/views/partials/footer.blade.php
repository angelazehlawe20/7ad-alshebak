<footer id="footer" class="footer dark-background py-3">
    <div class="container">
        <div class="row gy-3">
            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-geo-alt icon"></i>
                <div class="address" data-bs-toggle="tooltip" data-bs-placement="top" title="{!! nl2br(app()->getLocale() === 'ar' ? $footer?->address_ar : $footer?->address_en) !!}">
                    <p class="mb-0 text-truncate" style="max-width: 200px; cursor: pointer;">
                        {!! nl2br(app()->getLocale() === 'ar' ? $footer?->address_ar : $footer?->address_en) !!}
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-envelope icon"></i>
                <div class="email-container" style="position: relative; overflow: hidden;">
                    <p class="mb-0 email-text" style="max-width: 200px; cursor: grab; user-select: text; overflow-x: auto; white-space: nowrap; scrollbar-width: none;">
                        {{ $footer?->email }}
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-telephone icon"></i>
                <div data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $footer?->phone }}">
                    <p class="mb-0 text-truncate" style="max-width: 200px; cursor: pointer;">
                        {{ $footer?->phone }}
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex gap-3">
                <i class="bi bi-clock icon"></i>
                <div data-bs-toggle="tooltip" data-bs-placement="top" title="{!! $footer?->opening_hours !!}">
                    <p class="mb-0 text-truncate" style="max-width: 200px; cursor: pointer;">
                        {!! $footer?->opening_hours !!}
                    </p>
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

<style>
.email-text::-webkit-scrollbar {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Add drag scrolling for email
    const emailText = document.querySelector('.email-text');
    let isDown = false;
    let startX;
    let scrollLeft;

    emailText.addEventListener('mousedown', (e) => {
        isDown = true;
        emailText.style.cursor = 'grabbing';
        startX = e.pageX - emailText.offsetLeft;
        scrollLeft = emailText.scrollLeft;
    });

    emailText.addEventListener('mouseleave', () => {
        isDown = false;
        emailText.style.cursor = 'grab';
    });

    emailText.addEventListener('mouseup', () => {
        isDown = false;
        emailText.style.cursor = 'grab';
    });

    emailText.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - emailText.offsetLeft;
        const walk = (x - startX);
        emailText.scrollLeft = scrollLeft - walk;
    });
});
</script>
