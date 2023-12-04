<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherInfo>
 */
class TeacherInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'phone'=>fake()->phoneNumber(),
            'gender'=>fake()->word(),
            'city'=>fake()->city(),
            'edu_qual'=>fake()->word(),
            'national_card_id'=>fake()->uuid(),


            // 'image_national_card_front'=>fake()->imageUrl(640, 480, 'card', true),
            // 'image_national_card_back'=>fake()->imageUrl(640, 480, 'card', true),
            // 'image_attend'=>fake()->imageUrl(640, 480, 'card', true),
            // 'image_contract_direct_work'=>fake()->imageUrl(640, 480, 'card', true),


            // 'image_national_card_front' => fake()->image('storage/app/public', 360, 360, 'card', false, true, 'id', false, 'jpg'),
            // 'image_national_card_back' => fake()->image('storage/app/public', 360, 360, 'card', false, true, 'id', false, 'jpg'),
            // 'image_attend' => fake()->image('storage/app/public', 360, 360, 'card', false, true, 'id', false, 'jpg'),
            // 'image_contract_direct_work' => fake()->image('storage/app/public', 360, 360, 'card', false, true, 'id', false, 'jpg'),


            'image_national_card_front' => '1cbfac69e28183f40e110017ab3f1e52.jpg',
            'image_national_card_back' => '1cbfac69e28183f40e110017ab3f1e52.jpg',
            'image_attend' => '1cbfac69e28183f40e110017ab3f1e52.jpg',
            'image_contract_direct_work' => '1cbfac69e28183f40e110017ab3f1e52.jpg',

            'q_1'=>fake()->text(),
            'q_2'=>fake()->text(),
            'q_3'=>fake()->text(),
            'q_4'=>fake()->text(),
            'q_5'=>fake()->text(),
            'q_6'=>fake()->text(),
            'q_7'=>fake()->text(),
            'q_8'=>fake()->text(),
            'q_9' => fake()->text(),
            'q_10' => fake()->text(),
            'q_11' => fake()->text(),
            'researcher_id' => rand(1,10),

        ];
    }
}
