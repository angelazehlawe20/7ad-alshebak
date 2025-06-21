@extends('layouts.app')

@section('title', 'Menu')

@section('content')
<section id="menu" class="menu section">
    <!-- Section Title -->
    <div id="menu-content"></div>
    <div class="container section-title" data-aos="fade-up">
        <p><span>Had AlShebak</span> <span class="description-title">Menu</span></p>
    </div>

    <div class="container">
        <ul class="nav nav-tabs d-flex justify-content-center position-sticky top-0 bg-white z-3" data-aos="fade-up"
            data-aos-delay="100">
            @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active show' : '' }}" data-bs-toggle="tab"
                    data-bs-target="#menu-{{ $category->id }}">
                    <h4>{{ $category->name_ar }} - {{ $category->name_en }}</h4>
                </a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            @foreach($categories as $category)
            <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="menu-{{ $category->id }}">
                <div class="tab-header text-center">
                    <p>Menu</p>
                    <h3>{{ $category->name_en }} - {{ $category->name_ar }}</h3>
                </div>

                <div class="row gy-5">
                    @forelse($category->menuItems as $item)
                    <div class="col-lg-4 menu-item">
                        <div class="menu-card h-100">
                            <div class="menu-image-wrapper">
                                @if($item->image)
                                <a href="{{ asset('storage/' . $item->image) }}" class="glightbox">
                                    <img src="{{ asset('storage/' . $item->image) }}" class="menu-img img-fluid"
                                        alt="{{ $item->name_en }} - {{ $item->name_ar }}">
                                </a>
                                @else
                                <div class="no-image-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                                @endif
                            </div>

                            <div class="menu-content d-flex flex-column h-100">
                                <div class="menu-header">
                                    <h4 class="menu-title">{{ $item->name_ar }}</h4>
                                    <small class="menu-subtitle">{{ $item->name_en }}</small>
                                </div>

                                <div class="flex-grow-1">
                                    @if($item->description_ar)
                                    <p class="menu-description">
                                        {{ $item->description_ar }}
                                    </p>
                                    @endif

                                    @if($item->description_en)
                                    <p class="menu-description-en">
                                        {{ $item->description_en }}
                                    </p>
                                    @endif
                                </div>

                                <div class="menu-footer mt-auto">
                                    <span class="menu-price">{{ number_format($item->price, 2) }} $</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p class="no-items-message">No menu items in this category at the moment</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const hash = window.location.hash;

    if (hash) {
        const triggerEl = document.querySelector(`a[data-bs-target="${hash}"]`);
        if (triggerEl) {
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();
        }
    }
});
</script>
@endpush

<style>
    .menu-btn {
        padding: 8px 16px;
        border: 2px solid #ccc;
        background: white;
        border-radius: 20px;
        transition: all 0.3s;
    }

    .menu-btn.active {
        background: #ff6b6b;
        color: white;
        border-color: #ff6b6b;
    }

    .menu-category {
        transition: all 0.3s ease;
    }

    .menu-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .menu-card:hover {
        transform: translateY(-5px);
    }

    .menu-image-wrapper {
        position: relative;
        overflow: hidden;
        padding-top: 75%;
        /* 4:3 Aspect Ratio */
    }

    .menu-image-wrapper img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .menu-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .no-image-placeholder {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .no-image-placeholder i {
        font-size: 3rem;
        color: #ccc;
    }

    .no-items-message {
        font-size: 1.2rem;
        color: #666;
        margin: 2rem 0;
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .menu-content {
        padding: 1.5rem;
    }

    .menu-header {
        margin-bottom: 1rem;
    }

    .menu-title {
        font-size: 1.4rem;
        margin: 0;
        color: #333;
    }

    .menu-subtitle {
        display: block;
        color: #666;
        margin-top: 0.3rem;
    }

    .menu-description {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0.5rem;
    }

    .menu-description-en {
        color: #777;
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .menu-footer {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #eee;
    }

    .menu-price {
        font-size: 1.3rem;
        font-weight: bold;
        color: #AC8C64;
    }
</style>
