<?php

namespace App\Filament\Resources\SurveyResource\Pages;

use App\Models\Gov;
use Filament\Actions;
use App\Models\Survey;
use App\Models\District;
use App\Models\Researcher;
use App\Models\Subdistrict;
use App\Models\TeacherInfo;
use Filament\Resources\Components\Tab;
use Spatie\Activitylog\Models\Activity;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SurveyResource;
use EightyNine\ExcelImport\ExcelImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Konnco\FilamentImport\Actions\ImportField;
use Konnco\FilamentImport\Actions\ImportAction;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListSurveys extends ListRecords
{
    protected static string $resource = SurveyResource::class;

    protected function getHeaderActions(): array
    {
        $activity = Activity::all()->last();

        dd($activity->changes);
        return [
            Actions\CreateAction::make(),

            ExportAction::make('all')->exports([
                ExcelExport::make()
                    ->withFilename('all')
                    // ->fromForm()
                    ->withColumns([


                        Column::make('id')
                            ->heading('id'),

                        Column::make('researcher.name')
                            ->heading('الأسم الباحث'),

                        Column::make('researcher.phone')
                            ->heading('رقم هاتف الباحث'),

                        Column::make('lat')
                            ->heading('lat'),

                        Column::make('long')
                            ->heading('long'),

                        Column::make('created_at')
                            ->heading('تاريخ الزيارة'),

                        Column::make('gov_id')
                            ->getStateUsing(fn ($record) => Gov::where('Ar_Name', 'like', '%' . $record->gov . '%')->first()->siteCode ?? "null")
                            ->heading(__('gov_id')),

                        Column::make('gov')
                            ->heading('المحافظة'),

                        Column::make('district_id')
                            ->getStateUsing(fn ($record) => District::where('Ar_Name', 'like', '%' . $record->district . '%')->first()->siteCode ?? "null")
                            ->heading(__('district_id')),

                        Column::make('district')
                            ->heading('المديرية'),

                        Column::make('subdistrict_id')
                            ->getStateUsing(fn ($record) => Subdistrict::where('Ar_Name', 'like', '%' . $record->subdistrict . '%')->first()->siteCode ?? "null")
                            ->heading(__('subdistrict_id')),

                        Column::make('subdistrict')
                            ->heading('الغزلة'),

                        Column::make('village_name')
                            ->heading(__('village_name')),

                        Column::make('school')
                            ->heading('المدرسة'),
                        // img

                        Column::make('school_image')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->school_image) ?? "null")
                            ->heading(__('school_image')),

                        Column::make('maneger_name')
                            ->getStateUsing(fn ($record) => TeacherInfo::where('school', 'LIKE', '%' . $record->school . '%')->first()->name_manager_school ?? "null")
                            ->heading(__('maneger_name')),

                        Column::make('maneger_phone')
                            ->getStateUsing(fn ($record) => TeacherInfo::where('school', 'LIKE', '%' . $record->school . '%')->first()->phone_manager_school ?? "null")
                            ->heading(__('maneger_phone')),

                        Column::make('school_status')
                            ->heading('school_status'),

                        Column::make('name')
                            ->heading('اسم المستفيد'),

                        Column::make('teacher_name_as_on_real_life')
                            ->heading(__('teacher_name_as_on_real_life')),

                        Column::make('q_1')
                            ->heading(__('q_1')),

                        Column::make('note')
                            ->heading(__('note')),

                        Column::make('gender')
                            ->heading(__('gender')),

                        Column::make('phone')
                            ->heading(__('phone')),

                        Column::make('q_3')
                            ->heading(__('q_3')),

                        Column::make('national_card_id')
                            ->heading(__('national_card_id')),
                        // img

                        Column::make('image_national_card_front')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->image_national_card_front) ?? "null")
                            ->heading(__('image_national_card_front')),
                        // img

                        Column::make('image_national_card_back')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->image_national_card_back) ?? "null")
                            ->heading(__('image_national_card_back')),

                        Column::make('q_4')
                            ->heading(__('q_4')),

                        Column::make('teacher_birth_date')
                            ->heading(__('teacher_birth_date')),

                        Column::make('edu_qual')
                            ->heading(__('edu_qual')),

                        Column::make('Low_eduqual')
                            ->heading(__('Low_eduqual')),
                        // img

                        Column::make('eduqual_image')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->eduqual_image) ?? "null")
                            ->heading(__('صوره موهل المستفيد')),


                        Column::make('q_5')
                            ->heading(__('q_5')),

                        Column::make('q_6')
                            ->heading(__('q_6')),

                        Column::make('q_7')
                            ->heading(__('q_7')),
                        // img

                        Column::make('image_attend')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->image_attend) ?? "null")
                            ->heading(__('image_attend')),

                        Column::make('teaching_days_num_oct')
                            ->heading(__('teaching_days_num_oct')),
                        // img

                        Column::make('oct_image_attend')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->oct_image_attend) ?? "null")
                            ->heading(__('oct_image_attend')),


                        Column::make('teaching_days_num_nov')
                            ->heading(__('teaching_days_num_nov')),
                        // img

                        Column::make('nov_image_attend')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->nov_image_attend) ?? "null")
                            ->heading(__('nov_image_attend')),

                        Column::make('teaching_days_num_dec')
                            ->heading(__('teaching_days_num_dec')),
                        // img

                        Column::make('dec_image_attend')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->dec_image_attend) ?? "null")
                            ->heading(__('dec_image_attend')),

                        Column::make('q_8')
                            ->heading(__('q_8')),

                        Column::make('oct_teacher_sinature')
                            ->heading(__('oct_teacher_sinature')),

                        Column::make('nov_teacher_sinature')
                            ->heading(__('nov_teacher_sinature')),

                        Column::make('dec_teacher_sinature')
                            ->heading(__('dec_teacher_sinature')),

                        Column::make('q_9')
                            ->heading(__('q_9')),

                        Column::make('q_10')
                            ->heading(__('q_10')),

                        Column::make('checked_teacher_name')
                            ->heading(__('checked_teacher_name')),

                        Column::make('checked_job_type')
                            ->heading(__('checked_job_type')),

                        Column::make('teacher_job_type')
                            ->heading(__('teacher_job_type')),

                        Column::make('exact_teacher_job_type')
                            ->heading(__('exact_teacher_job_type')),

                        Column::make('checked_school_name')
                            ->heading(__('checked_school_name')),

                        Column::make('school_name_as_on_user_contract_work')
                            ->heading(__('school_name_as_on_user_contract_work')),

                        Column::make('school_name_on_vistiting_and_contract_identical')
                            ->heading(__('school_name_on_vistiting_and_contract_identical')),

                        Column::make('checked_location')
                            ->heading(__('checked_location')),

                        Column::make('check_school_location')
                            ->heading(__('check_school_location')),

                        Column::make('checked_hiring_date')
                            ->heading(__('checked_hiring_date')),

                        Column::make('contract_date')
                            ->heading(__('contract_date')),

                        Column::make('checked_management_signature')
                            ->heading(__('checked_management_signature')),

                        Column::make('checked_teacher_signature')
                            ->heading(__('checked_teacher_signature')),

                        Column::make('teacher_signature_comparison')
                            ->heading(__('teacher_signature_comparison')),

                        Column::make('checked_stamp')
                            ->heading(__('checked_stamp')),
                        // img

                        Column::make('image_contract_direct_work')
                            ->getStateUsing(fn ($record) => SurveyResource::getStorageName($record->image_contract_direct_work) ?? "null")
                            ->heading(__('صوره العقد')),

                        Column::make('teacher_cotract_type')
                            ->heading(__('teacher_cotract_type')),

                        Column::make('q_11')
                            ->heading(__('q_11')),

                        Column::make('gain_money')
                            ->heading(__('gain_money')),

                        Column::make('researcher_notes')
                            ->heading(__('researcher_notes')),

                        Column::make('done')
                            ->heading(__('done')),



















                    ])

                    ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),

            ])
                ->label('Export All'),


            ImportAction::make()
                ->uniqueField('id')
                ->fields([


                    ImportField::make('id')
                        ->label('id')
                    // ->required()
                    // ->helperText('Define as id helper')
                    ,

                    ImportField::make('researcher_id')
                    // ->required()
                    ->mutateBeforeCreate(function ($value) {
                        // dd($value);
                        return  Researcher::where('name', $value)->first()->id ?? 1;
                    })
                        ->label('الأسم الباحث'),

                    ImportField::make('researcher.phone')
                    // ->required()
                    ->label('رقم هاتف الباحث'),

                    ImportField::make('lat')
                        // ->required()
                        ->label('lat'),

                    ImportField::make('long')
                        // ->required()
                        ->label('long'),

                    ImportField::make('created_at')
                        // ->required()
                        ->label('تاريخ الزيارة'),

                    ImportField::make('gov_id')
                        // ->required()
                        ->label(__('gov_id')),

                    ImportField::make('gov')
                        // ->required()
                        ->label('المحافظة'),

                    ImportField::make('district_id')
                    // ->required()
                    ->label(__('district_id')),

                    ImportField::make('district')
                        // ->required()
                        ->label('المديرية'),

                    ImportField::make('subdistrict_id')
                    // ->required()
                    ->label(__('subdistrict_id')),

                    ImportField::make('subdistrict')
                    // ->required()
                    ->label('الغزلة'),

                    ImportField::make('village_name')
                    // ->required()
                    ->label(__('village_name')),

                    ImportField::make('school')
                        // ->required()
                        ->label('المدرسة'),
                    // img

                    ImportField::make('school_image')
                    // ->required()
                    ->label(__('school_image')),

                    ImportField::make('maneger_name')
                    // ->required()
                    ->label(__('maneger_name')),

                    ImportField::make('maneger_phone')
                    // ->required()
                    ->label(__('maneger_phone')),

                    ImportField::make('school_status')
                    // ->required()
                    ->label('school_status'),

                    ImportField::make('name')
                        // ->required()
                        ->label('اسم المستفيد'),

                    ImportField::make('teacher_name_as_on_real_life')
                    // ->required()
                    ->label(__('teacher_name_as_on_real_life')),

                    ImportField::make('q_1')
                        // ->required()
                        ->label(__('q_1')),

                    ImportField::make('note')
                        // ->required()
                        ->label(__('note')),

                    ImportField::make('gender')
                        // ->required()
                        ->label(__('gender')),

                    ImportField::make('phone')
                        // ->required()
                        ->label(__('phone')),

                    ImportField::make('q_3')
                        // ->required()
                        ->label(__('q_3')),

                    ImportField::make('national_card_id')
                    // ->required()
                    ->label(__('national_card_id')),
                    // img

                    ImportField::make('image_national_card_front')
                    // ->required()
                    ->label(__('image_national_card_front')),
                    // img

                    ImportField::make('image_national_card_back')
                    // ->required()
                    ->label(__('image_national_card_back')),

                    ImportField::make('q_4')
                        // ->required()
                        ->label(__('q_4')),

                    ImportField::make('teacher_birth_date')
                    // ->required()
                    ->label(__('teacher_birth_date')),

                    ImportField::make('edu_qual')
                        // ->required()
                        ->label(__('edu_qual')),

                    ImportField::make('Low_eduqual')
                    // ->required()
                    ->label(__('Low_eduqual')),
                    // img

                    ImportField::make('eduqual_image')
                    // ->required()
                    ->label(__('صوره موهل المستفيد')),

                    ImportField::make('q_5')
                        // ->required()
                        ->label(__('q_5')),

                    ImportField::make('q_6')
                        // ->required()
                        ->label(__('q_6')),

                    ImportField::make('q_7')
                        // ->required()
                        ->label(__('q_7')),
                    // img

                    ImportField::make('image_attend')
                    // ->required()
                    ->label(__('image_attend')),

                    ImportField::make('teaching_days_num_oct')
                    // ->required()
                    ->label(__('teaching_days_num_oct')),
                    // img

                    ImportField::make('oct_image_attend')
                    // ->required()
                    ->label(__('oct_image_attend')),

                    ImportField::make('teaching_days_num_nov')
                    // ->required()
                    ->label(__('teaching_days_num_nov')),
                    // img

                    ImportField::make('nov_image_attend')
                    // ->required()
                    ->label(__('nov_image_attend')),

                    ImportField::make('teaching_days_num_dec')
                    // ->required()
                    ->label(__('teaching_days_num_dec')),
                    // img

                    ImportField::make('dec_image_attend')
                    // ->required()
                    ->label(__('dec_image_attend')),

                    ImportField::make('q_8')
                        // ->required()
                        ->label(__('q_8')),

                    ImportField::make('oct_teacher_sinature')
                    // ->required()
                    ->label(__('oct_teacher_sinature')),

                    ImportField::make('nov_teacher_sinature')
                    // ->required()
                    ->label(__('nov_teacher_sinature')),

                    ImportField::make('dec_teacher_sinature')
                    // ->required()
                    ->label(__('dec_teacher_sinature')),

                    ImportField::make('q_9')
                        // ->required()
                        ->label(__('q_9')),

                    ImportField::make('q_10')
                        // ->required()
                        ->label(__('q_10')),

                    ImportField::make('checked_teacher_name')
                    // ->required()
                    ->label(__('checked_teacher_name')),

                    ImportField::make('checked_job_type')
                    // ->required()
                    ->label(__('checked_job_type')),

                    ImportField::make('teacher_job_type')
                    // ->required()
                    ->label(__('teacher_job_type')),

                    ImportField::make('exact_teacher_job_type')
                    // ->required()
                    ->label(__('exact_teacher_job_type')),

                    ImportField::make('checked_school_name')
                    // ->required()
                    ->label(__('checked_school_name')),

                    ImportField::make('school_name_as_on_user_contract_work')
                    // ->required()
                    ->label(__('school_name_as_on_user_contract_work')),

                    ImportField::make('school_name_on_vistiting_and_contract_identical')
                    // ->required()
                    ->label(__('school_name_on_vistiting_and_contract_identical')),

                    ImportField::make('checked_location')
                    // ->required()
                    ->label(__('checked_location')),

                    ImportField::make('check_school_location')
                    // ->required()
                    ->label(__('check_school_location')),

                    ImportField::make('checked_hiring_date')
                    // ->required()
                    ->label(__('checked_hiring_date')),

                    ImportField::make('contract_date')
                    // ->required()
                    ->label(__('contract_date')),

                    ImportField::make('checked_management_signature')
                    // ->required()
                    ->label(__('checked_management_signature')),

                    ImportField::make('checked_teacher_signature')
                    // ->required()
                    ->label(__('checked_teacher_signature')),

                    ImportField::make('teacher_signature_comparison')
                    // ->required()
                    ->label(__('teacher_signature_comparison')),

                    ImportField::make('checked_stamp')
                    // ->required()
                    ->label(__('checked_stamp')),
                    // img

                    ImportField::make('image_contract_direct_work')
                    // ->required()
                    ->label(__('صوره العقد')),

                    ImportField::make('teacher_cotract_type')
                    // ->required()
                    ->label(__('teacher_cotract_type')),

                    ImportField::make('q_11')
                        // ->required()
                        ->label(__('q_11')),

                    ImportField::make('gain_money')
                        // ->required()
                        ->label(__('gain_money')),

                    ImportField::make('researcher_notes')
                    // ->required()
                    ->label(__('researcher_notes')),

                    ImportField::make('done')
                        // ->required()
                        ->label(__('done')),



                ])->mutateBeforeCreate(function ($row) {
                    // do something with the model

                    // ddd($row);
                    Survey::where('id', $row['id'])->first()->delete();
                    // dd($model);
                    return $row;
                }),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('all')
                ->badge(Survey::count()),

            'reviewed' => Tab::make('reviewed')
                ->badge(Survey::where('done', 1)->count())
                ->modifyQueryUsing(function ($query) {
                    return $query->where('done', 1);
                }),
            'not reviewed' => Tab::make('not reviewed')
                ->badge(Survey::where('done', 0)->count())

                ->modifyQueryUsing(function ($query) {
                    return $query->where('done', 0);
                }),

        ];
    }
}
