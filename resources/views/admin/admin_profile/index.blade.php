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
                                    <input id="name" disabled type="text" name="name"
                                        value="{{ old('name', $admin->name) }}" class="form-control editable-field">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.email') }}</strong></label>
                                    <input id="email" disabled type="email" name="email"
                                        value="{{ old('email', $admin->email) }}" class="form-control editable-field" 
                                        style="text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.new_password') }}</strong></label>
                                    <input id="password" disabled type="password" name="password"
                                        class="form-control editable-field">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label><strong>{{ __('admins.confirm_password') }}</strong></label>
                                    <input id="password_confirmation" disabled type="password"
                                        name="password_confirmation" class="form-control editable-field">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- زر تعديل -->
                <div class="text-center my-4">
                    <button type="button" id="editBtn" class="btn btn-primary btn-lg" style="background-color: #8B7355; border: none;">
                        <i class="fas fa-edit mr-2"></i> {{ __('admins.edit') }}
                    </button>
                </div>

                <!-- أزرار حفظ وإلغاء -->
                <div class="row mt-4">
                    <div class="col-12 text-center d-none" id="actionButtons">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-save"></i> &nbsp;{{ __('admins.update_profile') }}
                        </button>
                        <button type="button" class="btn btn-secondary btn-lg" id="cancelEdit">
                            <i class="fas fa-times"></i> &nbsp;{{ __('admins.cancel') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editBtn = document.getElementById('editBtn');
        const actionButtons = document.getElementById('actionButtons');
        const cancelBtn = document.getElementById('cancelEdit');

        const inputs = document.querySelectorAll('.editable-field');
        const originalValues = {};

        // حفظ القيم الأصلية
        inputs.forEach(input => {
            originalValues[input.name] = input.value;
        });

        // عند الضغط على "تعديل"
        editBtn.addEventListener('click', () => {
            inputs.forEach(input => input.disabled = false);
            editBtn.classList.add('d-none');
            actionButtons.classList.remove('d-none');
        });

        // عند الضغط على "إلغاء"
        cancelBtn.addEventListener('click', () => {
            inputs.forEach(input => {
                input.disabled = true;
                if (originalValues[input.name] !== undefined) {
                    input.value = originalValues[input.name];
                }
            });
            editBtn.classList.remove('d-none');
            actionButtons.classList.add('d-none');
        });
    });
</script>
@endpush
