@extends('layouts.app')

@section('title', 'عرض الدور')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">إدارة الأدوار</a></li>
    <li class="breadcrumb-item active">عرض الدور</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="fas fa-user-shield fa-2x text-primary me-2"></i>
                {{ ucwords(str_replace('-', ' ', $role->name)) }}
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة للقائمة
                    </a>
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        تعديل الدور
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Role Info Card -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <div
                            class="avatar-lg rounded-circle bg-white text-primary mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-user-shield fa-3x"></i>
                        </div>
                        <h5 class="mb-0">{{ ucwords(str_replace('-', ' ', $role->name)) }}</h5>
                        <small>{{ $role->name }}</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong><i class="fas fa-key me-2"></i>الصلاحيات:</strong>
                            <span class="badge bg-info ms-2">{{ $role->permissions->count() }}</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="fas fa-users me-2"></i>المستخدمون:</strong>
                            <span class="badge bg-success ms-2">{{ $role->users->count() }}</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="fas fa-calendar me-2"></i>تاريخ الإنشاء:</strong>
                            <br>
                            <small class="text-muted">{{ $role->created_at->format('Y-m-d H:i') }}</small>
                        </div>

                        <div class="mb-3">
                            <strong><i class="fas fa-clock me-2"></i>آخر تحديث:</strong>
                            <br>
                            <small class="text-muted">{{ $role->updated_at->format('Y-m-d H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permissions & Users -->
            <div class="col-lg-8">
                <!-- Permissions Section -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-key me-2"></i>
                            الصلاحيات المخصصة ({{ $role->permissions->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($role->permissions->count() > 0)
                            @php
                                $permissionGroups = $role->permissions->groupBy(function ($permission) {
                                    return explode('-', $permission->name)[0];
                                });
                            @endphp

                            @foreach ($permissionGroups as $group => $groupPermissions)
                                <div class="mb-4">
                                    <h6 class="text-primary border-bottom pb-2">
                                        <i class="fas fa-folder me-1"></i>
                                        {{ ucwords(str_replace('-', ' ', $group)) }}
                                        <span class="badge bg-primary ms-2">{{ $groupPermissions->count() }}</span>
                                    </h6>
                                    <div class="row">
                                        @foreach ($groupPermissions as $permission)
                                            <div class="col-md-6 col-lg-4 mb-2">
                                                <span class="badge bg-success me-1">
                                                    <i class="fas fa-check me-1"></i>
                                                    {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                لا توجد صلاحيات مخصصة لهذا الدور
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Users Section -->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-users me-2"></i>
                            المستخدمون المرتبطون ({{ $role->users->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($role->users->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th><i class="fas fa-user"></i> الاسم</th>
                                            <th><i class="fas fa-envelope"></i> البريد الإلكتروني</th>
                                            <th><i class="fas fa-info-circle"></i> الحالة</th>
                                            <th><i class="fas fa-calendar"></i> تاريخ التسجيل</th>
                                            <th><i class="fas fa-cogs"></i> العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($role->users as $user)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div
                                                            class="avatar-sm rounded-circle bg-primary text-white me-2 d-flex align-items-center justify-content-center">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </div>
                                                        {{ $user->name }}
                                                    </div>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->is_approved && $user->is_active)
                                                        <span class="badge bg-success"><i class="fas fa-check"></i>
                                                            مفعل</span>
                                                    @elseif($user->is_approved && !$user->is_active)
                                                        <span class="badge bg-warning"><i class="fas fa-pause"></i>
                                                            معلق</span>
                                                    @else
                                                        <span class="badge bg-danger"><i class="fas fa-clock"></i> غير
                                                            مفعل</span>
                                                    @endif
                                                </td>
                                                <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <a href="{{ route('users.show', $user) }}"
                                                        class="btn btn-sm btn-outline-info" title="عرض المستخدم">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                لا يوجد مستخدمون مرتبطون بهذا الدور حالياً
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-tasks me-2"></i>
                            العمليات المتاحة
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                                تعديل الدور
                            </a>

                            @if ($role->users->count() == 0)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fas fa-trash"></i>
                                    حذف الدور
                                </button>
                            @else
                                <button type="button" class="btn btn-outline-danger" disabled
                                    title="لا يمكن حذف الدور لوجود مستخدمين مرتبطين به">
                                    <i class="fas fa-ban"></i>
                                    لا يمكن الحذف
                                </button>
                            @endif

                            <a href="{{ route('users.assign-roles') }}" class="btn btn-outline-success">
                                <i class="fas fa-user-plus"></i>
                                تعيين مستخدمين
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if ($role->users->count() == 0)
        <div class="modal fade" id="deleteModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            تأكيد الحذف
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3">
                            <strong>هل أنت متأكد من حذف الدور "{{ ucwords(str_replace('-', ' ', $role->name)) }}"؟</strong>
                        </p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>تحذير:</strong> هذا الإجراء لا يمكن التراجع عنه. سيتم حذف الدور وجميع الصلاحيات المرتبطة
                            به.
                        </div>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-key text-info me-2"></i>{{ $role->permissions->count() }} صلاحية سيتم
                                إلغاء ربطها</li>
                            <li><i class="fas fa-calendar text-muted me-2"></i>تاريخ الإنشاء:
                                {{ $role->created_at->format('Y-m-d') }}</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form method="POST" action="{{ route('roles.destroy', $role) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                نعم، احذف الدور
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <style>
        .avatar-lg {
            width: 80px;
            height: 80px;
            font-size: 24px;
            font-weight: bold;
        }

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
    </style>
@endsection
