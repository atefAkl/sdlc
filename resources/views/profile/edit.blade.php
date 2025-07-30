@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
<li class="breadcrumb-item active">الملف الشخصي</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-user-edit fa-2x text-primary me-2"></i>
            الملف الشخصي
        </h1>
    </div>

    <div class="row">
        <!-- Profile Info Card -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <div class="avatar-lg rounded-circle bg-white text-primary mx-auto mb-3 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                    <h5 class="mb-0">{{ $user->name }}</h5>
                    <small>{{ $user->email }}</small>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong><i class="fas fa-shield-alt me-2"></i>الأدوار:</strong>
                        @forelse($user->roles as $role)
                        <span class="badge bg-secondary me-1">{{ $role->name }}</span>
                        @empty
                        <span class="text-muted">لا يوجد أدوار محددة</span>
                        @endforelse
                    </div>

                    <div class="mb-3">
                        <strong><i class="fas fa-calendar me-2"></i>تاريخ التسجيل:</strong>
                        <br>
                        <small class="text-muted">{{ $user->created_at->format('Y-m-d H:i') }}</small>
                    </div>

                    <div class="mb-3">
                        <strong><i class="fas fa-info-circle me-2"></i>حالة الحساب:</strong>
                        <br>
                        @if($user->is_approved && $user->is_active)
                        <span class="badge bg-success"><i class="fas fa-check"></i> مفعل</span>
                        @elseif($user->is_approved && !$user->is_active)
                        <span class="badge bg-warning"><i class="fas fa-pause"></i> معلق</span>
                        @else
                        <span class="badge bg-danger"><i class="fas fa-clock"></i> بانتظار التفعيل</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <strong><i class="fas fa-tag me-2"></i>نوع التسجيل:</strong>
                        <br>
                        @if($user->registration_type === 'self_registered')
                        <span class="badge bg-info">تسجيل ذاتي</span>
                        @else
                        <span class="badge bg-primary">إداري</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>
                        تحديث المعلومات الشخصية
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-muted border-bottom pb-2 mb-3">
                                    <i class="fas fa-user fa-icon"></i>
                                    المعلومات الأساسية
                                </h6>
                            </div>

                            <!-- Name -->
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user fa-icon"></i>
                                    الاسم الكامل
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope fa-icon"></i>
                                    البريد الإلكتروني
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Change Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-muted border-bottom pb-2 mb-3">
                                    <i class="fas fa-lock fa-icon"></i>
                                    تغيير كلمة المرور (اختياري)
                                </h6>
                            </div>

                            <!-- Current Password -->
                            <div class="col-12 mb-3">
                                <label for="current_password" class="form-label">
                                    <i class="fas fa-key fa-icon"></i>
                                    كلمة المرور الحالية
                                </label>
                                <input type="password"
                                    class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password"
                                    name="current_password"
                                    placeholder="أدخل كلمة المرور الحالية">
                                @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    مطلوب فقط عند تغيير كلمة المرور
                                </div>
                            </div>

                            <!-- New Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock fa-icon"></i>
                                    كلمة المرور الجديدة
                                </label>
                                <input type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="أدخل كلمة المرور الجديدة">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm New Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock fa-icon"></i>
                                    تأكيد كلمة المرور الجديدة
                                </label>
                                <input type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    placeholder="أعد إدخال كلمة المرور الجديدة">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        حفظ التغييرات
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Account Security -->
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        أمان الحساب
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong><i class="fas fa-calendar me-2"></i>آخر تسجيل دخول:</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $user->last_login_at ? $user->last_login_at->format('Y-m-d H:i:s') : 'لم يتم تسجيل الدخول بعد' }}
                                </small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong><i class="fas fa-globe me-2"></i>عنوان IP الأخير:</strong>
                                <br>
                                <small class="text-muted">{{ $user->last_login_ip ?? 'غير متوفر' }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>نصائح الأمان:</strong>
                        <ul class="mb-0 mt-2">
                            <li>استخدم كلمة مرور قوية تحتوي على أحرف وأرقام ورموز</li>
                            <li>لا تشارك كلمة المرور مع أي شخص آخر</li>
                            <li>سجل خروجك من الحساب عند الانتهاء من العمل</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-lg {
        width: 80px;
        height: 80px;
        font-size: 24px;
    }

    .fa-icon {
        width: 16px;
        text-align: center;
        margin-right: 0.5rem;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    .badge {
        font-size: 0.8em;
    }
</style>
@endsection