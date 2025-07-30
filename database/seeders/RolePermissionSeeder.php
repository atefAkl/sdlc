<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'manage-users',
            'create-users',
            'edit-users',
            'delete-users',
            'view-users',

            // Project management
            'manage-projects',
            'create-projects',
            'edit-projects',
            'delete-projects',
            'view-projects',
            'assign-projects',

            // Team management
            'manage-teams',
            'create-teams',
            'edit-teams',
            'delete-teams',
            'view-teams',
            'assign-team-members',

            // Task management
            'manage-tasks',
            'create-tasks',
            'edit-tasks',
            'delete-tasks',
            'view-tasks',
            'assign-tasks',
            'update-task-status',

            // Client management
            'manage-clients',
            'create-clients',
            'edit-clients',
            'delete-clients',
            'view-clients',

            // Report management
            'view-reports',
            'generate-reports',
            'export-reports',

            // System settings
            'manage-settings',
            'view-settings',

            // SDLC Phase management
            'manage-phases',
            'view-phases',
            'update-phase-status',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions

        // Level 1: App Administrators (مديرو التطبيق)
        $appAdmin = Role::create(['name' => 'app-administrator']);
        $appAdmin->givePermissionTo(Permission::all()); // All permissions

        // Level 2: Administrative Staff (الموظفون الإداريون)
        $adminStaff = Role::create(['name' => 'administrative-staff']);
        $adminStaff->givePermissionTo([
            'manage-projects',
            'create-projects',
            'edit-projects',
            'view-projects',
            'assign-projects',
            'manage-tasks',
            'create-tasks',
            'edit-tasks',
            'view-tasks',
            'assign-tasks',
            'update-task-status',
            'manage-teams',
            'create-teams',
            'edit-teams',
            'view-teams',
            'assign-team-members',
            'view-users',
            'manage-clients',
            'create-clients',
            'edit-clients',
            'view-clients',
            'view-reports',
            'generate-reports',
            'export-reports',
            'manage-phases',
            'view-phases',
            'update-phase-status',
        ]);

        // Level 3: Developers & Mentors (المطورون والمنتورز)
        $developers = Role::create(['name' => 'developer-mentor']);
        $developers->givePermissionTo([
            'view-projects',
            'view-tasks',
            'update-task-status',
            'manage-teams',
            'view-teams',
            'assign-team-members',
            'view-users',
            'view-clients',
            'view-reports',
            'view-phases',
            'update-phase-status',
        ]);

        // Level 4: Clients (العملاء)
        $clients = Role::create(['name' => 'client']);
        $clients->givePermissionTo([
            'view-projects',
            'view-tasks',
            'view-reports',
            'view-phases',
        ]);

        // Level 5: Third Party/Interns (طرف ثالث/متدربين)
        $interns = Role::create(['name' => 'intern-third-party']);
        $interns->givePermissionTo([
            'view-tasks',
            'update-task-status',
            'view-phases',
        ]);

        // Create demo users for each role

        // App Administrator
        $admin = User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@sdlc.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('app-administrator');

        // Administrative Staff
        $staff = User::create([
            'name' => 'موظف إداري',
            'email' => 'staff@sdlc.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $staff->assignRole('administrative-staff');

        // Developer
        $developer = User::create([
            'name' => 'مطور',
            'email' => 'developer@sdlc.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $developer->assignRole('developer-mentor');

        // Client
        $client = User::create([
            'name' => 'عميل',
            'email' => 'client@sdlc.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $client->assignRole('client');

        // Intern
        $intern = User::create([
            'name' => 'متدرب',
            'email' => 'intern@sdlc.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $intern->assignRole('intern-third-party');
    }
}
