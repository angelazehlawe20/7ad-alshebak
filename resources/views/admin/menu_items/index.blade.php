@extends('admin.layouts.app')
@section('title', 'Menu Items')

@section('content')
    <h3>Menu Items</h3>
    <a href="{{ route('admin.menu_items.create') }}" class="btn btn-primary mb-3">Add New Menu Item</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name (EN)</th>
                <th>Name (AR)</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name_en }}</td>
                    <td>{{ $item->name_ar }}</td>
                    <td>{{ $item->price }}</td>
                    <td>
                        <a href="{{ route('admin.menu_items.edit', $item->id) }}" class="btn btn-sm btn-info">Edit</a>
                        <form action="{{ route('admin.menu_items.destroy', $item->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

