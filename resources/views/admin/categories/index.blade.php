@extends('admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Categories Management</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Category
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @forelse ($categories as $category)
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">{{ $category->name_en }}</h5>
                                            <h6 class="text-muted">{{ $category->name_ar }}</h6>
                                            <div class="d-flex align-items-center mt-3">
                                                <i class="fas fa-tag text-secondary me-2"></i>
                                                <small class="text-muted">Category {{ $loop->iteration }}</small>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                                   class="btn btn-outline-secondary flex-grow-1">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                   class="btn btn-outline-primary flex-grow-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                      method="POST"
                                                      class="flex-grow-1"
                                                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-outline-danger w-100">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="fas fa-list-alt fa-4x text-secondary mb-3"></i>
                                        <h4 class="text-secondary">No categories found</h4>
                                        <p class="text-muted">Add new categories to get started.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
