<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            PermissionSeeder::class,
            // PermissionsSeeder::class,
            AdminTypesSeeder::class,
            AdminTypePermissionSeeder::class,
            UserAdminTypesSeeder::class,
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
        $adminTypesPermissions = [
            // Super Admin has all permissions
            ['admin_type_id' => 1, 'permission_id' => 1],
            ['admin_type_id' => 1, 'permission_id' => 2],
            ['admin_type_id' => 1, 'permission_id' => 3],

            // Moderator has limited permissions
            ['admin_type_id' => 2, 'permission_id' => 1],
            ['admin_type_id' => 2, 'permission_id' => 2],

            // Viewer has only view permission
            ['admin_type_id' => 3, 'permission_id' => 1],
        ];

        foreach ($adminTypesPermissions as $relation) {
            DB::table('admin_type_permission')->insert(array_merge($relation, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}

class UserAdminTypesSeeder extends Seeder
{
    public function run(): void
    {
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
