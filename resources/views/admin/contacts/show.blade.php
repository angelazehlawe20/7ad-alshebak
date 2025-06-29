@extends('admin.layouts.app')
@section('title', __('contact.view_message_details'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-envelope"></i> {{ __('contact.view_message_details') }}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> {{ __('contact.messages') }}
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
                            <h3 class="card-title"><i class="fas fa-user mr-2"></i>{{ __('contact.contact_details') }}</h3>
                        </div>
                        <div class="card-body" style="background-color: #f5f5dc;">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        @if($contact->name_ar)
                                        <tr>
                                            <th scope="row" width="200">{{ __('contact.your_name') }}</th>
                                            <td>{{ $contact->name_ar }}</td>
                                        </tr>
                                        @endif
                                        @if($contact->name_en)
                                        <tr>
                                            <th scope="row">{{ __('contact.your_name') }} (EN)</th>
                                            <td>{{ $contact->name_en }}</td>
                                        </tr>
                                        @endif
                                        @if($contact->email)
                                        <tr>
                                            <th scope="row">{{ __('contact.your_email') }}</th>
                                            <td>{{ $contact->email }}</td>
                                        </tr>
                                        @endif
                                        @if($contact->subject_ar)
                                        <tr>
                                            <th scope="row">{{ __('contact.subject') }}</th>
                                            <td>{{ $contact->subject_ar }}</td>
                                        </tr>
                                        @endif
                                        @if($contact->subject_en)
                                        <tr>
                                            <th scope="row">{{ __('contact.subject') }}</th>
                                            <td>{{ $contact->subject_en }}</td>
                                        </tr>
                                        @endif
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
                            <h3 class="card-title"><i class="fas fa-comment mr-2"></i>{{ __('contact.message') }}</h3>
                        </div>
                        <div class="card-body" style="background-color: #f5f5dc;">
                            @if($contact->message_ar)
                            <div class="border rounded p-3 bg-light mb-3">
                                <h6>{{ __('contact.message') }} (AR)</h6>
                                {{ $contact->message_ar }}
                            </div>
                            @endif
                            @if($contact->message_en)
                            <div class="border rounded p-3 bg-light">
                                <h6>{{ __('contact.message') }} (EN)</h6>
                                {{ $contact->message_en }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
