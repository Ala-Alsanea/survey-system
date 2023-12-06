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

    protected static ?int $sort = 3;

    public bool $readyToLoad = false;

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    protected static string $color = 'info';

    protected function getData(): array
    {

        $labels = array_values(TeacherInfo::pluck('gov')->unique()->all());

        $targeted  = array_map(fn ($val) => ['data' => TeacherInfo::where('gov', $val)->count(), 'lable' => $val], $labels);
        $targeted  = array_values($targeted);

        $progressed  = array_values(array_map(fn ($val) => ['data' => Survey::where('gov', $val)->count(), 'lable' => $val], $labels));


        sleep(1);
        // dd($labels);

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

        // return [];

    }

    protected function getType(): string
    {
        return 'bar';
    }
}
