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


    protected function calpercentage($partSchool, $allSchools)
    {

        return $allSchools !== 0 ? number_format((float)(($partSchool / $allSchools) * 100), 2, '.', '') : 0;
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

                    // gov, distract and school

                    $SchoolCollected = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('is_deleted', 1)
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])->pluck('school')->unique()->count();
                    $Schools = $teacherInfo
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])->pluck('school')->unique()->count();
                    $SchoolNotCollected = $Schools - $SchoolCollected;

                    $TeacherExist = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('is_deleted', 1)
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('q_1', 'نعم')->count();
                    $TeacherNotExist = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('is_deleted', 1)
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('q_1', 'لا')->count();

                    // ?#######################(new)#############################
                    $openSchools = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('school_status', 'مفتوحة')
                        ->count();
                    $closeSchools = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('school_status', 'مغلقه')
                        ->count();

                    $totalNationalCardId = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('q_3', 'بطاقة شخصية جديدة (إلكترونية)')
                        ->count();

                    $totalEduQual = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('edu_qual', '!=', 'غير محدد')
                        ->count();

                    $male = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('gender', 'ذكر')
                        ->count();

                    $famale = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('gender', 'أنثى')
                        ->count();



                    $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected, $Schools);
                    $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected, $Schools);
                } else {


                    // gov and distract

                    $SchoolCollected = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('is_deleted', 1)
                        ->where('district', $this->filters['district'])->pluck('school')->unique()->count();
                    $Schools = $teacherInfo
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])->pluck('school')->unique()->count();
                    $SchoolNotCollected = $Schools - $SchoolCollected;

                    $TeacherExist = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('is_deleted', 1)
                        ->where('district', $this->filters['district'])
                        ->where('q_1', 'نعم')->count();
                    $TeacherNotExist = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('is_deleted', 1)
                        ->where('district', $this->filters['district'])
                        ->where('q_1', 'لا')->count();




                    // ?#######################(new)#############################
                    $openSchools = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        // ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('school_status', 'مفتوحة')
                        ->pluck('school')
                        ->unique()
                        ->count();
                    $closeSchools = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        // ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('school_status', 'مغلقه')
                        ->pluck('school')
                        ->unique()
                        ->count();

                    $totalNationalCardId = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        // ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where(
                            'q_3',
                            'بطاقة شخصية جديدة (إلكترونية)'
                        )
                        ->count();

                    $totalEduQual = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        // ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('edu_qual', '!=', 'غير محدد')
                        ->count();

                    $male = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        // ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('gender', 'ذكر')
                        ->count();

                    $famale = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        // ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('gender', 'أنثى')
                        ->count();


                    $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected, $Schools);
                    $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected, $Schools);
                }
            } else {


                // gov
                $SchoolCollected = $survey
                    ->where('gov', $this->filters['gov'])->where('is_deleted', 1)->pluck('school')->unique()->count();
                $Schools = $teacherInfo
                    ->where('gov', $this->filters['gov'])->pluck('school')->unique()->count();
                $SchoolNotCollected = $Schools - $SchoolCollected;

                $TeacherExist = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('is_deleted', 1)
                    ->where('q_1', 'نعم')->count();
                $TeacherNotExist = $survey
                    ->where('gov', $this->filters['gov'])
                    ->where('is_deleted', 1)
                    ->where('q_1', 'لا')->count();


                // ?#######################(new)#############################
                $openSchools = $survey
                    ->where('gov', $this->filters['gov'])
                    // ->where('district', $this->filters['district'])
                    // ->where('school', $this->filters['school'])
                    ->where('is_deleted', 1)
                    ->where('school_status', 'مفتوحة')
                    ->pluck('school')
                    ->unique()
                    ->count();
                $closeSchools = $survey
                    ->where('gov', $this->filters['gov'])
                    // ->where('district', $this->filters['district'])
                    // ->where('school', $this->filters['school'])
                    ->where('is_deleted', 1)
                    ->where('school_status', 'مغلقه')
                    ->pluck('school')
                    ->unique()
                    ->count();

                $totalNationalCardId = $survey
                    ->where('gov', $this->filters['gov'])
                    // ->where('district', $this->filters['district'])
                    // ->where('school', $this->filters['school'])
                    ->where('is_deleted', 1)
                    ->where('q_3', 'بطاقة شخصية جديدة (إلكترونية)')
                    ->count();

                $totalEduQual = $survey
                    ->where('gov', $this->filters['gov'])
                    // ->where('district', $this->filters['district'])
                    // ->where('school', $this->filters['school'])
                    ->where('is_deleted', 1)
                    ->where('edu_qual', '!=', 'غير محدد')
                    ->count();

                $male = $survey
                    ->where('gov', $this->filters['gov'])
                    // ->where('district', $this->filters['district'])
                    // ->where('school', $this->filters['school'])
                    ->where('is_deleted', 1)
                    ->where('gender', 'ذكر')
                    ->count();

                $famale = $survey
                    ->where('gov', $this->filters['gov'])
                    // ->where('district', $this->filters['district'])
                    // ->where('school', $this->filters['school'])
                    ->where('is_deleted', 1)
                    ->where('gender', 'أنثى')
                    ->count();

                $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected, $Schools);
                $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected, $Schools);
            }
        } else {

            // all
            $SchoolCollected = $survey->where('is_deleted', 1)->pluck('school')->unique()->count();
            $Schools = $teacherInfo->pluck('school')->unique()->count();
            $SchoolNotCollected = $Schools - $SchoolCollected;

            $TeacherExist = $survey
                ->where('is_deleted', 1)
                ->where('q_1', 'نعم')->count();
            $TeacherNotExist = $survey
                ->where('is_deleted', 1)
                ->where('q_1', 'لا')->count();

            $openSchools = $survey
                ->where('is_deleted', 1)
                ->where('school_status', 'مفتوحة')
                ->pluck('school')
                ->unique()
                ->count();
            $closeSchools = $survey
                ->where('is_deleted', 1)
                ->where('school_status', 'مغلقه')
                ->pluck('school')
                ->unique()
                ->count();

            //     dd(
            //         $survey
            //     ->where('is_deleted', 1)
            //     ->where('school_status', 'مفتوحة')
            //     ->pluck('school')
            //     ->unique()
            //     ->count()
            // );

            // ?#######################(new)#############################

            $totalNationalCardId = $survey
                // ->where('gov', $this->filters['gov'])
                // ->where('district', $this->filters['district'])
                // ->where('school', $this->filters['school'])
                ->where('is_deleted', 1)
                ->where('q_3', 'بطاقة شخصية جديدة (إلكترونية)')
                ->count();

            $totalEduQual = $survey
                // ->where('gov', $this->filters['gov'])
                // ->where('district', $this->filters['district'])
                // ->where('school', $this->filters['school'])
                ->where('is_deleted', 1)
                ->where('edu_qual', '!=', 'غير محدد')
                ->count();

            $male = $survey
                // ->where('gov', $this->filters['gov'])
                // ->where('district', $this->filters['district'])
                // ->where('school', $this->filters['school'])
                ->where('is_deleted', 1)
                ->where('gender', 'ذكر')
                ->count();

            $famale = $survey
                // ->where('gov', $this->filters['gov'])
                // ->where('district', $this->filters['district'])
                // ->where('school', $this->filters['school'])
                ->where('is_deleted', 1)
                ->where('gender', 'أنثى')
                ->count();


            $percentageOfCollectedSchools = $this->calpercentage($SchoolCollected, $Schools);
            $percentageOfNotCollectedSchools = $this->calpercentage($SchoolNotCollected, $Schools);
        }


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

            // ?#######################(new)#############################
            Stat::make('open', $openSchools)
                ->description('Schools')
                // ->descriptionIcon('heroicon-s-user')
                ->color('success'),

            Stat::make('close', $closeSchools)
                ->description('Schools')
                // ->descriptionIcon('heroicon-s-user')
                ->color('danger'),

            Stat::make('total', $totalNationalCardId)
                ->description('National Card Id')
                // ->descriptionIcon('heroicon-s-user')
                ->color('success'),

            Stat::make('total', $totalEduQual)
                ->description('Education Qualification')
                // ->descriptionIcon('heroicon-s-user')
                ->color('success'),

            Stat::make('total', $male)
                ->description('male')
                // ->descriptionIcon('heroicon-s-user')
                ->color('info'),

            Stat::make('total', $famale)
                ->description('famale')
                // ->descriptionIcon('heroicon-s-user')
                ->color('danger'),




        ];
        // return [];


    }
}
