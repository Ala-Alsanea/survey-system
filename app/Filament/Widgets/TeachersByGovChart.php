<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use Filament\Widgets\ChartWidget;

class TeachersByGovChart extends ChartWidget
{
    protected static ?string $heading = 'Teachers By Gov';


    protected function getData(): array
    {

        $type = array_values(Survey::pluck('gov')->unique()->all());

        $total = array_values(array_map(fn ($val) => ['data' => Survey::where('gov', 'like', '%' . $val . '%')
            ->where('is_deleted', 1)->count(), 'lable' => $val], $type));



        // dd($type);


        return [
            'datasets' => [
                [
                    'label' => 'teachers',
                    'data' => array_map(fn ($val) => $val['data'], $total),
                    'backgroundColor' => '#0198F1',
                    'borderColor' => '#0198F1',
                ],


            ],
            'labels' => array_map(fn ($val) => $val['lable'] ?? 'null', $total),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'indexAxis' => 'y',
            'barThickness' => 10
        ];
    }
}
