@extends('layouts.guest')

@section('title', __('messages.reset_password_title'))
@section('page_title', __('messages.reset_password_title'))
@section('page_description', __('messages.reset_password_description'))

@section('content')
<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Password Reset Token -->
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Email Address -->
    <div class="form-floating mb-3">
        <input id="email"
            class="form-control @error('email') is-invalid @enderror"
            type="email"
            name="email"
            value="{{ old('email', request('email')) }}"
            required
            autofocus
            autocomplete="username"
            readonly
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
    </div> <!-- Password -->
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
            <i class="fas fa-key fa-icon"></i>
            {{ __('messages.reset_password_button') }}
        </button>
    </div>
</form>
@endsection

@section('auth_links')
<div class="row text-center">
    <div class="col-12">
        <a href="{{ route('login') }}" class="small">
            <i class="fas fa-arrow-left fa-icon"></i>
            {{ __('messages.back_to_login') }}
        </a>
    </div>
</div>
@endsection