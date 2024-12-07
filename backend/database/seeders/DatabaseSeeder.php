<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
        ]);
    }
}
