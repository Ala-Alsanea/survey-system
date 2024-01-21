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

    protected static ?string $pollingInterval = null;

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

                    $openSchools = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('school_status', 'مفتوحة')
                        ->pluck('school')
                        ->unique()
                        ->count();
                    $closeSchools = $survey
                        ->where('gov', $this->filters['gov'])
                        ->where('district', $this->filters['district'])
                        ->where('school', $this->filters['school'])
                        ->where('is_deleted', 1)
                        ->where('school_status', '!=', 'مفتوحة')
                        ->pluck('school')
                        ->unique()
                        ->count();

                    $SchoolCollected = $openSchools + $closeSchools;

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

                    $female = $survey
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
                        ->where('school_status', '!=', 'مفتوحة')
                        ->pluck('school')
                        ->unique()
                        ->count();

                    $SchoolCollected = $openSchools + $closeSchools;

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

                    $female = $survey
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
                    ->where('school_status', '!=', 'مفتوحة')
                    ->pluck('school')
                    ->unique()
                    ->count();

                $SchoolCollected = $openSchools + $closeSchools;
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

                $female = $survey
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
            $openSchools = $survey
                // ->where('gov', $this->filters['gov'])
                // ->where('district', $this->filters['district'])
                // ->where('school', $this->filters['school'])
                ->where('is_deleted', 1)
                ->where('school_status', 'مفتوحة')
                ->pluck('school')
                ->unique()
                ->count();
            $closeSchools = $survey
                // ->where('gov', $this->filters['gov'])
                // ->where('district', $this->filters['district'])
                // ->where('school', $this->filters['school'])
                ->where('is_deleted', 1)
                ->where('school_status', '!=', 'مفتوحة')
                ->pluck('school')
                ->unique()
                ->count();

            $SchoolCollected = $openSchools + $closeSchools;

            $Schools = $teacherInfo->pluck('school')->unique()->count();
            $SchoolNotCollected = $Schools - $SchoolCollected;

            $TeacherExist = $survey
                ->where('is_deleted', 1)
                ->where('q_1', 'نعم')->count();
            $TeacherNotExist = $survey
                ->where('is_deleted', 1)
                ->where('q_1', 'لا')->count();



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
                ->where('edu_qual', '!=', 'اقل من ثانوية عامة')
                ->count();

            $male = $survey
                // ->where('gov', $this->filters['gov'])
                // ->where('district', $this->filters['district'])
                // ->where('school', $this->filters['school'])
                ->where('is_deleted', 1)
                ->where('gender', 'ذكر')
                ->count();

            $female = $survey
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

        // dd($openSchools);


        return [


            Stat::make('All targeted schools', $Schools)
                // ->color('success')
                // ->description('all')
                ->descriptionIcon('heroicon-s-building-office-2')
                ->color('info')
                ->extraAttributes([
                    // 'class' => 'h-16',
                ]),

            Stat::make('Achieved schools', $SchoolCollected)
                // ->color('success')
                ->description("$percentageOfCollectedSchools% collected")
                ->descriptionIcon('heroicon-s-building-office')
                ->color('success'),

            Stat::make('Not achieved schools', $SchoolNotCollected)
                // ->color('success')
                ->description("$percentageOfNotCollectedSchools% not collected")
                ->descriptionIcon('heroicon-s-building-office')
                ->color('danger'),


            Stat::make('Available', $TeacherExist)
                // ->color('success')
                ->description('teachers')
                ->descriptionIcon('heroicon-s-user')
                ->color('success'),

            Stat::make('Not available', $TeacherNotExist)
                // ->color('success')
                ->description('teachers')
                ->descriptionIcon('heroicon-s-user')
                ->color('danger'),

            // ?#######################(new)#############################
            Stat::make('open', $openSchools)
                ->description('Schools')
                ->descriptionIcon('heroicon-s-lock-open')
                ->color('success'),

            Stat::make('close', $closeSchools)
                ->description('Schools')
                ->descriptionIcon('heroicon-s-lock-closed')
                ->color('danger'),

            Stat::make('Teachers have ID', $totalNationalCardId)
                // ->description('National Card Id')
                ->descriptionIcon('heroicon-s-identification')
                ->color('info'),

            Stat::make('Qualified teachers', $totalEduQual)
                // ->description('Education Qualification')
                ->descriptionIcon('heroicon-s-academic-cap')
                ->color('info'),

            Stat::make('Male teachers', $male)
                // ->description('male')
                ->descriptionIcon('heroicon-s-user-circle')
                ->color('info'),

            Stat::make('Female teachers', $female)
                // ->description('famale')
                ->descriptionIcon('heroicon-s-user-circle')
                ->color('danger'),




        ];
        // return [];


    }
}
