<?php

namespace App\Filament\Widgets;

use App\Models\Researcher;
use App\Models\Survey;
use App\Models\TeacherInfo;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    public bool $readyToLoad = false;
    protected int | string | array $columnSpan = 'full';

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    protected function getStats(): array
    {
        $TeacherCollected = Survey::all()->count();
        $reviewedSurvey = Survey::where('done', 1)->count();
        $notReviewedSurvey = Survey::where('done', 0)->count();
        $labelsDone = Survey::pluck('done')->unique()->all();
        $data  = array_map(fn ($val) => ['data' => Survey::where('done', $val)->count(), 'lable' => str($val)], $labelsDone);
        $researcher = Researcher::all()->count();


        sleep(1);


        // dd($data);


        return [
            //
            Stat::make('Researchers', $researcher)
                ->color('success')
                ->description('total')
                ->descriptionIcon('heroicon-s-users')
                ->color('success'),

            Stat::make('Survey ', $TeacherCollected )
                ->color('success')
                ->description('Collected')
                ->descriptionIcon('heroicon-o-circle-stack')
                ->chart(array_map(fn ($val) => $val['data'], $data))
                ->color('success'),

            Stat::make('Not reviewed', $notReviewedSurvey)
                ->description('Survey')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),

            Stat::make('Reviewed ', $reviewedSurvey)
            ->description('Survey')
            ->descriptionIcon('heroicon-o-check-circle')
            ->color('success'),



        ];
        // return [];


    }
}
