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
                                <h3 class="card-title">
                                    <i class="fas fa-inbox me-2"></i>&nbsp;{{ __('contact.messages_list') }}
                                </h3>
                                <div class="btn-group flex-wrap" role="group" aria-label="Filter messages">
                                    <a href="{{ request()->url() }}"
                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                       title="{{__('contact.all_messages')}}"
                                       class="btn {{ !request('filter') ? 'btn-outline-primary' : 'btn-outline-primary' }}"
                                       style="border-color: #8B7355; background-color: {{ !request('filter') ? '#8B7355' : 'transparent' }}; color: {{ !request('filter') ? '#fff' : '#8B7355' }}; pointer-events: {{ !request('filter') ? 'none' : 'auto' }}">
                                        <i class="fas fa-list me-2"></i>&nbsp;<span class="d-none d-sm-inline">{{ __('contact.all_messages') }}</span>
                                    </a>

                                    <a href="{{ request()->url() }}?filter=read"
                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                       title="{{__('contact.read')}}"
                                       class="btn {{ request('filter') === 'read' ? 'btn-outline-primary' : 'btn-outline-primary' }}"
                                       style="border-color: #8B7355; background-color: {{ request('filter') === 'read' ? '#8B7355' : 'transparent' }}; color: {{ request('filter') === 'read' ? '#fff' : '#8B7355' }}; pointer-events: {{ request('filter') === 'read' ? 'none' : 'auto' }}">
                                        <i class="fas fa-check-double me-2"></i>&nbsp;<span class="d-none d-sm-inline">{{ __('contact.read') }}</span>
                                    </a>

                                    <a href="{{ request()->url() }}?filter=unread"
                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                       title="{{__('contact.unread')}}"
                                       class="btn {{ request('filter') === 'unread' ? 'btn-outline-primary' : 'btn-outline-primary' }}"
                                       style="border-color: #8B7355; background-color: {{ request('filter') === 'unread' ? '#8B7355' : 'transparent' }}; color: {{ request('filter') === 'unread' ? '#fff' : '#8B7355' }}; pointer-events: {{ request('filter') === 'unread' ? 'none' : 'auto' }}">
                                        <i class="fas fa-envelope me-2"></i>&nbsp;<span class="d-none d-sm-inline">{{ __('contact.unread') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" style="background-color: #f5f5dc;">
                            <div id="messages-list">
                                @include('admin.contacts.message_list')
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
    @vite(['resources/js/app.js'])

    <script src="{{ asset('assets/js/contactAdminPage.js') }}"></script>
@endsection
