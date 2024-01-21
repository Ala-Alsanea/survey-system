<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\ChartWidget;

class Q6Chart extends ChartWidget
{
    protected static ?string $heading = 'Teacher work confirmation from Parent Council representatives or Students Chart';

    protected function getData(): array
    {
        $district = array_values(TeacherInfo::pluck('district')->unique()->all());
        // $answers = array_values(Survey::pluck('q_6')->unique()->all());


        // foreach($answers as $answer )
        // {
        //     $chart[$answer] = array_values(array_map(fn ($val) => [
        //         'data' =>
        //         Survey::where('district', $val)
        //         ->where('q_6', 'like', '%'. $answer.'%')
        //         ->where('is_deleted', 1)
        //         ->count(),
        //         'lable' => $val
        //     ], $district));
        // }

        $yes = array_values(array_map(fn ($val) => [
            'data' =>
            Survey::where('district', $val)
                ->where('q_6', 'like', '%نعم%')
                ->where('is_deleted', 1)
                ->count(),
            'lable' => $val
        ], $district));


        $no = array_values(array_map(fn ($val) => [
            'data' =>
            Survey::where('district', $val)
                ->where('q_6', 'like', '%لا%')
                ->where('is_deleted', 1)
                ->count(),
            'lable' => $val
        ], $district));

        // $test = usort($yes, fn ($a, $b) => $b['data'] <=> $a['data']);
        // $test_2 = usort($no, fn ($a, $b) => $b['data'] <=> $a['data']);

        // dd($chart);


        return [
            'datasets' => [
                [
                    'label' => 'yes',
                    'data' => array_map(fn ($val) => $val['data'], $yes),
                    'backgroundColor' => '#0198F1',
                    'borderColor' => '#0198F1',
                ],

                [
                    'label' => 'no',
                    'data' =>  array_map(fn ($val) => $val['data'], $no),
                    'backgroundColor' => "#FF0000",
                    'borderColor' => '#FF0000',
                ]
            ],
            'labels' => array_map(fn ($val) => $val['lable'], $yes),
            // 'labels' => $district,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
