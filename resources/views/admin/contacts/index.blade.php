@extends('admin.layouts.app')

@section('title', 'Contact Messages')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title m-0">Contact Messages Management</h3>
                </div>

                <div class="card-body">

                    {{-- فلترة حسب الحالة --}}
                    <form action="{{ route('admin.contacts.filterByIsRead') }}" method="GET" class="mb-4 d-flex align-items-center gap-3">
                        <div class="form-group mb-0">
                            <label for="status" class="form-label me-2">Filter by Status:</label>
                            <select name="status" id="status" class="form-select" onchange="this.form.submit()" style="min-width: 200px;">
                                <option value="">-- All Statuses --</option>
                                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                            </select>
                        </div>
                        @if(request('status'))
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Clear Filter</a>
                        @endif
                    </form>

                    {{-- قائمة الرسائل --}}
                    <div class="row g-4">
                        @forelse ($contacts as $contact)
                        <div class="col-md-6 col-lg-4">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="card-title text-primary mb-0">
                                            <span class="text-muted">Name:</span> {{ $contact->name }}
                                        </h5>
                                        @if($contact->is_read)
                                        <span class="badge bg-success">Read</span>
                                        @else
                                        <span class="badge bg-warning text-dark">Unread</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <i class="fas fa-envelope text-secondary me-2"></i>
                                        <span class="text-muted">Email:</span> {{ $contact->email }}
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted">Subject:</h6>
                                        <p>{{ $contact->subject }}</p>
                                    </div>

                                    <div>
                                        <i class="fas fa-clock text-secondary me-2"></i>
                                        <small class="text-muted">{{ $contact->created_at->format('Y-m-d H:i') }}</small>
                                    </div>
                                </div>

                                <div class="card-footer bg-transparent border-top-0">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-outline-primary flex-grow-1">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                        @if(!$contact->is_read)
                                        <form action="{{ route('admin.contacts.markAsRead') }}" method="POST" class="flex-grow-1 m-0">
                                            @csrf
                                            <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                            <button type="submit" class="btn btn-outline-success w-100">
                                                <i class="fas fa-check-double"></i> Mark as Read
                                            </button>
                                        </form>
                                        @endif

                                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="flex-grow-1 m-0 delete-form">
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
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-envelope fa-4x text-secondary mb-3"></i>
                            <h4 class="text-secondary">No messages found</h4>
                            <p class="text-muted">There are no messages matching your criteria.</p>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to delete this message?')) {
                this.submit();
            }
        });
    });
</script>
@endpush
