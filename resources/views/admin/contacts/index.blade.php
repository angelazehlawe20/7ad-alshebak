@extends('admin.layouts.app')

@section('title', __('contact.contact_us') . ' ' . __('contact.messages'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-envelope me-2"></i>&nbsp;{{ __('contact.messages_list') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-12">
                    <div class="card bg-beige card-outline">
                        <div class="card-header bg-light">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                <h3 class="card-title"><i class="fas fa-inbox me-2"></i>&nbsp;{{
                                    __('contact.messages_list') }}</h3>
                                <div class="btn-group flex-wrap" role="group" aria-label="Filter messages">
                                    <a href="{{ request()->url() }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="{{__('contact.all_messages')}}"
                                        class="btn {{ !request('filter') ? 'btn-outline-primary' : 'btn-outline-primary' }}"
                                        style="border-color: #8B7355; background-color: {{ !request('filter') ? '#8B7355' : 'transparent' }}; color: {{ !request('filter') ? '#fff' : '#8B7355' }}; pointer-events: {{ !request('filter') ? 'none' : 'auto' }}">
                                        <i class="fas fa-list me-2"></i>&nbsp;<span class="d-none d-sm-inline">{{
                                            __('contact.all_messages') }}</span>
                                    </a>
                                    <a href="{{ request()->url() }}?filter=read" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{__('contact.read')}}"
                                        class="btn {{ request('filter') === 'read' ? 'btn-outline-primary' : 'btn-outline-primary' }}"
                                        style="border-color: #8B7355; background-color: {{ request('filter') === 'read' ? '#8B7355' : 'transparent' }}; color: {{ request('filter') === 'read' ? '#fff' : '#8B7355' }}; pointer-events: {{ request('filter') === 'read' ? 'none' : 'auto' }}">
                                        <i class="fas fa-check-double me-2"></i>&nbsp;<span
                                            class="d-none d-sm-inline">{{ __('contact.read') }}</span>
                                    </a>
                                    <a href="{{ request()->url() }}?filter=unread" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="{{__('contact.unread')}}"
                                        class="btn {{ request('filter') === 'unread' ? 'btn-outline-primary' : 'btn-outline-primary' }}"
                                        style="border-color: #8B7355; background-color: {{ request('filter') === 'unread' ? '#8B7355' : 'transparent' }}; color: {{ request('filter') === 'unread' ? '#fff' : '#8B7355' }}; pointer-events: {{ request('filter') === 'unread' ? 'none' : 'auto' }}">
                                        <i class="fas fa-envelope me-2"></i>&nbsp;<span class="d-none d-sm-inline">{{
                                            __('contact.unread') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" style="background-color: #f5f5dc;">
                            <div class="row g-4">
                                @forelse ($contacts as $contact)
                                <div class="col-12 col-sm-6 col-lg-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-transparent">
                                            <div
                                                class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                                                <h5 class="card-title mb-0 text-break" style="color: #8B7355;">{{
                                                    $contact->name }}</h5>
                                                @if($contact->is_read)
                                                <span class="badge bg-success">{{ __('contact.read') }}</span>
                                                @else
                                                <span class="badge bg-warning">{{ __('contact.unread') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <i class="fas fa-envelope text-secondary me-2"></i>&nbsp;
                                                <span class="text-break">{{ $contact->email }}</span>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="text-muted">{{ __('contact.subject') }}</h6>
                                                <p class="mb-0 text-break">{{ Str::limit($contact->subject, 100) }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6 class="text-muted">{{ __('contact.message') }}</h6>
                                                <p class="mb-0 text-break" style="white-space: pre-line">{{
                                                    Str::limit($contact->message, 150) }}</p>
                                            </div>
                                            <div class="text-muted">
                                                <i class="fas fa-clock me-2"></i>&nbsp;
                                                <small>{{ $contact->created_at?->format('Y-m-d H:i') }}</small>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-transparent">
                                            <div class="d-flex flex-wrap gap-2 w-100">
                                                <a href="{{ route('admin.contacts.show', $contact->id) }}"
                                                    class="btn btn-outline-primary flex-grow-1"
                                                    style="border-color: #8B7355; color: #8B7355; background-color: transparent !important;"
                                                    title="{{ __('contact.view_message_details') }}">
                                                    <i class="fas fa-eye"></i>&nbsp;<span class="d-none d-sm-inline">{{
                                                        __('contact.view') }}</span>
                                                </a>
                                                @if(!$contact->is_read)
                                                <form action="{{ route('admin.contacts.markAsRead') }}" method="POST"
                                                    class="flex-grow-1">
                                                    @csrf
                                                    <input type="hidden" name="contact_id" value="{{ $contact->id }}">
                                                    <button type="submit" class="btn btn-outline-success w-100"
                                                        style="border-color: #28a745; color: #28a745; background-color: transparent !important;"
                                                        title="{{ __('contact.message_as_read') }}">
                                                        <i class="fas fa-check-double"></i>&nbsp;<span
                                                            class="d-none d-sm-inline">{{ __('contact.message_as_read')
                                                            }}</span>
                                                    </button>
                                                </form>
                                                @endif
                                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}"
                                                    method="POST" class="delete-form flex-grow-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger w-100"
                                                        style="border-color: #dc3545; color: #dc3545; background-color: transparent !important;"
                                                        title="{{ __('contact.delete') }}">
                                                        <i class="fas fa-trash"></i>&nbsp;<span
                                                            class="d-none d-sm-inline">{{ __('contact.delete') }}</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <i class="fas fa-envelope fa-4x text-secondary mb-3"></i>
                                        <h4 class="text-secondary">{{ __('contact.no_messages_found') }}</h4>
                                    </div>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<script src="{{ asset('assets/js/contactAdminPage.js') }}"></script>
@endsection
