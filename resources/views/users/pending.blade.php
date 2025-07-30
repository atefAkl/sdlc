@extends('layouts.app')

@section('title', 'المستخدمين المعلقين')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
<li class="breadcrumb-item"><a href="{{ route('users.index') }}">إدارة المستخدمين</a></li>
<li class="breadcrumb-item active">المستخدمين المعلقين</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-clock fa-2x text-warning me-2"></i>
            المستخدمين المعلقين
            @if($pendingUsers->total() > 0)
            <span class="badge bg-warning text-dark">{{ $pendingUsers->total() }}</span>
            @endif
        </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i>
                    العودة للقائمة
                </a>
            </div>
        </div>
    </div>

    @if($pendingUsers->total() > 0)
    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <i class="fas fa-user-clock fa-3x text-warning mb-2"></i>
                    <h4 class="card-title">{{ $pendingUsers->total() }}</h4>
                    <p class="card-text text-muted">مستخدم بانتظار الموافقة</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-info">
                <div class="card-body">
                    <i class="fas fa-calendar-day fa-3x text-info mb-2"></i>
                    <h4 class="card-title">{{ $pendingUsers->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                    <p class="card-text text-muted">طلبات اليوم</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center border-success">
                <div class="card-body">
                    <i class="fas fa-user-plus fa-3x text-success mb-2"></i>
                    <h4 class="card-title">{{ $pendingUsers->where('registration_type', 'self_registered')->count() }}</h4>
                    <p class="card-text text-muted">تسجيل ذاتي</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Users Table -->
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h5 class="card-title mb-0">
                <i class="fas fa-list me-2"></i>
                قائمة المستخدمين المعلقين
            </h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th><i class="fas fa-hashtag"></i> #</th>
                            <th><i class="fas fa-user"></i> الاسم</th>
                            <th><i class="fas fa-envelope"></i> البريد الإلكتروني</th>
                            <th><i class="fas fa-tag"></i> نوع التسجيل</th>
                            <th><i class="fas fa-calendar"></i> تاريخ التسجيل</th>
                            <th><i class="fas fa-clock"></i> منذ</th>
                            <th><i class="fas fa-cogs"></i> العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingUsers as $user)
                        <tr>
                            <td>{{ $loop->iteration + ($pendingUsers->currentPage() - 1) * $pendingUsers->perPage() }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm rounded-circle bg-warning text-dark me-2 d-flex align-items-center justify-content-center">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $user->name }}</div>
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i>
                                            بانتظار الموافقة
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="mailto:{{ $user->email }}" class="text-decoration-none">
                                    {{ $user->email }}
                                </a>
                            </td>
                            <td>
                                @if($user->registration_type === 'self_registered')
                                <span class="badge bg-info">
                                    <i class="fas fa-user"></i>
                                    تسجيل ذاتي
                                </span>
                                @else
                                <span class="badge bg-primary">
                                    <i class="fas fa-user-tie"></i>
                                    إداري
                                </span>
                                @endif
                            </td>
                            <td>
                                <div>{{ $user->created_at->format('Y-m-d') }}</div>
                                <small class="text-muted">{{ $user->created_at->format('H:i') }}</small>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ $user->created_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Approve Button -->
                                    <form method="POST" action="{{ route('users.approve', $user) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm btn-success"
                                            title="تفعيل المستخدم"
                                            onclick="return confirm('هل أنت متأكد من تفعيل هذا المستخدم؟')">
                                            <i class="fas fa-check"></i>
                                            تفعيل
                                        </button>
                                    </form>

                                    <!-- View Details -->
                                    <button type="button"
                                        class="btn btn-sm btn-outline-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#userModal{{ $user->id }}"
                                        title="عرض التفاصيل">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Reject/Delete Button -->
                                    <form method="POST" action="{{ route('users.reject', $user) }}" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="رفض وحذف"
                                            onclick="return confirm('هل أنت متأكد من رفض وحذف هذا المستخدم؟ هذا الإجراء لا يمكن التراجع عنه.')">
                                            <i class="fas fa-times"></i>
                                            رفض
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- User Details Modal -->
                        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-dark">
                                        <h5 class="modal-title">
                                            <i class="fas fa-user me-2"></i>
                                            تفاصيل المستخدم
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-4"><strong>الاسم:</strong></div>
                                            <div class="col-8">{{ $user->name }}</div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4"><strong>البريد الإلكتروني:</strong></div>
                                            <div class="col-8">{{ $user->email }}</div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4"><strong>نوع التسجيل:</strong></div>
                                            <div class="col-8">
                                                @if($user->registration_type === 'self_registered')
                                                <span class="badge bg-info">تسجيل ذاتي</span>
                                                @else
                                                <span class="badge bg-primary">إداري</span>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4"><strong>تاريخ التسجيل:</strong></div>
                                            <div class="col-8">{{ $user->created_at->format('Y-m-d H:i:s') }}</div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4"><strong>IP Address:</strong></div>
                                            <div class="col-8">{{ $user->last_login_ip ?? 'غير متوفر' }}</div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4"><strong>User Agent:</strong></div>
                                            <div class="col-8">
                                                <small class="text-muted">
                                                    {{ $user->user_agent ?? 'غير متوفر' }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            إغلاق
                                        </button>
                                        <form method="POST" action="{{ route('users.approve', $user) }}" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-check"></i>
                                                تفعيل المستخدم
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($pendingUsers->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $pendingUsers->links() }}
            </div>
            @endif
        </div>
    </div>

    <!-- Bulk Actions -->
    <div class="card mt-3">
        <div class="card-header bg-light">
            <h6 class="card-title mb-0">
                <i class="fas fa-tasks me-2"></i>
                عمليات جماعية
            </h6>
        </div>
        <div class="card-body">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>ملاحظة:</strong> يمكنك تفعيل أو رفض المستخدمين بشكل فردي من الجدول أعلاه.
                العمليات الجماعية ستكون متوفرة في الإصدارات القادمة.
            </div>
        </div>
    </div>

    @else
    <!-- Empty State -->
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="fas fa-check-circle fa-5x text-success mb-4"></i>
            <h3 class="text-muted mb-3">رائع! لا يوجد مستخدمين معلقين</h3>
            <p class="text-muted mb-4">
                جميع المستخدمين تم تفعيلهم أو لا توجد طلبات تسجيل جديدة في الوقت الحالي.
            </p>
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('users.index') }}" class="btn btn-primary">
                    <i class="fas fa-users"></i>
                    عرض جميع المستخدمين
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-outline-primary">
                    <i class="fas fa-user-plus"></i>
                    إضافة مستخدم جديد
                </a>
            </div>
        </div>
    </div>
    @endif
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
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }

    .table th {
        background-color: rgba(32, 201, 151, 0.1);
        font-weight: 600;
        border-top: none;
    }

    .table td {
        vertical-align: middle;
    }

    .modal-content {
        border-radius: 10px;
    }

    .modal-header {
        border-radius: 10px 10px 0 0 !important;
    }
</style>
@endsection