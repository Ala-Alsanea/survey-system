<?php

namespace App\Filament\Pages;

// use Filament\Forms\Form;
use Filament\Forms\Form;
use Filament\Pages\Page;
use App\Filament\Widgets;
use App\Models\TeacherInfo;
use App\Filament\Widgets\Map;
use Filament\Facades\Filament;
use App\Filament\Widgets\Q6Chart;
use App\Filament\Widgets\Q10Chart;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use App\Filament\Widgets\StatsOverview;
use Filament\Forms\Components\Fieldset;
use function PHPUnit\Framework\isEmpty;
use App\Filament\Widgets\GainMoneyChart;
use Filament\Forms\Components\DatePicker;
use App\Filament\Widgets\EduQualTypeChart;
use App\Filament\Widgets\TeachersByGovChart;
use Awcodes\Overlook\Widgets\OverlookWidget;
use App\Filament\Widgets\NationalIdTypeChart;
use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\GenderByDistrictChart;
use App\Filament\Widgets\SchoolByDistrictChart;
use Filament\Pages\Dashboard\Actions\FilterAction;
use App\Filament\Widgets\SchoolByGovernoratesChart;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Widgets\Concerns\InteractsWithPageFilters;


class Dashboard extends BaseDashboard
{

    use HasFiltersForm;
    // use HasFiltersAction;
    // use InteractsWithPageFilters;



    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $title = 'Dashboard';


    // public function getWidgets(): array
    // {
    //     return [
    //         StatsOverview::class,
    //         Map::class,
    //         SchoolByGovernoratesChart::class,
    //         SchoolByDistrictChart::class
    //     ];
    // }

    public function getFooterWidgets(): array
    {
        return [
            StatsOverview::make(['filters' => $this->filters]),
            Map::make(),
            EduQualTypeChart::make(['filters' => $this->filters]),
            NationalIdTypeChart::make(['filters' => $this->filters]),
            SchoolByGovernoratesChart::make(),
            SchoolByDistrictChart::make(),
            GenderByDistrictChart::make(),
            TeachersByGovChart::make(),
            Q10Chart::make(),
            Q6Chart::make(),
            GainMoneyChart::make(),
        ];
    }


    public function filtersForm(Form $form): Form
    {
        $teacherInfo = TeacherInfo::all();
        $gov = array_values($teacherInfo->pluck('gov')->unique()->all());

        // filter
        // ?? it can be implemented in another way ,but the time could not help 😢😢




        if (isset($this->filters['gov'])) {


            $district = array_values($teacherInfo->where('gov', $this->filters['gov'])->pluck('district')->unique()->all());

            // filter if is set and district is in gov
            if (
                isset($this->filters['district'])&&
                $teacherInfo->where('gov', $this->filters['gov'])->where('district', $this->filters['district'])->pluck('district')->count() !== 0
            ) {

                $school = array_values($teacherInfo->where('district', $this->filters['district'])->pluck('school')->unique()->all());

                // filter school is not in district to clear filter
                if (
                    $teacherInfo->where('district', $this->filters['district'])->where('school', $this->filters['school'])->pluck('school')->count() === 0
                )
                    $this->filters['school'] =  null;
            } else {
                $school = [];
                $this->filters['district'] =  null;
                $this->filters['school'] =  null;
            }


        } else {

            // $district = array_values(TeacherInfo::pluck('district')->unique()->all());
            // $school = array_values(TeacherInfo::pluck('school')->unique()->all());
            $district = [];
            $school = [];
            $this->filters['district'] =  null;
            $this->filters['school'] =  null;
            $this->filters['gov'] =  null;
        }


        // formate to ['val'=>'val']
        $govArr = array();
        array_walk(
            $gov,
            function (&$val, $key) use (&$govArr) {
                $key = $val;
                $govArr[$key] = $val;
            }
        );

        $districtArr = array();
        array_walk(
            $district,
            function (&$val, $key) use (&$districtArr) {
                $key = $val;
                $districtArr[$key] = $val;
            }
        );

        $schoolArr = array();
        array_walk(
            $school,
            function (&$val, $key) use (&$schoolArr) {
                $key = $val;
                $schoolArr[$key] = $val;
            }
        );


        return $form
            ->schema([
                Fieldset::make('Filter')
                    ->schema([
                        Select::make('gov')
                            ->options($govArr)
                            ->label('Governorate'),

                        // $this->filters['district'] ?
                        Select::make('District')
                            ->reactive()
                            ->options($districtArr)
                            ->label('district')
                        //  : Select::make('')
                        ,

                        // $this->filters['school'] ?
                        Select::make('school')
                            ->options($schoolArr)
                            ->label('School')
                        // : Select::make('')
                        ,
                    ])
                    ->columns(3),
            ]);
    }
}
