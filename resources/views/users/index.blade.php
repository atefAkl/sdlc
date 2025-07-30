@extends('layouts.app')

@section('title', 'إدارة المستخدمين')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
<li class="breadcrumb-item active">إدارة المستخدمين</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-users fa-2x text-primary me-2"></i>
            إدارة المستخدمين
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    إضافة مستخدم جديد
                </a>
            </div>
        </div>
    </div>

    <!-- Users Tabs -->
    <ul class="nav nav-tabs" id="usersTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-users-tab" data-bs-toggle="tab" data-bs-target="#all-users" type="button" role="tab">
                <i class="fas fa-users"></i>
                جميع المستخدمين ({{ $users->total() }})
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-users" type="button" role="tab">
                <i class="fas fa-user-shield"></i>
                مديرو التطبيق
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="staff-tab" data-bs-toggle="tab" data-bs-target="#staff-users" type="button" role="tab">
                <i class="fas fa-user-tie"></i>
                الموظفون الإداريون
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="dev-tab" data-bs-toggle="tab" data-bs-target="#dev-users" type="button" role="tab">
                <i class="fas fa-code"></i>
                المطورون والمنتورز
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="client-tab" data-bs-toggle="tab" data-bs-target="#client-users" type="button" role="tab">
                <i class="fas fa-handshake"></i>
                العملاء
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="intern-tab" data-bs-toggle="tab" data-bs-target="#intern-users" type="button" role="tab">
                <i class="fas fa-graduation-cap"></i>
                متدربين/طرف ثالث
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link text-warning" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending-users" type="button" role="tab">
                <i class="fas fa-clock"></i>
                بانتظار الموافقة
                @if($users->where('is_approved', false)->count() > 0)
                <span class="badge bg-warning">{{ $users->where('is_approved', false)->count() }}</span>
                @endif
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="usersTabContent">
        <!-- All Users Tab -->
        <div class="tab-pane fade show active" id="all-users" role="tabpanel">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th><i class="fas fa-hashtag"></i> #</th>
                                    <th><i class="fas fa-user"></i> الاسم</th>
                                    <th><i class="fas fa-envelope"></i> البريد الإلكتروني</th>
                                    <th><i class="fas fa-shield-alt"></i> الأدوار</th>
                                    <th><i class="fas fa-calendar"></i> تاريخ التسجيل</th>
                                    <th><i class="fas fa-info-circle"></i> الحالة</th>
                                    <th><i class="fas fa-cogs"></i> العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm rounded-circle bg-primary text-white me-2 d-flex align-items-center justify-content-center">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            {{ $user->name }}
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @forelse($user->roles as $role)
                                        <span class="badge bg-secondary me-1">{{ $role->name }}</span>
                                        @empty
                                        <span class="text-muted">لا يوجد أدوار</span>
                                        @endforelse
                                    </td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        @if($user->is_approved && $user->is_active)
                                        <span class="badge bg-success"><i class="fas fa-check"></i> مفعل</span>
                                        @elseif($user->is_approved && !$user->is_active)
                                        <span class="badge bg-warning"><i class="fas fa-pause"></i> معلق</span>
                                        @else
                                        <span class="badge bg-danger"><i class="fas fa-clock"></i> غير مفعل</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('users.show', $user) }}" class="btn btn-sm btn-outline-info" title="عرض">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            @if(!$user->is_approved)
                                            <form method="POST" action="{{ route('users.approve', $user) }}" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-success" title="تفعيل">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            @endif
                                            <form method="POST" action="{{ route('users.destroy', $user) }}" class="d-inline"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-users fa-3x text-muted mb-3 d-block"></i>
                                        <h5 class="text-muted">لا يوجد مستخدمين</h5>
                                        <a href="{{ route('users.create') }}" class="btn btn-primary mt-2">
                                            <i class="fas fa-plus"></i>
                                            إضافة أول مستخدم
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($users->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Other tabs will be populated via AJAX for better performance -->
        <div class="tab-pane fade" id="admin-users" role="tabpanel">
            <div class="card mt-3">
                <div class="card-body text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                    <p>جاري تحميل البيانات...</p>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="staff-users" role="tabpanel">
            <div class="card mt-3">
                <div class="card-body text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                    <p>جاري تحميل البيانات...</p>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="dev-users" role="tabpanel">
            <div class="card mt-3">
                <div class="card-body text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                    <p>جاري تحميل البيانات...</p>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="client-users" role="tabpanel">
            <div class="card mt-3">
                <div class="card-body text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                    <p>جاري تحميل البيانات...</p>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="intern-users" role="tabpanel">
            <div class="card mt-3">
                <div class="card-body text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                    <p>جاري تحميل البيانات...</p>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pending-users" role="tabpanel">
            <div class="card mt-3">
                <div class="card-body text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-2x text-primary mb-3"></i>
                    <p>جاري تحميل البيانات...</p>
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

    .nav-tabs .nav-link {
        border-radius: 0.5rem 0.5rem 0 0;
        margin-bottom: -1px;
    }

    .nav-tabs .nav-link.active {
        background-color: var(--bs-primary);
        color: white !important;
        border-color: var(--bs-primary);
    }

    .table th {
        background-color: rgba(32, 201, 151, 0.1);
        font-weight: 600;
    }
</style>
@endsection