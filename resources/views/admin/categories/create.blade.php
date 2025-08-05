@extends('admin.layouts.app')

@section('title', __('category.add_new_category'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-plus"></i>&nbsp;{{ __('category.add_new_category') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <form action="{{ route('admin.categories.store') }}" method="POST" id="categoryForm">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-language mr-2"></i>&nbsp;{{ __('category.name_arabic') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <input type="text"
                                           name="name_ar"
                                           id="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           value="{{ old('name_ar') }}">
                                    @error('name_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-language mr-2"></i>&nbsp;{{ __('category.name_english') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <input type="text"
                                           name="name_en"
                                           id="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           value="{{ old('name_en') }}">
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save mr-2"></i>&nbsp;{{ __('category.create_category') }}
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times mr-2"></i>&nbsp;{{ __('category.cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
