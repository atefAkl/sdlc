<!-- Custom Sidebar Styles -->
<style>
    /* Sidebar General Styles */
    .sidebar {
        background-color: #f8f9fa;
        border-right: 1px solid #dee2e6;
    }

    /* Navigation Links */
    .sidebar .nav-link {
        padding: 0.75rem 1rem;
        color: #6c757d;
        border-radius: 0.375rem;
        margin-bottom: 0.25rem;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link:hover {
        background-color: rgba(32, 201, 151, 0.1);
        color: #20c997;
        text-decoration: none;
    }

    .sidebar .nav-link.active {
        background-color: #20c997;
        color: white !important;
    }

    /* Accordion Button Styles */
    .sidebar .accordion-button {
        padding: 0.75rem 1rem;
        color: #6c757d;
        background-color: transparent;
        border: none;
        border-radius: 0.375rem;
        margin-bottom: 0.25rem;
        transition: all 0.3s ease-in-out;
        box-shadow: none;
        text-align: right;
        justify-content: space-between;
    }

    .sidebar .accordion-button:hover {
        background-color: rgba(32, 201, 151, 0.1);
        color: #20c997;
    }

    .sidebar .accordion-button:not(.collapsed) {
        background-color: rgba(32, 201, 151, 0.2);
        color: #20c997;
        box-shadow: none;
    }

    .sidebar .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23212529'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .sidebar .accordion-button:not(.collapsed)::after {
        transform: rotate(-180deg);
    }

    /* Accordion Body */
    .sidebar .accordion-body {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
    }

    /* Icon Styles */
    .fa-icon {
        width: 20px;
        text-align: center;
        margin-right: 0.5rem;
        margin-left: 0;
    }

    /* RTL Support */
    [dir="rtl"] .fa-icon {
        margin-right: 0;
        margin-left: 0.5rem;
    }

    /* Badge Styles in Sidebar */
    .sidebar .badge {
        font-size: 0.75em;
        padding: 0.25em 0.5em;
    }

    /* Nested Navigation */
    .sidebar .nav-link.ms-3 {
        font-size: 0.9rem;
        padding-left: 2.5rem;
    }

    [dir="rtl"] .sidebar .nav-link.ms-3 {
        padding-right: 2.5rem;
        padding-left: 1rem;
    }

    /* Custom Accordion Item */
    .sidebar .accordion-item {
        background-color: transparent;
        margin-bottom: 0.25rem;
    }

    .sidebar .accordion-item:first-of-type .accordion-button {
        border-top-left-radius: 0.375rem;
        border-top-right-radius: 0.375rem;
    }

    .sidebar .accordion-item:last-of-type .accordion-button.collapsed {
        border-bottom-left-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }

    /* Active Page Indicator */
    .sidebar .nav-link.active .fa-icon {
        color: white;
    }

    /* Custom Scrollbar */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #20c997;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #1a9870;
    }
</style>
<nav class="col-md-3 col-lg-2 d-md-block sidebar custom-scrollbar" style="height: 100vh; overflow-y: auto;">
    <div class="position-sticky pt-3">
        <!-- Logo & Brand -->
        <div class="text-center mb-4">
            <h4 class="text-primary">
                <i class="fas fa-project-diagram fa-icon"></i>
                {{ __('messages.dashboard') }}
            </h4>
            <small class="text-muted">SDLC Management</small>
        </div>

        <!-- Navigation Menu - Bootstrap Accordion -->
        <div class="accordion accordion-flush" id="sidebarAccordion">
            <!-- Dashboard -->
            <div class="nav-item mb-2">
                <a class="nav-link active" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt fa-icon"></i>
                    {{ __('messages.dashboard') }}
                </a>
            </div>

            <!-- Projects Section -->
            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed nav-link" type="button" data-bs-toggle="collapse"
                        data-bs-target="#projectsCollapse" aria-expanded="false" aria-controls="projectsCollapse">
                        <span>
                            <i class="fas fa-folder-open fa-icon"></i>
                            {{ __('messages.projects') }}
                        </span>
                    </button>
                </h2>
                <div id="projectsCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                    <div class="accordion-body p-0">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-plus-circle fa-icon"></i>
                                    {{ __('messages.new_projects') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-clock fa-icon"></i>
                                    {{ __('messages.ongoing_projects') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-check-circle fa-icon"></i>
                                    {{ __('messages.completed_projects') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Teams Section -->
            <div class="accordion-item border-0">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed nav-link" type="button" data-bs-toggle="collapse"
                        data-bs-target="#teamsCollapse" aria-expanded="false" aria-controls="teamsCollapse">
                        <span>
                            <i class="fas fa-users fa-icon"></i>
                            {{ __('messages.teams') }}
                        </span>
                    </button>
                </h2>
                <div id="teamsCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                    <div class="accordion-body p-0">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-cog fa-icon"></i>
                                    {{ __('messages.team_management') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-tasks fa-icon"></i>
                                    {{ __('messages.task_assignment') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="fas fa-chart-line fa-icon"></i>
                                    {{ __('messages.performance_evaluation') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- User Management Section -->
            @can('manage-users')
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed nav-link" type="button" data-bs-toggle="collapse"
                            data-bs-target="#usersCollapse" aria-expanded="false" aria-controls="usersCollapse">
                            <span>
                                <i class="fas fa-user-cog fa-icon"></i>
                                إدارة المستخدمين
                            </span>
                        </button>
                    </h2>
                    <div id="usersCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body p-0">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.index') }}">
                                        <i class="fas fa-list fa-icon"></i>
                                        قائمة المستخدمين
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.create') }}">
                                        <i class="fas fa-user-plus fa-icon"></i>
                                        إضافة مستخدم جديد
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.pending') }}">
                                        <i class="fas fa-clock fa-icon"></i>
                                        المستخدمين المعلقين
                                        @php
                                            $pendingCount = \App\Models\User::where('is_approved', false)->count();
                                        @endphp
                                        @if ($pendingCount > 0)
                                            <span class="badge bg-warning text-dark ms-2">{{ $pendingCount }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.edit') }}">
                                        <i class="fas fa-user-edit fa-icon"></i>
                                        الملف الشخصي
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endcan

            <!-- Roles & Permissions Section -->
            @can('manage-roles')
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed nav-link" type="button" data-bs-toggle="collapse"
                            data-bs-target="#rolesCollapse" aria-expanded="false" aria-controls="rolesCollapse">
                            <span>
                                <i class="fas fa-user-shield fa-icon"></i>
                                الأدوار والصلاحيات
                            </span>
                        </button>
                    </h2>
                    <div id="rolesCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body p-0">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('roles.index') }}">
                                        <i class="fas fa-users-cog fa-icon"></i>
                                        إدارة الأدوار
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('permissions.index') }}">
                                        <i class="fas fa-key fa-icon"></i>
                                        إدارة الصلاحيات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.assign-roles') }}">
                                        <i class="fas fa-user-tag fa-icon"></i>
                                        تعيين الأدوار للمستخدمين
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endcan

            <!-- SDLC Phases Section -->
            @can('manage-phases')
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed nav-link" type="button" data-bs-toggle="collapse"
                            data-bs-target="#phasesCollapse" aria-expanded="false" aria-controls="phasesCollapse">
                            <span>
                                <i class="fas fa-layer-group fa-icon"></i>
                                مراحل SDLC
                            </span>
                        </button>
                    </h2>
                    <div id="phasesCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body p-0">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-search fa-icon"></i>
                                        مرحلة التحليل
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-drafting-compass fa-icon"></i>
                                        مرحلة التصميم
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-code fa-icon"></i>
                                        مرحلة التطوير
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-bug fa-icon"></i>
                                        مرحلة الاختبار
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-rocket fa-icon"></i>
                                        مرحلة الإطلاق
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-tools fa-icon"></i>
                                        مرحلة الصيانة
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endcan

            <!-- Clients Section -->
            @can('manage-clients')
                <div class="nav-item mb-2">
                    <a class="nav-link" href="#">
                        <i class="fas fa-handshake fa-icon"></i>
                        {{ __('messages.clients') }}
                    </a>
                </div>
            @endcan

            <!-- Reports Section -->
            @can('view-reports')
                <div class="accordion-item border-0">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed nav-link" type="button" data-bs-toggle="collapse"
                            data-bs-target="#reportsCollapse" aria-expanded="false" aria-controls="reportsCollapse">
                            <span>
                                <i class="fas fa-chart-bar fa-icon"></i>
                                التقارير والإحصائيات
                            </span>
                        </button>
                    </h2>
                    <div id="reportsCollapse" class="accordion-collapse collapse" data-bs-parent="#sidebarAccordion">
                        <div class="accordion-body p-0">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-chart-line fa-icon"></i>
                                        تقارير المشروعات
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-chart-pie fa-icon"></i>
                                        تقارير الفرق
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-clock fa-icon"></i>
                                        تقارير الوقت
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="fas fa-download fa-icon"></i>
                                        تصدير التقارير
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endcan

            <!-- Settings Section -->
            @can('manage-settings')
                <div class="nav-item mb-2">
                    <a class="nav-link" href="#">
                        <i class="fas fa-cog fa-icon"></i>
                        {{ __('messages.settings') }}
                    </a>
                </div>
            @endcan
        </div>
    </div>
</nav>
