<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\ChartWidget;

class SchoolByDistrictChart extends ChartWidget
{
    protected static ?string $heading = 'School By district';
    protected static string $color = 'info';

    protected function getData(): array
    {

        $district = array_values(TeacherInfo::pluck('district')->unique()->all());

        $targetedSchool = array_values(array_map(fn ($val) => ['data' => TeacherInfo::where('district', $val)->pluck('school')->unique()->count(), 'lable' => $val], $district));
        $progressedSchool = array_values(array_map(fn ($val) => ['data' => Survey::where('district', $val)->where('is_deleted', 1)->pluck('school')->unique()->count(), 'lable' => $val], $district));

        $test = usort($targetedSchool, fn ($a, $b)=> $b['data'] <=> $a['data']);
        $test_2 = usort($progressedSchool, fn ($a, $b) => $b['data'] <=> $a['data']);


        return [
            'datasets' => [
                [
                    'label' => 'targeted',
                    'data' => array_map(fn ($val) => $val['data'], $targetedSchool),
                    'backgroundColor' => '#0198F1',
                    'borderColor' => '#0198F1',
                ],

                [
                    'label' => 'progress',
                    'data' =>  array_map(fn ($val) => $val['data'], $progressedSchool),
                    'backgroundColor' => '#16a34a',
                    'borderColor' => '#065f46',
                ]
            ],
            'labels' => array_map(fn ($val) => $val['lable'], $targetedSchool),
        ];

        // return[];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            //  'indexAxis'=> 'y',
            'barThickness'=> 10
        ];
    }
}
