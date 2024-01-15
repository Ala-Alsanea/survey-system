<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use Flowframe\Trend\Trend;
use App\Models\TeacherInfo;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SchoolByGovernoratesChart extends ChartWidget
{
    protected static ?string $heading = 'School By Governorates';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'info';

    protected function getData(): array
    {

        $gov = array_values(TeacherInfo::pluck('gov')->unique()->all());
        $targetedSchool = array_values(array_map(fn ($val) => ['data' => TeacherInfo::where('gov', $val)->pluck('school')->unique()->count(), 'lable' => $val], $gov));
        $progressedSchool = array_values(array_map(fn ($val) => ['data' => Survey::where('gov', $val)->where('is_deleted', 1)->pluck('school')->unique()->count(), 'lable' => $val], $gov));

        $test = usort($targetedSchool, fn ($a, $b) => $b['data'] <=> $a['data']);
        $test_2 = usort($progressedSchool, fn ($a, $b) => $b['data'] <=> $a['data']);


        return [
            'datasets' => [
                [
                    'label' => 'targeted',
                    'data' => array_map(fn ($val) => $val['data'], $targetedSchool),
                    // 'backgroundColor' => '#d4d4d8',
                    // 'borderColor' => '#3f3f46',
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

        // return [];

    }

    protected function getType(): string
    {
        return 'bar';
    }
    protected function getOptions(): array
    {
        return [
            // 'indexAxis' => 'y',
        ];
    }
}
