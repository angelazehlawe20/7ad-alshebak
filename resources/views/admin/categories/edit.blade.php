@extends('admin.layouts.app')

@section('title', __('category.edit_category'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit me-2"></i> {{ __('category.edit_category') }}
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_ar">
                                        <i class="fas fa-language me-1"></i> {{ __('category.name_arabic') }}
                                    </label>
                                    <input type="text"
                                           name="name_ar"
                                           id="name_ar"
                                           class="form-control"
                                           value="{{ old('name_ar', $category->name_ar) }}"
                                           required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_en">
                                        <i class="fas fa-language me-1"></i> {{ __('category.name_english') }}
                                    </label>
                                    <input type="text"
                                           name="name_en"
                                           id="name_en"
                                           class="form-control"
                                           value="{{ old('name_en', $category->name_en) }}"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> {{ __('category.back') }}
                            </a>

                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fas fa-save me-1"></i> {{ __('category.update_category') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
