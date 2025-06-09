@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category: {{ $category->name_en }} ({{ $category->name_ar }})</h3>
                    </div>
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('admin.menu.createItemInCategory', ['id' => $category->id]) }}" class="btn btn-primary mr-2">
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
                                        <th>Description (EN)</th>
                                        <th>Description (AR)</th>
                                        <th width="10%">Price</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($category->menuItems as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name_en }}</td>
                                            <td>{{ $item->name_ar }}</td>
                                            <td>{{ $item->description_en }}</td>
                                            <td>{{ $item->description_ar }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
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
                                            <td colspan="7" class="text-center">
                                                <i class="fas fa-utensils fa-2x mb-2"></i>
                                                <p>No menu items found in this category</p>
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

    @push('scripts')
    <script>
        document.getElementById('categoryFilter').addEventListener('change', function() {
            const categoryId = this.value;
            if (categoryId) {
                window.location.href = "{{ route('admin.categories.show', '') }}/" + categoryId;
            } else {
                window.location.href = "{{ route('admin.categories.index') }}";
            }
        });
    </script>
    @endpush
@endsection
