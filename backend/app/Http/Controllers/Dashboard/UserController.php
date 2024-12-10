<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
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
                    ->orWhere('phone_number', 'like', "%{$search}%");
            });

            $suspendedUsersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%");
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
        // Fetching roles from the database to populate a dropdown in the form
        $roles = Role::all();

        // Returning the 'create' view and passing the roles data to it
        return view('dashboard.users.create', compact('roles'));
    }

    // Other methods remain unchanged
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive,suspended',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'role_id' => $validated['role_id'],
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function updateStatus(User $user)
    {
        $user->status = ($user->status == 'active') ? 'inactive' : 'active';
        $user->save();

        return redirect()->route('users.index')->with('status', 'تم تحديث حالة المستخدم');
    }
}
