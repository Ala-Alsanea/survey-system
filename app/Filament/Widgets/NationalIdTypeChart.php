<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\ChartWidget;

class NationalIdTypeChart extends ChartWidget
{
    protected static ?string $heading = 'National Id Type';

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


        $type = array_values(Survey::pluck('q_3')->unique()->all());

        $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%'.$val.'%')->count(), 'lable' => $val], $type));

        // dd($type);


        return [
            'datasets' => [
                [
                    'label' => 'National Id',
                    'data' => array_map(fn ($val) => $val['data'], $total),
                    // 'backgroundColor' => '#d4d4d8',
                    // 'borderColor' => '#3f3f46',
                ],


            ],
            'labels' => array_map(fn ($val) => $val['lable']??'null', $total),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }


    protected function getOptions(): array
    {
        return [
             'indexAxis'=> 'y',
            'barThickness' => 10
        ];
    }
}
