@extends('admin.layouts.app')
@section('title', 'Create Offer')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Create New Offer</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.offers.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_ar" class="form-label">Title (Arabic) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" required>
                                    <div class="invalid-feedback">Please provide an Arabic title.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="title_en" class="form-label">Title (English) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                                    <div class="invalid-feedback">Please provide an English title.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="description_ar" class="form-label">Description (Arabic) <small class="text-muted">(Optional)</small></label>
                                    <textarea class="form-control" id="description_ar" name="description_ar" rows="4">{{ old('description_ar') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="description_en" class="form-label">Description (English) <small class="text-muted">(Optional)</small></label>
                                    <textarea class="form-control" id="description_en" name="description_en" rows="4">{{ old('description_en') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="active" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select" id="active" name="active" required>
                                        <option value="1" {{ old('active', '1') == "1" ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('active') == "0" ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <div class="invalid-feedback">Please select a status.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="valid_until" class="form-label">Valid Until <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="valid_until" name="valid_until" value="{{ old('valid_until') }}" required>
                                    <div class="invalid-feedback">Please provide a valid date.</div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Create Offer</button>
                            <a href="{{ route('admin.offers.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Form validation
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush

@endsection
