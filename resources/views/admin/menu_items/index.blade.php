@extends('admin.layouts.app')
@section('title', 'Menu Items')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Menu Items Management</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.menu.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Menu Item
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Name (EN)</th>
                                        <th>Name (AR)</th>
                                        <th width="10%">Price</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name_en }}</td>
                                            <td>{{ $item->name_ar }}</td>
                                            <td>{{ number_format($item->price, 2) }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.menu.edit', $item->id) }}"
                                                       class="btn btn-info btn-sm"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.menu.destroy', $item->id) }}"
                                                          method="POST"
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-sm"
                                                                title="Delete"
                                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <i class="fas fa-utensils fa-2x mb-2"></i>
                                                <p>No menu items found</p>
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
