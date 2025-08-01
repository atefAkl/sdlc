<!-- filepath: c:\wamp64\www\administration\sdlc\resources\views\users\edit.blade.php -->
@extends('layouts.app')

@section('title', 'تعديل المستخدم - ' . $user->name)

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h3 mb-0 text-primary">
                            <i class="fas fa-user-edit fa-icon"></i>
                            تعديل المستخدم
                        </h2>
                        <p class="text-muted mb-0">تحديث بيانات ومعلومات المستخدم: <strong>{{ $user->name }}</strong></p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('users.show', $user) }}" class="btn btn-outline-info">
                            <i class="fas fa-eye"></i> عرض التفاصيل
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> العودة للقائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <ul class="nav nav-tabs card-header-tabs" id="editTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="basic-info-tab" data-bs-toggle="tab"
                                    data-bs-target="#basic-info" type="button" role="tab">
                                    <i class="fas fa-user fa-icon"></i>
                                    المعلومات الأساسية
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="account-settings-tab" data-bs-toggle="tab"
                                    data-bs-target="#account-settings" type="button" role="tab">
                                    <i class="fas fa-cog fa-icon"></i>
                                    إعدادات الحساب
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="password-reset-tab" data-bs-toggle="tab"
                                    data-bs-target="#password-reset" type="button" role="tab">
                                    <i class="fas fa-key fa-icon"></i>
                                    إدارة كلمة المرور
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="roles-permissions-tab" data-bs-toggle="tab"
                                    data-bs-target="#roles-permissions" type="button" role="tab">
                                    <i class="fas fa-user-shield fa-icon"></i>
                                    الأدوار والصلاحيات
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="admin-notes-tab" data-bs-toggle="tab"
                                    data-bs-target="#admin-notes" type="button" role="tab">
                                    <i class="fas fa-sticky-note fa-icon"></i>
                                    الملاحظات الإدارية
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="editTabsContent">

                            <!-- Basic Information Tab -->
                            <div class="tab-pane fade show active" id="basic-info" role="tabpanel">
                                <form method="POST" action="{{ route('users.update-basic-info', $user) }}"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <h5 class="text-primary border-bottom pb-2">
                                                <i class="fas fa-id-card fa-icon"></i>
                                                المعلومات الأساسية
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Full Name -->
                                        <div class="col-md-6 mb-3">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-user fa-icon text-primary"></i>
                                                الاسم الكامل <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $user->name) }}"
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">
                                                <i class="fas fa-envelope fa-icon text-primary"></i>
                                                البريد الإلكتروني <span class="text-danger">*</span>
                                            </label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', $user->email) }}"
                                                required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Phone -->
                                        <div class="col-md-6 mb-3">
                                            <label for="phone" class="form-label">
                                                <i class="fas fa-phone fa-icon text-primary"></i>
                                                رقم الهاتف
                                            </label>
                                            <input type="tel"
                                                class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                name="phone" value="{{ old('phone', $user->phone ?? '') }}">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Department -->
                                        <div class="col-md-6 mb-3">
                                            <label for="department" class="form-label">
                                                <i class="fas fa-building fa-icon text-primary"></i>
                                                القسم/الإدارة
                                            </label>
                                            <select class="form-select @error('department') is-invalid @enderror"
                                                id="department" name="department">
                                                <option value="">اختر القسم...</option>
                                                <option value="development"
                                                    {{ old('department', $user->department ?? '') == 'development' ? 'selected' : '' }}>
                                                    قسم التطوير
                                                </option>
                                                <option value="design"
                                                    {{ old('department', $user->department ?? '') == 'design' ? 'selected' : '' }}>
                                                    قسم التصميم
                                                </option>
                                                <option value="testing"
                                                    {{ old('department', $user->department ?? '') == 'testing' ? 'selected' : '' }}>
                                                    قسم الاختبار
                                                </option>
                                                <option value="management"
                                                    {{ old('department', $user->department ?? '') == 'management' ? 'selected' : '' }}>
                                                    الإدارة
                                                </option>
                                                <option value="support"
                                                    {{ old('department', $user->department ?? '') == 'support' ? 'selected' : '' }}>
                                                    الدعم الفني
                                                </option>
                                            </select>
                                            @error('department')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Job Title -->
                                        <div class="col-md-6 mb-3">
                                            <label for="job_title" class="form-label">
                                                <i class="fas fa-briefcase fa-icon text-primary"></i>
                                                المنصب الوظيفي
                                            </label>
                                            <input type="text"
                                                class="form-control @error('job_title') is-invalid @enderror"
                                                id="job_title" name="job_title"
                                                value="{{ old('job_title', $user->job_title ?? '') }}">
                                            @error('job_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Start Date -->
                                        <div class="col-md-6 mb-3">
                                            <label for="start_date" class="form-label">
                                                <i class="fas fa-calendar fa-icon text-primary"></i>
                                                تاريخ بداية العمل
                                            </label>
                                            <input type="date"
                                                class="form-control @error('start_date') is-invalid @enderror"
                                                id="start_date" name="start_date"
                                                value="{{ old('start_date', $user->start_date ?? '') }}">
                                            @error('start_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Registration Info (Read Only) -->
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <h6 class="text-muted border-bottom pb-2">معلومات التسجيل</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <small class="text-muted d-block">
                                                        <i class="fas fa-calendar-plus fa-icon"></i>
                                                        تاريخ التسجيل: {{ $user->created_at->format('d/m/Y') }}
                                                    </small>
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($user->approved_at)
                                                        <small class="text-muted d-block">
                                                            <i class="fas fa-check fa-icon"></i>
                                                            تاريخ الاعتماد: {{ $user->approved_at->format('d/m/Y') }}
                                                        </small>
                                                    @endif
                                                </div>
                                                <div class="col-md-4">
                                                    @if ($user->last_login_at)
                                                        <small class="text-muted d-block">
                                                            <i class="fas fa-sign-in-alt fa-icon"></i>
                                                            آخر دخول: {{ $user->last_login_at->diffForHumans() }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-save"></i>
                                                    حفظ المعلومات الأساسية
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Account Settings Tab -->
                            <div class="tab-pane fade" id="account-settings" role="tabpanel">
                                <form method="POST" action="{{ route('users.update-account-settings', $user) }}"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <h5 class="text-warning border-bottom pb-2">
                                                <i class="fas fa-cog fa-icon"></i>
                                                إعدادات الحساب
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Account Status -->
                                        <div class="col-md-6 mb-4">
                                            <h6 class="text-primary mb-3">حالة الحساب</h6>

                                            <!-- Is Active -->
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="is_active"
                                                    name="is_active" value="1"
                                                    {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    <i class="fas fa-power-off fa-icon text-success"></i>
                                                    الحساب نشط
                                                </label>
                                                <small class="form-text text-muted d-block">
                                                    يمكن للمستخدم تسجيل الدخول والوصول للنظام
                                                </small>
                                            </div>

                                            <!-- Is Approved -->
                                            <div class="form-check form-switch mb-3">
                                                <input class="form-check-input" type="checkbox" id="is_approved"
                                                    name="is_approved" value="1"
                                                    {{ old('is_approved', $user->is_approved) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_approved">
                                                    <i class="fas fa-check-circle fa-icon text-primary"></i>
                                                    الحساب معتمد
                                                </label>
                                                <small class="form-text text-muted d-block">
                                                    تم الموافقة على حساب المستخدم من قبل الإدارة
                                                </small>
                                            </div>
                                        </div>

                                        <!-- Registration Settings -->
                                        <div class="col-md-6 mb-4">
                                            <h6 class="text-primary mb-3">إعدادات التسجيل</h6>

                                            <!-- Registration Type -->
                                            <div class="mb-3">
                                                <label for="registration_type" class="form-label">
                                                    <i class="fas fa-user-tag fa-icon text-info"></i>
                                                    نوع التسجيل
                                                </label>
                                                <select class="form-select" id="registration_type"
                                                    name="registration_type">
                                                    <option value="admin_created"
                                                        {{ old('registration_type', $user->registration_type) == 'admin_created' ? 'selected' : '' }}>
                                                        إنشاء إداري
                                                    </option>
                                                    <option value="self_registered"
                                                        {{ old('registration_type', $user->registration_type) == 'self_registered' ? 'selected' : '' }}>
                                                        تسجيل ذاتي
                                                    </option>
                                                    <option value="imported"
                                                        {{ old('registration_type', $user->registration_type) == 'imported' ? 'selected' : '' }}>
                                                        مستورد
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Current Status Display -->
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <div class="alert alert-info">
                                                <h6 class="alert-heading">الحالة الحالية:</h6>
                                                <div class="d-flex gap-3">
                                                    @if ($user->is_approved)
                                                        <span class="badge bg-success">معتمد</span>
                                                    @else
                                                        <span class="badge bg-warning">في انتظار الاعتماد</span>
                                                    @endif

                                                    @if ($user->is_active)
                                                        <span class="badge bg-primary">نشط</span>
                                                    @else
                                                        <span class="badge bg-secondary">غير نشط</span>
                                                    @endif

                                                    <span
                                                        class="badge bg-info">{{ ucfirst($user->registration_type) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="submit" class="btn btn-warning">
                                                    <i class="fas fa-save"></i>
                                                    حفظ إعدادات الحساب
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Password Reset Tab -->
                            <div class="tab-pane fade" id="password-reset" role="tabpanel">
                                <div class="row">
                                    <div class="col-12 mb-4">
                                        <h5 class="text-danger border-bottom pb-2">
                                            <i class="fas fa-key fa-icon"></i>
                                            إدارة كلمة المرور
                                        </h5>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="card border-danger">
                                            <div class="card-header bg-danger text-white">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-shield-alt fa-icon"></i>
                                                    إعادة تعيين كلمة المرور
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="alert alert-warning">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    <strong>ملاحظة أمنية:</strong> لأسباب أمنية، لا يمكن تعديل كلمة المرور
                                                    مباشرة.
                                                    يمكنك إرسال رابط إعادة تعيين كلمة المرور للمستخدم عبر بريده الإلكتروني.
                                                </div>

                                                <div class="text-center">
                                                    <div class="mb-4">
                                                        <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                                                        <h6>{{ $user->name }}</h6>
                                                        <p class="text-muted">{{ $user->email }}</p>
                                                    </div>

                                                    <button type="button" class="btn btn-danger btn-lg"
                                                        onclick="sendPasswordReset('{{ $user->email }}')">
                                                        <i class="fas fa-paper-plane"></i>
                                                        إرسال رابط إعادة التعيين
                                                    </button>

                                                    <div class="mt-3">
                                                        <small class="text-muted">
                                                            سيتم إرسال رابط آمن لإعادة تعيين كلمة المرور إلى البريد
                                                            الإلكتروني للمستخدم
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Roles & Permissions Tab -->
                            <div class="tab-pane fade" id="roles-permissions" role="tabpanel">
                                <form method="POST" action="{{ route('users.update-roles', $user) }}"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <h5 class="text-success border-bottom pb-2">
                                                <i class="fas fa-user-shield fa-icon"></i>
                                                الأدوار والصلاحيات
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Roles Assignment -->
                                        <div class="col-lg-6 mb-4">
                                            <div class="card border-primary">
                                                <div class="card-header bg-primary text-white">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-shield-alt fa-icon"></i>
                                                        تعيين الأدوار
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($roles as $role)
                                                        <div class="form-check mb-3 p-3 border rounded">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="role_{{ $role->id }}" name="roles[]"
                                                                value="{{ $role->id }}"
                                                                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                                            <label class="form-check-label w-100"
                                                                for="role_{{ $role->id }}">
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div>
                                                                        <span
                                                                            class="badge bg-primary me-2">{{ $role->display_name ?? $role->name }}</span>
                                                                        @if ($role->description)
                                                                            <small
                                                                                class="text-muted d-block">{{ $role->description }}</small>
                                                                        @endif
                                                                    </div>
                                                                    @if ($user->hasRole($role->name))
                                                                        <i class="fas fa-check-circle text-success"></i>
                                                                    @endif
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Current Permissions Display -->
                                        <div class="col-lg-6 mb-4">
                                            <div class="card border-success">
                                                <div class="card-header bg-success text-white">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-key fa-icon"></i>
                                                        الصلاحيات الحالية
                                                    </h6>
                                                </div>
                                                <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                                                    @php
                                                        $userPermissions = $user->getAllPermissions();
                                                    @endphp
                                                    @if ($userPermissions->count() > 0)
                                                        <div class="row">
                                                            @foreach ($userPermissions as $permission)
                                                                <div class="col-12 mb-2">
                                                                    <span
                                                                        class="badge bg-success-subtle text-success border border-success w-100 text-start p-2">
                                                                        <i class="fas fa-key me-2"></i>
                                                                        {{ $permission->display_name ?? $permission->name }}
                                                                    </span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <div class="text-center text-muted">
                                                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                                                            <p>لا توجد صلاحيات محددة</p>
                                                            <small>الصلاحيات تُحدث تلقائياً عند تعيين الأدوار</small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fas fa-save"></i>
                                                    حفظ الأدوار والصلاحيات
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Admin Notes Tab -->
                            <div class="tab-pane fade" id="admin-notes" role="tabpanel">
                                <form method="POST" action="{{ route('users.update-admin-notes', $user) }}"
                                    class="needs-validation" novalidate>
                                    @csrf
                                    @method('PATCH')

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <h5 class="text-info border-bottom pb-2">
                                                <i class="fas fa-sticky-note fa-icon"></i>
                                                الملاحظات الإدارية
                                            </h5>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="card border-info">
                                                <div class="card-header bg-info text-white">
                                                    <h6 class="card-title mb-0">
                                                        <i class="fas fa-comment fa-icon"></i>
                                                        ملاحظات خاصة بالإدارة
                                                    </h6>
                                                </div>
                                                <div class="card-body">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle"></i>
                                                        <strong>ملاحظة:</strong> هذه الملاحظات مخصصة للاستخدام الإداري فقط
                                                        ولن تكون مرئية للمستخدم.
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="admin_notes" class="form-label">
                                                            <i class="fas fa-edit fa-icon text-info"></i>
                                                            الملاحظات والتعليقات
                                                        </label>
                                                        <textarea class="form-control @error('admin_notes') is-invalid @enderror" id="admin_notes" name="admin_notes"
                                                            rows="8"
                                                            placeholder="أضف ملاحظات أو تعليقات حول هذا المستخدم مثل:
- تقييم الأداء
- ملاحظات حول السلوك
- تواريخ مهمة
- قرارات إدارية
- أي معلومات أخرى ذات صلة...">{{ old('admin_notes', $user->admin_notes ?? '') }}</textarea>
                                                        @error('admin_notes')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                        <div class="form-text">
                                                            الحد الأقصى: 1000 حرف
                                                        </div>
                                                    </div>

                                                    <!-- Notes History (if needed in future) -->
                                                    @if ($user->admin_notes)
                                                        <div class="border-top pt-3">
                                                            <small class="text-muted">
                                                                <i class="fas fa-history fa-icon"></i>
                                                                آخر تحديث: {{ $user->updated_at->format('d/m/Y H:i') }}
                                                            </small>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-center gap-3">
                                                <button type="submit" class="btn btn-info btn-lg">
                                                    <i class="fas fa-save"></i>
                                                    حفظ الملاحظات الإدارية
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
        </div>

        <!-- Back to User Profile Button -->
        <div class="row">
            <div class="col-12 text-center">
                <a href="{{ route('users.show', $user) }}" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-user"></i>
                    العودة لملف المستخدم
                </a>
            </div>
        </div>
    </div>

    <script>
        // Form Validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // Password Reset Function
        function sendPasswordReset(email) {
            if (confirm('هل أنت متأكد من إرسال رابط إعادة تعيين كلمة المرور إلى: ' + email + '؟')) {
                fetch('{{ route('users.send-password-reset') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            email: email
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('تم إرسال رابط إعادة التعيين بنجاح!');
                        } else {
                            alert('حدث خطأ أثناء الإرسال: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('حدث خطأ أثناء الإرسال!');
                    });
            }
        }

        // Character count for admin notes
        document.addEventListener('DOMContentLoaded', function() {
            const adminNotes = document.getElementById('admin_notes');
            if (adminNotes) {
                adminNotes.addEventListener('input', function() {
                    const remaining = 1000 - this.value.length;
                    const formText = this.nextElementSibling.nextElementSibling;
                    if (remaining < 0) {
                        formText.textContent = `تجاوزت الحد الأقصى بـ ${Math.abs(remaining)} حرف`;
                        formText.className = 'form-text text-danger';
                    } else {
                        formText.textContent = `المتبقي: ${remaining} حرف`;
                        formText.className = 'form-text text-muted';
                    }
                });
            }
        });
    </script>
@endsection
