@extends('layouts.guest')

@section('title', __('messages.email_verification_title'))
@section('page_title', __('messages.email_verification_title'))
@section('page_description', __('messages.email_verification_description'))

@section('content')
<div class="text-center mb-4">
    <div class="mb-4">
        <i class="fas fa-envelope-open-text" style="font-size: 4rem; color: var(--primary-color, #20c997);"></i>
    </div>

    <p class="text-muted">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </p>
</div>

@if (session('status') == 'verification-link-sent')
<div class="alert alert-success mb-4">
    <i class="fas fa-check-circle me-2"></i>
    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
</div>
@endif

<div class="row">
    <div class="col-12 mb-3">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="d-grid">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-paper-plane fa-icon"></i>
                    {{ __('messages.resend_verification') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('auth_links')
<div class="row text-center">
    <div class="col-12">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link small p-0">
                <i class="fas fa-sign-out-alt fa-icon"></i>
                {{ __('messages.logout') }}
            </button>
        </form>
    </div>
</div>
@endsection