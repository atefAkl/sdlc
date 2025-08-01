<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SDLC Management') }} - @yield('title', __('messages.dashboard'))</title>
    {{-- Application Favicon --*/>
    <-- Favicon --}}
    <link href="{{ asset('assets/images/SDT Green.png') }}" rel="icon" type="image/x-icon" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap RTL (for Arabic) -->
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-Xbg45MqvDIk1e563NLpGEulpX6AvL404DP+/iCgW9eFa2BqztiwTexswJo2jLMue" crossorigin="anonymous">
    @endif

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom RTL Support -->
    <style>
        @media (max-width: 767.98px) {
            main {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
        }

        /* RTL adjustments for main content */
        [dir="rtl"] main {
            margin-right: 250px;
            margin-left: 0;
        }

        [dir="ltr"] main {
            margin-left: 250px;
            margin-right: 0;
        }

        /* Mobile responsive */
        @media (max-width: 767.98px) {

            [dir="rtl"] main,
            [dir="ltr"] main {
                margin-left: 0 !important;
                margin-right: 0 !important;
            }
        }
    </style>

</head>

<body class="font-sans antialiased">
    <!-- Sidebar -->
    @include('includes.sidebar')

    <!-- Main Content -->
    <main style="min-height: 100vh;">
        <div class="container-fluid px-4">
            <!-- Mobile Sidebar Toggle -->
            <button class="btn btn-primary sidebar-toggle d-md-none mb-3" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Top Navigation -->
            <header
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
                            <input class="form-control" type="search" placeholder="{{ __('messages.search') }}"
                                aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Language Switcher -->
                    <div class="dropdown me-3">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
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
                        <button class="btn btn-outline-primary dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
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
        </div>
    </main>

    @media (max-width: 767.98px) {
    main {
    margin-left: 0 !important;
    }
    }

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Custom JS -->

    <script>
        // CSRF Token for Ajax requests
        window.csrfToken = '{{ csrf_token() }}';

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Accordion Management
            const accordionButtons = document.querySelectorAll('.sidebar .accordion-button');

            accordionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Close other accordion items when opening a new one
                    const currentTarget = this.getAttribute('data-bs-target');
                    const currentCollapse = document.querySelector(currentTarget);

                    // Optional: Auto-close other sections when opening a new one
                    // Uncomment the following lines if you want only one section open at a time
                    /*
                    accordionButtons.forEach(otherButton => {
                        if (otherButton !== this) {
                            const otherTarget = otherButton.getAttribute('data-bs-target');
                            const otherCollapse = document.querySelector(otherTarget);
                            if (otherCollapse && otherCollapse.classList.contains('show')) {
                                const bsCollapse = new bootstrap.Collapse(otherCollapse, {
                                    toggle: false
                                });
                                bsCollapse.hide();
                            }
                        }
                    });
                    */
                });
            });

            // Highlight active navigation item based on current URL
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar .nav-link[href]');

            navLinks.forEach(link => {
                // Remove existing active classes
                link.classList.remove('active');

                // Check if this link matches current path
                const linkPath = new URL(link.href).pathname;
                if (currentPath === linkPath) {
                    link.classList.add('active');

                    // Also expand parent accordion if this link is inside one
                    const parentCollapse = link.closest('.accordion-collapse');
                    if (parentCollapse) {
                        parentCollapse.classList.add('show');
                        const parentButton = document.querySelector(
                            `[data-bs-target="#${parentCollapse.id}"]`);
                        if (parentButton) {
                            parentButton.classList.remove('collapsed');
                            parentButton.setAttribute('aria-expanded', 'true');
                        }
                    }
                }
            });

            // Add smooth scrolling to sidebar
            const sidebar = document.querySelector('.sidebar');
            if (sidebar) {
                sidebar.style.scrollBehavior = 'smooth';
            }
        });

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
            const bsToast = new bootstrap.Toast(toast, {
                autohide: true,
                delay: 5000
            });
            bsToast.show();

            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', () => {
                toast.remove();
            });
        }

        // Function to update pending users count
        function updatePendingUsersCount() {
            fetch('/users/pending-count', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': window.csrfToken,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const pendingBadge = document.querySelector('.sidebar a[href*="pending"] .badge');
                    if (data.count > 0) {
                        if (pendingBadge) {
                            pendingBadge.textContent = data.count;
                        } else {
                            // Create badge if it doesn't exist
                            const pendingLink = document.querySelector('.sidebar a[href*="pending"]');
                            if (pendingLink) {
                                const badge = document.createElement('span');
                                badge.className = 'badge bg-warning text-dark ms-2';
                                badge.textContent = data.count;
                                pendingLink.appendChild(badge);
                            }
                        }
                    } else {
                        if (pendingBadge) {
                            pendingBadge.remove();
                        }
                    }
                })
                .catch(error => {
                    console.log('Error updating pending users count:', error);
                });
        }

        // Update pending count every 30 seconds
        setInterval(updatePendingUsersCount, 30000);
    </script>
    // Show success/error messages from session
    @if (session('success'))
        <script>
            const successMessage = "{{ session('success') }}";
            showToast(successMessage, 'success');
        </script>
    @endif

    @if (session('error'))
        <script>
            const errorMessage = "{{ session('error') }}";
            showToast(errorMessage, 'danger');
        </script>
    @endif

    @stack('scripts')
</body>

</html>
