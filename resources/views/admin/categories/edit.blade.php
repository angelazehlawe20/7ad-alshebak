@extends('admin.layouts.app')

@section('title', __('category.edit_category'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-edit"></i> {{ __('category.edit_category') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-language mr-2"></i>{{ __('category.name_arabic') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <input type="text"
                                           name="name_ar"
                                           id="name_ar"
                                           class="form-control"
                                           value="{{ old('name_ar', $category->name_ar) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-language mr-2"></i>{{ __('category.name_english') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <input type="text"
                                           name="name_en"
                                           id="name_en"
                                           class="form-control"
                                           value="{{ old('name_en', $category->name_en) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-arrow-left mr-2"></i> {{ __('category.back') }}
                        </a>

                        <button type="submit" class="btn btn-success btn-lg save-changes-btn">
                            <i class="fas fa-save mr-2"></i> {{ __('category.update_category') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
