<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\ChartWidget;

class SchoolByDistrictChart extends ChartWidget
{
    protected static ?string $heading = 'School By district';

    protected static ?int $sort = 5;

    public bool $readyToLoad = false;
    protected static bool $isLazy = true;
    // protected static ?string $maxHeight = '300px';

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    protected static string $color = 'info';

    protected function getData(): array
    {

        $district = array_values(TeacherInfo::pluck('district')->unique()->all());

        $targetedSchool = array_values(array_map(fn ($val) => ['data' => TeacherInfo::where('district', $val)->pluck('school')->unique()->count(), 'lable' => $val], $district));
        $progressedSchool = array_values(array_map(fn ($val) => ['data' => Survey::where('district', $val)->pluck('school')->count(), 'lable' => $val], $district));

        $test = usort($targetedSchool, fn ($a, $b)=> $b['data'] <=> $a['data']);

        // dd($targetedSchool);

        // $num = 0;
        // for ($i = 0; $i < count($targetedSchool); $i++) {
        //     $num += $targetedSchool[$i]['data'];
        //     // echo $num;
        // }

        // dd($targetedSchool);


        // dd($progressedSchool);

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
