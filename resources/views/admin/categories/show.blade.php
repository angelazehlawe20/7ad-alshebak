@extends('admin.layouts.app')

@section('title', 'Category Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Category: {{ $category->name_en }} ({{ $category->name_ar }})</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.menu.createItemInCategory', ['id' => $category->id]) }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add New Menu Item
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @forelse ($category->menuItems as $item)
                                <div class="col-12 col-sm-6 col-md-4">
                                    <div class="card h-100 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">{{ $item->name_en }}</h5>
                                            <h6 class="text-muted">{{ $item->name_ar }}</h6>
                                            <p class="card-text mt-3">
                                                {{ $item->description_en }}
                                            </p>
                                            <p class="card-text">
                                                {{ $item->description_ar }}
                                            </p>
                                            <div class="d-flex align-items-center mt-3">
                                                <i class="fas fa-tag text-secondary me-2"></i>
                                                <span class="text-primary fw-bold">${{ number_format($item->price, 2) }}</span>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.menu.edit', $item->id) }}"
                                                   class="btn btn-outline-primary flex-grow-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.menu.destroy', $item->id) }}"
                                                      method="POST"
                                                      class="flex-grow-1"
                                                      onsubmit="return confirm('Are you sure you want to delete this item?')">
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
                                        <i class="fas fa-utensils fa-4x text-secondary mb-3"></i>
                                        <h4 class="text-secondary">No menu items found in this category</h4>
                                        <p class="text-muted">Add new menu items to get started.</p>
                                    </div>
                                </div>
                            @endforelse
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
