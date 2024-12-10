<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Services\SearchService;

class UserController extends Controller
{
    // Show the list of users with search, filter, and suspended users
    public function index(Request $request)
    {
        // Initialize the query for both active and suspended users
        $activeUsersQuery = User::query()->whereIn('status', ['active', 'inactive']);
        $suspendedUsersQuery = User::query()->where('status', 'suspended');
    
        // Apply search filter using the SearchService
        if ($search = $request->input('search')) {
            $searchFields = ['name', 'email'];
            $activeUsersQuery = SearchService::apply($activeUsersQuery, $searchFields, $search);
            $suspendedUsersQuery = SearchService::apply($suspendedUsersQuery, $searchFields, $search);
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive,suspended',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
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
