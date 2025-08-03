@extends('layouts.app')

@section('title', 'تعديل الصلاحية')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
    <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">إدارة الصلاحيات</a></li>
    <li class="breadcrumb-item active">تعديل الصلاحية</li>
@endsection

@section('content')
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                <i class="fas fa-edit fa-2x text-primary me-2"></i>
                تعديل الصلاحية
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i>
                        العودة للقائمة
                    </a>
                    <a href="{{ route('permissions.show', $permission) }}" class="btn btn-outline-info">
                        <i class="fas fa-eye"></i>
                        عرض الصلاحية
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Form Card -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit me-2"></i>
                            تعديل معلومات الصلاحية
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('permissions.update', $permission) }}">
                            @csrf
                            @method('PATCH')

                            <!-- Current Permission Info -->
                            <div class="alert alert-info mb-4">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-info-circle fa-2x me-3"></i>
                                    <div>
                                        <h6 class="mb-1">الصلاحية الحالية</h6>
                                        <strong>{{ $permission->name }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            تم الإنشاء: {{ $permission->created_at->format('Y-m-d H:i') }}
                                            | آخر تحديث: {{ $permission->updated_at->format('Y-m-d H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Permission Name -->
                            <div class="mb-4">
                                <label for="name" class="form-label">
                                    <i class="fas fa-key text-primary me-1"></i>
                                    اسم الصلاحية <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $permission->name) }}" required>
                                <div class="form-text">
                                    <i class="fas fa-exclamation-triangle text-warning me-1"></i>
                                    <strong>تحذير:</strong> تغيير اسم الصلاحية قد يؤثر على الأدوار والمستخدمين المرتبطين بها
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
                                    id="display_name" name="display_name"
                                    value="{{ old('display_name', $permission->display_name ?? ucwords(str_replace('-', ' ', $permission->name))) }}"
                                    placeholder="اسم مفهوم يظهر في واجهة المستخدم">
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary" onclick="window.history.back()">
                                    <i class="fas fa-times"></i>
                                    إلغاء
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    حفظ التعديلات
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Info Card -->
            <div class="col-lg-4">
                <!-- Permission Usage -->
                <div class="card mb-3">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>
                            استخدام الصلاحية
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <strong><i class="fas fa-user-shield text-info me-2"></i>الأدوار المرتبطة:</strong>
                            <span class="badge bg-info ms-2">{{ $permission->roles->count() }}</span>
                        </div>

                        @php
                            $totalUsers = $permission->roles->sum(fn($role) => $role->users->count());
                        @endphp
                        <div class="mb-3">
                            <strong><i class="fas fa-users text-success me-2"></i>المستخدمون المتأثرون:</strong>
                            <span class="badge bg-success ms-2">{{ $totalUsers }}</span>
                        </div>

                        @if ($permission->roles->count() > 0)
                            <div class="mb-3">
                                <strong>الأدوار:</strong>
                                <div class="mt-2">
                                    @foreach ($permission->roles as $role)
                                        <span class="badge bg-secondary me-1 mb-1">
                                            {{ ucwords(str_replace('-', ' ', $role->name)) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if ($permission->roles->count() > 0)
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <small>
                                    <strong>تنبيه:</strong> هذه الصلاحية مستخدمة في {{ $permission->roles->count() }}
                                    دور(أدوار).
                                    تعديل اسمها قد يؤثر على النظام.
                                </small>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Related Permissions -->
                @php
                    $group = explode('-', $permission->name)[0];
                    $relatedPermissions = $permissions->filter(function ($p) use ($permission, $group) {
                        return $p->id !== $permission->id && str_starts_with($p->name, $group . '-');
                    });
                @endphp

                @if ($relatedPermissions->count() > 0)
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-layer-group me-2"></i>
                                صلاحيات مرتبطة ({{ ucwords(str_replace('-', ' ', $group)) }})
                            </h6>
                        </div>
                        <div class="card-body">
                            @foreach ($relatedPermissions as $related)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-light text-dark">{{ $related->name }}</span>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('permissions.show', $related) }}"
                                            class="btn btn-outline-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('permissions.edit', $related) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-tasks me-2"></i>
                            العمليات المتاحة
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('permissions.show', $permission) }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-eye"></i>
                                عرض تفاصيل الصلاحية
                            </a>

                            @if ($permission->roles->count() == 0)
                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fas fa-trash"></i>
                                    حذف الصلاحية
                                </button>
                            @else
                                <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                                    <i class="fas fa-ban"></i>
                                    لا يمكن الحذف (مستخدمة)
                                </button>
                            @endif

                            <a href="{{ route('roles.assign-permissions', [$permission->id]) }}"
                                class="btn btn-outline-success btn-sm">
                                <i class="fas fa-user-shield"></i>
                                تعيين لأدوار
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
                            <strong>هل أنت متأكد من حذف الصلاحية "{{ $permission->name }}"؟</strong>
                        </p>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>تحذير:</strong> هذا الإجراء لا يمكن التراجع عنه.
                        </div>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-key text-warning me-2"></i>الصلاحية: {{ $permission->name }}</li>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const displayNameInput = document.getElementById('display_name');
            const originalName = '{{ $permission->name }}';

            // Warn user about name changes
            nameInput.addEventListener('input', function() {
                if (this.value !== originalName) {
                    this.classList.add('border-warning');
                    if (!document.getElementById('name-warning')) {
                        const warning = document.createElement('div');
                        warning.id = 'name-warning';
                        warning.className = 'alert alert-warning mt-2';
                        warning.innerHTML =
                            '<i class="fas fa-exclamation-triangle me-2"></i>تغيير اسم الصلاحية سيؤثر على جميع الأدوار المرتبطة بها!';
                        this.parentNode.appendChild(warning);
                    }
                } else {
                    this.classList.remove('border-warning');
                    const warning = document.getElementById('name-warning');
                    if (warning) {
                        warning.remove();
                    }
                }
            });

            // Auto-update display name
            nameInput.addEventListener('input', function() {
                if (!displayNameInput.value || displayNameInput.dataset.autoGenerated === 'true') {
                    displayNameInput.value = generateDisplayName(this.value);
                    displayNameInput.dataset.autoGenerated = 'true';
                }
            });

            displayNameInput.addEventListener('input', function() {
                this.dataset.autoGenerated = 'false';
            });
        });

        function generateDisplayName(name) {
            return name.split('-').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
        }
    </script>
@endsection
