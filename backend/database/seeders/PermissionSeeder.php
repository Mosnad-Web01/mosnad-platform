<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// database/seeders/PermissionSeeder.php

use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'View Dashboard', 'slug' => 'view-dashboard', 'description' => 'Permission to view the dashboard', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manage Users', 'slug' => 'manage-users', 'description' => 'Permission to manage users', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manage Job Opportunities', 'slug' => 'manage-job-opportunities', 'description' => 'Permission to manage job opportunities', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manage Courses', 'slug' => 'manage-courses', 'description' => 'Permission to manage courses', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manage Bootcamps', 'slug' => 'manage-bootcamps', 'description' => 'Permission to manage bootcamps', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manage Youth Surveys', 'slug' => 'manage-youth-surveys', 'description' => 'Permission to manage youth forms', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manage Company surveys', 'slug' => 'manage-company-survays', 'description' => 'Permission to manage company surveys', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Manage Comments', 'slug' => 'manage-comments', 'description' => 'Permission to manage comments and messages of users ', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}


