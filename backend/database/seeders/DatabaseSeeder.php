<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdminType;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class, // creates 3 roles : admin, company, student
            UserSeeder::class, // creates 3 users : admin, company, student
            JobOpportunitySeeder::class, // creates 10 job opportunities in arabic language
            PermissionSeeder::class, // creates 12 permissions
            AdminTypesSeeder::class, // creates 3 admin types
            AdminTypePermissionSeeder::class, // assign permissions to admin types
            UserAdminTypesSeeder::class, // assign admin-roles to users
        ]);
    }
}



class AdminTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin_types')->insert([
            ['name' => 'Super Admin', 'description' => 'Full access to the system', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Moderator', 'description' => 'Limited access to manage content', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Viewer', 'description' => 'Can only view data', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

class AdminTypePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Retrieve all permissions
        $permissions = Permission::all();

        // Super Admin has all permissions
        $superAdmin = AdminType::where('name', 'Super Admin')->first();
        foreach ($permissions as $permission) {
            DB::table('admin_type_permission')->insert([
                'admin_type_id' => $superAdmin->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Moderator has limited permissions (e.g., half of the total permissions)
        $moderator = AdminType::where('name', 'Moderator')->first();
        $moderatorPermissions = $permissions->take(floor($permissions->count() / 2)); // Half of the permissions
        foreach ($moderatorPermissions as $permission) {
            DB::table('admin_type_permission')->insert([
                'admin_type_id' => $moderator->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Viewer has only view permissions (or other minimal permissions)
        $viewer = AdminType::where('name', 'Viewer')->first();
        $viewerPermissions = $permissions->where('slug', 'view-dashboard'); // Only "view-dashboard" permission
        foreach ($viewerPermissions as $permission) {
            DB::table('admin_type_permission')->insert([
                'admin_type_id' => $viewer->id,
                'permission_id' => $permission->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

class UserAdminTypesSeeder extends Seeder
{
    public function run(): void
    {
        //assign admin-roles to users
        $userAdminTypes = [
            ['user_id' => 1, 'admin_type_id' => 1], // User 1 is a Super Admin
            ['user_id' => 2, 'admin_type_id' => 2], // User 2 is a Moderator
            ['user_id' => 3, 'admin_type_id' => 3], // User 3 is a Viewer
        ];

        foreach ($userAdminTypes as $relation) {
            DB::table('user_admin_types')->insert(array_merge($relation, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
