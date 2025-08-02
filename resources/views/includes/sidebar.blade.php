<!-- Custom Sidebar Styles -->
<style>
    :root {
        --sidebar-bg-color: #016b4bff;
        --text-color-light: #fff;
        --text-color-lite: #acf5dfff;
        --sidebar-border-color: #dee2e6;
        --navitem-color: #6c757d;
        --navitem-bg-color: #dcf1eb;
        --navitem-active-color: #eafdf0;
        --navlitem-active-bg-color: #20c997;
        --sidebar-active-text-color: white;
        --sidebar-hover-bg-color: rgba(32, 201, 151, 0.1);
        --sidebar-hover-text-color: #20c997;
    }

    .text-light {
        color: var(--text-color-light);
    }

    .text-lite {
        color: var(--text-color-lite);
    }

    .breadcrumb-item a {
        color: var(--text-color-light);
    }

    /* Adjustments for the breadcrumb textcolor */
    ol.breadcrumb li.breadcrumb-item:before,
    ol.breadcrumb li.breadcrumb-item:after {
        color: var(--text-color-light);
        padding-inline-start: 1rem;
        font-size: 1.5rem;
        transform: scaleY(1.3);
    }

    /* RTL Adjustments for the breadcrumb separator */
    [dir=rtl] ol.breadcrumb li.breadcrumb-item:first-child:before,
    [dir=rtl] ol.breadcrumb li.breadcrumb-item:last-child:after,
    [dir=rtl] ol.breadcrumb li.breadcrumb-item:before {
        content: "";
    }

    [dir=rtl] ol.breadcrumb li.breadcrumb-item:after {
        content: "\22B3";
    }

    /* LTR Adjustments for the breadcrumb separator */
    [dir=ltr] ol.breadcrumb li.breadcrumb-item:last-child:after,
    [dir=ltr] ol.breadcrumb li.breadcrumb-item:before,
    [dir=ltr] ol.breadcrumb li.breadcrumb-item.active:before {
        content: "";
    }

    [dir=ltr] ol.breadcrumb li.breadcrumb-item:after {
        content: "\22B3";
    }

    .breadcrumb-item a:hover,
    .breadcrumb-item.active {
        color: var(--text-color-lite);
    }

    /* Adjustment for Sidebar Styles */
    .sidebar {
        background-color: var(--sidebar-bg-color);
        border-inline-start: 1px solid #dee2e6;
        height: 100vh;
        overflow-y: auto;
        position: fixed;
        top: 0;
        width: 250px;
        z-index: 1000;
    }

    .sidebar .brand-section {
        background-color: var(--navlitem-active-bg-color);
        color: var(--navitem-active-color);
        padding: 1rem 1rem 0;
    }

    /* LTR Override for specific content */
    html[dir="rtl"] .sidebar * {
        right: 0 !important;
        direction: rtl;
    }

    @media (max-width: 767.98px) {
        .sidebar {
            position: fixed;
            transform: translateX(100%);
            /* RTL adjustment */
            transition: transform 0.3s ease-in-out;
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }

    /* Main Navigation Items */
    .sidebar .nav-item {
        width: 100%;
        background-color: var(--navitem-bg-color);
        color: var(--navlitem-color);
        border-radius: 0;
        margin-bottom: 1px;
    }

    .sidebar .nav-link {
        padding: 0.875rem 1rem;
        color: #6c757d;
        width: 100%;
        transition: all 0.3s ease-in-out;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        border: none;
        background: none;
        font-weight: 500;
        border-radius: 0;
    }

    .sidebar .nav-link:hover {
        background-color: #20c9971a;
        color: #20c997;
        text-decoration: none;
    }

    .sidebar .nav-link.active {
        background-color: #20c997;
        color: white !important;
    }

    .sidebar .nav-link.active .fa-icon {
        color: white;
    }

    /* Icon and Text Container */
    .sidebar .nav-link .nav-content {
        display: flex;
        align-items: center;
        flex: 1;
    }

    .fa-icon {
        width: 20px;
        text-align: center;
        margin-inline-end: 0.75rem;
        flex-shrink: 0;
    }

    /* Dropdown Arrow */
    .sidebar .nav-link .dropdown-arrow {
        margin-inline-start: 0.5rem;
        font-size: 0.75rem;
        transition: transform 0.3s ease;
        opacity: 0.7;
    }

    .sidebar .nav-link.open .dropdown-arrow {
        transform: rotate(180deg);
    }

    /* Badge Styling */
    .sidebar .badge {
        font-size: 0.65rem;
        padding: 0.2rem 0.4rem;
        margin-inline-start: 0.5rem;
    }

    .sidebar-toggle {
        display: none;
    }

    @media (max-width: 767.98px) {
        .sidebar-toggle {
            display: block;
        }
    }

    /* Custom Scrollbar */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #20c997;
    }

    .sidebar::-webkit-scrollbar-thumb:hover {
        background: #1a9870;
    }

    /* Submenu Styles */
    .sidebar .submenu {
        display: none;
        background-color: transparent;
        border-inline-start: 3px solid #20c997;
        margin-top: 0;
        padding: 0.25rem 0;
    }

    .sidebar .submenu.show {
        display: block;
    }

    .sidebar .submenu .nav-link {
        font-size: 0.875rem;
        padding: 0.5rem;
        font-weight: 400;
        color: #5a6c7d;
        background-color: transparent;
    }

    .sidebar .submenu .nav-link:hover {
        background-color: rgba(32, 201, 151, 0.1) !important;
        color: #20c997 !important;
        padding-inline-start: 2rem;
        /* Keep consistent padding */
    }

    .sidebar .submenu .nav-link.active {
        background-color: rgba(32, 201, 151, 0.15) !important;
        color: #034d37 !important;
        font-weight: 500;
    }

    .sidebar .submenu .nav-link .nav-content {
        display: flex;
        align-items: center;
    }

    .sidebar .submenu .nav-link .fa-icon {
        width: 16px;
        font-size: 0.8rem;
        margin-inline-end: 0.5rem;
        opacity: 0.8;
        flex-shrink: 0;
        color: #034d37;
    }


    /* Section Headers */
    .sidebar .nav-section {
        padding: 1rem 1rem 0.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        color: #9ca3af;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    /* Ensure consistent styling for all nav-links */
    .sidebar .nav-link {
        position: relative;
        overflow: hidden;
    }

    /* Remove conflicting background effects */
    .sidebar .nav-link::before {
        display: none;
    }

    /* Main navigation hover effect */
    .sidebar .nav-item>.nav-link:hover {
        background-color: rgba(32, 201, 151, 0.1) !important;
        color: #20c997 !important;
    }

    /* Main navigation active state */
    .sidebar .nav-item>.nav-link.active {
        background-color: #20c997 !important;
        color: white !important;
    }

    .sidebar .nav-link:hover::before {
        width: 100%;
    }

    .sidebar .nav-link:hover {
        position: relative;
        z-index: 1;
    }
</style>

<nav class="sidebar">
    <div class="d-grid">
        <!-- Logo & Brand -->
        <a href="{{ route('dashboard') }}" class="brand-section text-center pb-3 mb-1">
            <h4 class="fs-3 fw-bold">
                <img width="60" style="display: block; margin: 0 auto;"
                    src="{{ asset('assets/images/SDT White.png') }}" alt="">
            </h4>
            <small class="text-light">{{ __('sidebar.ashboard') }}</small>
        </a>

        <!-- Navigation Menu -->
        <div class="nav flex-column">


            <!-- Projects Section -->
            <div class="nav-item">
                <a class="nav-link has-submenu" onclick="toggleSubmenu(this)">
                    <div class="nav-content">
                        <i class="fas fa-folder-open fa-icon"></i>
                        {{ __('sidebar.projects') }}
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="submenu">
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-plus-circle fa-icon"></i>
                            {{ __('sidebar.new_projects') }}
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-clock fa-icon"></i>
                            {{ __('sidebar.ongoing_projects') }}
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-check-circle fa-icon"></i>
                            {{ __('sidebar.completed_projects') }}
                        </div>
                    </a>
                </div>
            </div>

            <!-- Teams Section -->
            <div class="nav-item">
                <a class="nav-link has-submenu" onclick="toggleSubmenu(this)">
                    <div class="nav-content">
                        <i class="fas fa-users fa-icon"></i>
                        {{ __('sidebar.teams') }}
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="submenu">
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-cog fa-icon"></i>
                            {{ __('sidebar.team_management') }}
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-tasks fa-icon"></i>
                            {{ __('sidebar.tasks') }}
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-chart-line fa-icon"></i>
                            {{ __('sidebar.evaluation') }}
                        </div>
                    </a>
                </div>
            </div>

            <!-- User Management Section -->
            @can('manage-users')

            <div class="nav-item">
                <a class="nav-link has-submenu{{ request()->is('users*') ? ' active' : '' }}"
                    onclick="toggleSubmenu(this)">
                    <div class="nav-content">
                        <i class="fas fa-user-cog fa-icon"></i>
                        إدارة المستخدمين
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="submenu{{ request()->is('users*') ? ' show' : '' }}">
                    <a class="nav-link" href="{{ route('users.index') }}">
                        <div class="nav-content">
                            <i class="fas fa-list fa-icon"></i>
                            قائمة المستخدمين
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('users.create') }}">
                        <div class="nav-content">
                            <i class="fas fa-user-plus fa-icon"></i>
                            إضافة مستخدم جديد
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('users.pending') }}">
                        <div class="nav-content">
                            <i class="fas fa-clock fa-icon"></i>
                            المستخدمين المعلقين
                            @php
                            $pendingCount = \App\Models\User::where('is_approved', false)->count();
                            @endphp
                            @if ($pendingCount > 0)
                            <span class="badge bg-warning text-dark">{{ $pendingCount }}</span>
                            @endif
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('profile.edit', Auth::id()) }}">
                        <div class="nav-content">
                            <i class="fas fa-user-edit fa-icon"></i>
                            الملف الشخصي
                        </div>
                    </a>
                </div>
            </div>

            @endcan

            <!-- Roles & Permissions Section -->
            @if ('manage-roles')
            <div class="nav-item">
                <a class="nav-link has-submenu" onclick="toggleSubmenu(this)">
                    <div class="nav-content">
                        <i class="fas fa-user-shield fa-icon"></i>
                        الأدوار والصلاحيات
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="submenu">
                    <a class="nav-link" href="{{ route('roles.index') }}">
                        <div class="nav-content">
                            <i class="fas fa-users-cog fa-icon"></i>
                            إدارة الأدوار
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('permissions.index') }}">
                        <div class="nav-content">
                            <i class="fas fa-key fa-icon"></i>
                            إدارة الصلاحيات
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('users.assign-roles') }}">
                        <div class="nav-content">
                            <i class="fas fa-user-tag fa-icon"></i>
                            تعيين الأدوار للمستخدمين
                        </div>
                    </a>
                </div>
            </div>
            @endcan

            <!-- SDLC Phases Section -->
            @can('manage-phases')
            <div class="nav-item">
                <a class="nav-link has-submenu" onclick="toggleSubmenu(this)">
                    <div class="nav-content">
                        <i class="fas fa-layer-group fa-icon"></i>
                        مراحل SDLC
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="submenu">
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-search fa-icon"></i>
                            مرحلة التحليل
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-drafting-compass fa-icon"></i>
                            مرحلة التصميم
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-code fa-icon"></i>
                            مرحلة التطوير
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-bug fa-icon"></i>
                            مرحلة الاختبار
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-rocket fa-icon"></i>
                            مرحلة الإطلاق
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-tools fa-icon"></i>
                            مرحلة الصيانة
                        </div>
                    </a>
                </div>
            </div>
            @endcan

            <!-- Clients Section -->
            @can('manage-clients')
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <div class="nav-content">
                        <i class="fas fa-handshake fa-icon"></i>
                        {{ __('messages.clients') }}
                    </div>
                </a>
            </div>
            @endcan

            <!-- Reports Section -->
            @can('view-reports')
            <div class="nav-item">
                <a class="nav-link has-submenu" onclick="toggleSubmenu(this)">
                    <div class="nav-content">
                        <i class="fas fa-chart-bar fa-icon"></i>
                        التقارير والإحصائيات
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="submenu">
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-chart-line fa-icon"></i>
                            تقارير المشروعات
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-chart-pie fa-icon"></i>
                            تقارير الفرق
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-clock fa-icon"></i>
                            تقارير الوقت
                        </div>
                    </a>
                    <a class="nav-link" href="#">
                        <div class="nav-content">
                            <i class="fas fa-download fa-icon"></i>
                            تصدير التقارير
                        </div>
                    </a>
                </div>
            </div>
            @endcan

            <!-- Settings Section -->
            @can('manage-settings')
            <div class="nav-item">
                <a class="nav-link has-submenu" onclick="toggleSubmenu(this)">
                    <div class="nav-content">
                        <i class="fas fa-cog fa-icon"></i>
                        {{ __('messages.settings') }}
                    </div>
                    <span class="dropdown-arrow">▼</span>
                </a>
                <div class="submenu">
                </div>
            </div>
            @endcan
        </div>
    </div>
</nav>

<!-- Enhanced JavaScript for Sidebar -->
<script>
    function toggleSubmenu(element) {
        // Close all other submenus
        const allSubmenus = document.querySelectorAll('.sidebar .submenu');
        const allMenus = document.querySelectorAll('.sidebar .has-submenu');

        allMenus.forEach(menu => {
            if (menu !== element) {
                menu.classList.remove('open');
            }
        });

        allSubmenus.forEach(submenu => {
            if (submenu !== element.parentNode.querySelector('.submenu')) {
                submenu.classList.remove('show');
            }
        });

        // Toggle current submenu
        const parentNavItem = element.closest('.nav-item');
        const submenu = parentNavItem.querySelector('.submenu');

        if (submenu) {
            submenu.classList.toggle('show');
            element.classList.toggle('open');
        }
    }

    // Set active menu item based on current URL
    document.addEventListener('DOMContentLoaded', function() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar .nav-link[href]');

        navLinks.forEach(link => {
            // Remove active class from all links first
            link.classList.remove('active');

            if (link.getAttribute('href') === currentPath) {
                // Add active class to current link
                link.classList.add('active');

                // If it's a submenu item, show its parent submenu
                const parentSubmenu = link.closest('.submenu');
                if (parentSubmenu) {
                    parentSubmenu.classList.add('show');
                    const parentNavItem = parentSubmenu.closest('.nav-item');
                    const parentMenu = parentNavItem.querySelector('.has-submenu');
                    if (parentMenu) {
                        parentMenu.classList.add('open');
                    }
                }
            }
        });
    });

    // Mobile sidebar toggle
    function toggleSidebar() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('show');
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(e) {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.sidebar-toggle');

        if (window.innerWidth <= 767.98 &&
            !sidebar.contains(e.target) &&
            (!toggleBtn || !toggleBtn.contains(e.target)) &&
            sidebar.classList.contains('show')) {
            sidebar.classList.remove('show');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        const sidebar = document.querySelector('.sidebar');
        if (window.innerWidth > 767.98) {
            sidebar.classList.remove('show');
        }
    });
</script>