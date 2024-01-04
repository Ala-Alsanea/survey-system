<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use App\Models\Survey;
use App\Models\District;
use App\Models\Researcher;
use App\Models\TeacherInfo;
use Illuminate\Database\Seeder;
use bfinlay\SpreadsheetSeeder\SpreadsheetSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password'=>'654321',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'reviewer',
            'email' => 'reviewer@reviewer.com',
            'password' => '123',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'viewer',
            'email' => 'viewer@viewer.com',
            'password' => '123',
        ]);


        // Researcher::factory()->count(1)->create();
        Researcher::factory()->create([
            'name'=>'test user',
            'phone'=>'789456123',
            'password' => '15987532',
            'valid'=>1,
        ]);

        $this->call([
            SpreadsheetSeeder::class,
        ]);


        // Survey::factory()->count(300)->create();
    }
}
