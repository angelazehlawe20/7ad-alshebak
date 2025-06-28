@extends('admin.layouts.app')

@section('title', __('admins.profile_title'))

@section('content')
<div class="container mt-4">
    <h2><i class="fas fa-user"></i> {{ __('admins.profile_heading') }}</h2>
    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label style="direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ __('admins.name') }}</label>
            <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label style="direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ __('admins.email') }}</label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required
                style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
        </div>

        <div class="mb-3">
            <label style="direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ __('admins.current_password')
                }}</label>
            <input type="password" name="old_password" class="form-control">
            @error('old_password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label style="direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ __('admins.new_password')
                }}</label>
            <input type="password" name="password" class="form-control">
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label style="direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">{{ __('admins.confirm_password')
                }}</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('admins.update_profile') }}</button>
    </form>
</div>
@endsection
