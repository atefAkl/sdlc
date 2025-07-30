@extends('layouts.app')

@section('title', 'إضافة مستخدم جديد')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
<li class="breadcrumb-item"><a href="{{ route('users.index') }}">إدارة المستخدمين</a></li>
<li class="breadcrumb-item active">إضافة مستخدم جديد</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            <i class="fas fa-user-plus fa-2x text-primary me-2"></i>
            إضافة مستخدم جديد
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

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-plus me-2"></i>
                        بيانات المستخدم الجديد
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf

                        <!-- Personal Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-muted border-bottom pb-2 mb-3">
                                    <i class="fas fa-user fa-icon"></i>
                                    المعلومات الشخصية
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
                                    value="{{ old('name') }}"
                                    required
                                    placeholder="أدخل الاسم الكامل">
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
                                    value="{{ old('email') }}"
                                    required
                                    placeholder="example@domain.com">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Password Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-muted border-bottom pb-2 mb-3">
                                    <i class="fas fa-lock fa-icon"></i>
                                    كلمة المرور
                                </h6>
                            </div>

                            <!-- Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock fa-icon"></i>
                                    كلمة المرور
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        name="password"
                                        required
                                        placeholder="أدخل كلمة المرور">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle"></i>
                                    يجب أن تكون كلمة المرور 8 أحرف على الأقل
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-lock fa-icon"></i>
                                    تأكيد كلمة المرور
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password"
                                        class="form-control"
                                        id="password_confirmation"
                                        name="password_confirmation"
                                        required
                                        placeholder="أعد إدخال كلمة المرور">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Roles Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-muted border-bottom pb-2 mb-3">
                                    <i class="fas fa-shield-alt fa-icon"></i>
                                    الأدوار والصلاحيات
                                </h6>
                            </div>

                            <div class="col-12">
                                <label class="form-label">
                                    <i class="fas fa-users-cog fa-icon"></i>
                                    تعيين الأدوار
                                </label>
                                <div class="row">
                                    @foreach($roles as $role)
                                    <div class="col-md-6 col-lg-4 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                name="roles[]"
                                                value="{{ $role->name }}"
                                                id="role_{{ $role->id }}"
                                                {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_{{ $role->id }}">
                                                <span class="badge bg-secondary me-1">{{ $role->name }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @if($roles->isEmpty())
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    لا توجد أدوار متاحة. يمكنك <a href="{{ route('roles.create') }}">إنشاء دور جديد</a> أولاً.
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Registration Type Info -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>نوع التسجيل:</strong> إداري - سيتم تفعيل الحساب تلقائياً
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                        <i class="fas fa-times"></i>
                                        إلغاء
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        إنشاء المستخدم
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const password = document.getElementById('password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                password.type = 'password';
                icon.className = 'fas fa-eye';
            }
        });

        // Toggle password confirmation visibility
        document.getElementById('togglePasswordConfirm').addEventListener('click', function() {
            const passwordConfirm = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');

            if (passwordConfirm.type === 'password') {
                passwordConfirm.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                passwordConfirm.type = 'password';
                icon.className = 'fas fa-eye';
            }
        });

        // Password strength indicator (optional enhancement)
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            let strength = 0;

            if (password.length >= 8) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            // You can add visual strength indicator here
        });
    });
</script>

<style>
    .fa-icon {
        width: 16px;
        text-align: center;
        margin-right: 0.5rem;
    }

    .form-check-input:checked {
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
    }

    .card {
        border: none;
        border-radius: 10px;
    }

    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }

    .btn-group .btn+.btn {
        margin-left: 0.5rem;
    }

    .alert-info {
        background-color: rgba(32, 201, 151, 0.1);
        border-color: rgba(32, 201, 151, 0.3);
        color: #0f5132;
    }
</style>
@endsection