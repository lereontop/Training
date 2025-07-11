<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'name'          => $this->faker->company(),
            'description'   => $this->faker->paragraph(2),
            'contactEmail'  => $this->faker->unique()->companyEmail(),
            'contactPhone'  => $this->faker->phoneNumber(),
        ];
    }
}
