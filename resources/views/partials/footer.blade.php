<footer id="footer" class="footer dark-background py-3">
    <div class="container">
        <div class="row gy-3">
            <div class="col-lg-3 col-md-6 footer-info">
                <div class="d-flex gap-3 align-items-start">
                    <i class="bi bi-geo-alt icon"></i>
                    <div class="draggable-container">
                        <p class="mb-0 draggable-text">
                            {!! nl2br(app()->getLocale() === 'ar' ? $footer?->address_ar : $footer?->address_en) !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 footer-info">
                <div class="d-flex gap-3 align-items-start">
                    <i class="bi bi-envelope icon"></i>
                    <div class="draggable-container">
                        <p class="mb-0 draggable-text">
                            {{ $footer?->email }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 footer-info">
                <div class="d-flex gap-3 align-items-start">
                    <i class="bi bi-telephone icon"></i>
                    <div class="draggable-container">
                        <p class="mb-0 draggable-text">
                            {{ $footer?->phone }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 footer-info">
                <div class="d-flex gap-3 align-items-start">
                    <i class="bi bi-clock icon"></i>
                    <div class="draggable-container">
                        <p class="mb-0 draggable-text">
                            {!! $footer?->opening_hours !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center mt-4">
                <div class="social-links d-flex gap-4">
                    <a href="{{ $footer?->facebook_url }}" class="facebook"
                        style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i
                            class="bi bi-facebook"></i></a>
                    <a href="{{ $footer?->instagram_url }}" class="instagram"
                        style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i
                            class="bi bi-instagram"></i></a>
                    @if($footer?->whatsapp)
                    <a href="{{ $footer?->whatsapp }}" class="whatsapp"
                        style="font-size: 24px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;"><i
                            class="bi bi-whatsapp"></i></a>
                    @endif
                </div>
            </div>

            <div class="col-12">
                <hr class="my-4" style="border-color: rgba(255, 255, 255, 0.1);">
                <p class="text-center text-white-50 mb-0">
                    {{__('footer.designed_by')}} : <a href="https://wa.me/963932296001" class="text-white-50 text-decoration-none"><i class="bi bi-whatsapp"></i></a>
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
.draggable-container {
    position: relative;
    overflow: hidden;
    max-width: 300px;
}

.draggable-text {
    cursor: grab;
    user-select: text;
    overflow-x: auto;
    white-space: nowrap;
    scrollbar-width: none;
    padding: 5px;
}

.draggable-text::-webkit-scrollbar {
    display: none;
}

@media (max-width: 800px) {
    .footer-info {
        text-align: center;
    }

    .footer-info .d-flex {
        justify-content: center;
    }

    .draggable-container {
        max-width: 100%;
    }

    .draggable-text {
        white-space: normal;
        word-wrap: break-word;
        text-align: center;
    }

    .icon {
        font-size: 1.2rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all draggable elements
    const draggableElements = document.querySelectorAll('.draggable-text');

    draggableElements.forEach(element => {
        let isDown = false;
        let startX;
        let scrollLeft;

        element.addEventListener('mousedown', (e) => {
            isDown = true;
            element.style.cursor = 'grabbing';
            startX = e.pageX - element.offsetLeft;
            scrollLeft = element.scrollLeft;
        });

        element.addEventListener('mouseleave', () => {
            isDown = false;
            element.style.cursor = 'grab';
        });

        element.addEventListener('mouseup', () => {
            isDown = false;
            element.style.cursor = 'grab';
        });

        element.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - element.offsetLeft;
            const walk = (x - startX);
            element.scrollLeft = scrollLeft - walk;
        });
    });

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
