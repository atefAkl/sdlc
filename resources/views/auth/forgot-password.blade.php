@extends('layouts.guest')

@section('title', __('messages.forgot_password_title'))
@section('page_title', __('messages.forgot_password_title'))
@section('page_description', __('messages.forgot_password_description'))

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div class="form-floating mb-4">
        <input id="email"
            class="form-control @error('email') is-invalid @enderror"
            type="email"
            name="email"
            value="{{ old('email') }}"
            required
            autofocus
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

    <!-- Submit Button -->
    <div class="d-grid">
        <button class="btn btn-primary-custom btn-lg" type="submit">
            <i class="fas fa-paper-plane fa-icon"></i>
            {{ __('messages.send_reset_link') }}
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