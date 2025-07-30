@extends('layouts.guest')

@section('title', __('messages.login'))
@section('page_title', __('messages.login_title'))
@section('page_description', __('messages.login_description'))

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="form-floating mb-3">
        <input id="email"
            class="form-control @error('email') is-invalid @enderror"
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
            autocomplete="username"
            placeholder="{{ __('messages.email_address') }}">
        <label for="email">
            <i class="fas fa-envelope fa-icon"></i>
            {{ __('messages.email_address') }}
        </label>
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Password -->
    <div class="form-floating mb-3">
        <input id="password"
            class="form-control @error('password') is-invalid @enderror"
            type="password"
            name="password"
            required
            autocomplete="current-password"
            placeholder="{{ __('messages.password') }}">
        <label for="password">
            <i class="fas fa-lock fa-icon"></i>
            {{ __('messages.password') }}
        </label>
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">
            {{ __('messages.remember_me') }}
        </label>
    </div>

    <!-- Submit Button -->
    <div class="d-grid">
        <button class="btn btn-primary-custom btn-lg" type="submit">
            <i class="fas fa-sign-in-alt fa-icon"></i>
            {{ __('messages.login_button') }}
        </button>
    </div>
</form>
@endsection

@section('auth_links')
<div class="row text-center">
    <div class="col-12 mb-2">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}" class="small">
            {{ __('messages.forgot_password_link') }}
        </a>
        @endif
    </div>

    @if (Route::has('register'))
    <div class="col-12">
        <span class="text-muted small">{{ __('messages.dont_have_account') }}</span>
        <a href="{{ route('register') }}" class="small">
            {{ __('messages.register_button') }}
        </a>
    </div>
    @endif
</div>
@endsection