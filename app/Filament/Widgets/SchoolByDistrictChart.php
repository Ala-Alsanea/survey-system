<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\ChartWidget;

class SchoolByDistrictChart extends ChartWidget
{
    protected static ?string $heading = 'School By district';

    protected static ?int $sort = 3;

    public bool $readyToLoad = false;

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    protected static string $color = 'info';

    protected function getData(): array
    {

        $labels = array_values(TeacherInfo::pluck('district')->unique()->all());
        $targeted  = array_values(array_map(fn ($val) => ['data' => TeacherInfo::where('district', $val)->count(), 'lable' => $val], $labels));

        $progressed  = array_values(array_map(fn ($val) => ['data' => Survey::where('district', $val)->count(), 'lable' => $val], $labels));



        sleep(1);
        // dd($targeted);

        return [
            'datasets' => [
                [
                    'label' => 'targeted',
                    'data' => array_map(fn ($val) => $val['data'], $targeted),
                    // 'backgroundColor' => '#d4d4d8',
                    // 'borderColor' => '#3f3f46',
                ],

                [
                    'label' => 'progress',
                    'data' =>  array_map(fn ($val) => $val['data'], $progressed),
                    'backgroundColor' => '#16a34a',
                    'borderColor' => '#065f46',
                ]
            ],
            'labels' => array_map(fn ($val) => $val['lable'], $targeted),
        ];

        // return[];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
