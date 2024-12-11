<?php
// app/Services/AdminTypeService.php
namespace App\Services;

use App\Models\AdminType;
use App\Models\User;

class AdminTypeService
{
    public function createAdminType(array $data): AdminType
    {
        return AdminType::create($data);
    }

    public function assignPermissions(AdminType $adminType, array $permissionIds): void
    {
        $adminType->permissions()->sync($permissionIds);
    }

    public function assignToUser(User $user, AdminType $adminType): void
    {
        $user->adminTypes()->syncWithoutDetaching([$adminType->id]);
    }

    public function removeFromUser(User $user, AdminType $adminType): void
    {
        $user->adminTypes()->detach($adminType->id);
    }
}
