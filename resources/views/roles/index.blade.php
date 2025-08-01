@extends('layouts.app')

@section('title', 'إدارة الأدوار')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item active">إدارة الأدوار</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="fas fa-users-cog fa-2x text-primary me-2"></i>
                إدارة الأدوار
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('roles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        إضافة دور جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- Roles Table -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>
                    قائمة الأدوار ({{ $roles->total() }})
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th><i class="fas fa-hashtag"></i> #</th>
                                <th><i class="fas fa-tag"></i> اسم الدور</th>
                                <th><i class="fas fa-key"></i> عدد الصلاحيات</th>
                                <th><i class="fas fa-users"></i> عدد المستخدمين</th>
                                <th><i class="fas fa-calendar"></i> تاريخ الإنشاء</th>
                                <th><i class="fas fa-cogs"></i> العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration + ($roles->currentPage() - 1) * $roles->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="avatar-sm rounded-circle bg-primary text-white me-2 d-flex align-items-center justify-content-center">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                            <div>
                                                <strong>{{ ucwords(str_replace('-', ' ', $role->name)) }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $role->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            <i class="fas fa-key me-1"></i>
                                            {{ $role->permissions->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-users me-1"></i>
                                            {{ $role->users->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>{{ $role->created_at->format('Y-m-d') }}</div>
                                        <small class="text-muted">{{ $role->created_at->format('H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('roles.show', $role) }}" class="btn btn-sm btn-outline-info"
                                                title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('roles.edit', $role) }}"
                                                class="btn btn-sm btn-outline-primary" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-success"
                                                data-bs-toggle="modal"
                                                data-bs-target="#permissionsModal{{ $role->id }}"
                                                title="إدارة الصلاحيات">
                                                <i class="fas fa-key"></i>
                                            </button>
                                            @if ($role->users->count() == 0)
                                                <form method="POST" action="{{ route('roles.destroy', $role) }}"
                                                    class="d-inline"
                                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الدور؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="حذف">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    title="لا يمكن حذف الدور لوجود مستخدمين مرتبطين به" disabled>
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                                <!-- Permissions Modal -->
                                <div class="modal fade" id="permissionsModal{{ $role->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">
                                                    <i class="fas fa-key me-2"></i>
                                                    صلاحيات دور: {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST"
                                                    action="{{ route('roles.assign-permissions', $role) }}">
                                                    @csrf
                                                    <div class="row">
                                                        @forelse($role->permissions as $permission)
                                                            <div class="col-md-4 mb-2">
                                                                <span class="badge bg-success me-1">
                                                                    <i class="fas fa-check me-1"></i>
                                                                    {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                                                                </span>
                                                            </div>
                                                        @empty
                                                            <div class="col-12">
                                                                <div class="alert alert-warning">
                                                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                                                    لا توجد صلاحيات مخصصة لهذا الدور
                                                                </div>
                                                            </div>
                                                        @endforelse
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">إغلاق</button>
                                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    تعديل الصلاحيات
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-users-cog fa-3x text-muted mb-3 d-block"></i>
                                        <h5 class="text-muted">لا توجد أدوار</h5>
                                        <a href="{{ route('roles.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus"></i>
                                            إضافة أول دور
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($roles->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $roles->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users-cog fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-0">{{ $roles->total() }}</h5>
                                <small>إجمالي الأدوار</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-key fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-0">
                                    {{ $roles->sum(function ($role) {return $role->permissions->count();}) }}</h5>
                                <small>إجمالي الصلاحيات المخصصة</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users fa-2x me-3"></i>
                            <div>
                                <h5 class="mb-0">{{ $roles->sum(function ($role) {return $role->users->count();}) }}
                                </h5>
                                <small>إجمالي المستخدمين المرتبطين</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 14px;
            font-weight: bold;
        }

        .card {
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(32, 201, 151, 0.05);
        }
    </style>
@endsection
