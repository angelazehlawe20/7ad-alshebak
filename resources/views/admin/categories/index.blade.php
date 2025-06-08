@extends('admin.layouts.app')

@section('title', 'Manage Categories')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories Management</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mr-2">
                                <i class="fas fa-plus"></i> Add New Category
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('admin.partials.alerts')

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name (EN)</th>
                                        <th>Name (AR)</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $category->name_en }}</td>
                                            <td>{{ $category->name_ar }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.categories.show', $category->id) }}"
                                                       class="btn btn-secondary btn-sm"
                                                       title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                       class="btn btn-info btn-sm"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                          method="POST"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this category?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <i class="fas fa-list-alt fa-2x mb-2"></i>
                                                <p>No categories found</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
