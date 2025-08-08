@extends('admin.layouts.app')

@section('title', __('admins.title'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <h1 class="m-0" style="color: #8B7355">
                        <i class="fas fa-users me-2"></i> {{ __('admins.list_title') }}
                    </h1>
                    <a href="{{ route('admin.admins.create') }}" class="btn"
                       style="background-color: #8B7355; color: white;">
                        <i class="fas fa-plus me-2"></i>{{ __('admins.add_admin') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-2 px-sm-0">
            <div class="row">
                @forelse($admins as $admin)
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-user me-2"></i> {{ $admin->name }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong><i class="fas fa-envelope me-2"></i> {{ __('admins.email') }}:</strong>
                                    <p class="text-muted mb-0">{{ $admin->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <strong><i class="fas fa-user-shield me-2"></i> {{ __('admins.type') }}:</strong>
                                    <div class="mt-1">
                                        @if($admin->is_owner)
                                            <span class="badge bg-primary">{{ __('admins.owner') }}</span>
                                        @else
                                            <span class="badge bg-secondary">{{ __('admins.admin') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <strong><i class="fas fa-calendar me-2"></i> {{ __('admins.created_at') }}:</strong>
                                    <p class="text-muted mb-0">{{ $admin->created_at ? $admin->created_at->format('d-m-Y') : '-' }}</p>
                                </div>

                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-flex gap-2 justify-content-between">
                                    <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn flex-grow-1"
                                       style="background-color: #8B7355; color: white;">
                                        <i class="fas fa-edit me-2"></i> {{ __('admins.edit') }}
                                    </a>
                                    <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST" class="flex-grow-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100"
                                                onclick="return confirm('{{ __('admins.delete_confirm') }}')">
                                            <i class="fas fa-trash me-2"></i> {{ __('admins.delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            {{ __('admins.no_admins') }}
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
