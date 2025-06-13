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
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="card h-100 shadow-sm">
                                <div class="position-relative">
                                    @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                         class="card-img-top"
                                         alt="{{ $item->name_en }}"
                                         loading="lazy"
                                         style="height: 300px; object-fit: contain; background-color: #f8f9fa; padding: 10px;">
                                    @else
                                    <div class="bg-light text-center p-4" style="height: 300px;">
                                        <i class="fas fa-image fa-3x text-secondary" style="margin-top: 100px;"></i>
                                        <p class="mt-2 text-secondary">No image available</p>
                                    </div>
                                    @endif
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-primary fs-6">${{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $item->name_en }}</h5>
                                    <h6 class="text-muted">{{ $item->name_ar }}</h6>
                                    <p class="card-text small text-truncate" title="{{ $item->description_en }}">
                                        {{ $item->description_en }}
                                    </p>
                                    <p class="card-text small text-truncate" title="{{ $item->description_ar }}">
                                        {{ $item->description_ar }}
                                    </p>
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
                                            <button type="submit" class="btn btn-outline-danger w-100">
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
