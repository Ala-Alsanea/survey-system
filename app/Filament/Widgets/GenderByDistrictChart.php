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
            ->where('is_deleted', 1)
            ->pluck('gender')
            ->count(), 'lable' => $val], $district));

        $female = array_values(array_map(fn ($val) => ['data' => Survey::where('district', $val)
            ->where('gender', 'أنثى')
            ->where('is_deleted', 1)
            ->pluck('gender')
            ->count(), 'lable' => $val], $district));


        return [
            'datasets' => [
                [
                    'label' => 'male',
                    'data' => array_map(fn ($val) => $val['data'], $male),
                    'backgroundColor' => '#0198F1',
                    'borderColor' => '#0198F1',
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
