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
        // Create a known admin user
        User::factory()->create([
            'name' => 'John Admin',
            'email' => 'john.admin@gmail.com',
            'role' => 'admin',
        ]);
    }
}
