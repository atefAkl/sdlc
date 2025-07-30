<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('messages.welcome') }} - SDLC Management System</title>

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

    <!-- Custom CSS -->
    @vite(['resources/css/app.css'])

    <style>
        .hero-section {
            background: linear-gradient(135deg, #20c997 0%, #17a2b8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }

        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(32, 201, 151, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(32, 201, 151, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(32, 201, 151, 0);
            }
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="text-white">
                        <!-- Language Switcher -->
                        <div class="mb-4">
                            <div class="dropdown">
                                <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-globe me-2"></i>
                                    {{ app()->getLocale() == 'ar' ? 'العربية' : 'English' }}
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ url('/lang/ar') }}">
                                            <i class="fas fa-flag me-2"></i>العربية
                                        </a></li>
                                    <li><a class="dropdown-item" href="{{ url('/lang/en') }}">
                                            <i class="fas fa-flag me-2"></i>English
                                        </a></li>
                                </ul>
                            </div>
                        </div>

                        <h1 class="display-4 fw-bold mb-4">
                            @if(app()->getLocale() == 'ar')
                            نظام إدارة المشروعات البرمجية
                            @else
                            Software Project Management System
                            @endif
                        </h1>

                        <p class="lead mb-4">
                            @if(app()->getLocale() == 'ar')
                            نظام شامل لإدارة المشروعات البرمجية باستخدام منهجية Agile مع دعم كامل لمراحل تطوير البرمجيات (SDLC)
                            @else
                            Comprehensive software project management system using Agile methodology with full support for Software Development Life Cycle (SDLC)
                            @endif
                        </p>

                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg pulse-animation">
                                <i class="fas fa-tachometer-alt me-2"></i>
                                {{ __('messages.dashboard') }}
                            </a>
                            <button class="btn btn-outline-light btn-lg" onclick="scrollToFeatures()">
                                <i class="fas fa-info-circle me-2"></i>
                                @if(app()->getLocale() == 'ar')
                                تعرف على المزيد
                                @else
                                Learn More
                                @endif
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="glass-card p-5 text-white">
                        <div class="text-center mb-4">
                            <i class="fas fa-project-diagram" style="font-size: 4rem;"></i>
                            <h3 class="mt-3">SDLC Management</h3>
                        </div>

                        <div class="row text-center">
                            <div class="col-6 mb-3">
                                <h4>15</h4>
                                <small>{{ __('messages.projects') }}</small>
                            </div>
                            <div class="col-6 mb-3">
                                <h4>8</h4>
                                <small>{{ __('messages.teams') }}</small>
                            </div>
                            <div class="col-6">
                                <h4>42</h4>
                                <small>{{ __('messages.users') }}</small>
                            </div>
                            <div class="col-6">
                                <h4>12</h4>
                                <small>{{ __('messages.clients') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">
                        @if(app()->getLocale() == 'ar')
                        مراحل تطوير البرمجيات
                        @else
                        Software Development Life Cycle
                        @endif
                    </h2>
                    <p class="lead text-muted">
                        @if(app()->getLocale() == 'ar')
                        إدارة شاملة لجميع مراحل تطوير المشروعات البرمجية
                        @else
                        Comprehensive management of all software development phases
                        @endif
                    </p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Phase 1: Analysis -->
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-search text-primary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">{{ __('messages.analysis') }}</h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                تحليل متطلبات المشروع وفهم احتياجات العميل
                                @else
                                Project requirements analysis and understanding client needs
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Phase 2: Design -->
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-drafting-compass text-success" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">{{ __('messages.design') }}</h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                تصميم هيكل النظام والواجهات
                                @else
                                System architecture and interface design
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Phase 3: Development -->
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-code text-warning" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">{{ __('messages.development') }}</h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                تطوير وبرمجة المشروع
                                @else
                                Project development and programming
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Phase 4: Testing -->
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-bug text-info" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">{{ __('messages.testing') }}</h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                اختبار النظام وإصلاح الأخطاء
                                @else
                                System testing and bug fixing
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Phase 5: Deployment -->
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-rocket text-danger" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">{{ __('messages.deployment') }}</h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                إطلاق المشروع ونشره
                                @else
                                Project launch and deployment
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Phase 6: Maintenance -->
                <div class="col-lg-4 col-md-6">
                    <div class="card feature-card h-100 border-0 shadow">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-tools text-secondary" style="font-size: 3rem;"></i>
                            </div>
                            <h5 class="card-title">{{ __('messages.maintenance') }}</h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                صيانة النظام والدعم التقني
                                @else
                                System maintenance and technical support
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Levels Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-5 fw-bold text-primary">
                        @if(app()->getLocale() == 'ar')
                        مستويات المستخدمين
                        @else
                        User Levels
                        @endif
                    </h2>
                </div>
            </div>

            <div class="row g-4">
                <!-- Level 1: App Administrators -->
                <div class="col-lg-6">
                    <div class="card border-warning">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-crown text-warning me-2"></i>
                                {{ __('messages.app_administrators') }}
                            </h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                إدارة كاملة للتطبيق وإعدادات النظام العامة
                                @else
                                Complete application management and general system settings
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level 2: Administrative Staff -->
                <div class="col-lg-6">
                    <div class="card border-primary">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-user-tie text-primary me-2"></i>
                                {{ __('messages.administrative_staff') }}
                            </h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                إدارة المشروعات وتخصيص المهام
                                @else
                                Project management and task assignment
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level 3: Developers & Mentors -->
                <div class="col-lg-6">
                    <div class="card border-success">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-laptop-code text-success me-2"></i>
                                {{ __('messages.developers_mentors') }}
                            </h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                تكوين وإدارة الفرق وتنفيذ المهام
                                @else
                                Team formation and management, task execution
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Level 4: Clients -->
                <div class="col-lg-6">
                    <div class="card border-info">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-handshake text-info me-2"></i>
                                {{ __('messages.clients_level') }}
                            </h5>
                            <p class="card-text">
                                @if(app()->getLocale() == 'ar')
                                عرض تقدم المشروعات وتقديم المتطلبات
                                @else
                                Project progress viewing and requirements submission
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Language Test Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-6 fw-bold text-primary">
                        @if(app()->getLocale() == 'ar')
                        اختبار تبديل اللغة
                        @else
                        Language Switch Test
                        @endif
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-flag me-2"></i>
                                النص العربي (RTL)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-end">
                                هذا نص تجريبي باللغة العربية لاختبار الاتجاه من اليمين إلى اليسار.
                                يجب أن يظهر النص منسقاً بشكل صحيح مع دعم RTL.
                            </p>
                            <div class="d-flex justify-content-end gap-2">
                                <button class="btn btn-success btn-sm" onclick="showMessage('ar')">
                                    <i class="fas fa-check me-1"></i>
                                    اختبار
                                </button>
                                <a href="{{ url('/lang/ar') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-language me-1"></i>
                                    العربية
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fas fa-flag me-2"></i>
                                English Text (LTR)
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="text-start">
                                This is a test text in English to check the Left-to-Right direction.
                                The text should be properly formatted with LTR support.
                            </p>
                            <div class="d-flex justify-content-start gap-2">
                                <button class="btn btn-success btn-sm" onclick="showMessage('en')">
                                    <i class="fas fa-check me-1"></i>
                                    Test
                                </button>
                                <a href="{{ url('/lang/en') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-language me-1"></i>
                                    English
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="mb-4">
                @if(app()->getLocale() == 'ar')
                ابدأ إدارة مشروعاتك الآن
                @else
                Start Managing Your Projects Now
                @endif
            </h2>
            <p class="lead mb-4">
                @if(app()->getLocale() == 'ar')
                انضم إلى آلاف المطورين الذين يستخدمون نظام SDLC لإدارة مشروعاتهم بكفاءة
                @else
                Join thousands of developers using SDLC system to manage their projects efficiently
                @endif
            </p>
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg me-3">
                <i class="fas fa-rocket me-2"></i>
                @if(app()->getLocale() == 'ar')
                ابدأ الآن
                @else
                Get Started
                @endif
            </a>
            <button class="btn btn-outline-light btn-lg" onclick="testFeatures()">
                <i class="fas fa-cog me-2"></i>
                @if(app()->getLocale() == 'ar')
                اختبار الميزات
                @else
                Test Features
                @endif
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            <p class="mb-0">
                &copy; 2025 {{ config('app.name') }} -
                @if(app()->getLocale() == 'ar')
                جميع الحقوق محفوظة
                @else
                All Rights Reserved
                @endif
            </p>
            <small class="text-muted">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </small>
        </div>
    </footer>

    <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 p-3" style="{{ app()->getLocale() == 'ar' ? 'left: 1rem;' : 'right: 1rem;' }}">
        <!-- Toasts will be inserted here -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function scrollToFeatures() {
            document.getElementById('features').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function showMessage(lang) {
            const message = lang === 'ar' ?
                'تم الاختبار بنجاح! النظام يدعم اللغة العربية بشكل كامل' :
                'Test successful! The system fully supports English language';

            showToast(message, 'success');
        }

        function testFeatures() {
            const currentLang = document.documentElement.getAttribute('lang');
            const message = currentLang === 'ar' ?
                'جميع الميزات تعمل بشكل ممتاز! يمكنك الآن الانتقال إلى لوحة التحكم' :
                'All features are working perfectly! You can now proceed to the dashboard';

            showToast(message, 'info');
        }

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

        // Add smooth scrolling to all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Welcome message
        document.addEventListener('DOMContentLoaded', function() {
            const currentLang = document.documentElement.getAttribute('lang');
            const welcomeMessage = currentLang === 'ar' ?
                'مرحباً بك في نظام إدارة المشروعات البرمجية!' :
                'Welcome to the Software Development Life Cycle Management System!';

            setTimeout(() => {
                showToast(welcomeMessage, 'info');
            }, 1000);
        });
    </script>
</body>

</html>