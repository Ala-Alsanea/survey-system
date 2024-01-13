<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use Filament\Widgets\ChartWidget;

class EduQualTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Education Qualification Type';

    public bool $readyToLoad = false;
    protected static bool $isLazy = true;
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'primary';

    public function loadData()
    {
        $this->readyToLoad = true;
    }


    protected function getData(): array
    {

        $type = array_values(Survey::pluck('edu_qual')->unique()->all());

        $total = array_values(array_map(fn ($val) => ['data' => Survey::where('edu_qual', 'like', '%' . $val . '%')->count(), 'lable' => $val], $type));

        // dd($type);


        return [
            'datasets' => [
                [
                    'label' => 'Education Qualification',
                    'data' => array_map(fn ($val) => $val['data'], $total),
                    'backgroundColor' => '#ff6c86',
                    'borderColor' => '#9b001b',
                ],


            ],
            'labels' => array_map(fn ($val) => $val['lable'] ?? 'null', $total),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
