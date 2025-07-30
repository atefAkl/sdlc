<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SDLC Management') }} - @yield('title', __('messages.welcome'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap RTL (for Arabic) -->
    @if(app()->getLocale() == 'ar')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @endif

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Guest Layout Specific Styles */
        .guest-container {
            min-height: 100vh;
            background: linear-gradient(135deg,
                    var(--primary-color, #20c997) 0%,
                    var(--secondary-color, #17a2b8) 50%,
                    var(--accent-color, #6c757d) 100%);
            position: relative;
            overflow: hidden;
        }

        .guest-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .brand-header {
            background: var(--primary-color, #20c997);
            color: white;
            text-align: center;
            padding: 2rem;
            position: relative;
        }

        .brand-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg,
                    rgba(255, 255, 255, 0.1) 25%,
                    transparent 25%,
                    transparent 75%,
                    rgba(255, 255, 255, 0.1) 75%);
            background-size: 20px 20px;
        }

        .brand-logo {
            font-size: 3rem;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }

        .brand-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 1;
        }

        .brand-subtitle {
            opacity: 0.9;
            font-size: 0.9rem;
            position: relative;
            z-index: 1;
        }

        .form-container {
            padding: 2rem;
        }

        .form-floating .form-control {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            padding: 1rem 0.75rem;
            height: auto;
        }

        .form-floating .form-control:focus {
            border-color: var(--primary-color, #20c997);
            box-shadow: 0 0 0 0.2rem rgba(32, 201, 151, 0.25);
        }

        .btn-primary-custom {
            background: var(--primary-color, #20c997);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background: var(--primary-dark, #17a085);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(32, 201, 151, 0.4);
        }

        .language-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }

        .language-switcher .btn {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            backdrop-filter: blur(10px);
        }

        .language-switcher .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .auth-links {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .auth-links a {
            color: var(--primary-color, #20c997);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .auth-links a:hover {
            color: var(--primary-dark, #17a085);
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            border: none;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .floating-circle:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-circle:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 15%;
            animation-delay: 2s;
        }

        .floating-circle:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        .floating-circle:nth-child(4) {
            width: 40px;
            height: 40px;
            bottom: 10%;
            right: 10%;
            animation-delay: 1s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* RTL Specific Styles */
        [dir="rtl"] .language-switcher {
            right: auto;
            left: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .auth-card {
                margin: 1rem;
                border-radius: 15px;
            }

            .brand-header {
                padding: 1.5rem;
            }

            .brand-logo {
                font-size: 2.5rem;
            }

            .brand-title {
                font-size: 1.25rem;
            }

            .form-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="guest-container d-flex align-items-center justify-content-center">
        <!-- Floating Elements -->
        <div class="floating-elements">
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
            <div class="floating-circle"></div>
        </div>

        <!-- Language Switcher -->
        <div class="language-switcher">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-globe fa-icon"></i>
                    {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/lang/ar') }}">العربية</a></li>
                    <li><a class="dropdown-item" href="{{ url('/lang/en') }}">English</a></li>
                </ul>
            </div>
        </div>

        <!-- Auth Card -->
        <div class="auth-card col-11 col-sm-8 col-md-6 col-lg-4">
            <!-- Brand Header -->
            <div class="brand-header">
                <div class="brand-logo">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <h1 class="brand-title">SDLC Management</h1>
                <p class="brand-subtitle">{{ __('messages.system_description') }}</p>
            </div>

            <!-- Form Container -->
            <div class="form-container">
                <!-- Page Title -->
                <div class="text-center mb-4">
                    <h2 class="h4 text-dark mb-1">@yield('page_title')</h2>
                    <p class="text-muted small">@yield('page_description')</p>
                </div>

                <!-- Flash Messages -->
                @if(session('status'))
                <div class="alert alert-success mb-4">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('status') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Main Content -->
                @yield('content')

                <!-- Auth Links -->
                <div class="auth-links">
                    @yield('auth_links')
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 p-3" style="{{ app()->getLocale() == 'ar' ? 'left: 1rem;' : 'right: 1rem;' }}">
        <!-- Toast messages will be inserted here -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // CSRF Token for Ajax requests
        window.csrfToken = '{{ csrf_token() }}';

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

        // Show success/error messages from session
        @if(session('success'))
        showToast('{{ session('
            success ') }}', 'success');
        @endif

        @if(session('error'))
        showToast('{{ session('
            error ') }}', 'danger');
        @endif

        // Form validation enhancement
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>' + submitBtn.textContent;

                        // Re-enable after 5 seconds as fallback
                        setTimeout(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = submitBtn.textContent.replace(/^.*?\s/, '');
                        }, 5000);
                    }
                });
            });

            // Enhanced form field animations
            const formControls = document.querySelectorAll('.form-control');
            formControls.forEach(control => {
                control.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                control.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>

    @stack('scripts')
</body>

</html>