<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'role_id' => 1,
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'phone_number' => '1234567890',
                'status' => 'active',
            ],
            [
                'name' => 'Company',
                'email' => 'company@example.com',
                'role_id' => 2,
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'phone_number' => '1234567890',
                'status' => 'active',
            ],
            [
                'name' => 'Student',
                'email' => 'student@example.com',
                'role_id' => 3,
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
                'phone_number' => '1234567890',
                'status' => 'active',
            ],
        ];

        foreach ($users as $user) {
            User::factory()->create($user);
        }
        User::factory(10)->create(
            [
                'role_id' => 1
            ]
        );
    }
}
