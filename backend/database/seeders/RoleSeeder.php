<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 3 roles  admin,  company, student
        Role::factory(3)->state(new Sequence(
            ['name' => 'admin'],
            ['name' => 'company'],
            ['name' => 'student']
        ))->create();
    }
}
