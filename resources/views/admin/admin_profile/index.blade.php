@extends('admin.layouts.app')

@section('title', __('admins.profile_title'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-user"></i> &nbsp;{{ __('admins.profile_heading') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">

            <form action="{{ route('admin.profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-beige card-outline">
                            <div class="card-header bg-light">
                                <h3 class="card-title"><i class="fas fa-user-edit"></i> &nbsp;{{ __('admins.profile_details') }}</h3>
                            </div>
                            <div class="card-body" style="background-color: #f5f5dc;">
                                <div class="form-group">
                                    <label><strong>{{ __('admins.name') }}</strong></label>
                                    <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.email') }}</strong></label>
                                    <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.new_password') }}</strong></label>
                                    <input type="password" name="password" class="form-control">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.confirm_password') }}</strong></label>
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save"></i> &nbsp;{{ __('admins.update_profile') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
