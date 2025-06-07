@extends('admin.layouts.app')
@section('title', 'Contact Messages')

@section('content')
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <h3 class="mb-3">Contact Messages</h3>

                <!-- Filter -->
                <div class="card">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.contacts.index') }}" class="d-flex gap-2">
                            <div style="max-width: 200px;">
                                <select name="status" class="form-select">
                                    <option value="">All Status</option>
                                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
                                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                                </select>
                            </div>
                            <div class="flex-grow-1">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Search by name, email, or subject"
                                        value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Search
                                    </button>
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-undo"></i> Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Table -->
                <div class="card mt-4">
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Sent At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>
                                            <a href="mailto:{{ $contact->email }}" class="text-decoration-none">
                                                {{ $contact->email }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="text-wrap" style="max-width: 200px;">
                                                {{ Str::limit($contact->subject, 50) }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $contact->is_read ? 'success' : 'warning' }}">
                                                {{ $contact->is_read ? 'Read' : 'Unread' }}
                                            </span>
                                        </td>
                                        <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                                    class="btn btn-info"
                                                    data-bs-toggle="tooltip"
                                                    title="View Message">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                @if(!$contact->is_read)
                                                    <form action="{{ route('admin.contacts.markAsRead', $contact->id) }}"
                                                        method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="btn btn-success"
                                                            data-bs-toggle="tooltip"
                                                            title="Mark as Read">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif

                                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}"
                                                    method="POST"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger"
                                                        data-bs-toggle="tooltip"
                                                        title="Delete Message">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="text-muted">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <div>No messages found</div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-4">
                    {{ $contacts->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Delete confirmation
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
@endsection
