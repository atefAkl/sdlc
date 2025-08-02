@extends('layouts.app')
@section('title', __('messages.profile'))
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
<li class="breadcrumb-item active">{{ __('messages.profile') }}</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- User Info & Password (Common for all) -->
        <div class="col-lg-4">
            {{-- Card for Profile Picture and Basic Info --}}
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="https://i.pravatar.cc/150?u={{ auth()->id() }}" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3">{{ auth()->user()->name }}</h5>
                    <p class="text-muted mb-1">{{ auth()->user()->getRoleNames()->implode(', ') }}</p>
                    <p class="text-muted mb-4">{{ auth()->user()->email }}</p>
                </div>
            </div>

            {{-- Card for Password Change --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('messages.change_password') }}</h5>
                </div>
                <div class="card-body">
                    {{-- Password change form goes here --}}
                    <p class="text-muted">Form to change password...</p>
                </div>
            </div>
        </div>

        <!-- Dynamic Content based on Role -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('messages.user_details') }}</h5>
                </div>
                <div class="card-body">
                    {{-- User details form goes here --}}
                    <p class="text-muted">Form to update name and email...</p>
                </div>
            </div>

            {{-- This section will only show for users who can manage projects --}}
            @can('manage-projects')
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Assigned Projects</h5>
                </div>
                <div class="card-body">
                    <p>A list of projects assigned to this developer/admin will appear here.</p>
                </div>
            </div>
            @endcan

            {{-- This section will only show for Clients --}}
            @hasrole('client')
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Billing History</h5>
                </div>
                <div class="card-body">
                    <p>A table with invoices and payment status will appear here for the client.</p>
                </div>
            </div>
            @endhasrole

            {{-- This section will only show for Interns --}}
            @hasrole('intern')
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Mentorship Details</h5>
                </div>
                <div class="card-body">
                    <p>Details about the assigned mentor and learning path will appear here.</p>
                </div>
            </div>
            @endhasrole

        </div>
    </div>
</div>
@endsection