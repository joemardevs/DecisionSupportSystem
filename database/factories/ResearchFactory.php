<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class ResearchFactory extends Factory
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
            'department_id' => fake()->numberBetween($min = 1, $max = 7),
            'title' => fake()->word(),
            'status_id' => fake()->numberBetween($min = 1, $max = 6),
            'created_at' => fake()->dateTimeBetween($startDate = '-3 years', $endDate = 'now'),
        ];
    }
}
