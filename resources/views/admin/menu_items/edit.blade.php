@extends('admin.layouts.app')

@section('title', __('menu.edit_menu_item'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('menu.edit_menu_item') }}</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('admin.menu.update', $menuItem->id) }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- حقل redirect_to لإعادة التوجيه --}}
                        <input type="hidden" name="redirect_to" value="{{ url()->previous() }}">

                        {{-- اختيار التصنيف --}}
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">{{ __('menu.category') }}</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $menuItem->category_id) ==
                                    $category->id ? 'selected' : '' }}>
                                    {{ $category->name_en }} - {{ $category->name_ar }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            {{-- الاسم بالإنكليزي --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.name_en') }}</label>
                                    <input type="text" name="name_en" class="form-control"
                                        value="{{ old('name_en', $menuItem->name_en) }}" required>
                                </div>
                            </div>
                            {{-- الاسم بالعربي --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.name_ar') }}</label>
                                    <input type="text" name="name_ar" class="form-control"
                                        value="{{ old('name_ar', $menuItem->name_ar) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            {{-- الوصف بالإنكليزي --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.description_en') }}</label>
                                    <textarea name="description_en" class="form-control"
                                        rows="4">{{ old('description_en', $menuItem->description_en) }}</textarea>
                                </div>
                            </div>
                            {{-- الوصف بالعربي --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.description_ar') }}</label>
                                    <textarea name="description_ar" class="form-control"
                                        rows="4">{{ old('description_ar', $menuItem->description_ar) }}</textarea>
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
                                            value="{{ old('price', $menuItem->price) }}" required>
                                    </div>
                                </div>
                            </div>
                            {{-- رفع الصورة --}}
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('menu.image') }}</label>
                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <div class="mt-2" id="imagePreview"
                                        style="display: {{ $menuItem->image ? 'block' : 'none' }};">
                                        <img src="{{ $menuItem->image ? asset('storage/' . $menuItem->image) : '' }}"
                                            alt="Menu Item Image" class="img-thumbnail">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">{{ __('menu.update_item') }}</button>
                            <a href="{{ url()->previous() }}" class="btn btn-light">{{ __('menu.cancel') }}</a>
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