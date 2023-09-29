<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DepartmentSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(ResearchSeeder::class);

        User::factory()->create([
            'username' => 'admin',
            'name' => 'Admin User',
            'department_id' => 1,
            'role_id' => 1,
            'position' => 'Admin',
            'status' => 'single',
            'sex' => 'male',
            'date_of_birth' => fake()->date($format = 'Y-m-d'),
            'date_of_original_appointment' => fake()->date($format = 'Y-m-d'),
            'highest_educational_attaintment' => fake()->randomElement(['High School', 'College']),
            'address' => fake()->address(),


            // 'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
