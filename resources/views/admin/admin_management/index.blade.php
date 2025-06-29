@extends('admin.layouts.app')

@section('title', __('admins.title'))

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-users"></i> {{ __('admins.list_title') }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid px-0">
            <div class="card bg-beige card-outline">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><i class="fas fa-list mr-2"></i>{{ __('admins.list_title') }}</h3>
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> {{ __('admins.add_admin') }}
                    </a>
                </div>
                <div class="card-body" style="background-color: #f5f5dc;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ __('admins.name') }}</th>
                                    <th>{{ __('admins.email') }}</th>
                                    <th>{{ __('admins.type') }}</th>
                                    <th>{{ __('admins.created_at') }}</th>
                                    <th>{{ __('admins.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @if($admin->is_owner)
                                        <span class="badge bg-primary">{{ __('admins.owner') }}</span>
                                        @else
                                        <span class="badge bg-secondary">{{ __('admins.admin') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $admin->created_at ? $admin->created_at->format('Y-m-d') : '-' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('admin.admins.edit', $admin) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i> {{ __('admins.edit') }}
                                            </a>
                                            <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('{{ __('admins.delete_confirm') }}')">
                                                    <i class="fas fa-trash"></i> {{ __('admins.delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">{{ __('admins.no_admins') }}</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
