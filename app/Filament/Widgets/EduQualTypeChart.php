<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use Filament\Widgets\ChartWidget;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Widgets\Concerns\InteractsWithPageFilters;


class EduQualTypeChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Education Qualification Type';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'primary';


    public function getHeading(): string | Htmlable | null
    {
        $filterLable = $this->filters['gov'] . " - " . $this->filters['district'] . " - " . $this->filters['school'];
        return "Education Qualification Type ( $filterLable )";
    }


    protected function getData(): array
    {

        $type = array_values(Survey::pluck('edu_qual')->unique()->all());

        // $total = array_values(array_map(fn ($val) => ['data' => Survey::where('edu_qual', 'like', '%' . $val . '%')
        //     ->where('is_deleted', 1)
        //     ->count(), 'lable' => $val], $type));



        if (!isEmpty($this->filters['gov']) || $this->filters['gov'] != null) {

            if (!isEmpty($this->filters['district']) || $this->filters['district'] != null) {


                if (!isEmpty($this->filters['school']) || $this->filters['school'] != null) {

                    // gov, distract and school

                    $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')
                        ->where('is_deleted', 1)
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->count(), 'lable' => $val], $type));
                } else {
                    // gov and distract

                    $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')
                        ->where('is_deleted', 1)
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->count(), 'lable' => $val], $type));
                }
            } else {
                // gov
                $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')
                    ->where('is_deleted', 1)
                    ->where('gov', $this->filters['gov'])
                    ->count(), 'lable' => $val], $type));;
            }
        } else {
            // all
            $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')->where('is_deleted', 1)->count(), 'lable' => $val], $type));
        }

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
