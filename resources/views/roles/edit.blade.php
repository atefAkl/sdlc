@extends('layouts.app')

@section('title', 'تعديل الدور')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">إدارة الأدوار</a></li>
    <li class="breadcrumb-item active">تعديل الدور</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="fas fa-edit fa-2x text-primary me-2"></i>
                تعديل الدور: {{ ucwords(str_replace('-', ' ', $role->name)) }}
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة للقائمة
                    </a>
                    <a href="{{ route('roles.show', $role) }}" class="btn btn-outline-info">
                        <i class="fas fa-eye"></i>
                        عرض الدور
                    </a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-shield me-2"></i>
                            تعديل بيانات الدور
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role) }}">
                            @csrf
                            @method('PATCH')

                            <!-- Role Info Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted border-bottom pb-2 mb-3">
                                        <i class="fas fa-tag fa-icon"></i>
                                        معلومات الدور
                                    </h6>
                                </div>

                                <!-- Role Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-tag fa-icon"></i>
                                        اسم الدور
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name"
                                        value="{{ old('name', ucwords(str_replace('-', ' ', $role->name))) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Current System Name -->
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-code fa-icon"></i>
                                        الاسم في النظام
                                    </label>
                                    <input type="text" class="form-control" value="{{ $role->name }}" readonly>
                                    <div class="form-text">
                                        هذا هو الاسم المستخدم داخلياً في النظام
                                    </div>
                                </div>
                            </div>

                            <!-- Current Statistics -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted border-bottom pb-2 mb-3">
                                        <i class="fas fa-chart-bar fa-icon"></i>
                                        إحصائيات الدور
                                    </h6>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-info text-white">
                                        <div class="card-body text-center">
                                            <i class="fas fa-key fa-2x mb-2"></i>
                                            <h4>{{ $role->permissions->count() }}</h4>
                                            <small>صلاحية مخصصة</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-success text-white">
                                        <div class="card-body text-center">
                                            <i class="fas fa-users fa-2x mb-2"></i>
                                            <h4>{{ $role->users->count() }}</h4>
                                            <small>مستخدم مرتبط</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-warning text-dark">
                                        <div class="card-body text-center">
                                            <i class="fas fa-calendar fa-2x mb-2"></i>
                                            <h6>{{ $role->created_at->format('Y-m-d') }}</h6>
                                            <small>تاريخ الإنشاء</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Permissions Section -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-muted border-bottom pb-2 mb-3">
                                        <i class="fas fa-key fa-icon"></i>
                                        الصلاحيات
                                    </h6>
                                </div>

                                <div class="col-12">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                        <label class="form-check-label fw-bold" for="selectAll">
                                            <i class="fas fa-check-double me-1"></i>
                                            تحديد جميع الصلاحيات
                                        </label>
                                    </div>

                                    <div class="row">
                                        @if ($permissions->count() > 0)
                                            @php
                                                $permissionGroups = $permissions->groupBy(function ($permission) {
                                                    return explode('-', $permission->name)[0];
                                                });
                                            @endphp

                                            @foreach ($permissionGroups as $group => $groupPermissions)
                                                <div class="col-md-6 col-lg-4 mb-4">
                                                    <div class="card border-light">
                                                        <div class="card-header bg-light py-2">
                                                            <h6 class="mb-0">
                                                                <i class="fas fa-folder me-1"></i>
                                                                {{ ucwords(str_replace('-', ' ', $group)) }}
                                                            </h6>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input group-select" type="checkbox"
                                                                    id="group_{{ $group }}"
                                                                    data-group="{{ $group }}">
                                                                <label class="form-check-label small"
                                                                    for="group_{{ $group }}">
                                                                    تحديد الكل
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="card-body py-2">
                                                            @foreach ($groupPermissions as $permission)
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input permission-checkbox"
                                                                        type="checkbox" name="permissions[]"
                                                                        value="{{ $permission->name }}"
                                                                        id="permission_{{ $permission->id }}"
                                                                        data-group="{{ $group }}"
                                                                        {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                                                    <label class="form-check-label small"
                                                                        for="permission_{{ $permission->id }}">
                                                                        {{ ucwords(str_replace('-', ' ', $permission->name)) }}
                                                                        @if (in_array($permission->name, $rolePermissions))
                                                                            <i class="fas fa-check text-success ms-1"
                                                                                title="مخصص حالياً"></i>
                                                                        @endif
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-12">
                                                <div class="alert alert-info">
                                                    <i class="fas fa-info-circle me-2"></i>
                                                    لا توجد صلاحيات متاحة.
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times"></i>
                                            إلغاء
                                        </a>
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
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
            const groupSelects = document.querySelectorAll('.group-select');

            // Initialize state
            updateSelectAllState();
            groupSelects.forEach(groupSelect => {
                updateGroupSelectState(groupSelect.dataset.group);
            });

            // Select All functionality
            selectAllCheckbox.addEventListener('change', function() {
                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                groupSelects.forEach(groupSelect => {
                    groupSelect.checked = this.checked;
                });
            });

            // Group Select functionality
            groupSelects.forEach(groupSelect => {
                groupSelect.addEventListener('change', function() {
                    const group = this.dataset.group;
                    const groupCheckboxes = document.querySelectorAll(
                        `[data-group="${group}"].permission-checkbox`);

                    groupCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });

                    updateSelectAllState();
                });
            });

            // Individual checkbox change
            permissionCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateGroupSelectState(this.dataset.group);
                    updateSelectAllState();
                });
            });

            function updateGroupSelectState(group) {
                const groupCheckboxes = document.querySelectorAll(`[data-group="${group}"].permission-checkbox`);
                const groupSelect = document.querySelector(`[data-group="${group}"].group-select`);
                const checkedCount = Array.from(groupCheckboxes).filter(cb => cb.checked).length;

                if (checkedCount === 0) {
                    groupSelect.checked = false;
                    groupSelect.indeterminate = false;
                } else if (checkedCount === groupCheckboxes.length) {
                    groupSelect.checked = true;
                    groupSelect.indeterminate = false;
                } else {
                    groupSelect.checked = false;
                    groupSelect.indeterminate = true;
                }
            }

            function updateSelectAllState() {
                const checkedCount = Array.from(permissionCheckboxes).filter(cb => cb.checked).length;

                if (checkedCount === 0) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                } else if (checkedCount === permissionCheckboxes.length) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = true;
                }
            }
        });
    </script>
@endsection
