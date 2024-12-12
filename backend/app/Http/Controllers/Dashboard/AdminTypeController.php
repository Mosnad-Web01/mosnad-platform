<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminType;
use App\Models\User;
use App\Services\AdminTypeService;
use Illuminate\Http\JsonResponse;
use App\Models\Permission;


class AdminTypeController extends Controller
{
    public function __construct(
        private readonly AdminTypeService $adminTypeService
    ) {
    }

    public function index()
    {
        $adminRoles = AdminType::with(['permissions'])->get();
        return view('dashboard.admin-roles.index', compact('adminRoles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.admin-roles.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $adminType = $this->adminTypeService->createAdminType([
            'name' => $validated['name'],
            'description' => $validated['description']
        ]);

        $this->adminTypeService->assignPermissions($adminType, $validated['permissions']);

        return redirect()->route('admin-roles.index')->with('success', 'Admin type created successfully.');

    }
    public function edit(AdminType $adminType)
{
    $permissions = Permission::all();
    $adminTypePermissions = $adminType->permissions->pluck('id')->toArray();
    return view('dashboard.admin-roles.edit', compact('adminType', 'permissions', 'adminTypePermissions'));
}

public function update(Request $request, AdminType $adminType)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'permissions' => 'required|array',
        'permissions.*' => 'exists:permissions,id'
    ]);

    $adminType->update([
        'name' => $validated['name'],
        'description' => $validated['description']
    ]);

    $this->adminTypeService->syncPermissions($adminType, $validated['permissions']);

    return redirect()->route('admin-roles.index')->with('success', 'Admin type updated successfully.');
}

public function destroy(AdminType $adminType)
{
    try {
        $adminType->delete();
        return redirect()->route('admin-roles.index')->with('success', 'Admin type deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('admin-roles.index')->with('error', 'Error deleting admin type.');
    }
}


    public function assignToUser(Request $request, AdminType $adminType, User $user): JsonResponse
    {
        if (!$user || !$adminType) {
            return response()->json(['message' => 'User or admin role not found'], 404);
        }

        try {
            $this->adminTypeService->assignToUser($user, $adminType);
            return response()->json(['message' => 'Admin role assigned successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error assigning admin type'], 500);
        }
    }

}
