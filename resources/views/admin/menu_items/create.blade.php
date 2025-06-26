@extends('admin.layouts.app')

@section('title', __('menu.create_menu_item'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('menu.add_new_menu_item') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.menu.store') }}" method="POST" class="needs-validation"
                        enctype="multipart/form-data" novalidate>
                        @csrf

                        {{-- إعادة التوجيه إلى صفحة التصنيف في حال التعديل من داخل تصنيف --}}
                        @if(isset($category))
                        <input type="hidden" name="redirect_to"
                            value="{{ route('admin.categories.show', $category->id) }}">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <div class="form-group mb-3">
                            <label class="form-label">{{ __('menu.category') }}:</label>
                            <p><strong>{{ $category->name_en }} ({{ $category->name_ar }})</strong></p>
                        </div>
                        @else
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">{{ __('menu.category') }}</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">{{ __('menu.select_category') }}</option>
                                @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id')==$cat->id ? 'selected' : '' }}>
                                    {{ $cat->name_en }} - {{ $cat->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @endif

                        <div class="row">
                            {{-- الاسم --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control" value="{{ old('name_en') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control" value="{{ old('name_ar') }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- الوصف --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.description_en') }}</label>
                                    <textarea name="description_en" class="form-control"
                                        rows="4">{{ old('description_en') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.description_ar') }}</label>
                                    <textarea name="description_ar" class="form-control"
                                        rows="4">{{ old('description_ar') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- السعر --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.price') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" name="price" step="0.01" class="form-control"
                                            value="{{ old('price') }}" required>
                                    </div>
                                </div>
                            </div>
                            {{-- الصورة --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.image') }}</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview" style="display: none;">
                                        <img src="" alt="Image Preview" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">{{ __('menu.create_item') }}</button>
                            <a href="{{ route('admin.menu.index') }}" class="btn btn-light">{{ __('menu.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const img = preview.querySelector('img');

        if (e.target.files && e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(e.target.files[0]);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endsection