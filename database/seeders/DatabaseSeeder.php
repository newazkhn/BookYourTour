<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@tourism.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Regular Test User
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@tourism.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);

        // Create additional test users
        User::factory(5)->create([
            'role' => 'user',
        ]);

        $this->call([
            DestinationSeeder::class,
        ]);
    }
}
