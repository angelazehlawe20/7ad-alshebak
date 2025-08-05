@extends('admin.layouts.app')

@section('title', __('admins.add_title'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-user-plus"></i>&nbsp; {{ __('admins.add_heading') }}</h1>
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
                            <h3 class="card-title"><i class="fas fa-user-shield"></i>&nbsp; {{ __('admins.add_heading') }}</h3>
                        </div>
                        <div class="card-body" style="background-color: #f5f5dc;">
                            <form action="{{ route('admin.admins.store') }}" method="POST">
                                @csrf

                                <div class="form-group">
                                    <label><strong>{{ __('admins.name') }}</strong></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.email') }}</strong></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.new_password') }}</strong></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password">
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.password_confirmation') }}</strong></label>
                                    <input type="password" class="form-control"
                                        name="password_confirmation">
                                </div>

                                <div class="row mt-4">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-success btn-lg">
                                            <i class="fas fa-save"></i>&nbsp; {{ __('admins.save') }}
                                        </button>
                                        <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary btn-lg">
                                            <i class="fas fa-times"></i>&nbsp; {{ __('admins.cancel') }}
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
