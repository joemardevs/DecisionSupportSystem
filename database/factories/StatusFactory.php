<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $statuses = ['On going', 'Completed', 'Presented', 'Published', 'Copyrighted', 'Archived'];
    protected $statusesIndex = 0;
    public function definition(): array
    {
        $status = $this->statuses[$this->statusesIndex];
        $this->statusesIndex = ($this->statusesIndex + 1) % count($this->statuses);
        return [
            //
            'name' => $status,
        ];
    }
}
