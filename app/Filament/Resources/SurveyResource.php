<?php

namespace App\Filament\Resources;

use App\Models\Gov;
use Filament\Forms;
use Filament\Tables;
use App\Models\Survey;
use App\Models\District;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Subdistrict;
use App\Models\TeacherInfo;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use pxlrbt\FilamentExcel\Columns\Column;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Enums\ActionsPosition;
use Illuminate\Database\Eloquent\Collection;
use EightyNine\ExcelImport\ExcelImportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use App\Filament\Resources\SurveyResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\SurveyResource\RelationManagers;



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

                        // new
                        Forms\Components\MarkdownEditor::make('village_name')
                            ->label(__('village_name'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('school_name_as_on_user_contract_work')
                            ->label(__('school_name_as_on_user_contract_work'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('school_name_on_vistiting_and_contract_identical')
                            ->label(__('school_name_on_vistiting_and_contract_identical'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('check_school_location')
                            ->label(__('check_school_location'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('teacher_name_as_on_real_life')
                            ->label(__('teacher_name_as_on_real_life'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('exact_teacher_job_type')
                            ->label(__('exact_teacher_job_type'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('teacher_job_type')
                            ->label(__('teacher_job_type'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('teacher_signature_comparison')
                            ->label(__('teacher_signature_comparison'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('teacher_cotract_type')
                            ->label(__('teacher_cotract_type'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('contract_date')
                            ->label(__('contract_date'))
                            ->disabled(),


                    ])
                    ->columns(1),


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


                Tables\Columns\TextColumn::make('id')
                    ->label(__('id'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label(__('phone'))
                    ->toggleable(isToggledHiddenByDefault: false)

                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('gender'))
                    ->toggleable(isToggledHiddenByDefault: false)

                    ->searchable(),
                Tables\Columns\TextColumn::make('gov')
                    ->toggleable(isToggledHiddenByDefault: false)

                    ->label(__('gov'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('district')
                    ->label(__('district'))
                    ->toggleable(isToggledHiddenByDefault: true)

                    ->searchable(),
                Tables\Columns\TextColumn::make('subdistrict')
                    ->label(__('subdistrict'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),

                Tables\Columns\TextColumn::make('researcher.name')
                    ->label(__('researcher_name'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('national_card_id')
                    ->label(__('national_card_id'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    // ->searchable()
                    ->sortable(),


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
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
                // Filter::make('is_deleted')
                //     ->label('is_deleted')
                //     ->query(fn (Builder $query): Builder => $query->where('is_deleted', true))
            ])->headerActions([
                // ...

            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Action::make('Hide')
                    ->color('danger')
                    ->action(
                        function (Survey $record) {
                            $record->is_deleted = 0;
                            $record->save();
                            return $record;
                        }
                    )
                    ->requiresConfirmation()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Survey deleted')
                            ->body('The Survey has been deleted successfully.'),
                    ),
                Tables\Actions\RestoreAction::make(),
                Tables\Actions\EditAction::make(),
            ], position: ActionsPosition::BeforeColumns)
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                Tables\Actions\BulkAction::make('Hide')
                    ->color('danger')
                    ->action(
                        function (Collection $records) {
                            $records->each(
                                function ($record, $key) {
                                    $record->update(['is_deleted' => 0]);
                                }
                            );
                            // dd($records);
                            // $records->each->save();
                            return $records;
                        }
                    )
                    ->requiresConfirmation()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('Survey deleted')
                            ->body('The Survey has been deleted successfully.'),
                    ),
                // ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_deleted', true));
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

    // public static function canDelete(Model $model): bool
    // {
    //     return false;
    // }

    public static function getStorageName($name)
    {
        return asset('storage/' . $name);
    }
}
