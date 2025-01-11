<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $user = User::where('email', 'admin@example.com')->first();
        if (!$user) {
            User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('Admin@123'),
                'role' => 'admin',
                // 'email_verified_at' => null,
                // 'remember_token' => null,
            ]);
        }
        Car::factory(10)->create();
    }
}
