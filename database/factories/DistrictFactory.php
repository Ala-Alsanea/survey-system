<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\District>
 */
class DistrictFactory extends Factory
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
            // 'name' => fake()->city(),
            // 'code' => fake()->uuid(),
            // 'parent_code' => fake()->randomElement(['15', '13']),
            // 'city_id' => fake()->randomElement([1, 2]),

        ];
    }
}
