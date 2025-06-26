@extends('admin.layouts.app')

@section('title', __('admins.profile_title'))

@section('content')
<div class="container mt-4">
    <h2><i class="fas fa-user"></i> {{ __('admins.profile_heading') }}</h2>
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>{{ __('admins.name') }}</label>
            <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>{{ __('admins.email') }}</label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>{{ __('admins.new_password') }}</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>{{ __('admins.confirm_password') }}</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('admins.update_profile') }}</button>
    </form>
</div>
@endsection
