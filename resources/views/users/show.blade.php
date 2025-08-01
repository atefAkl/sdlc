<!-- filepath: c:\wamp64\www\administration\sdlc\resources\views\users\show.blade.php -->
@extends('layouts.app')

@section('title', 'تفاصيل المستخدم - ' . $user->name)

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="h3 mb-0 text-primary">
                            <i class="fas fa-user fa-icon"></i>
                            تفاصيل المستخدم
                        </h2>
                        <p class="text-muted mb-0">عرض شامل لمعلومات وأداء المستخدم</p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> تعديل
                        </a>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> العودة للقائمة
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- User Basic Info Card -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-id-card fa-icon"></i>
                            المعلومات الأساسية
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <div class="position-relative d-inline-block">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=20c997&color=fff&size=120&font-size=0.5"
                                    alt="{{ $user->name }}" class="rounded-circle border border-3 border-primary"
                                    width="120" height="120">
                                @if ($user->is_active)
                                    <span
                                        class="position-absolute bottom-0 end-0 bg-success rounded-circle p-2 border border-2 border-white">
                                        <i class="fas fa-check text-white" style="font-size: 0.8rem;"></i>
                                    </span>
                                @else
                                    <span
                                        class="position-absolute bottom-0 end-0 bg-warning rounded-circle p-2 border border-2 border-white">
                                        <i class="fas fa-pause text-white" style="font-size: 0.8rem;"></i>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- User Details -->
                        <h4 class="text-primary mb-2">{{ $user->name }}</h4>
                        <p class="text-muted mb-3">{{ $user->email }}</p>

                        <!-- Status Badges -->
                        <div class="mb-3">
                            @if ($user->is_approved)
                                <span class="badge bg-success mb-1">مُعتمد</span>
                            @else
                                <span class="badge bg-warning mb-1">في انتظار الاعتماد</span>
                            @endif

                            @if ($user->is_active)
                                <span class="badge bg-primary mb-1">نشط</span>
                            @else
                                <span class="badge bg-secondary mb-1">غير نشط</span>
                            @endif

                            <span class="badge bg-info mb-1">{{ ucfirst($user->registration_type) }}</span>
                        </div>

                        <!-- Registration Info -->
                        <div class="text-start">
                            <small class="text-muted d-block">تاريخ التسجيل:
                                {{ $user->created_at->format('d/m/Y') }}</small>
                            @if ($user->approved_at)
                                <small class="text-muted d-block">تاريخ الاعتماد:
                                    {{ $user->approved_at->format('d/m/Y') }}</small>
                            @endif
                            @if ($user->last_login_at)
                                <small class="text-muted d-block">آخر دخول:
                                    {{ $user->last_login_at->diffForHumans() }}</small>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Roles & Permissions -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-shield fa-icon"></i>
                            الأدوار والصلاحيات
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- User Roles -->
                            <div class="col-md-6 mb-3">
                                <h6 class="text-primary mb-3">الأدوار المعينة</h6>
                                @if ($user->roles->count() > 0)
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($user->roles as $role)
                                            <span
                                                class="badge bg-primary-subtle text-primary border border-primary px-3 py-2">
                                                <i class="fas fa-shield-alt me-1"></i>
                                                {{ $role->display_name ?? $role->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        لم يتم تعيين أي أدوار بعد
                                    </div>
                                @endif
                            </div>

                            <!-- User Permissions -->
                            <div class="col-md-6 mb-3">
                                <h6 class="text-success mb-3">الصلاحيات المتاحة</h6>
                                @php
                                    $permissions = $user->getAllPermissions();
                                @endphp
                                @if ($permissions->count() > 0)
                                    <div class="row">
                                        @foreach ($permissions->take(6) as $permission)
                                            <div class="col-12 mb-1">
                                                <small class="badge bg-success-subtle text-success border border-success">
                                                    <i class="fas fa-key me-1"></i>
                                                    {{ $permission->display_name ?? $permission->name }}
                                                </small>
                                            </div>
                                        @endforeach
                                        @if ($permissions->count() > 6)
                                            <div class="col-12">
                                                <small class="text-muted">وغيرها {{ $permissions->count() - 6 }} صلاحية
                                                    أخرى...</small>
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-muted">
                                        <i class="fas fa-info-circle"></i>
                                        لا توجد صلاحيات محددة
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Role Actions -->
                        <div class="border-top pt-3 mt-3">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="assignRoles({{ $user->id }})">
                                    <i class="fas fa-user-plus"></i> تعيين أدوار
                                </button>
                                <button class="btn btn-outline-success" onclick="assignPermissions({{ $user->id }})">
                                    <i class="fas fa-key"></i> تعيين صلاحيات
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks and Projects Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-tasks fa-icon"></i>
                            المهام والمشروعات
                        </h5>
                    </div>
                    <div class="card-body">
                        <!-- Projects Stats -->
                        <div class="row mb-4">
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="text-center p-3 bg-primary-subtle rounded">
                                    <i class="fas fa-project-diagram fa-2x text-primary mb-2"></i>
                                    <h4 class="text-primary mb-0">{{ $staticData['projects_stats']['total_projects'] }}
                                    </h4>
                                    <small class="text-muted">إجمالي المشروعات</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="text-center p-3 bg-success-subtle rounded">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <h4 class="text-success mb-0">{{ $staticData['projects_stats']['completed_projects'] }}
                                    </h4>
                                    <small class="text-muted">مشروعات مكتملة</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="text-center p-3 bg-warning-subtle rounded">
                                    <i class="fas fa-clock fa-2x text-warning mb-2"></i>
                                    <h4 class="text-warning mb-0">{{ $staticData['projects_stats']['ongoing_projects'] }}
                                    </h4>
                                    <small class="text-muted">مشروعات جارية</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-3">
                                <div class="text-center p-3 bg-secondary-subtle rounded">
                                    <i class="fas fa-pause-circle fa-2x text-secondary mb-2"></i>
                                    <h4 class="text-secondary mb-0">
                                        {{ $staticData['projects_stats']['pending_projects'] }}</h4>
                                    <small class="text-muted">مشروعات معلقة</small>
                                </div>
                            </div>
                        </div>

                        <!-- Tasks List -->
                        <h6 class="text-primary mb-3">المهام المكلف بها</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>المهمة</th>
                                        <th>المشروع</th>
                                        <th>الحالة</th>
                                        <th>التقدم</th>
                                        <th>الأولوية</th>
                                        <th>تاريخ الاستحقاق</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staticData['tasks'] as $task)
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>{{ $task['title'] }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $task['description'] }}</small>
                                                </div>
                                            </td>
                                            <td>{{ $task['project_name'] }}</td>
                                            <td>
                                                @switch($task['status'])
                                                    @case('completed')
                                                        <span class="badge bg-success">مكتملة</span>
                                                    @break

                                                    @case('in_progress')
                                                        <span class="badge bg-warning">قيد التنفيذ</span>
                                                    @break

                                                    @case('pending')
                                                        <span class="badge bg-secondary">معلقة</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar @if ($task['progress'] == 100) bg-success @elseif($task['progress'] >= 50) bg-warning @else bg-info @endif"
                                                        role="progressbar" style="width: {{ $task['progress'] }}%">
                                                        {{ $task['progress'] }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @switch($task['priority'])
                                                    @case('high')
                                                        <span class="badge bg-danger">عالية</span>
                                                    @break

                                                    @case('medium')
                                                        <span class="badge bg-warning">متوسطة</span>
                                                    @break

                                                    @case('low')
                                                        <span class="badge bg-info">منخفضة</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <small>{{ \Carbon\Carbon::parse($task['due_date'])->format('d/m/Y') }}</small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Evaluations and Skills Section -->
        <div class="row">
            <!-- Evaluations -->
            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-star fa-icon"></i>
                            التقييمات والدرجات
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($staticData['evaluations'] as $evaluation)
                            <div class="border rounded p-3 mb-3 @if (!$loop->last) border-bottom @endif">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h6 class="text-primary mb-1">{{ $evaluation['project_name'] }}</h6>
                                        <p class="text-muted mb-2">{{ $evaluation['phase'] }} Phase</p>
                                        <p class="mb-2">{{ $evaluation['feedback'] }}</p>
                                        <small class="text-muted">
                                            بواسطة: {{ $evaluation['evaluated_by'] }} •
                                            {{ \Carbon\Carbon::parse($evaluation['evaluation_date'])->format('d/m/Y') }}
                                        </small>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="mb-2">
                                            <span
                                                class="badge bg-primary fs-6 px-3 py-2">{{ $evaluation['grade'] }}</span>
                                        </div>
                                        <div class="mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= floor($evaluation['rating']))
                                                    <i class="fas fa-star text-warning"></i>
                                                @elseif($i - 0.5 <= $evaluation['rating'])
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <small class="text-muted">{{ $evaluation['rating'] }}/5.0</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Skills -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-code fa-icon"></i>
                            المهارات التقنية
                        </h5>
                    </div>
                    <div class="card-body">
                        @foreach ($staticData['skills'] as $skill)
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-medium">{{ $skill['name'] }}</span>
                                    <span class="badge bg-primary">{{ $skill['level'] }}%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                        style="width: {{ $skill['level'] }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Assignment Modal -->
    <div class="modal fade" id="assignRolesModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعيين الأدوار</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Role assignment form will be loaded here -->
                    <p class="text-muted">هذه الميزة ستكون متاحة قريباً...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Permissions Assignment Modal -->
    <div class="modal fade" id="assignPermissionsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تعيين الصلاحيات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- Permissions assignment form will be loaded here -->
                    <p class="text-muted">هذه الميزة ستكون متاحة قريباً...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function assignRoles(userId) {
            // Show modal for role assignment
            const modal = new bootstrap.Modal(document.getElementById('assignRolesModal'));
            modal.show();
        }

        function assignPermissions(userId) {
            // Show modal for permissions assignment
            const modal = new bootstrap.Modal(document.getElementById('assignPermissionsModal'));
            modal.show();
        }
    </script>
@endsection
