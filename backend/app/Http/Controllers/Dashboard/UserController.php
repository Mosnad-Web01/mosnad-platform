<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Show the list of users based on their role
    public function index()
    {

        $users = User::paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    // Store a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:active,inactive',
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

    public function create()
    {
        // Fetching roles from the database to populate a dropdown in the form
        $roles = Role::all();

        // Returning the 'create' view and passing the roles data to it
        return view('dashboard.users.create', compact('roles'));
    }

    // Update user status (active or inactive)
    public function updateStatus(User $user)
    {
        // Toggle user status
        $user->status = ($user->status == 'active') ? 'inactive' : 'active';
        $user->save();

        return redirect()->route('users.index')->with('status', 'تم تحديث حالة المستخدم');
    }
}
