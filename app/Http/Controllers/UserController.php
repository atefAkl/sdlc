<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

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
            'approved_by' => Auth::id(),
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
        // Load user with relationships
        $user->load(['roles', 'permissions']);

        // Static data for demonstration (will be replaced with real data later)
        $staticData = [
            'tasks' => [
                [
                    'id' => 1,
                    'title' => 'تطوير واجهة المستخدم الرئيسية',
                    'description' => 'إنشاء واجهة المستخدم الرئيسية للتطبيق',
                    'status' => 'in_progress',
                    'progress' => 75,
                    'priority' => 'high',
                    'due_date' => '2025-08-15',
                    'project_name' => 'نظام إدارة العملاء'
                ],
                [
                    'id' => 2,
                    'title' => 'اختبار وحدة المصادقة',
                    'description' => 'إجراء اختبارات شاملة لنظام تسجيل الدخول',
                    'status' => 'completed',
                    'progress' => 100,
                    'priority' => 'medium',
                    'due_date' => '2025-07-30',
                    'project_name' => 'تطبيق الجوال'
                ],
                [
                    'id' => 3,
                    'title' => 'مراجعة الكود البرمجي',
                    'description' => 'مراجعة وتحسين جودة الكود',
                    'status' => 'pending',
                    'progress' => 0,
                    'priority' => 'low',
                    'due_date' => '2025-08-20',
                    'project_name' => 'موقع الشركة'
                ]
            ],
            'evaluations' => [
                [
                    'project_name' => 'نظام إدارة العملاء',
                    'phase' => 'Development',
                    'rating' => 4.5,
                    'grade' => 'A',
                    'feedback' => 'أداء ممتاز في تطوير الواجهات، مع الحاجة لتحسين بسيط في التوثيق.',
                    'evaluated_by' => 'أحمد محمد - كبير المطورين',
                    'evaluation_date' => '2025-07-28'
                ],
                [
                    'project_name' => 'تطبيق الجوال',
                    'phase' => 'Testing',
                    'rating' => 4.8,
                    'grade' => 'A+',
                    'feedback' => 'اختبارات شاملة ودقيقة، تم اكتشاف جميع الأخطاء بفعالية عالية.',
                    'evaluated_by' => 'سارة أحمد - مدير الجودة',
                    'evaluation_date' => '2025-07-25'
                ]
            ],
            'skills' => [
                ['name' => 'Laravel', 'level' => 85],
                ['name' => 'JavaScript', 'level' => 78],
                ['name' => 'Vue.js', 'level' => 72],
                ['name' => 'Database Design', 'level' => 88],
                ['name' => 'API Development', 'level' => 80]
            ],
            'projects_stats' => [
                'total_projects' => 8,
                'completed_projects' => 5,
                'ongoing_projects' => 2,
                'pending_projects' => 1
            ]
        ];
        return view('users.show', compact('user', 'staticData'));
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
     * Update user basic information.
     */
    public function updateBasicInfo(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'department' => 'nullable|string|in:development,design,testing,management,support',
            'job_title' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'department' => $request->department,
            'job_title' => $request->job_title,
            'start_date' => $request->start_date,
        ]);

        return redirect()->route('users.edit', $user)->with('success', 'تم تحديث المعلومات الأساسية بنجاح');
    }

    /**
     * Update user account settings.
     */
    public function updateAccountSettings(Request $request, User $user)
    {
        $request->validate([
            'registration_type' => 'required|in:admin_created,self_registered,imported',
        ]);

        $user->update([
            'registration_type' => $request->registration_type,
            'is_active' => $request->has('is_active'),
            'is_approved' => $request->has('is_approved'),
            'approved_by' => $request->has('is_approved') ? Auth::id() : $user->approved_by,
            'approved_at' => $request->has('is_approved') ? now() : $user->approved_at,
        ]);

        return redirect()->route('users.edit', $user)->with('success', 'تم تحديث إعدادات الحساب بنجاح');
    }

    /**
     * Update user roles.
     */
    public function updateRoles(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id'
        ]);

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

        return redirect()->route('users.edit', $user)->with('success', 'تم تحديث الأدوار والصلاحيات بنجاح');
    }

    /**
     * Update admin notes.
     */
    public function updateAdminNotes(Request $request, User $user)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $user->update([
            'admin_notes' => $request->admin_notes,
        ]);

        return redirect()->route('users.edit', $user)->with('success', 'تم تحديث الملاحظات الإدارية بنجاح');
    }

    /**
     * Send password reset link.
     */
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['success' => true, 'message' => 'تم إرسال رابط إعادة التعيين بنجاح']);
        }

        return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء الإرسال']);
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
     * Get pending users count for AJAX.
     */
    public function pendingCount()
    {
        $count = User::where('is_approved', false)->count();
        return response()->json(['count' => $count]);
    }

    /**
     * Approve a pending user.
     */
    public function approve(User $user)
    {
        $user->update([
            'is_approved' => true,
            'is_active' => true,
            'approved_by' => Auth::id(),
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
