@extends('admin.layouts.app')
@section('title', __('category.category_details'))
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-list"></i>&nbsp;{{ __('category.category') }}: {{
                        $category->name_en }} - {{ $category->name_ar }}</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid px-0">
            <div class="row gy-4">
                <div class="col-md-12 mb-4">
                    <div class="card bg-beige card-outline">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-utensils mr-2"></i>&nbsp;{{ __('category.menu_items') }}
                            </h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.menu.createItemInCategory', ['id' => $category->id]) }}"
                                    class="btn" style="background-color: #8B7355; color: white;">
                                    <i class="fas fa-plus"></i>&nbsp;{{ __('category.add_new_menu_item') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body" style="background-color: #f5f5dc;">
                            <div class="row g-4">
                                @forelse ($category->menuItems as $item)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 shadow">
                                        <div class="position-relative">
                                            @if($item->image)
                                            <img src="{{ asset($item->image) }}" class="card-img-top"
                                                alt="{{ $item->name_en }}" loading="lazy"
                                                style="height: 300px; object-fit: contain; background-color: #fff; padding: 10px;">
                                            @else
                                            <div class="bg-light text-center p-4" style="height: 300px;">
                                                <i class="fas fa-image fa-3x text-secondary"
                                                    style="margin-top: 100px;"></i>
                                                <p class="mt-2 text-secondary">{{ __('category.no_image_available') }}
                                                </p>
                                            </div>
                                            @endif
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <span class="badge fs-6 fw-bold" style="background-color: #8B7355;">
                                                    {{ number_format($item->price) }}&nbsp;{{__('admins.syp')}}</span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="border rounded p-3 bg-light mb-3">
                                                <h5 class="card-title">{{ $item->name_en }}</h5>
                                                {!! nl2br(e($item->name_ar)) !!}
                                            </div>

                                            <div class="border rounded p-3 bg-light mb-3">
                                                <h6>{{ __('menu.description_en') }}</h6>
                                                {!! nl2br(e($item->description_en)) !!}
                                            </div>

                                            <div class="border rounded p-3 bg-light mb-3">
                                                <h6>{{ __('menu.description_ar') }}</h6>
                                                {!! nl2br(e($item->description_ar)) !!}
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.menu.edit', $item->id) }}"
                                                    class="btn flex-grow-1"
                                                    style="border: 1px solid #8B7355; color: #8B7355;">
                                                    <i class="fas fa-edit"></i>&nbsp;{{ __('category.edit') }}
                                                </a>
                                                <form action="{{ route('admin.menu.destroy', $item->id) }}"
                                                    method="POST" class="flex-grow-1"
                                                    onsubmit="return confirm('{{ __('category.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger w-100">
                                                        <i class="fas fa-trash"></i>&nbsp;{{ __('category.delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="fas fa-utensils fa-4x text-secondary mb-3"></i>
                                        <h4 class="text-secondary">{{ __('category.no_menu_items') }}</h4>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
