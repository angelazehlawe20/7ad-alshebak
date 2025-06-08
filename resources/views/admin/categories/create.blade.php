@extends('admin.layouts.app')

@section('title', 'Add New Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add New Category</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @include('admin.partials.alerts')

                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_ar">
                                        <i class="fas fa-language"></i> Name (Arabic)
                                    </label>
                                    <input type="text"
                                           name="name_ar"
                                           id="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           value="{{ old('name_ar') }}"
                                           required>
                                    @error('name_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_en">
                                        <i class="fas fa-language"></i> Name (English)
                                    </label>
                                    <input type="text"
                                           name="name_en"
                                           id="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           value="{{ old('name_en') }}"
                                           required>
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check-circle"></i> Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
