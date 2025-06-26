@extends('admin.layouts.app')
@section('title', __('contact.view_message_details'))

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">{{ __('contact.view_message_details') }}</h4>
                <div class="page-title-right">
                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary waves-effect waves-light pb-2" onclick="window.location.reload();">
                        <i class="fas fa-arrow-left"></i> {{ __('contact.messages') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <h3 class="card-title m-0">{{ __('contact.contact') }} {{ __('contact.us') }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
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

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">{{ __('contact.message') }}</h5>
                            @if($contact->message_ar)
                            <div class="border rounded p-3 bg-light mb-3">
                                <h6>{{ __('contact.message') }}</h6>
                                {{ $contact->message_ar }}
                            </div>
                            @endif
                            @if($contact->message_en)
                            <div class="border rounded p-3 bg-light">
                                <h6>{{ __('contact.message') }}</h6>
                                {{ $contact->message_en }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
