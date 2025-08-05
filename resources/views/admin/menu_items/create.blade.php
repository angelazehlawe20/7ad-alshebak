@extends('admin.layouts.app')

@section('title', __('menu.create_menu_item'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-utensils"></i>&nbsp;{{ __('menu.create_menu_item') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- إعادة التوجيه إلى صفحة التصنيف في حال التعديل من داخل تصنيف --}}
                <div class="row gy-4">
                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>&nbsp;{{ __('menu.basic_info') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                @if(isset($category))
                                    <input type="hidden" name="redirect_to" value="{{ route('admin.categories.show', $category->id) }}">
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                    <div class="form-group">
                                        <label><strong>{{ __('menu.category') }}:</strong></label>
                                        <p>{{ $category->name_en }} ({{ $category->name_ar }})</p>
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label><strong>{{ __('menu.category') }}</strong></label>
                                        <select name="category_id" class="form-control">
                                            <option value="">{{ __('menu.select_category') }}</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected' : '' }}>
                                                    {{ $cat->name_en }} - {{ $cat->name_ar }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label><strong>{{ __('menu.name_en') }}</strong></label>
                                    <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('menu.name_ar') }}</strong></label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('menu.price') }}</strong></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><strong>{{__('admins.syr')}}</strong></span>
                                        <input type="number" name="price" step="0.01" class="form-control font-weight-bold" value="{{ old('price') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="card bg-beige card-outline h-100">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-file-alt mr-2"></i>&nbsp;{{ __('menu.description_and_image') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('menu.description_en') }}</strong></label>
                                    <textarea name="description_en" class="form-control" rows="3">{{ old('description_en') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('menu.description_ar') }}</strong></label>
                                    <textarea name="description_ar" class="form-control" rows="3">{{ old('description_ar') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('menu.image') }}</strong></label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img src="" alt="Image Preview" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-lg" style="background-color: #8B7355; color: white; border: none;">
                            <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;{{ __('menu.create_item') }}
                        </button>
                        <a href="{{ route('admin.menu.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times"></i>&nbsp;&nbsp;{{ __('menu.cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/createMenuItemPage.js') }}"></script>
@endsection
