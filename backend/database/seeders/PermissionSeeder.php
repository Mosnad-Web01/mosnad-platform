<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            // ['name' => 'عرض لوحة التحكم', 'slug' => 'view-dashboard', 'description' => 'إذن لعرض لوحة التحكم', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة المستخدمين', 'slug' => 'manage-users', 'description' => 'إذن لإدارة المستخدمين', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة فرص العمل', 'slug' => 'manage-job-opportunities', 'description' => 'إذن لإدارة فرص العمل', 'created_at' => now(), 'updated_at' => now()],
            // ['name' => 'إدارة الدورات', 'slug' => 'manage-courses', 'description' => 'إذن لإدارة الدورات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة معسكرات التدريب', 'slug' => 'manage-bootcamps', 'description' => 'إذن لإدارة معسكرات التدريب', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة الاستبيانات' , 'slug' => 'manage-surveys', 'description' => 'إذن لإدارة الاستبيانات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة استبيانات الشباب', 'slug' => 'manage-youth-surveys', 'description' => 'إذن لإدارة استبيانات الشباب', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة استبيانات الشركات', 'slug' => 'manage-company-survays', 'description' => 'إذن لإدارة استبيانات الشركات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة التعليقات', 'slug' => 'manage-comments', 'description' => 'إذن لإدارة التعليقات ورسائل المستخدمين', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة الأذونات', 'slug' => 'manage-permissions', 'description' => 'إذن لإدارة الأذونات', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة الأدوار', 'slug' => 'manage-roles', 'description' => 'إذن لإدارة الأدوار', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'إدارة المدونات', 'slug' => 'manage-blogs', 'description' => 'إذن لإدارة المدونات', 'created_at' => now(), 'updated_at' => now()],
        ];



        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
