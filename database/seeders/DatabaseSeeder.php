<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Author;
use App\Models\Research;
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
        $this->call(DepartmentSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(StatusSeeder::class);
        // $this->call(ResearchSeeder::class);
        // $this->call(AuthorSeeder::class);

        // // seed pivot table author_research
        // // Define the number of records you want to insert
        // $recordsCount = 50;

        // // Insert records into the pivot table
        // for ($i = 1; $i <= $recordsCount; $i++) {
        //     DB::table('author_research')->insert([
        //         'author_id' => rand(1, 30), // Replace with your actual author IDs
        //         'research_id' => rand(1, 50), // Replace with your actual research IDs
        //     ]);
        // }

        User::factory()->create([
            'username' => 'admin',
            'name' => 'Admin User',
            'role_id' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);
    }
}
