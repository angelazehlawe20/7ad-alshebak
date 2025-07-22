@extends('admin.layouts.app')
@section('title', __('contact.view_message_details'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-envelope me-2"></i> {{ __('contact.view_message_details') }}</h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary btn-lg px-4">
                        <i class="fas fa-arrow-left me-2"></i> {{ __('contact.messages') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-beige card-outline">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><i class="fas fa-user me-2"></i>{{ __('contact.contact_details') }}</h3>
                        </div>
                        <div class="card-body" style="background-color: #f5f5dc;">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row">{{ __('contact.your_name') }}</th>
                                            <td>{{ $contact->name }}</td>
                                        </tr>
                                        @if($contact->email)
                                        <tr>
                                            <th scope="row">{{ __('contact.your_email') }}</th>
                                            <td>{{ $contact->email }}</td>
                                        </tr>
                                        @endif
                                        
                                        <tr>
                                            <th scope="row">{{ __('contact.subject') }}</th>
                                            <td>{{ $contact->subject }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('contact.status') ?? 'Status' }}</th>
                                            <td>
                                                @if($contact->is_read)
                                                    <span class="badge bg-success">{{ __('contact.read') }}</span>
                                                @else
                                                    <span class="badge bg-warning">{{ __('contact.unread') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">{{ __('contact.sent_at') ?? 'Sent At' }}</th>
                                            <td>{{ $contact->created_at }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card bg-beige card-outline">
                        <div class="card-header bg-light">
                            <h3 class="card-title"><i class="fas fa-comment me-2"></i>{{ __('contact.message') }}</h3>
                        </div>
                        <div class="card-body" style="background-color: #f5f5dc;">
                            <div class="border rounded p-3 bg-light mb-3">
                                <h6>{{ __('contact.message') }}</h6>
                                {!! nl2br(e($contact->message)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
