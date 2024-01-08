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


    protected function calpercentage($partSchool,$allSchools)
    {

        return $allSchools !==0? number_format((float)(($partSchool / $allSchools) * 100), 2, '.', ''):0;
    }

    protected function getStats(): array
    {

        // dd($this->filters);

        // ! make it filter on backend not sql connction
        $teacherInfo = TeacherInfo::all();
        $survey = Survey::all();
        // dd($teach->where('district', $this->filters['district']));

        if (!isEmpty($this->filters['gov']) || $this->filters['gov'] != null) {

            if (!isEmpty($this->filters['district']) || $this->filters['district'] != null) {


                if (!isEmpty($this->filters['school']) || $this->filters['school'] != null) {

                    $SchoolCollected = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school', $this->filters['school'])->pluck('school')->unique()->count();
                    $Schools = $teacherInfo
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school', $this->filters['school'])->pluck('school')->unique()->count();
                    $SchoolNotCollected = $Schools - $SchoolCollected;

                    $TeacherExist = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school', $this->filters['school'])
                    ->where('q_1', 'نعم')->count();
                    $TeacherNotExist = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school', $this->filters['school'])
                    ->where('q_1', 'لا')->count();

                    $openSchools = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school', $this->filters['school'])
                    ->where('school_status', 'مفتوحة')->count();
                    $closeSchools = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school', $this->filters['school'])
                    ->where('school_status', 'مغلقه')->count();



                    $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected , $Schools) ;
                    $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected , $Schools) ;
                } else {



                    $SchoolCollected = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])->pluck('school')->unique()->count();
                    $Schools = $teacherInfo
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])->pluck('school')->unique()->count();
                    $SchoolNotCollected = $Schools - $SchoolCollected;

                    $TeacherExist = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('q_1', 'نعم')->count();
                    $TeacherNotExist = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('q_1', 'لا')->count();



                    $openSchools = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school_status', 'مفتوحة')->count();
                    $closeSchools = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('district', $this->filters['district'])
                    ->where('school_status', 'مغلقه')->count();


                    $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected , $Schools) ;
                    $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected , $Schools) ;
                }
            } else {


                $SchoolCollected = $survey
                ->where('gov', $this->filters['gov'])->pluck('school')->unique()->count();
                $Schools = $teacherInfo
                ->where('gov', $this->filters['gov'])->pluck('school')->unique()->count();
                $SchoolNotCollected = $Schools - $SchoolCollected;

                $TeacherExist = $survey
                ->where('gov', $this->filters['gov'])
                ->where('q_1', 'نعم')->count();
                $TeacherNotExist = $survey
                ->where('gov', $this->filters['gov'])
                ->where('q_1', 'لا')->count();


                $openSchools = $survey
                ->where('gov', $this->filters['gov'])
                ->where('school_status', 'مفتوحة')->count();
                $closeSchools = $survey
                ->where('gov', $this->filters['gov'])
                ->where('school_status', 'مغلقه')->count();

                $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected , $Schools) ;
                $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected , $Schools) ;
            }
        } else {

            $SchoolCollected = $survey->pluck('school')->unique()->count();
            $Schools = $teacherInfo->pluck('school')->unique()->count();
            $SchoolNotCollected = $Schools - $SchoolCollected;

            $TeacherExist = $survey
            ->where('q_1', 'نعم')->count();
            $TeacherNotExist = $survey
            ->where('q_1', 'لا')->count();

            $openSchools = $survey
            ->where('school_status', 'مفتوحة')->count();
            $closeSchools = $survey
            ->where('school_status', 'مغلقه')->count();


            $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected , $Schools) ;
            $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected , $Schools) ;
        }


        // dd(TeacherInfo::pluck('school')->unique()->all());

        // ! fix filter is "" not null
        $disLabel = !isEmpty($this->filters['district']) || $this->filters['district'] != null  ? $this->filters['district'] : 'all';
        $subLabel = !isEmpty($this->filters['school']) || $this->filters['school'] != null ? $this->filters['school'] : 'all';
        $desc = $disLabel . ' - ' . $subLabel;

        // dd($this->filters);


        return [


            Stat::make('filter', !isEmpty($this->filters['gov']) || $this->filters['gov'] != null  ? $this->filters['gov'] : 'all')
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
