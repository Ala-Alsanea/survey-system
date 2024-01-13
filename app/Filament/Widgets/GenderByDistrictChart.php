<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\ChartWidget;

class GenderByDistrictChart extends ChartWidget
{
    protected static ?string $heading = 'Gender By District';

    protected function getData(): array
    {
        $district = array_values(TeacherInfo::pluck('district')->unique()->all());

        $male = array_values(array_map(fn ($val) => ['data' => Survey::where('district', $val)
        ->where('gender', 'ذكر')
        ->pluck('gender')
        ->count(), 'lable' => $val], $district));

        $female = array_values(array_map(fn ($val) => ['data' => Survey::where('district', $val)
        ->where('gender', 'أنثى')
        ->pluck('gender')
        ->count(), 'lable' => $val], $district));


        return [
            'datasets' => [
                [
                    'label' => 'male',
                    'data' => array_map(fn ($val) => $val['data'], $male),
                    // 'backgroundColor' => '#d4d4d8',
                    // 'borderColor' => '#3f3f46',
                ],

                [
                    'label' => 'female',
                    'data' =>  array_map(fn ($val) => $val['data'], $female),
                    'backgroundColor' => '#ffc0cb',
                    'borderColor' => '#ff748c',
                ]
            ],
            'labels' => $district,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
