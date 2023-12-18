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
        $SchoolCollected = Survey::pluck('school')->unique()->count();
        $Schools = TeacherInfo::pluck('school')->unique()->count();
        $SchoolNotCollected = $Schools - $SchoolCollected;

        $TeacherExist = Survey::where('q_1', 'نعم')->count();
        $TeacherNotExist = Survey::where('q_1', 'لا')->count();

        $percentageOfCollectedSchools = number_format((float)(($SchoolCollected / $Schools) * 100), 2, '.', '');
        $percentageOfNotCollectedSchools = number_format((float)(($SchoolNotCollected / $Schools) * 100), 2, '.', '');
        // dd()

        return [


            Stat::make('School', $Schools)
                // ->color('success')
                ->description('all')
                ->descriptionIcon('heroicon-s-building-office-2')
                ->color('success')
                ->extraAttributes([
                    'class' => 'col-span-2',
                ]),

            Stat::make('School', $SchoolCollected)
                // ->color('success')
                ->description("$percentageOfCollectedSchools% collected")
                ->descriptionIcon('heroicon-s-building-office')
                ->color('success'),

            Stat::make('School', $SchoolNotCollected)
                // ->color('success')
                ->description("$percentageOfNotCollectedSchools% not collected")                ->descriptionIcon('heroicon-s-building-office')
                ->color('danger'),


            Stat::make('Teacher', $TeacherExist)
                // ->color('success')
                ->description('Exist')
                ->descriptionIcon('heroicon-s-user')
                ->color('success'),

            Stat::make('Teacher', $TeacherNotExist)
                // ->color('success')
                ->description('Not Exist')
                ->descriptionIcon('heroicon-s-user')
                ->color('danger'),




        ];
        // return [];


    }
}
