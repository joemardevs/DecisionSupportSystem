<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'name' => fake()->name(),
            'department_id' => fake()->numberBetween($min = 2, $max = 7),
            'position' => fake()->randomElement(['Professor I', 'Professor II', 'Professor III']),
            'status' => fake()->randomElement(['Permanent', 'Temporary']),
            'sex' => fake()->randomElement(['male', 'female']),
            'date_of_birth' => fake()->date($format = 'Y-m-d'),
            'date_of_original_appointment' => fake()->date($format = 'Y-m-d'),
            'highest_educational_attaintment' => fake()->randomElement(['High School', 'College']),
            'address' => fake()->address(),
            // 'email' => fake()->unique()->safeEmail(),
        ];
    }
}
