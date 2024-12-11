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
    ) {}

    public function index()
    {
        $adminTypes = AdminType::with(['permissions'])->get();
        return view('dashboard.admin-types.index', compact('adminTypes'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('dashboard.admin-types.create', compact('permissions'));
    }


    public function store(Request $request): JsonResponse
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

        return response()->json([
            'message' => 'Admin type created successfully',
            'data' => $adminType
        ]);
    }

    public function assignToUser(Request $request, AdminType $adminType, User $user): JsonResponse
    {
        \Log::info('Assigning admin type to user started', [
            'user_id' => $user->id ?? null,
            'admin_type_id' => $adminType->id ?? null,
        ]);

        if (!$user || !$adminType) {
            \Log::warning('User or admin type not found', [
                'user_id' => $user->id ?? null,
                'admin_type_id' => $adminType->id ?? null,
            ]);
            return response()->json(['message' => 'User or admin type not found'], 404);
        }

        try {
            $this->adminTypeService->assignToUser($user, $adminType);
            \Log::info('Admin type assigned successfully', [
                'user_id' => $user->id,
                'admin_type_id' => $adminType->id,
            ]);
            return response()->json(['message' => 'Admin type assigned successfully']);
        } catch (\Exception $e) {
            \Log::error('Error assigning admin type', [
                'exception' => $e->getMessage(),
                'user_id' => $user->id ?? null,
                'admin_type_id' => $adminType->id ?? null,
            ]);
            return response()->json(['message' => 'Error assigning admin type'], 500);
        }
    }

}
