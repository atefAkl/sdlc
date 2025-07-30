<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create Permissions
        $permissions = [
            // System Administration
            'manage-system-settings',
            'manage-application-config',
            'view-system-logs',
            'backup-restore-data',

            // User Management
            'create-users',
            'view-users',
            'edit-users',
            'delete-users',
            'activate-users',
            'deactivate-users',
            'reset-user-passwords',
            'view-pending-users',
            'approve-user-registrations',

            // Role & Permission Management
            'create-roles',
            'view-roles',
            'edit-roles',
            'delete-roles',
            'assign-roles-to-users',
            'create-permissions',
            'view-permissions',
            'edit-permissions',
            'delete-permissions',
            'assign-permissions-to-roles',
            'assign-direct-permissions-to-users',

            // Project Management
            'create-projects',
            'view-projects',
            'edit-projects',
            'delete-projects',
            'manage-project-phases',
            'assign-projects-to-teams',

            // Team Management
            'create-teams',
            'view-teams',
            'edit-teams',
            'delete-teams',
            'assign-team-members',
            'manage-team-roles',

            // Task Management
            'create-tasks',
            'view-tasks',
            'edit-tasks',
            'delete-tasks',
            'assign-tasks',
            'update-task-status',
            'view-task-progress',

            // Client Management
            'create-clients',
            'view-clients',
            'edit-clients',
            'delete-clients',
            'manage-client-projects',
            'view-client-feedback',

            // Reports & Analytics
            'view-all-reports',
            'generate-reports',
            'export-reports',
            'view-analytics-dashboard',
            'view-performance-metrics',

            // Profile Management
            'view-own-profile',
            'edit-own-profile',
            'change-own-password',

            // Limited Access (for Third Party/Interns)
            'view-assigned-tasks-only',
            'update-assigned-tasks-only',
            'view-assigned-projects-only',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Create Roles and assign permissions

        // Level 1: App Administrators (مديرو التطبيق)
        $appAdmin = Role::firstOrCreate(['name' => 'App Administrator']);
        $appAdmin->givePermissionTo(Permission::all()); // All permissions

        // Level 2: Administrative Staff (الموظفون الإداريون)
        $adminStaff = Role::firstOrCreate(['name' => 'Administrative Staff']);
        $adminStaffPermissions = [
            // User Management (limited)
            'view-users',
            'create-users',
            'edit-users',
            'activate-users',
            'deactivate-users',
            'view-pending-users',
            'approve-user-registrations',
            'reset-user-passwords',

            // Project Management (full)
            'create-projects',
            'view-projects',
            'edit-projects',
            'delete-projects',
            'manage-project-phases',
            'assign-projects-to-teams',

            // Team Management (full)
            'create-teams',
            'view-teams',
            'edit-teams',
            'delete-teams',
            'assign-team-members',
            'manage-team-roles',

            // Task Management (full)
            'create-tasks',
            'view-tasks',
            'edit-tasks',
            'delete-tasks',
            'assign-tasks',
            'update-task-status',
            'view-task-progress',

            // Client Management (full)
            'create-clients',
            'view-clients',
            'edit-clients',
            'delete-clients',
            'manage-client-projects',
            'view-client-feedback',

            // Reports (full)
            'view-all-reports',
            'generate-reports',
            'export-reports',
            'view-analytics-dashboard',
            'view-performance-metrics',

            // Profile
            'view-own-profile',
            'edit-own-profile',
            'change-own-password',
        ];
        $adminStaff->givePermissionTo($adminStaffPermissions);

        // Level 3: Developers & Mentors (المطورون والمنتورز)
        $developer = Role::firstOrCreate(['name' => 'Developer']);
        $developerPermissions = [
            // Team Management (limited)
            'create-teams',
            'view-teams',
            'edit-teams',
            'assign-team-members',
            'manage-team-roles',

            // Task Management (full)
            'create-tasks',
            'view-tasks',
            'edit-tasks',
            'assign-tasks',
            'update-task-status',
            'view-task-progress',

            // Project Management (view and update)
            'view-projects',
            'manage-project-phases',

            // Reports (limited)
            'view-performance-metrics',
            'view-analytics-dashboard',

            // Profile
            'view-own-profile',
            'edit-own-profile',
            'change-own-password',
        ];
        $developer->givePermissionTo($developerPermissions);

        // Level 4: Clients (العملاء)
        $client = Role::firstOrCreate(['name' => 'Client']);
        $clientPermissions = [
            // Project Management (view only)
            'view-projects',
            'view-task-progress',

            // Client specific
            'view-client-feedback',
            'manage-client-projects',

            // Reports (limited)
            'view-performance-metrics',

            // Profile
            'view-own-profile',
            'edit-own-profile',
            'change-own-password',
        ];
        $client->givePermissionTo($clientPermissions);

        // Level 5: Third Party/Interns (طرف ثالث/متدربين)
        $intern = Role::firstOrCreate(['name' => 'Intern']);
        $internPermissions = [
            // Limited access only
            'view-assigned-tasks-only',
            'update-assigned-tasks-only',
            'view-assigned-projects-only',

            // Profile
            'view-own-profile',
            'edit-own-profile',
            'change-own-password',
        ];
        $intern->givePermissionTo($internPermissions);

        // 3. Create Demo Users for each role

        // App Administrator
        $appAdminUser = User::firstOrCreate([
            'email' => 'admin@sdlc.test'
        ], [
            'name' => 'System Administrator',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => true,
            'is_active' => true,
        ]);
        $appAdminUser->assignRole('App Administrator');

        // Administrative Staff
        $adminStaffUser = User::firstOrCreate([
            'email' => 'manager@sdlc.test'
        ], [
            'name' => 'Project Manager',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => true,
            'is_active' => true,
        ]);
        $adminStaffUser->assignRole('Administrative Staff');

        // Developer
        $developerUser = User::firstOrCreate([
            'email' => 'developer@sdlc.test'
        ], [
            'name' => 'Senior Developer',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => true,
            'is_active' => true,
        ]);
        $developerUser->assignRole('Developer');

        // Client
        $clientUser = User::firstOrCreate([
            'email' => 'client@sdlc.test'
        ], [
            'name' => 'Client Representative',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => true,
            'is_active' => true,
        ]);
        $clientUser->assignRole('Client');

        // Intern
        $internUser = User::firstOrCreate([
            'email' => 'intern@sdlc.test'
        ], [
            'name' => 'Junior Intern',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_approved' => false, // Pending approval
            'is_active' => false,
        ]);
        $internUser->assignRole('Intern');

        // Create a pending user (self-registered)
        $pendingUser = User::firstOrCreate([
            'email' => 'pending@sdlc.test'
        ], [
            'name' => 'Pending User',
            'password' => Hash::make('password'),
            'email_verified_at' => null,
            'is_approved' => false,
            'is_active' => false,
        ]);
        // No role assigned yet - will be assigned after approval

        $this->command->info('Roles, Permissions, and Demo Users created successfully!');
        $this->command->info('Demo Users:');
        $this->command->info('- Admin: admin@sdlc.test / password');
        $this->command->info('- Manager: manager@sdlc.test / password');
        $this->command->info('- Developer: developer@sdlc.test / password');
        $this->command->info('- Client: client@sdlc.test / password');
        $this->command->info('- Intern: intern@sdlc.test / password (Pending Approval)');
        $this->command->info('- Pending: pending@sdlc.test / password (Self-Registered)');
    }
}
