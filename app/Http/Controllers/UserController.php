<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_approved' => true, // Admin created users are auto-approved
            'is_active' => true,
            'registration_type' => 'admin_created',
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    /**
     * Display the specified user.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'array'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->password) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        if ($request->roles) {
            $user->syncRoles($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'تم تحديث المستخدم بنجاح');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'تم حذف المستخدم بنجاح');
    }

    /**
     * Display pending users for approval.
     */
    public function pending()
    {
        $pendingUsers = User::where('is_approved', false)->paginate(10);
        return view('users.pending', compact('pendingUsers'));
    }

    /**
     * Approve a pending user.
     */
    public function approve(User $user)
    {
        $user->update([
            'is_approved' => true,
            'is_active' => true,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()->route('users.pending')->with('success', 'تم تفعيل المستخدم بنجاح');
    }

    /**
     * Reject a pending user.
     */
    public function reject(User $user)
    {
        $user->delete();
        return redirect()->route('users.pending')->with('success', 'تم رفض وحذف المستخدم');
    }

    /**
     * Show form for assigning roles to users.
     */
    public function assignRolesForm()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('users.assign-roles', compact('users', 'roles'));
    }

    /**
     * Assign roles to a user.
     */
    public function assignRoles(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array'
        ]);

        $user->syncRoles($request->roles);

        return redirect()->route('users.assign-roles')->with('success', 'تم تعيين الأدوار بنجاح');
    }
}
