<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->firstName(),
            'name' => fake()->name(),
            'department_id' => fake()->numberBetween($min = 2, $max = 7),
            // 'role_id' => fake()->randomNumber($min = 0, $max = 1),
            'position' => fake()->randomElement(['Professor I', 'Professor II', 'Professor III']),
            'status' => fake()->randomElement(['Permanent', 'Temporary']),
            'sex' => fake()->randomElement(['male', 'female']),
            'date_of_birth' => fake()->date($format = 'Y-m-d'),
            'date_of_original_appointment' => fake()->date($format = 'Y-m-d'),
            'highest_educational_attaintment' => fake()->randomElement(['High School', 'College']),
            'address' => fake()->address(),


            // 'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    // public function unverified(): static
    // {
    //     return $this->state(fn (array $attributes) => [
    //         'email_verified_at' => null,
    //     ]);
    // }
}
