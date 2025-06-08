@extends('admin.layouts.app')
@section('title', 'Offers')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Offers Management</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.offers.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add New Offer
                        </a>
                    </div>
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

                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Title (EN)</th>
                                    <th width="25%">Title (AR)</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Valid Until</th>
                                    <th width="20%">Actions</th>
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
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $offer->valid_until->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.offers.edit', $offer->id) }}"
                                                   class="btn btn-info btn-sm"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.offers.destroy', $offer->id) }}"
                                                      method="POST"
                                                      class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm delete-offer"
                                                            title="Delete"
                                                            data-id="{{ $offer->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-offer').on('click', function(e) {
            e.preventDefault();
            const button = $(this);
            const form = button.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <i class="fas fa-tag fa-2x text-muted mb-2"></i>
                                            <p class="mb-0">No offers found.</p>
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
