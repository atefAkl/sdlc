<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of permissions.
     */
    public function index()
    {
        $permissions = Permission::with('roles')->paginate(15);
        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
            'description' => 'nullable|string|max:500'
        ]);

        Permission::create([
            'name' => strtolower(str_replace(' ', '-', $request->name)),
            'guard_name' => 'web'
        ]);

        return redirect()->route('permissions.index')->with('success', 'تم إنشاء الصلاحية بنجاح');
    }

    /**
     * Display the specified permission.
     */
    public function show(Permission $permission)
    {
        $permission->load('roles');
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified permission.
     */
    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            'description' => 'nullable|string|max:500'
        ]);

        $permission->update([
            'name' => strtolower(str_replace(' ', '-', $request->name))
        ]);

        return redirect()->route('permissions.index')->with('success', 'تم تحديث الصلاحية بنجاح');
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy(Permission $permission)
    {
        // Check if permission is assigned to any role
        if ($permission->roles()->count() > 0) {
            return redirect()->route('permissions.index')
                ->with('error', 'لا يمكن حذف الصلاحية لأنها مخصصة لأدوار موجودة');
        }

        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'تم حذف الصلاحية بنجاح');
    }

    /**
     * Get permissions by category (AJAX).
     */
    public function getByCategory(Request $request)
    {
        $category = $request->get('category');

        $permissions = Permission::where('name', 'LIKE', $category . '-%')
            ->orWhere('name', 'LIKE', '%' . $category . '%')
            ->get();

        return response()->json($permissions);
    }

    /**
     * Bulk assign permissions to roles.
     */
    public function bulkAssignToRoles(Request $request)
    {
        $request->validate([
            'permission_ids' => 'required|array',
            'role_ids' => 'required|array'
        ]);

        $permissions = Permission::whereIn('id', $request->permission_ids)->get();
        $roles = Role::whereIn('id', $request->role_ids)->get();

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }

        return redirect()->route('permissions.index')
            ->with('success', 'تم تعيين الصلاحيات للأدوار بنجاح');
    }
}
