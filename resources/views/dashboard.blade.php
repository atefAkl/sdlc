@extends('layouts.app')

@section('title', __('messages.dashboard'))

@section('breadcrumb')
<li class="breadcrumb-item active">{{ __('messages.dashboard') }}</li>
@endsection

@section('content')
<div class="row">
    <!-- Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h5>
                    <i class="fas fa-home fa-icon"></i>
                    {{ __('messages.welcome') }} - SDLC Management System
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6>{{ __('messages.welcome') }} {{ Auth::user()->name ?? 'User' }}!</h6>
                        <p class="text-muted">
                            مرحباً بك في نظام إدارة المشروعات البرمجية. يمكنك من خلال هذا النظام إدارة المشروعات باستخدام منهجية Agile.
                        </p>
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary" onclick="showToast('مرحباً! النظام يعمل بشكل ممتاز', 'success')">
                                <i class="fas fa-check fa-icon"></i>
                                اختبار الإشعارات
                            </button>
                            <button class="btn btn-outline-secondary" onclick="toggleLanguage()">
                                <i class="fas fa-language fa-icon"></i>
                                اختبار اللغة
                            </button>
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <i class="fas fa-project-diagram text-primary" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>{{ __('messages.projects') }}</h6>
                        <h3>15</h3>
                        <small>{{ __('messages.active') }}</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-folder-open" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-success-light text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>{{ __('messages.teams') }}</h6>
                        <h3>8</h3>
                        <small>{{ __('messages.active') }}</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning-light text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>{{ __('messages.users') }}</h6>
                        <h3>42</h3>
                        <small>{{ __('messages.active') }}</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-friends text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info-light text-dark">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6>{{ __('messages.clients') }}</h6>
                        <h3>12</h3>
                        <small>{{ __('messages.active') }}</small>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-handshake text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SDLC Phases -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6>
                    <i class="fas fa-sitemap fa-icon"></i>
                    مراحل تطوير البرمجيات (SDLC)
                </h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-search fa-icon text-primary"></i>{{ __('messages.analysis') }}</span>
                        <span class="badge bg-primary rounded-pill">3</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-drafting-compass fa-icon text-success"></i>{{ __('messages.design') }}</span>
                        <span class="badge bg-success rounded-pill">2</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-code fa-icon text-warning"></i>{{ __('messages.development') }}</span>
                        <span class="badge bg-warning rounded-pill">8</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-bug fa-icon text-info"></i>{{ __('messages.testing') }}</span>
                        <span class="badge bg-info rounded-pill">1</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-rocket fa-icon text-danger"></i>{{ __('messages.deployment') }}</span>
                        <span class="badge bg-danger rounded-pill">1</span>
                    </div>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-tools fa-icon text-secondary"></i>{{ __('messages.maintenance') }}</span>
                        <span class="badge bg-secondary rounded-pill">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Levels -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h6>
                    <i class="fas fa-layer-group fa-icon"></i>
                    مستويات المستخدمين
                </h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <div class="list-group-item">
                        <strong><i class="fas fa-crown fa-icon text-warning"></i>{{ __('messages.app_administrators') }}</strong>
                        <small class="text-muted d-block">إدارة كاملة للتطبيق</small>
                    </div>
                    <div class="list-group-item">
                        <strong><i class="fas fa-user-tie fa-icon text-primary"></i>{{ __('messages.administrative_staff') }}</strong>
                        <small class="text-muted d-block">إدارة المشروعات والمهام</small>
                    </div>
                    <div class="list-group-item">
                        <strong><i class="fas fa-laptop-code fa-icon text-success"></i>{{ __('messages.developers_mentors') }}</strong>
                        <small class="text-muted d-block">تكوين الفرق وتنفيذ المهام</small>
                    </div>
                    <div class="list-group-item">
                        <strong><i class="fas fa-handshake fa-icon text-info"></i>{{ __('messages.clients_level') }}</strong>
                        <small class="text-muted d-block">عرض التقدم وتقديم المتطلبات</small>
                    </div>
                    <div class="list-group-item">
                        <strong><i class="fas fa-user-graduate fa-icon text-secondary"></i>{{ __('messages.third_party_interns') }}</strong>
                        <small class="text-muted d-block">وصول محدود ومؤقت</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Language & Direction Test -->
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <h6>
                    <i class="fas fa-globe fa-icon"></i>
                    اختبار اللغة والاتجاه (Language & Direction Test)
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>النص العربي (RTL):</h6>
                        <p class="text-end">
                            هذا نص تجريبي باللغة العربية لاختبار الاتجاه من اليمين إلى اليسار.
                            يجب أن يظهر النص منسقاً بشكل صحيح مع دعم RTL.
                        </p>
                        <div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-primary btn-sm">حفظ</button>
                            <button class="btn btn-outline-secondary btn-sm">إلغاء</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>English Text (LTR):</h6>
                        <p class="text-start">
                            This is a test text in English to check the Left-to-Right direction.
                            The text should be properly formatted with LTR support.
                        </p>
                        <div class="d-flex justify-content-start gap-2">
                            <button class="btn btn-primary btn-sm">Save</button>
                            <button class="btn btn-outline-secondary btn-sm">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Test Modal -->
<div class="modal fade" id="testModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-cog fa-icon"></i>
                    اختبار Modal
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-user fa-icon"></i>
                        {{ __('messages.name') }}
                    </label>
                    <input type="text" class="form-control" placeholder="أدخل الاسم">
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-envelope fa-icon"></i>
                        {{ __('messages.email') }}
                    </label>
                    <input type="email" class="form-control" placeholder="أدخل البريد الإلكتروني">
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        <i class="fas fa-list fa-icon"></i>
                        {{ __('messages.status') }}
                    </label>
                    <select class="form-select">
                        <option>{{ __('messages.active') }}</option>
                        <option>{{ __('messages.inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">
                    <i class="fas fa-save fa-icon"></i>
                    {{ __('messages.save') }}
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times fa-icon"></i>
                    {{ __('messages.cancel') }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleLanguage() {
        const currentLang = document.documentElement.lang;
        const newLang = currentLang === 'ar' ? 'en' : 'ar';
        window.location.href = `/lang/${newLang}`;
    }

    // Test modal
    document.addEventListener('DOMContentLoaded', function() {
        // Add click handler for modal test
        const testButton = document.createElement('button');
        testButton.className = 'btn btn-outline-primary btn-sm mt-3';
        testButton.innerHTML = '<i class="fas fa-window-maximize fa-icon"></i>اختبار Modal';
        testButton.onclick = function() {
            const modal = new bootstrap.Modal(document.getElementById('testModal'));
            modal.show();
        };

        // Add button to the welcome card
        const welcomeCard = document.querySelector('.card-body .d-flex');
        if (welcomeCard) {
            welcomeCard.appendChild(testButton);
        }
    });
</script>
@endpush