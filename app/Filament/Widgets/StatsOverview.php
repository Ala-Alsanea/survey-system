<?php

namespace App\Filament\Widgets;

use App\Models\Survey;
use App\Models\Researcher;
use App\Models\TeacherInfo;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

use function PHPUnit\Framework\isEmpty;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    // use HasFiltersAction;


    protected static ?int $sort = 1;

    // public bool $readyToLoad = false;

    // protected int | string | array $columnSpan = 'full';

    // public function loadData()
    // {
    //     $this->readyToLoad = true;
    // }

    protected function getStats(): array
    {

        // dd($this->filters);


        $SchoolCollected = Survey::pluck('school')->unique()->count();
        $Schools = TeacherInfo::pluck('school')->unique()->count();
        $SchoolNotCollected = $Schools - $SchoolCollected;

        $TeacherExist = Survey::where('q_1', 'نعم')->count();
        $TeacherNotExist = Survey::where('q_1', 'لا')->count();

        $percentageOfCollectedSchools = number_format((float)(($SchoolCollected / $Schools) * 100), 2, '.', '');
        $percentageOfNotCollectedSchools = number_format((float)(($SchoolNotCollected / $Schools) * 100), 2, '.', '');


        // dd(TeacherInfo::pluck('school')->unique()->all());

        // ! fix filter is "" not null
        $disLabel = !isEmpty($this->filters['district'])  ? $this->filters['district'] : 'all';
        $subLabel = !isEmpty($this->filters['subdistrict'])  ? $this->filters['subdistrict'] : 'all';
        $desc = $disLabel. ' - ' .$subLabel;
        // dd($this->filters);


        return [


            Stat::make('filter', !isEmpty($this->filters['gov'])  ? $this->filters['gov']: 'all')
                // ->color('success')
                ->description($desc)
                // ->descriptionIcon('heroicon-s-building-office-2')
                // ->color('success')
                ->extraAttributes([
                    // 'class' => 'col-span-2',
                ]),

            Stat::make('School', $Schools)
                // ->color('success')
                ->description('all')
                ->descriptionIcon('heroicon-s-building-office-2')
                ->color('success')
                ->extraAttributes([
                    // 'class' => 'col-span-2',
                ]),

            Stat::make('School', $SchoolCollected)
                // ->color('success')
                ->description("$percentageOfCollectedSchools% collected")
                ->descriptionIcon('heroicon-s-building-office')
                ->color('success'),

            Stat::make('School', $SchoolNotCollected)
                // ->color('success')
                ->description("$percentageOfNotCollectedSchools% not collected")
                ->descriptionIcon('heroicon-s-building-office')
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
