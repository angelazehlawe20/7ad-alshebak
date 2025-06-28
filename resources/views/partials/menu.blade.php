@extends('layouts.app')

@section('title', __('navbar.menu') )

@section('content')
<section id="menu" class="menu section">
    <!-- Section Title -->
    <div id="menu-content"></div>
    <div class="container section-title" data-aos="fade-up">
        @if(app()->getLocale() == 'ar')
        <p style="font-family: var(--arabic-font)"><span>{{ __('menu.menu') }}</span> <span class="description-title">{{
                __('menu.brand_name') }}</span></p>
        @else
        <p style="font-family: var(--english-font)"><span>{{ __('menu.brand_name') }}</span> <span
                class="description-title">{{ __('menu.menu') }}</span></p>
        @endif
    </div>

    <div class="container">
        <ul class="nav nav-tabs d-flex justify-content-center position-sticky top-0 bg-white z-3" data-aos="fade-up"
            data-aos-delay="100">
            @foreach($categories as $category)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active show' : '' }}" data-bs-toggle="tab"
                    data-bs-target="#menu-{{ $category->id }}">
                    <h4
                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                        {{ $category->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}</h4>
                </a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
            @php
            $hasItems = false;
            @endphp

            @foreach($categories as $category)
            <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="menu-{{ $category->id }}">
                <div class="tab-header text-center">
                    <p
                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                        {{ __('menu.menu') }}</p>
                    <h3
                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                        {{ $category->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}</h3>
                </div>

                <div class="row gy-4">
                    @forelse($category->menuItems as $item)
                    @php $hasItems = true; @endphp
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 menu-item">
                        <div class="menu-card h-100">
                            <div class="menu-image-wrapper">
                                @if($item->image)
                                <a href="{{ asset( $item->image) }}" class="glightbox">
                                    <img src="{{ asset( $item->image) }}" class="menu-img img-fluid"
                                        alt="{{ $item->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}">
                                </a>
                                @else
                                <div class="no-image-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                                @endif
                            </div>

                            <div class="menu-content d-flex flex-column h-100">
                                <div class="menu-header">
                                    <h4 class="menu-title"
                                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                                        {{ $item->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}
                                    </h4>

                                    @if($item->{app()->getLocale() == 'ar' ? 'description_ar' : 'description_en'})
                                    <p class="menu-description"
                                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                                        {{ $item->{app()->getLocale() == 'ar' ? 'description_ar'
                                        : 'description_en'} }}</p>
                                    @endif
                                </div>

                                <div class="card-price fw-bold fs-5 mt-auto">
                                    <span class="menu-price"
                                        style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">{{
                                        number_format($item->price) }} $</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center">
                        <p class="no-items-message"
                            style="font-family: {{ app()->getLocale() == 'ar' ? 'var(--arabic-font)' : 'var(--english-font)' }}">
                            {{ __('menu.no_items') }}</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
