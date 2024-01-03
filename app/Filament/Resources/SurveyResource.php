<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Survey;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use pxlrbt\FilamentExcel\Columns\Column;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Resources\SurveyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\SurveyResource\RelationManagers;
use App\Models\TeacherInfo;

class SurveyResource extends Resource
{
    protected static ?string $model = Survey::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('معلومات الباحث')
                    ->description('')
                    ->schema([
                        Forms\Components\Select::make('researcher.name')
                            ->label(__('researcher_name'))
                            ->relationship('researcher', 'name')
                            ->columnSpanFull()
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('lat')
                            ->label(__('lat'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('long')
                            ->label(__('long'))
                            ->disabled(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('معلومات المستفيد')
                    ->description('')
                    ->schema([

                        Forms\Components\MarkdownEditor::make('name')
                            ->label(__('name'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('phone')
                            ->label(__('phone'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('gender')
                            ->label(__('gender'))
                            ->disabled(),
                        Forms\Components\TextInput::make('gov')
                            ->label(__('gov'))
                            ->disabled(),
                        Forms\Components\TextInput::make('district')
                            ->label(__('district'))
                            ->disabled(),
                        Forms\Components\TextInput::make('subdistrict')
                            ->label(__('subdistrict'))
                            ->disabled(),
                        Forms\Components\TextInput::make('school')
                            ->label(__('school'))
                            ->disabled(),
                        Forms\Components\FileUpload::make('school_image')
                            ->label(__('school_image'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),
                    ])
                    ->columns(2),


                Forms\Components\Section::make('هوية المستفيد')
                    ->description('')
                    ->schema([


                        Forms\Components\MarkdownEditor::make('edu_qual')
                            ->label(__('edu_qual'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('national_card_id')
                            ->label(__('national_card_id'))
                            ->disabled(),


                        Forms\Components\FileUpload::make('eduqual_image')
                            ->label(__('eduqual_image'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),
                        Forms\Components\FileUpload::make('image_national_card_front')
                            ->label(__('image_national_card_front'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),
                        Forms\Components\FileUpload::make('image_national_card_back')
                            ->label(__('image_national_card_back'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),

                    ])
                    ->columns(1),

                Forms\Components\Section::make('ملحقات')
                    ->description('')
                    ->schema([

                        Forms\Components\FileUpload::make('image_attend')
                            ->label(__('image_attend'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),

                        Forms\Components\FileUpload::make('oct_image_attend')
                            ->label(__('oct_image_attend'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),
                        Forms\Components\FileUpload::make('nov_image_attend')
                            ->label(__('nov_image_attend'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),
                        Forms\Components\FileUpload::make('dec_image_attend')
                            ->label(__('dec_image_attend'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),


                        Forms\Components\FileUpload::make('image_contract_direct_work')
                            ->label(__('image_contract_direct_work'))
                            ->openable()
                            ->deletable(false)
                            ->disabled()
                            ->image(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('الاسئله')
                    ->description('')
                    ->schema([

                        Forms\Components\MarkdownEditor::make('q_1')
                            ->label(__('q_1'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('note')
                            ->label(__('note'))
                            ->disabled(),
                        // Forms\Components\MarkdownEditor::make('q_2')
                        // ->label(__('q_2'))
                        // ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_3')
                            ->label(__('q_3'))
                            ->disabled(),

                        Forms\Components\MarkdownEditor::make('q_4')
                            ->label(__('q_4'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_5')
                            ->label(__('q_5'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_6')
                            ->label(__('q_6'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_7')
                            ->label(__('q_7'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_8')
                            ->label(__('q_8'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_9')
                            ->label(__('q_9'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_10')
                            ->label(__('q_10'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('q_11')
                            ->label(__('q_11'))
                            ->disabled(),


                        Forms\Components\MarkdownEditor::make('teaching_days_num_oct')
                            ->label(__('teaching_days_num_oct'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('teaching_days_num_nov')
                            ->label(__('teaching_days_num_nov'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('teaching_days_num_dec')
                            ->label(__('teaching_days_num_dec'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('teacher_birth_date')
                            ->label(__('teacher_birth_date'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('oct_teacher_sinature')
                            ->label(__('oct_teacher_sinature'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('nov_teacher_sinature')
                            ->label(__('nov_teacher_sinature'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('dec_teacher_sinature')
                            ->label(__('dec_teacher_sinature'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('school_status')
                            ->label(__('school_status'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('Low_eduqual')
                            ->label(__('Low_eduqual'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('gain_money')
                            ->label(__('gain_money'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_teacher_name')
                            ->label(__('checked_teacher_name'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_job_type')
                            ->label(__('checked_job_type'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_school_name')
                            ->label(__('checked_school_name'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_location')
                            ->label(__('checked_location'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_hiring_date')
                            ->label(__('checked_hiring_date'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_management_signature')
                            ->label(__('checked_management_signature'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_teacher_signature')
                            ->label(__('checked_teacher_signature'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('checked_stamp')
                            ->label(__('checked_stamp'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('researcher_notes')
                            ->label(__('researcher_notes'))
                            ->disabled(),



                    ])
                    ->columns(1),


                // Forms\Components\Section::make('التحقق')
                //     ->description('حدد نوع البيانات المتواجدة في العقد او الارساليه مباشرة العمل')
                //     ->schema([

                //         Forms\Components\Select::make('val_name')
                //             ->label(__('val_name'))
                //             ->options([
                //                 __('yes') => __('yes'),
                //                 __('no') => __('no'),
                //             ])
                //             ->required(),
                //         Forms\Components\Select::make('val_job_type')
                //             ->label(__('val_job_type'))
                //             ->options([
                //                 __('yes') => __('yes'),
                //                 __('no') => __('no'),
                //             ])
                //             ->required(),
                //         Forms\Components\Select::make('val_school')
                //             ->label(__('val_school'))
                //             ->options([
                //                 __('yes') => __('yes'),
                //                 __('no') => __('no'),
                //             ])
                //             ->required(),
                //         Forms\Components\Select::make('val_location')
                //             ->label(__('val_location'))
                //             ->options([
                //                 __('yes') => __('yes'),
                //                 __('no') => __('no'),
                //             ])
                //             ->required(),
                //         Forms\Components\Select::make('val_hire_date')
                //             ->label(__('val_hire_date'))
                //             ->options([
                //                 __('yes') => __('yes'),
                //                 __('no') => __('no'),
                //             ])
                //             ->required(),
                //         Forms\Components\Select::make('val_signature')
                //             ->label(__('val_signature'))
                //             ->options([
                //                 __('yes') => __('yes'),
                //                 __('no') => __('no'),
                //             ])
                //             ->required(),
                //         Forms\Components\Select::make('val_Seal')
                //             ->label(__('val_Seal'))
                //             ->options([
                //                 __('yes') => __('yes'),
                //                 __('no') => __('no'),
                //             ])
                //             ->columnSpanFull()
                //             ->required(),
                //     ])
                //     ->columns(2),


                Forms\Components\Section::make('المراجعه')
                    ->description('')
                    ->schema([

                        Forms\Components\Toggle::make('done')
                            ->label(__('done'))
                            ->in([true]),
                    ])
                    ->columns(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //

                Tables\Columns\TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('gender'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('gov')
                    ->label(__('gov'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('district')
                    ->label(__('district'))
                    ->searchable(),


                Tables\Columns\TextColumn::make('subdistrict')
                    ->label(__('subdistrict'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('researcher.name')
                    ->label(__('researcher_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('national_card_id')
                    ->label(__('national_card_id'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    // ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('edu_qual')
                //     ->searchable(),
                // Tables\Columns\ImageColumn::make('image_national_card_front'),
                // Tables\Columns\ImageColumn::make('image_national_card_back'),
                // Tables\Columns\ImageColumn::make('image_attend'),
                // Tables\Columns\ImageColumn::make('image_contract_direct_work'),
                // Tables\Columns\TextColumn::make('q_1')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_2')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_3')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_4')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_5')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_6')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_7')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_8')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_9')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_10')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('q_11')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('val_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('val_job_type')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('val_school')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('val_location')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('val_hire_date')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('val_signature')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('val_Seal')
                //     ->searchable(),

                Tables\Columns\IconColumn::make('done')
                    ->label(__('done'))
                    ->icon(fn (string $state): string => match ($state) {
                        '1' => 'heroicon-o-check-circle',
                        '0' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        '1' => 'success',
                        '0' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])->headerActions([
                // ...
                ExportAction::make('all')->exports([
                    ExcelExport::make()
                        ->withFilename('all')
                        // ->fromForm()
                        ->withColumns([
                            Column::make('gov')->heading('المحافظة'),
                            Column::make('district')->heading('المديرية'),
                            Column::make('subdistrict')->heading('الغزلة'),
                            Column::make('school')->heading('المدرسة'),
                            Column::make('researcher.name')->heading('الأسم الباحث'),

                            Column::make('long')->heading('long'),
                            Column::make('lat')->heading('lat'),

                            Column::make('school_status')->heading('school_status'),
                            Column::make('name')->heading('اسم المستفيد'),
                            Column::make('q_1')->heading(__('q_1')),
                            Column::make('note')->heading(__('note')),
                            Column::make('gender')->heading(__('gender')),
                            Column::make('phone')->heading(__('phone')),
                            Column::make('q_3')->heading(__('q_3')),
                            Column::make('national_card_id')->heading(__('national_card_id')),
                            Column::make('q_4')->heading(__('q_4')),
                            Column::make('teacher_birth_date')->heading(__('teacher_birth_date')),
                            Column::make('edu_qual')->heading(__('edu_qual')),
                            Column::make('Low_eduqual')->heading(__('Low_eduqual')),
                            Column::make('q_5')->heading(__('q_5')),
                            Column::make('q_6')->heading(__('q_6')),

                            Column::make('q_7')->heading(__('q_7')),
                            Column::make('teaching_days_num_oct')->heading(__('teaching_days_num_oct')),
                            Column::make('teaching_days_num_nov ')->heading(__('teaching_days_num_nov    ')),
                            Column::make('teaching_days_num_dec')->heading(__('teaching_days_num_dec')),


                            Column::make('q_8')->heading(__('q_8')),
                            Column::make('oct_teacher_sinature')->heading(__('oct_teacher_sinature')),
                            Column::make('nov_teacher_sinature')->heading(__('nov_teacher_sinature')),
                            Column::make('dec_teacher_sinature')->heading(__('dec_teacher_sinature')),


                            Column::make('q_9')->heading(__('q_9')),


                            Column::make('q_10')->heading(__('q_10')),
                            // Column::make('q_11')->heading(__('q_11')),

                            // Column::make('gain_money')->heading(__('gain_money')),
                            // Column::make('checked_teacher_name')->heading(__('checked_teacher_name')),
                            // Column::make('checked_job_type')->heading(__('checked_job_type')),
                            // Column::make('checked_school_name')->heading(__('checked_school_name')),
                            // Column::make('checked_location')->heading(__('checked_location')),
                            // Column::make('checked_hiring_date')->heading(__('checked_hiring_date')),
                            // Column::make('checked_management_signature')->heading(__('checked_management_signature')),
                            // Column::make('checked_teacher_signature')->heading(__('checked_teacher_signature')),
                            // Column::make('checked_stamp')->heading(__('checked_stamp')),
                            // Column::make('researcher_notes')->heading(__('researcher_notes')),

                            // Column::make('long')->heading(__('long')),
                            // Column::make('lat')->heading(__('lat')),

                            // Column::make('val_name')->heading(__('val_name')),
                            // Column::make('val_job_type')->heading(__('val_job_type')),
                            // Column::make('val_school')->heading(__('val_school')),
                            // Column::make('val_location')->heading(__('val_location')),
                            // Column::make('val_hire_date')->heading(__('val_hire_date')),
                            // Column::make('val_signature')->heading(__('val_signature')),
                            // Column::make('val_Seal')->heading(__('val_Seal')),





                            // Column::make('researcher.name')->heading(__('researcher_name')),

                            // Column::make('school')
                            //     ->formatStateUsing(fn ($record) => TeacherInfo::where('school', 'LIKE', '%' . $record . '%')->first()->name_manager_school)
                            //     ->heading(__('maneger_name')),

                            Column::make('school')
                                ->tableColumn(Tables\Columns\TextColumn::make('school'))
                                // ->formatStateUsing(fn ($record) => TeacherInfo::where('school', $record)->first()->phone_manager_school ?? "null")
                                ->heading(__('maneger_phone')),



                        ])
                        ->except([
                            // 'created_at',
                            // 'updated_at',
                            'oct_image_attend',
                            'nov_image_attend',
                            'dec_image_attend',
                            'image_contract_direct_work',
                            'image_attend',
                            'image_national_card_front',
                            'image_national_card_back',
                            'school_image',
                            'eduqual_image',
                            // '',
                        ])
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),

                ])
                    ->label('Export All'),

                ExportAction::make('un')->exports([
                    ExcelExport::make()
                        ->withFilename('survay')
                        ->withColumns([
                            Column::make('name')->heading('Teacher_info-PQ[الأسم الرباعي]'),
                            Column::make('phone')->heading('Teacher_info-PQ[رقم التلفون]'),
                            Column::make('gender')->heading(__('gender')),
                            Column::make('gov')->heading('Teacher_info-PQ[المحافظة]'),
                            Column::make('district')->heading('Teacher_info-PQ[المديرية]'),
                            Column::make('subdistrict')->heading('Teacher_info-PQ[الغزلة]'),
                            Column::make('school')->heading('Teacher_info-PQ[المدرسة]'),
                            Column::make('edu_qual')->heading('Teacher_info-PQ[المؤهل]'),
                            Column::make('national_card_id')->heading('Teacher_info-PQ[رقم البطاقة]'),

                            // Column::make('image_national_card_front')->heading(__('image_national_card_front')),
                            // Column::make('image_national_card_back')->heading(__('image_national_card_back')),
                            // Column::make('image_attend')->heading(__('image_attend')),
                            // Column::make('image_contract_direct_work')->heading(__('image_contract_direct_work')),

                            // Column::make('q_1')->heading(__('q_1')),
                            Column::make('q_3')->heading('Teacher_info-PQ[نوع الهوية]'),
                            // Column::make('q_4')->heading(__('q_4')),
                            // Column::make('q_5')->heading(__('q_5')),
                            // Column::make('q_6')->heading(__('q_6')),
                            // Column::make('q_7')->heading(__('q_7')),
                            // Column::make('q_8')->heading(__('q_8')),
                            // Column::make('q_9')->heading(__('q_9')),
                            // Column::make('q_10')->heading(__('q_10')),
                            // Column::make('q_11')->heading(__('q_11')),

                            // Column::make('note')->heading(__('note')),
                            // Column::make('teaching_days_num_oct')->heading(__('teaching_days_num_oct')),
                            // Column::make('teaching_days_num_nov')->heading(__('teaching_days_num_nov')),
                            // Column::make('teaching_days_num_dec')->heading(__('teaching_days_num_dec')),
                            // Column::make('teacher_birth_date')->heading(__('teacher_birth_date')),
                            // Column::make('oct_teacher_sinature')->heading(__('oct_teacher_sinature')),
                            // Column::make('nov_teacher_sinature')->heading(__('nov_teacher_sinature')),
                            // Column::make('dec_teacher_sinature')->heading(__('dec_teacher_sinature')),
                            // Column::make('school_status')->heading(__('school_status')),
                            // Column::make('Low_eduqual')->heading(__('Low_eduqual')),
                            // Column::make('gain_money')->heading(__('gain_money')),
                            // Column::make('checked_teacher_name')->heading(__('checked_teacher_name')),
                            // Column::make('checked_job_type')->heading(__('checked_job_type')),
                            // Column::make('checked_school_name')->heading(__('checked_school_name')),
                            // Column::make('checked_location')->heading(__('checked_location')),
                            // Column::make('checked_hiring_date')->heading(__('checked_hiring_date')),
                            // Column::make('checked_management_signature')->heading(__('checked_management_signature')),
                            // Column::make('checked_teacher_signature')->heading(__('checked_teacher_signature')),
                            // Column::make('checked_stamp')->heading(__('checked_stamp')),
                            // Column::make('researcher_notes')->heading(__('researcher_notes')),

                            // Column::make('long')->heading(__('long')),
                            // Column::make('lat')->heading(__('lat')),

                            // Column::make('val_name')->heading(__('val_name')),
                            // Column::make('val_job_type')->heading(__('val_job_type')),
                            // Column::make('val_school')->heading(__('val_school')),
                            // Column::make('val_location')->heading(__('val_location')),
                            // Column::make('val_hire_date')->heading(__('val_hire_date')),
                            // Column::make('val_signature')->heading(__('val_signature')),
                            // Column::make('val_Seal')->heading(__('val_Seal')),





                            // Column::make('researcher.name')->heading(__('researcher_name')),



                        ])
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                    // ->askForFilename()
                    // ->withFilename(fn ($filename) => 'prefix-' . $filename)

                ])
                    ->label('Export UN'),






            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([

                // ExportBulkAction::make()->exports([ExcelExport::make('form')
                //     ->withFilename('all')
                //     ->fromForm()
                //     ->except([
                //         'created_at',
                //         'updated_at',
                //         'oct_image_attend',
                //         'nov_image_attend',
                //         'dec_image_attend',
                //         'image_contract_direct_work',
                //         'image_attend',
                //         'image_national_card_front',
                //         'image_national_card_back',
                //         'school_image',
                //         'eduqual_image',
                //         // '',
                //     ])
                //     ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                // ]),
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSurveys::route('/'),
            'create' => Pages\CreateSurvey::route('/create'),
            // 'view' => Pages\ViewSurvey::route('/{record}'),
            // 'edit' => Pages\EditSurvey::route('/{record}/edit'),
        ];
    }


    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $model): bool
    {
        return false;
    }
}
