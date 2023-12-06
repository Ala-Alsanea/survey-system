<?php

namespace App\Filament\Widgets;

use App\Models\Researcher;
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
        // $collected = TeacherInfo::all()->count();
        // $reviewed = TeacherInfo::where('done', 1)->count();
        // $not_reviewed = TeacherInfo::where('done', 0)->count();
        // $labels = TeacherInfo::pluck('done')->unique()->all();
        // $data  = array_map(fn ($val) => ['data' => TeacherInfo::where('done', $val)->count(), 'lable' => str($val)], $labels);
        // $researcher = Researcher::all()->count();


        // sleep(1);


        // // dd($data);


        // return [
        //     //
        //     Stat::make('Researchers', $researcher)
        //         ->color('success')
        //         ->description('الباحثيين')
        //         ->descriptionIcon('heroicon-s-users')
        //         ->color('success'),

        //     Stat::make('Collected', $collected )
        //         ->color('success')
        //         ->description('مستفيد')
        //         ->descriptionIcon('heroicon-o-circle-stack')
        //         ->chart(array_map(fn ($val) => $val['data'], $data))
        //         ->color('success'),

        //     Stat::make('Not reviewed yet', $not_reviewed)
        //         ->description('مستفيد')
        //         ->descriptionIcon('heroicon-o-x-circle')
        //         ->color('danger'),

        //     Stat::make('Reviewed', $reviewed)
        //     ->description('مستفيد')
        //     ->descriptionIcon('heroicon-o-check-circle')
        //     ->color('success'),



        // ];
        return [];


    }
}
