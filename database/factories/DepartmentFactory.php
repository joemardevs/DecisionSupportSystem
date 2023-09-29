<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $colleges = ['ADMIN', 'CBM', 'CCJE', 'CCSICT', 'CED', 'IAT', 'PS', 'SAS'];
    protected $collegesIndex = 0;
    public function definition(): array
    {
        $college = $this->colleges[$this->collegesIndex];
        $this->collegesIndex = ($this->collegesIndex + 1) % count($this->colleges);
        return [
            //
            'name' => $college,
        ];
    }
}
