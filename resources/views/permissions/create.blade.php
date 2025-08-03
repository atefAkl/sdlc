@extends('layouts.app')

@section('title', 'إضافة صلاحية جديدة')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('nav.dashboard') }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">{{ __('nav.permission-management') }}</a></li>
    <li class="breadcrumb-item active">{{ __('vav.add-new-permission') }}</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="fas fa-key fa-2x text-success me-2"></i>
                إضافة صلاحية جديدة
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Form Card -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-plus me-2"></i>
                            معلومات الصلاحية الجديدة
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.store') }}">
                            @csrf

                            <!-- Permission Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="fas fa-key text-primary me-1"></i>
                                    اسم الصلاحية <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="مثال: users-create" required>
                                <div class="form-text">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    استخدم صيغة kebab-case (مثل: users-create, roles-edit, permissions-delete)
                                </div>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Display Name -->
                            <div class="mb-4">
                                <label for="display_name" class="form-label">
                                    <i class="fas fa-tag text-info me-1"></i>
                                    الاسم المعروض
                                </label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                    id="display_name" name="display_name" value="{{ old('display_name') }}"
                                    placeholder="مثال: إنشاء المستخدمين">
                                <div class="form-text">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    اسم مفهوم يظهر في واجهة المستخدم (اختياري - سيتم توليده تلقائياً من اسم الصلاحية)
                                </div>
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Group Selection -->
                            <div class="mb-4">
                                <label for="group" class="form-label">
                                    <i class="fas fa-layer-group text-warning me-1"></i>
                                    المجموعة
                                </label>
                                <div class="row">
                                    <div class="col-md-8">

                                        <select class="form-select @error('group') is-invalid @enderror" id="group"
                                            name="group">
                                            <option value="">اختر مجموعة موجودة أو أدخل جديدة</option>
                                            @foreach ($existingGroups as $group)
                                                <option value="{{ $group->category }}"
                                                    {{ old('group') == $group->category || $groupe == $group->category ? 'selected' : '' }}>
                                                    {{ ucwords($group->category) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" id="new_group" placeholder="مجموعة جديدة"
                                            value="{{ old('new_group') }}">
                                    </div>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    اختر مجموعة موجودة أو أدخل اسم مجموعة جديدة
                                </div>
                                @error('group')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Actions -->
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-cogs text-secondary me-1"></i>
                                    العمليات المدعومة
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="create_action"
                                                value="create">
                                            <label class="form-check-label" for="create_action">
                                                <i class="fas fa-plus text-success me-1"></i>
                                                إنشاء (Create)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="read_action" value="read">
                                            <label class="form-check-label" for="read_action">
                                                <i class="fas fa-eye text-info me-1"></i>
                                                عرض (Read)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="update_action"
                                                value="update">
                                            <label class="form-check-label" for="update_action">
                                                <i class="fas fa-edit text-warning me-1"></i>
                                                تعديل (Update)
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="delete_action"
                                                value="delete">
                                            <label class="form-check-label" for="delete_action">
                                                <i class="fas fa-trash text-danger me-1"></i>
                                                حذف (Delete)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-info-circle text-info me-1"></i>
                                    اختر العمليات لإنشاء عدة صلاحيات تلقائياً (مثل: users-create, users-read...)
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                                    <i class="fas fa-times"></i>
                                    إلغاء
                                </button>
                                <div>
                                    <button type="submit" name="action" value="save" class="btn btn-success me-2">
                                        <i class="fas fa-save"></i>
                                        حفظ الصلاحية
                                    </button>
                                    <button type="submit" name="action" value="save_and_continue"
                                        class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        حفظ وإضافة أخرى
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            إرشادات تسمية الصلاحيات
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6 class="text-primary">نمط التسمية المقترح:</h6>
                            <code>[مجموعة]-[عملية]</code>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-success">أمثلة صحيحة:</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-1"></i> <code>users-create</code></li>
                                <li><i class="fas fa-check text-success me-1"></i> <code>roles-edit</code></li>
                                <li><i class="fas fa-check text-success me-1"></i> <code>permissions-delete</code></li>
                                <li><i class="fas fa-check text-success me-1"></i> <code>dashboard-access</code></li>
                            </ul>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-danger">تجنب:</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-times text-danger me-1"></i> المسافات</li>
                                <li><i class="fas fa-times text-danger me-1"></i> الأحرف الكبيرة</li>
                                <li><i class="fas fa-times text-danger me-1"></i> الرموز الخاصة</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Existing Groups -->
                @if ($existingGroups->count() > 0)
                    <div class="card mt-3">
                        <div class="card-header bg-secondary text-white">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-layer-group me-2"></i>
                                المجموعات الموجودة
                            </h6>
                        </div>
                        <div class="card-body">
                            @foreach ($existingGroups as $group)
                                <span class="badge bg-secondary me-1 mb-1">
                                    {{ ucwords(str_replace('-', ' ', $group)) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="card mt-3">
                    <div class="card-header bg-primary text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-bolt me-2"></i>
                            إجراءات سريعة
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-outline-primary btn-sm"
                                onclick="fillUserPermissions()">
                                <i class="fas fa-users"></i>
                                صلاحيات المستخدمين
                            </button>
                            <button type="button" class="btn btn-outline-warning btn-sm"
                                onclick="fillRolePermissions()">
                                <i class="fas fa-user-shield"></i>
                                صلاحيات الأدوار
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="fillSystemPermissions()">
                                <i class="fas fa-cog"></i>
                                صلاحيات النظام
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const displayNameInput = document.getElementById('display_name');
            const groupSelect = document.getElementById('group');
            const newGroupInput = document.getElementById('new_group');

            // Auto-generate display name from permission name
            nameInput.addEventListener('input', function() {
                if (!displayNameInput.value || displayNameInput.value === generateDisplayName(nameInput
                        .dataset.previousValue || '')) {
                    displayNameInput.value = generateDisplayName(this.value);
                }
                nameInput.dataset.previousValue = this.value;
            });

            // Handle new group input
            newGroupInput.addEventListener('input', function() {
                if (this.value) {
                    groupSelect.value = '';
                }
            });

            groupSelect.addEventListener('change', function() {
                if (this.value) {
                    newGroupInput.value = '';
                }
            });

            // Handle action checkboxes
            document.querySelectorAll('input[type="checkbox"][value]').forEach(checkbox => {
                checkbox.addEventListener('change', updatePermissionPreview);
            });

            // Override form submission to handle multiple permissions
            document.querySelector('form').addEventListener('submit', function(e) {
                const checkedActions = Array.from(document.querySelectorAll(
                    'input[type="checkbox"][value]:checked')).map(cb => cb.value);

                if (checkedActions.length > 0) {
                    e.preventDefault();
                    submitMultiplePermissions(checkedActions);
                }
            });
        });

        function generateDisplayName(name) {
            return name.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        }

        function updatePermissionPreview() {
            const baseName = document.getElementById('name').value;
            const checkedActions = Array.from(document.querySelectorAll('input[type="checkbox"][value]:checked')).map(cb =>
                cb.value);

            if (baseName && checkedActions.length > 0) {
                console.log('Will create permissions:', checkedActions.map(action => `${baseName}-${action}`));
            }
        }

        function submitMultiplePermissions(actions) {
            const form = document.querySelector('form');
            const baseName = document.getElementById('name').value;
            const displayName = document.getElementById('display_name').value;
            const group = document.getElementById('group').value || document.getElementById('new_group').value;

            // Create a new form with multiple permission data
            const newForm = document.createElement('form');
            newForm.method = 'POST';
            newForm.action = form.action;

            // Add CSRF token
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = document.querySelector('input[name="_token"]').value;
            newForm.appendChild(csrfInput);

            // Add multiple permissions data
            const permissionsInput = document.createElement('input');
            permissionsInput.type = 'hidden';
            permissionsInput.name = 'multiple_permissions';
            permissionsInput.value = JSON.stringify({
                base_name: baseName,
                display_name: displayName,
                group: group,
                actions: actions
            });
            newForm.appendChild(permissionsInput);

            // Add action
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = document.activeElement.value;
            newForm.appendChild(actionInput);

            document.body.appendChild(newForm);
            newForm.submit();
        }

        function fillUserPermissions() {
            document.getElementById('name').value = 'users';
            document.getElementById('display_name').value = 'إدارة المستخدمين';
            document.getElementById('group').value = 'users';
            document.querySelectorAll('input[type="checkbox"][value]').forEach(cb => cb.checked = true);
        }

        function fillRolePermissions() {
            document.getElementById('name').value = 'roles';
            document.getElementById('display_name').value = 'إدارة الأدوار';
            document.getElementById('group').value = 'roles';
            document.querySelectorAll('input[type="checkbox"][value]').forEach(cb => cb.checked = true);
        }

        function fillSystemPermissions() {
            document.getElementById('name').value = 'system';
            document.getElementById('display_name').value = 'إدارة النظام';
            document.getElementById('group').value = 'system';
            document.getElementById('create_action').checked = false;
            document.getElementById('read_action').checked = true;
            document.getElementById('update_action').checked = true;
            document.getElementById('delete_action').checked = false;
        }
    </script>
@endsection
