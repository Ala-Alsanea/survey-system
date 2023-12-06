<?php

namespace App\Filament\Widgets;

use App\Models\TeacherInfo;
use Flowframe\Trend\Trend;
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

        // $labels = TeacherInfo::pluck('gender')->unique()->all();

        // $data  = array_map(fn($val)=>['data'=>TeacherInfo::where('gender',$val)->count(),'lable'=>str($val)],$labels);

        // // sleep(2);
        // // dd($data);

        // return [
        //     'datasets' => [
        //         [
        //             'label' => 'targeted',
        //             'data' => [500,500],
        //             // 'backgroundColor' => '#d4d4d8',
        //             // 'borderColor' => '#3f3f46',
        //         ],

        //         [
        //             'label' => 'progress',
        //             'data' =>  array_map(fn ($val) => $val['data'], $data),
        //             'backgroundColor' => '#16a34a',
        //             'borderColor' => '#065f46',
        //         ]
        //     ],
        //     'labels' => array_map(fn ($val) => $val['lable'], $data),
        // ];

        return [];

    }

    protected function getType(): string
    {
        return 'bar';
    }
}
