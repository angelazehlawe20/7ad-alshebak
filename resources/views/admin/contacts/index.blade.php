@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title m-0">Contact Messages List</h3>
                                <div class="btn-group" role="group" aria-label="Filter messages">
                                    <a href="{{ request()->url() }}"
                                        class="btn {{ !request('filter') ? 'btn-primary' : 'btn-outline-primary' }}">
                                        <i class="fas fa-list"></i> All Messages
                                    </a>
                                    <a href="{{ request()->url() }}?filter=read"
                                        class="btn {{ request('filter') === 'read' ? 'btn-primary' : 'btn-outline-primary' }}">
                                        <i class="fas fa-check-double"></i> Read
                                    </a>
                                    <a href="{{ request()->url() }}?filter=unread"
                                        class="btn {{ request('filter') === 'unread' ? 'btn-primary' : 'btn-outline-primary' }}">
                                        <i class="fas fa-envelope"></i> Unread
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row g-4">
                                @forelse ($contacts as $contact)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 {{ !$contact->is_read }}">
                                        <div class="card-header bg-transparent">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h5 class="card-title text-primary mb-0">
                                                    {{ $contact->name }}
                                                </h5>
                                                @if($contact->is_read)
                                                <span class="badge bg-success">Read</span>
                                                @else
                                                <span class="badge bg-warning">Unread</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <i class="fas fa-envelope text-secondary"></i>
                                                <span class="ms-2">{{ $contact->email }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="text-muted">Subject</h6>
                                                <p class="mb-0">{{ Str::limit($contact->subject, 100) }}</p>
                                            </div>
                                            <div class="text-muted">
                                                <i class="fas fa-clock"></i>
                                                <small class="ms-2">{{ $contact->created_at ? $contact->created_at->format('Y-m-d H:i') : '' }}</small>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <div class="btn-group w-100">
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                                        class="btn btn-primary"
                                                        data-bs-toggle="tooltip"
                                                        title="View Message Details">
                                                        <i class="fas fa-eye me-1"></i>View
                                                    </a>

                                                    @if(!$contact->is_read)
                                                    <form action="{{ route('admin.contacts.markAsRead') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                                        <button type="submit"
                                                            class="btn btn-success"
                                                            data-bs-toggle="tooltip"
                                                            title="Mark Message as Read">
                                                            <i class="fas fa-check-double me-1"></i>Mark As Read
                                                        </button>
                                                    </form>
                                                    @endif

                                                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}"
                                                        method="POST"
                                                        class="delete-form d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Delete this Message">
                                                            <i class="fas fa-trash me-1"></i>Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="fas fa-envelope fa-4x text-secondary mb-3"></i>
                                        <h4 class="text-secondary">No Messages Found</h4>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function() {
        $('.delete-form').on('submit', function(e) {
            e.preventDefault();
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
                    this.submit();
                }
            });
        });
    });
</script>
@endpush
