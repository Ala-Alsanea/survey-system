<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\ChartWidget;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Contracts\Support\Htmlable;
use Filament\Widgets\Concerns\InteractsWithPageFilters;


class NationalIdTypeChart extends ChartWidget
{
    use InteractsWithPageFilters;


    // protected static ?string $heading = 'National Id Type';

    protected static string $color = 'info';



    public function getHeading(): string | Htmlable | null
    {
        $filterLable = $this->filters['gov'] . " - " . $this->filters['district'] . " - " . $this->filters['school'];
        return "National Id Type";
    }

    protected function getData(): array
    {


        $type = array_values(Survey::pluck('q_3')->unique()->all());


        if (!isEmpty($this->filters['gov']) || $this->filters['gov'] != null) {

            if (!isEmpty($this->filters['district']) || $this->filters['district'] != null) {


                if (!isEmpty($this->filters['school']) || $this->filters['school'] != null) {

                    // gov, distract and school

                    $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')
                        ->where('is_deleted', 1)
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->count(), 'lable' => match ($val) {
                            'إستبيان' => 'Temporary ID (a questionnaire)',
                            'بطاقة شخصية جديدة (إلكترونية)' => 'Personal electronic ID',
                            'بطاقة شخصية قديمة' => 'Old Personal ID',
                            'بطاقة عائلية' => 'Family Card',
                            'جواز سفر' => 'Passport',
                            'لا يوجد' => 'None',
                        default => 'Not Selected',
                    }
                ], $type));
                } else {
                    // gov and distract

                    $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')
                        ->where('is_deleted', 1)
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->count(), 'lable' => match ($val) {
                            'إستبيان' => 'Temporary ID (a questionnaire)',
                            'بطاقة شخصية جديدة (إلكترونية)' => 'Personal electronic ID',
                            'بطاقة شخصية قديمة' => 'Old Personal ID',
                            'بطاقة عائلية' => 'Family Card',
                            'جواز سفر' => 'Passport',
                            'لا يوجد' => 'None',
                        default => 'Not Selected',
                    }], $type));
                }
            } else {
                // gov
                $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')
                    ->where('is_deleted', 1)
                    ->where('gov', $this->filters['gov'])
                    ->count(), 'lable' => match ($val) {
                            'إستبيان' => 'Temporary ID (a questionnaire)',
                            'بطاقة شخصية جديدة (إلكترونية)' => 'Personal electronic ID',
                            'بطاقة شخصية قديمة' => 'Old Personal ID',
                            'بطاقة عائلية' => 'Family Card',
                            'جواز سفر' => 'Passport',
                            'لا يوجد' => 'None',
                        default => 'Not Selected',
                    }], $type));;
            }
        } else {
            // all
            $total = array_values(array_map(fn ($val) => ['data' => Survey::where('q_3', 'like', '%' . $val . '%')->where('is_deleted', 1)->count(),
            'lable' => match ($val) {
                            'إستبيان' => 'Temporary ID (a questionnaire)',
                            'بطاقة شخصية جديدة (إلكترونية)' => 'Personal electronic ID',
                            'بطاقة شخصية قديمة' => 'Old Personal ID',
                            'بطاقة عائلية' => 'Family Card',
                            'جواز سفر' => 'Passport',
                            'لا يوجد' => 'None',
                        default => 'Not Selected',
                    }], $type));
        }




        // dd($type);


        return [
            'datasets' => [
                [
                    'label' => 'National Id',
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
