@extends('admin.layouts.app')

@section('title', __('category.categories_management'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">{{ __('category.categories_management') }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> {{ __('category.add_new_category') }}
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
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.categories.show', $category->id) }}"
                                                   class="btn btn-outline-secondary flex-grow-1">
                                                    <i class="fas fa-eye"></i> {{ __('category.view') }}
                                                </a>
                                                <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                   class="btn btn-outline-primary flex-grow-1">
                                                    <i class="fas fa-edit"></i> {{ __('category.edit') }}
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                      method="POST"
                                                      class="flex-grow-1"
                                                      onsubmit="return confirm('{{ __('category.confirm_delete') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-outline-danger w-100">
                                                        <i class="fas fa-trash"></i> {{ __('category.delete') }}
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
                                        <h4 class="text-secondary">{{ __('category.no_categories_found') }}</h4>
                                        <p class="text-muted">{{ __('category.add_to_get_started') }}</p>
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
