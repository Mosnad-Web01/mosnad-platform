<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\AdminType;
use App\Services\AdminTypeService;

class UserController extends Controller
{
    public function __construct(
        private readonly AdminTypeService $adminTypeService
    ) {
    }
    // Show the list of users with search, filter, and suspended users
    public function index(Request $request)
    {
        // Initialize the query for both active and suspended users
        $activeUsersQuery = User::query()->whereIn('status', ['active', 'inactive']);
        $suspendedUsersQuery = User::query()->where('status', 'suspended');

        // Apply search filter
        if ($search = $request->input('search')) {
            $activeUsersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ;
            });

            $suspendedUsersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                   ;
            });
        }

        // Filter by role
        if ($role = $request->input('role')) {
            $activeUsersQuery->where('role_id', $role);
            $suspendedUsersQuery->where('role_id', $role);
        }

        // Paginate results
        $users = $activeUsersQuery->paginate(10)->appends($request->query());
        $suspendedUsers = $suspendedUsersQuery->paginate(10)->appends($request->query());

        $roles = Role::all(); // Fetch roles for the filter dropdown

        return view('dashboard.users.index', compact('users', 'suspendedUsers', 'roles'));
    }


    public function create()
    {
        // Fetch admin types instead of roles
        $adminTypes = AdminType::with('permissions')->get();
        return view('dashboard.users.create', compact('adminTypes'));
    }

    // Other methods remain unchanged
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
         
            'admin_types' => 'required|array',
            'admin_types.*' => 'exists:admin_types,id',
            'status' => 'required|in:active,inactive,suspended',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            
            'role_id' => 1,
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

           // Assign selected admin types to the user
           $user->adminTypes()->attach($validated['admin_types']);

           return redirect()->route('users.index')
           ->with('success', 'User created successfully.');
    }

    public function updateStatus(User $user)
    {
        $user->status = ($user->status == 'active') ? 'inactive' : 'active';
        $user->save();

        return redirect()->route('users.index')->with('status', 'تم تحديث حالة المستخدم');
    }
}