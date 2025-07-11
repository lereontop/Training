<?php

namespace Database\Factories;

use App\Models\Employer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title'       => $this->faker->jobTitle(),
            'type'        => $this->faker->randomElement(['Full-Time', 'Part-Time', 'Contract']),
            'description' => $this->faker->paragraph(4),
            'location'    => $this->faker->city() . ', ' . $this->faker->stateAbbr(),
            'salary'      => '$' . $this->faker->numberBetween(60000, 120000),
        ];
    }
}
