@extends('admin.layouts.app')
@section('title', 'Offers')

@section('content')
<h3>Offers</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('admin.offers.create') }}" class="btn btn-primary mb-3">Add New Offer</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Title (EN)</th>
            <th>Title (AR)</th>
            <th>Active</th>
            <th>Valid Until</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($offers as $offer)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $offer->title_en }}</td>
                <td>{{ $offer->title_ar }}</td>
                <td>
                    @if($offer->active)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>{{ $offer->valid_until->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('admin.offers.edit', $offer->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure you want to delete this offer?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No offers found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
