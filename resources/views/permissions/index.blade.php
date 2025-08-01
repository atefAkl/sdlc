@extends('layouts.app')

@section('title', 'إدارة الصلاحيات')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item active">إدارة الصلاحيات</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="fas fa-key fa-2x text-warning me-2"></i>
                إدارة الصلاحيات
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('permissions.create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i>
                        إضافة صلاحية جديدة
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="card-title mb-0">إجمالي الصلاحيات</h6>
                                <h2 class="mb-0">{{ $permissions->count() }}</h2>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-key fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="card-title mb-0">الصلاحيات المستخدمة</h6>
                                <h2 class="mb-0">{{ $permissions->filter(fn($p) => $p->roles->count() > 0)->count() }}
                                </h2>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="card-title mb-0">الصلاحيات غير المستخدمة</h6>
                                <h2 class="mb-0">{{ $permissions->filter(fn($p) => $p->roles->count() == 0)->count() }}
                                </h2>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-triangle fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 mb-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="card-title mb-0">مجموعات الصلاحيات</h6>
                                <h2 class="mb-0">{{ $permissions->groupBy(fn($p) => explode('-', $p->name)[0])->count() }}
                                </h2>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="fas fa-layer-group fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="search" placeholder="البحث في الصلاحيات..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="group" class="form-select">
                            <option value="">جميع المجموعات</option>
                            @foreach ($permissions->groupBy(fn($p) => explode('-', $p->name)[0]) as $group => $groupPermissions)
                                <option value="{{ $group }}" {{ request('group') == $group ? 'selected' : '' }}>
                                    {{ ucwords(str_replace('-', ' ', $group)) }} ({{ $groupPermissions->count() }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="usage" class="form-select">
                            <option value="">جميع الحالات</option>
                            <option value="used" {{ request('usage') == 'used' ? 'selected' : '' }}>المستخدمة فقط
                            </option>
                            <option value="unused" {{ request('usage') == 'unused' ? 'selected' : '' }}>غير المستخدمة فقط
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary flex-fill">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Permissions by Groups -->
        @php
            $filteredPermissions = $permissions;

            // Apply search filter
            if (request('search')) {
                $filteredPermissions = $filteredPermissions->filter(function ($permission) {
                    return str_contains(strtolower($permission->name), strtolower(request('search')));
                });
            }

            // Apply group filter
            if (request('group')) {
                $filteredPermissions = $filteredPermissions->filter(function ($permission) {
                    return explode('-', $permission->name)[0] == request('group');
                });
            }

            // Apply usage filter
            if (request('usage') == 'used') {
                $filteredPermissions = $filteredPermissions->filter(fn($p) => $p->roles->count() > 0);
            } elseif (request('usage') == 'unused') {
                $filteredPermissions = $filteredPermissions->filter(fn($p) => $p->roles->count() == 0);
            }

            $permissionGroups = $filteredPermissions->groupBy(function ($permission) {
                return explode('-', $permission->name)[0];
            });
        @endphp

        @if ($permissionGroups->count() > 0)
            @foreach ($permissionGroups as $group => $groupPermissions)
                <div class="card mb-4">
                    <div class="card-header bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                <i class="fas fa-folder text-primary me-2"></i>
                                {{ ucwords(str_replace('-', ' ', $group)) }}
                                <span class="badge bg-primary ms-2">{{ $groupPermissions->count() }}</span>
                            </h5>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-outline-success"
                                    onclick="selectAllInGroup('{{ $group }}')">
                                    <i class="fas fa-check-double"></i>
                                    تحديد الكل
                                </button>
                                <button type="button" class="btn btn-outline-warning"
                                    onclick="deselectAllInGroup('{{ $group }}')">
                                    <i class="fas fa-times"></i>
                                    إلغاء التحديد
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">
                                            <input type="checkbox" class="form-check-input group-checkbox"
                                                data-group="{{ $group }}">
                                        </th>
                                        <th><i class="fas fa-key"></i> اسم الصلاحية</th>
                                        <th><i class="fas fa-user-shield"></i> الأدوار المرتبطة</th>
                                        <th><i class="fas fa-users"></i> عدد المستخدمين</th>
                                        <th><i class="fas fa-calendar"></i> تاريخ الإنشاء</th>
                                        <th width="120"><i class="fas fa-cogs"></i> العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupPermissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox" class="form-check-input permission-checkbox"
                                                    data-group="{{ $group }}" value="{{ $permission->id }}">
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div
                                                        class="avatar-sm rounded bg-warning text-dark me-2 d-flex align-items-center justify-content-center">
                                                        <i class="fas fa-key"></i>
                                                    </div>
                                                    <div>
                                                        <strong>{{ ucwords(str_replace('-', ' ', $permission->name)) }}</strong>
                                                        <br>
                                                        <small class="text-muted">{{ $permission->name }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if ($permission->roles->count() > 0)
                                                    @foreach ($permission->roles->take(3) as $role)
                                                        <span
                                                            class="badge bg-info me-1 mb-1">{{ ucwords(str_replace('-', ' ', $role->name)) }}</span>
                                                    @endforeach
                                                    @if ($permission->roles->count() > 3)
                                                        <span
                                                            class="badge bg-secondary">+{{ $permission->roles->count() - 3 }}</span>
                                                    @endif
                                                @else
                                                    <span class="text-muted">غير مستخدمة</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $userCount = $permission->roles->sum(
                                                        fn($role) => $role->users->count(),
                                                    );
                                                @endphp
                                                @if ($userCount > 0)
                                                    <span class="badge bg-success">{{ $userCount }}</span>
                                                @else
                                                    <span class="badge bg-secondary">0</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small
                                                    class="text-muted">{{ $permission->created_at->format('Y-m-d') }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('permissions.show', $permission) }}"
                                                        class="btn btn-outline-info" title="عرض">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('permissions.edit', $permission) }}"
                                                        class="btn btn-outline-primary" title="تعديل">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    @if ($permission->roles->count() == 0)
                                                        <button type="button" class="btn btn-outline-danger"
                                                            onclick="deletePermission({{ $permission->id }}, '{{ $permission->name }}')"
                                                            title="حذف">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-outline-secondary" disabled
                                                            title="لا يمكن الحذف - مستخدمة في أدوار">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Bulk Actions -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>العمليات المجمعة:</strong>
                            <span id="selected-count" class="badge bg-primary ms-2">0</span> صلاحية محددة
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-success" onclick="assignToRole()">
                                <i class="fas fa-user-shield"></i>
                                تعيين لدور
                            </button>
                            <button type="button" class="btn btn-outline-danger" onclick="bulkDelete()">
                                <i class="fas fa-trash"></i>
                                حذف المحدد
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h5>لا توجد صلاحيات</h5>
                    <p class="text-muted">لم يتم العثور على صلاحيات تطابق معايير البحث</p>
                    <div class="mt-3">
                        <a href="{{ route('permissions.create') }}" class="btn btn-success me-2">
                            <i class="fas fa-plus"></i>
                            إضافة صلاحية جديدة
                        </a>
                        <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-refresh"></i>
                            إعادة تعيين المرشحات
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Delete Modal -->
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
                    <p><strong>هل أنت متأكد من حذف الصلاحية؟</strong></p>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        هذا الإجراء لا يمكن التراجع عنه.
                    </div>
                    <div id="permission-details"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <form id="delete-form" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash"></i>
                            نعم، احذف
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-sm {
            width: 32px;
            height: 32px;
            font-size: 12px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            updateSelectedCount();

            // Handle individual checkbox changes
            document.querySelectorAll('.permission-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectedCount();
                    updateGroupCheckbox(this.dataset.group);
                });
            });

            // Handle group checkbox changes
            document.querySelectorAll('.group-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const group = this.dataset.group;
                    const isChecked = this.checked;

                    document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`)
                        .forEach(cb => {
                            cb.checked = isChecked;
                        });

                    updateSelectedCount();
                });
            });
        });

        function selectAllInGroup(group) {
            document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`).forEach(cb => {
                cb.checked = true;
            });
            updateSelectedCount();
            updateGroupCheckbox(group);
        }

        function deselectAllInGroup(group) {
            document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`).forEach(cb => {
                cb.checked = false;
            });
            updateSelectedCount();
            updateGroupCheckbox(group);
        }

        function updateGroupCheckbox(group) {
            const groupCheckboxes = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
            const checkedCount = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]:checked`).length;
            const groupCheckbox = document.querySelector(`.group-checkbox[data-group="${group}"]`);

            if (checkedCount === 0) {
                groupCheckbox.indeterminate = false;
                groupCheckbox.checked = false;
            } else if (checkedCount === groupCheckboxes.length) {
                groupCheckbox.indeterminate = false;
                groupCheckbox.checked = true;
            } else {
                groupCheckbox.indeterminate = true;
            }
        }

        function updateSelectedCount() {
            const selectedCount = document.querySelectorAll('.permission-checkbox:checked').length;
            document.getElementById('selected-count').textContent = selectedCount;
        }

        function deletePermission(id, name) {
            document.getElementById('permission-details').innerHTML = `
        <strong>الصلاحية:</strong> ${name}
    `;
            document.getElementById('delete-form').action = `/permissions/${id}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        function assignToRole() {
            const selectedIds = Array.from(document.querySelectorAll('.permission-checkbox:checked')).map(cb => cb.value);
            if (selectedIds.length === 0) {
                alert('يرجى تحديد صلاحية واحدة على الأقل');
                return;
            }

            // Redirect to role assignment page with selected permissions
            const params = new URLSearchParams();
            selectedIds.forEach(id => params.append('permissions[]', id));
            window.location.href = `/roles/assign-permissions?${params.toString()}`;
        }

        function bulkDelete() {
            const selectedIds = Array.from(document.querySelectorAll('.permission-checkbox:checked')).map(cb => cb.value);
            if (selectedIds.length === 0) {
                alert('يرجى تحديد صلاحية واحدة على الأقل');
                return;
            }

            if (confirm(`هل أنت متأكد من حذف ${selectedIds.length} صلاحية؟`)) {
                // Handle bulk delete
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/permissions/bulk-delete';

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = document.querySelector('meta[name="csrf-token"]').content;
                form.appendChild(csrfInput);

                selectedIds.forEach(id => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'permissions[]';
                    input.value = id;
                    form.appendChild(input);
                });

                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
