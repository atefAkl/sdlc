@extends('layouts.app')

@section('title', 'عرض الصلاحية')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">إدارة الصلاحيات</a></li>
    <li class="breadcrumb-item active">عرض الصلاحية</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="fas fa-key fa-2x text-warning me-2"></i>
                {{ ucwords(str_replace('-', ' ', $permission->name)) }}
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة للقائمة
                    </a>
                    <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        تعديل الصلاحية
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Permission Info Card -->
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <div class="card-header bg-warning text-dark text-center">
                        <div
                            class="avatar-lg rounded-circle bg-white text-warning mx-auto mb-3 d-flex align-items-center justify-content-center">
                            <i class="fas fa-key fa-3x"></i>
                        </div>
                        <h5 class="mb-0">{{ ucwords(str_replace('-', ' ', $permission->name)) }}</h5>
                        <small>{{ $permission->name }}</small>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong><i class="fas fa-layer-group me-2"></i>المجموعة:</strong>
                            <span
                                class="badge bg-info ms-2">{{ ucwords(str_replace('-', ' ', explode('-', $permission->name)[0])) }}</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="fas fa-user-shield me-2"></i>الأدوار:</strong>
                            <span class="badge bg-primary ms-2">{{ $permission->roles->count() }}</span>
                        </div>

                        @php
                            $totalUsers = $permission->roles->sum(fn($role) => $role->users->count());
                        @endphp
                        <div class="mb-3">
                            <strong><i class="fas fa-users me-2"></i>المستخدمون:</strong>
                            <span class="badge bg-success ms-2">{{ $totalUsers }}</span>
                        </div>

                        <div class="mb-3">
                            <strong><i class="fas fa-calendar me-2"></i>تاريخ الإنشاء:</strong>
                            <br>
                            <small class="text-muted">{{ $permission->created_at->format('Y-m-d H:i') }}</small>
                        </div>

                        <div class="mb-3">
                            <strong><i class="fas fa-clock me-2"></i>آخر تحديث:</strong>
                            <br>
                            <small class="text-muted">{{ $permission->updated_at->format('Y-m-d H:i') }}</small>
                        </div>

                        <!-- Status Badge -->
                        <div class="text-center mt-3">
                            @if ($permission->roles->count() > 0)
                                <span class="badge bg-success px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>
                                    صلاحية مستخدمة
                                </span>
                            @else
                                <span class="badge bg-warning px-3 py-2">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    صلاحية غير مستخدمة
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Roles & Users -->
            <div class="col-lg-8">
                <!-- Roles Section -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-shield me-2"></i>
                            الأدوار المرتبطة ({{ $permission->roles->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($permission->roles->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th><i class="fas fa-user-shield"></i> اسم الدور</th>
                                            <th><i class="fas fa-key"></i> إجمالي الصلاحيات</th>
                                            <th><i class="fas fa-users"></i> عدد المستخدمين</th>
                                            <th><i class="fas fa-calendar"></i> تاريخ الإنشاء</th>
                                            <th><i class="fas fa-cogs"></i> العمليات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission->roles as $role)
                                            <tr>
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
                                                    <span class="badge bg-info">{{ $role->permissions->count() }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">{{ $role->users->count() }}</span>
                                                </td>
                                                <td>
                                                    <small
                                                        class="text-muted">{{ $role->created_at->format('Y-m-d') }}</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('roles.show', $role) }}"
                                                            class="btn btn-outline-info" title="عرض الدور">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('roles.edit', $role) }}"
                                                            class="btn btn-outline-primary" title="تعديل الدور">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                هذه الصلاحية غير مرتبطة بأي دور حالياً
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Users Section -->
                @if ($permission->roles->count() > 0)
                    <div class="card mb-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-users me-2"></i>
                                المستخدمون المتأثرون ({{ $totalUsers }})
                            </h5>
                        </div>
                        <div class="card-body">
                            @if ($totalUsers > 0)
                                @php
                                    $allUsers = collect();
                                    foreach ($permission->roles as $role) {
                                        foreach ($role->users as $user) {
                                            if (!$allUsers->contains('id', $user->id)) {
                                                $user->role_names = collect([$role->name]);
                                                $allUsers->push($user);
                                            } else {
                                                $existingUser = $allUsers->firstWhere('id', $user->id);
                                                $existingUser->role_names->push($role->name);
                                            }
                                        }
                                    }
                                @endphp

                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th><i class="fas fa-user"></i> الاسم</th>
                                                <th><i class="fas fa-envelope"></i> البريد الإلكتروني</th>
                                                <th><i class="fas fa-user-shield"></i> الأدوار</th>
                                                <th><i class="fas fa-info-circle"></i> الحالة</th>
                                                <th><i class="fas fa-cogs"></i> العمليات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($allUsers as $user)
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
                                                        @foreach ($user->role_names as $roleName)
                                                            <span
                                                                class="badge bg-secondary me-1 mb-1">{{ ucwords(str_replace('-', ' ', $roleName)) }}</span>
                                                        @endforeach
                                                    </td>
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
                                    لا يوجد مستخدمون يملكون هذه الصلاحية حالياً
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Related Permissions -->
                @php
                    $group = explode('-', $permission->name)[0];
                    $relatedPermissions = $permissions->filter(function ($p) use ($permission, $group) {
                        return $p->id !== $permission->id && str_starts_with($p->name, $group . '-');
                    });
                @endphp

                @if ($relatedPermissions->count() > 0)
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-layer-group me-2"></i>
                                صلاحيات مرتبطة من مجموعة "{{ ucwords(str_replace('-', ' ', $group)) }}"
                                ({{ $relatedPermissions->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($relatedPermissions as $related)
                                    <div class="col-md-6 col-lg-4 mb-3">
                                        <div class="card border">
                                            <div class="card-body p-3">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div class="flex-grow-1">
                                                        <h6 class="card-title mb-1">
                                                            {{ ucwords(str_replace('-', ' ', $related->name)) }}</h6>
                                                        <small class="text-muted">{{ $related->name }}</small>
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                            type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('permissions.show', $related) }}">
                                                                    <i class="fas fa-eye me-2"></i>عرض
                                                                </a></li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('permissions.edit', $related) }}">
                                                                    <i class="fas fa-edit me-2"></i>تعديل
                                                                </a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between text-muted">
                                                    <small><i
                                                            class="fas fa-user-shield me-1"></i>{{ $related->roles->count() }}
                                                        دور</small>
                                                    <small><i
                                                            class="fas fa-users me-1"></i>{{ $related->roles->sum(fn($r) => $r->users->count()) }}
                                                        مستخدم</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
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
                            <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                                تعديل الصلاحية
                            </a>

                            @if ($permission->roles->count() == 0)
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fas fa-trash"></i>
                                    حذف الصلاحية
                                </button>
                            @else
                                <button type="button" class="btn btn-outline-danger" disabled
                                    title="لا يمكن حذف الصلاحية لوجود أدوار مرتبطة بها">
                                    <i class="fas fa-ban"></i>
                                    لا يمكن الحذف
                                </button>
                            @endif

                            <a href="{{ route('roles.assign-permissions', ['permissions' => [$permission->id]]) }}"
                                class="btn btn-outline-success">
                                <i class="fas fa-user-shield"></i>
                                تعيين لأدوار
                            </a>

                            <a href="{{ route('permissions.create') }}" class="btn btn-outline-info">
                                <i class="fas fa-plus"></i>
                                إضافة صلاحية جديدة
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    @if ($permission->roles->count() == 0)
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
                            <strong>هل أنت متأكد من حذف الصلاحية
                                "{{ ucwords(str_replace('-', ' ', $permission->name)) }}"؟</strong>
                        </p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>تحذير:</strong> هذا الإجراء لا يمكن التراجع عنه.
                        </div>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-key text-warning me-2"></i>الصلاحية: {{ $permission->name }}</li>
                            <li><i class="fas fa-layer-group text-info me-2"></i>المجموعة:
                                {{ explode('-', $permission->name)[0] }}</li>
                            <li><i class="fas fa-calendar text-muted me-2"></i>تاريخ الإنشاء:
                                {{ $permission->created_at->format('Y-m-d') }}</li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <form method="POST" action="{{ route('permissions.destroy', $permission) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                                نعم، احذف الصلاحية
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
