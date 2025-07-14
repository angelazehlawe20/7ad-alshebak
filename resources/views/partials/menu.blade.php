@extends('layouts.app')

@section('title', __('navbar.menu') )

@section('content')
<section id="menu" class="menu section">
    <!-- Section Title -->
    <div class="container d-flex flex-column align-items-center" data-aos="fade-up">
        <div id="menu-content"></div>
        <div class="container section-title">
            <p>
                <span class="description-title">{{__('menu.brand_name_menu') }}</span>
            </p>
        </div>

        @if(count($categories) > 0)
        <div class="menu-navigation w-100 d-flex flex-column align-items-center">
            <div class="overflow-auto w-100">
                <ul class="nav nav-tabs d-flex justify-content-center position-sticky top-0 bg-white z-3"
                    data-aos="fade-up" data-aos-delay="100">
                    @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active show' : '' }} px-3 py-2" data-bs-toggle="tab"
                            data-bs-target="#menu-{{ $category->id }}">
                            <h4 class="fs-6 m-0">
                                {{ $category->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}</h4>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content w-100" data-aos="fade-up" data-aos-delay="200">
                @php
                $hasItems = false;
                @endphp

                @foreach($categories as $category)
                <div class="tab-pane fade {{ $loop->first ? 'active show' : '' }}" id="menu-{{ $category->id }}">
                    <div class="tab-header text-center">
                        <h3 class="fs-4 my-4">
                            {{ $category->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}</h3>
                    </div>

                    <div class="row gy-4">
                        @forelse($category->menuItems as $item)
                        @php $hasItems = true; @endphp
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 menu-item">
                            <div class="menu-card h-100 shadow-sm rounded overflow-hidden">
                                <div class="menu-image-wrapper position-relative" style="aspect-ratio: 16/9;">
                                    @if($item->image)
                                    <a href="{{ asset( $item->image) }}" class="glightbox">
                                        <img src="{{ asset( $item->image) }}"
                                            class="menu-img img-fluid w-100 h-100 object-fit-cover"
                                            alt="{{ $item->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}">
                                    </a>
                                    @else
                                    <div
                                        class="no-image-placeholder d-flex align-items-center justify-content-center h-100 bg-light">
                                        <i class="bi bi-image fs-1"></i>
                                    </div>
                                    @endif
                                </div>

                                <div class="menu-content d-flex flex-column h-100 p-3">
                                    <div class="menu-header">
                                        <h4 class="menu-title fs-5 mb-2">
                                            {{ $item->{app()->getLocale() == 'ar' ? 'name_ar' : 'name_en'} }}
                                        </h4>
                                        @if($item->{app()->getLocale() == 'ar' ? 'description_ar' : 'description_en'})
                                        <div class="border rounded p-3 bg-light mb-3">
                                            <p class="menu-description small text-muted mb-0">
                                                {!! nl2br(e($item->{app()->getLocale() == 'ar' ? 'description_ar' : 'description_en'})) !!}
                                            </p>
                                        </div>
                                        @endif
                                    </div>

                                    <div class="card-price fw-bold fs-5 mt-auto pt-2 border-top">
                                        <span class="menu-price fw-bolder">
                                            {{number_format($item->price) }} {{__('admins.syr')}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <p class="no-items-message text-muted">
                                {{ __('menu.no_items') }}</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="text-center py-5">
            <p class="no-items-message text-muted">{{ __('menu.no_items') }}</p>
        </div>
        @endif
    </div>
</section>
@endsection
