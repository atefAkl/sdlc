<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;

// Public home route
Route::get('/', function () {
    return view('home');
})->name('home');

// Language switching route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        App::setLocale($locale);
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Auth Routes (for guests only)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    // Register
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // Password Reset
    Route::get('/forgot-password', [PasswordResetController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'reset'])->name('password.reset');
    Route::post('/reset-password', [PasswordResetController::class, 'update'])->name('password.store');

    // Email Verification
    Route::get('/verify-email', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::post('/email/verification-notification', function () {
        // Resend verification email
        return back()->with('status', 'verification-link-sent');
    })->name('verification.send');
});

// Protected Routes (for authenticated users only)
Route::middleware('auth')->group(function () {
    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Management
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // User Management Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/pending/list', [UserController::class, 'pending'])->name('pending');
        Route::get('/pending/count', [UserController::class, 'pendingCount'])->name('pending.count');
        Route::patch('/{user}/approve', [UserController::class, 'approve'])->name('approve');
        Route::patch('/{user}/reject', [UserController::class, 'reject'])->name('reject');
        Route::get('/assign-roles/form', [UserController::class, 'assignRolesForm'])->name('assign-roles');
        Route::post('/{user}/assign-roles', [UserController::class, 'assignRoles'])->name('assign-roles.store');

        // Additional user management routes
        Route::patch('/{user}/basic-info', [UserController::class, 'updateBasicInfo'])->name('update-basic-info');
        Route::patch('/{user}/account-settings', [UserController::class, 'updateAccountSettings'])->name('update-account-settings');
        Route::patch('/{user}/roles', [UserController::class, 'updateRoles'])->name('update-roles');
        Route::patch('/{user}/admin-notes', [UserController::class, 'updateAdminNotes'])->name('update-admin-notes');
        Route::post('/send-password-reset', [UserController::class, 'sendPasswordResetLink'])->name('send-password-reset');
    });

    // Role Management Routes
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/', [RoleController::class, 'store'])->name('store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy');
        Route::post('/{role}/permissions', [RoleController::class, 'assignPermissions'])->name('assign-permissions');
    });

    // Permission Management Routes
    Route::prefix('permissions')->name('permissions.')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/', [PermissionController::class, 'store'])->name('store');
        Route::get('/{permission}', [PermissionController::class, 'show'])->name('show');
        Route::get('/{permission}/edit', [PermissionController::class, 'edit'])->name('edit');
        Route::patch('/{permission}', [PermissionController::class, 'update'])->name('update');
        Route::delete('/{permission}', [PermissionController::class, 'destroy'])->name('destroy');
        Route::get('/category/{category}', [PermissionController::class, 'getByCategory'])->name('by-category');
        Route::post('/bulk-assign', [PermissionController::class, 'bulkAssignToRoles'])->name('bulk-assign');
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    // Email Verification
    Route::get('/email/verify/{id}/{hash}', function () {
        // Email verification logic
        return redirect('/dashboard');
    })->name('verification.verify');
});
