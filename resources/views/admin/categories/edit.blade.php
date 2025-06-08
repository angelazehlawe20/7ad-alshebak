@extends('admin.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-edit me-2"></i> Edit Category</h3>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_ar"><i class="fas fa-language me-1"></i> Name (Arabic)</label>
                                    <input type="text"
                                           name="name_ar"
                                           id="name_ar"
                                           class="form-control @error('name_ar') is-invalid @enderror"
                                           value="{{ old('name_ar', $category->name_ar) }}"
                                           required>
                                    @error('name_ar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name_en"><i class="fas fa-language me-1"></i> Name (English)</label>
                                    <input type="text"
                                           name="name_en"
                                           id="name_en"
                                           class="form-control @error('name_en') is-invalid @enderror"
                                           value="{{ old('name_en', $category->name_en) }}"
                                           required>
                                    @error('name_en')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back
                            </a>

                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fas fa-save me-1"></i> Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
