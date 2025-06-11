@extends('admin.layouts.app')
@section('title', 'Message Details')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Message Details</h4>
                    <div class="page-title-right">
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary waves-effect waves-light pb-2" onclick="window.location.reload();">
                            <i class="fas fa-arrow-left"></i> Back to Messages
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-transparent border-bottom">
                        <h3 class="card-title m-0">Contact Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row" width="200">Name</th>
                                                <td>{{ $contact->name }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td>{{ $contact->email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Subject</th>
                                                <td>{{ $contact->subject }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Status</th>
                                                <td>
                                                    @if($contact->is_read)
                                                        <span class="badge bg-success">Read</span>
                                                    @else
                                                        <span class="badge bg-warning">Unread</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="mb-3">Message Content</h5>
                                <div class="border rounded p-3 bg-light">
                                    {{ $contact->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
