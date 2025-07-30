@extends('layouts.guest')

@section('title', __('messages.register'))
@section('page_title', __('messages.register_title'))
@section('page_description', __('messages.register_description'))

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="form-floating mb-3">
        <input id="name"
            class="form-control @error('name') is-invalid @enderror"
            type="text"
            name="name"
            value="{{ old('name') }}"
            required
            autofocus
            autocomplete="name"
            placeholder="{{ __('messages.full_name') }}">
        <label for="name">
            <i class="fas fa-user fa-icon"></i>
            {{ __('messages.full_name') }}
        </label>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Email Address -->
    <div class="form-floating mb-3">
        <input id="email"
            class="form-control @error('email') is-invalid @enderror"
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
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
            autocomplete="new-password"
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

    <!-- Confirm Password -->
    <div class="form-floating mb-4">
        <input id="password_confirmation"
            class="form-control @error('password_confirmation') is-invalid @enderror"
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
            placeholder="{{ __('messages.confirm_password') }}">
        <label for="password_confirmation">
            <i class="fas fa-lock fa-icon"></i>
            {{ __('messages.confirm_password') }}
        </label>
        @error('password_confirmation')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Submit Button -->
    <div class="d-grid">
        <button class="btn btn-primary-custom btn-lg" type="submit">
            <i class="fas fa-user-plus fa-icon"></i>
            {{ __('messages.register_button') }}
        </button>
    </div>
</form>
@endsection

@section('auth_links')
<div class="row text-center">
    <div class="col-12">
        <span class="text-muted small">{{ __('messages.already_have_account') }}</span>
        <a href="{{ route('login') }}" class="small">
            {{ __('messages.login_button') }}
        </a>
    </div>
</div>
@endsection