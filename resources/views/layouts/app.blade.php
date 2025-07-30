<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name <!-- Teams Section -->
    <li class="nav-item">
        <div class="nav-link d-flex justify-content-between align-items-center collapsed"
            data-bs-toggle="collapse"
            data-bs-target="#teamsCollapse"
            aria-expanded="false"
            aria-controls="teamsCollapse"
            style="cursor: pointer;">
            <span>
                <i class="fas fa-users fa-icon"></i>
                {{ __('messages.teams') }}
            </span>
            <i class="fas fa-chevron-down collapse-icon"></i>
        </div>ontent="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SDLC Management') }} - @yield('title', __('messages.dashboard'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <!-- Bootstrap 5 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Bootstrap RTL (for Arabic) -->
        @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.rtl.min.css" integrity="sha384-Xbg45MqvDIk1e563NLpGEulpX6AvL404DP+/iCgW9eFa2BqztiwTexswJo2jLMue" crossorigin="anonymous">
        @endif

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Sidebar Styles -->
        <style>
            .collapse-icon {
                transition: transform 0.3s ease;
            }

            .nav-link:not(.collapsed) .collapse-icon {
                transform: rotate(180deg);
            }

            .nav-link.collapsed .collapse-icon {
                transform: rotate(0deg);
            }

            .sidebar .nav-link {
                padding: 0.75rem 1rem;
                color: #6c757d;
                border-radius: 0.375rem;
                margin-bottom: 0.25rem;
                transition: all 0.3s ease-in-out;
            }

            .sidebar .nav-link:hover {
                background-color: rgba(32, 201, 151, 0.1);
                color: #20c997;
            }

            .sidebar .nav-link.active {
                background-color: #20c997;
                color: white;
            }

            .sidebar .nav-link[data-bs-toggle="collapse"] {
                cursor: pointer;
            }

            .sidebar .nav-link[data-bs-toggle="collapse"]:hover {
                text-decoration: none;
            }

            .fa-icon {
                width: 20px;
                text-align: center;
                margin-right: 0.5rem;
            }

            /* CSS لتغيير اتجاه الأيقونة عند فتح القائمة */
            .nav-link.collapsed .collapse-icon {
                transform: rotate(0deg);
                transition: transform 0.3s ease-in-out;
            }

            .nav-link:not(.collapsed) .collapse-icon {
                transform: rotate(180deg);
                transition: transform 0.3s ease-in-out;
            }
        </style>
</head>

<body class="font-sans antialiased">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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

                    <!-- Navigation Menu -->
                    <ul class="nav flex-column" id="sidebarAccordion">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('dashboard') }}">
                                <i class="fas fa-tachometer-alt fa-icon"></i>
                                {{ __('messages.dashboard') }}
                            </a>
                        </li>

                        <!-- Projects Section -->
                        <li class="nav-item">
                            <div class="nav-link d-flex justify-content-between align-items-center collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectsCollapse"
                                aria-expanded="false"
                                aria-controls="projectsCollapse"
                                style="cursor: pointer;">
                                <span>
                                    <i class="fas fa-folder-open fa-icon"></i>
                                    {{ __('messages.projects') }}
                                </span>
                                <i class="fas fa-chevron-down collapse-icon"></i>
                            </div>
                            <div class="collapse" id="projectsCollapse">
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
                        </li>

                        <!-- Teams Section -->
                        <li class="nav-item">
                            <div class="nav-link d-flex justify-content-between align-items-center collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#teamsCollapse"
                                aria-expanded="false"
                                aria-controls="teamsCollapse"
                                style="cursor: pointer;">
                                <span>
                                    <i class="fas fa-users fa-icon"></i>
                                    {{ __('messages.teams') }}
                                </span>
                                <i class="fas fa-chevron-down collapse-icon"></i>
                            </div>
                            <div class="collapse" id="teamsCollapse">
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
                        </li>

                        <!-- User Management Section -->
                        @can('manage users')
                        <li class="nav-item">
                            <div class="nav-link d-flex justify-content-between align-items-center collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#usersCollapse"
                                aria-expanded="false"
                                aria-controls="usersCollapse"
                                style="cursor: pointer;">
                                <span>
                                    <i class="fas fa-user-cog fa-icon"></i>
                                    {{ __('messages.user_management') }}
                                </span>
                                <i class="fas fa-chevron-down collapse-icon"></i>
                            </div>
                            <div class="collapse" id="usersCollapse" data-bs-parent="#sidebar-nav">
                                <ul class="nav flex-column ms-3">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.index') }}">
                                            <i class="fas fa-list fa-icon"></i>
                                            إدارة المستخدمين
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
                        </li>
                        @endcan

                        <!-- Roles & Permissions Section -->
                        @can('manage roles')
                        <li class="nav-item">
                            <div class="nav-link d-flex justify-content-between align-items-center collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#rolesCollapse"
                                aria-expanded="false"
                                aria-controls="rolesCollapse"
                                style="cursor: pointer;">
                                <span>
                                    <i class="fas fa-user-shield fa-icon"></i>
                                    {{ __('messages.roles_permissions') }}
                                </span>
                                <i class="fas fa-chevron-down collapse-icon"></i>
                            </div>
                            <div class="collapse" id="rolesCollapse" data-bs-parent="#sidebar-nav">
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
                                            تعيين الأدوار
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endcan

                        <!-- Clients -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-handshake fa-icon"></i>
                                {{ __('messages.clients') }}
                            </a>
                        </li>

                        <!-- Reports -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar fa-icon"></i>
                                {{ __('messages.reports') }}
                            </a>
                        </li>

                        <!-- Settings -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog fa-icon"></i>
                                {{ __('messages.settings') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Top Navigation -->
                <header class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <!-- Breadcrumb -->
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>

                    <!-- Search & User Menu -->
                    <div class="d-flex align-items-center">
                        <!-- Search Form -->
                        <form class="d-flex me-3" role="search">
                            <div class="input-group">
                                <input class="form-control" type="search" placeholder="{{ __('messages.search') }}" aria-label="Search">
                                <button class="btn btn-outline-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Language Switcher -->
                        <div class="dropdown me-3">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-globe fa-icon"></i>
                                {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ url('/lang/ar') }}">العربية</a></li>
                                <li><a class="dropdown-item" href="{{ url('/lang/en') }}">English</a></li>
                            </ul>
                        </div>

                        <!-- User Menu -->
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user fa-icon"></i>
                                {{ Auth::user()->name ?? 'User' }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-icon"></i>
                                        {{ __('messages.profile') }}
                                    </a></li>
                                <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-cog fa-icon"></i>
                                        {{ __('messages.settings') }}
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt fa-icon"></i>
                                            {{ __('messages.logout') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @if (app()->getLocale() == 'ar')
    <style>
        .toast-container {
            left: 1rem;
        }
    </style>
    @else
    <style>
        .toast-container {
            right: 1rem;
        }
    </style>
    @endif

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 p-3">
        <!-- Toast messages will be inserted here -->
    </div>



    <!-- Bootstrap JS (bundle only) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom JS -->

    <script>
        // CSRF Token for Ajax requests
        window.csrfToken = '{{ csrf_token() }}';

        // Initialize when DOM is loaded


        // Toast function
        function showToast(message, type = 'success') {
            const toastContainer = document.querySelector('.toast-container');
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-bg-${type} border-0`;
            toast.setAttribute('role', 'alert');
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            toastContainer.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();

            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }
    </script>
    // Show success/error messages from session
    @if(session('success'))

    <script>
        const successMessage = "{{ session('success') }}";
        showToast(successMessage, 'success');
    </script>

    @endif

    @if(session('error'))
    <script>
        const errorMessage = "{{ session('error') }}";
        showToast(errorMessage, 'danger');
    </script>
    @endif

    @stack('scripts')
</body>

</html>