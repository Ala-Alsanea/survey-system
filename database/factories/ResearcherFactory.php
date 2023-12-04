<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Researcher>
 */
class ResearcherFactory extends Factory
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
            'phone' => fake()->phoneNumber(),
            'gender' => fake()->word(),
            'password' => fake()->password(),
            'device_id' => fake()->uuid(),
        ];
    }
}
