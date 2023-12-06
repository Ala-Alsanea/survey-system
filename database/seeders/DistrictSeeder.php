<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Abyan
        District::factory()->create([
            'siteCode'=> 12,
            'ParentCode'=> 1,
            'Ar_Name'=> 'ابين',
            'En_Name' => 'Abyan',
        ]);

        District::factory()->create([
            'siteCode' => 1201,
            'ParentCode' => 12,
            'Ar_Name' => 'المحفد',
            'En_Name' => '',
        ]);
    }
}
