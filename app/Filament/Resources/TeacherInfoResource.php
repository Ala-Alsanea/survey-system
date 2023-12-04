<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherInfoResource\Pages;
use App\Filament\Resources\TeacherInfoResource\RelationManagers;
use App\Models\TeacherInfo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherInfoResource extends Resource
{
    protected static ?string $model = TeacherInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'المستفيدين';

    public static function getNavigationLabel(): string
    {
        return TeacherInfoResource::$label;
    }

    public static function getPluralLabel(): string
    {
        return TeacherInfoResource::$label;
    }

    public static function getModelLabel(): string
    {
        return 'المستفيد';
    }


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
                            ->disabled(),
                    ])
                    ->columns(2),
                Forms\Components\Section::make('معلومات المستفيد')
                    ->description('')
                    ->schema([

                        Forms\Components\TextInput::make('name')
                            ->label(__('name'))
                            ->disabled(),
                        Forms\Components\TextInput::make('phone')
                            ->label(__('phone'))
                            ->disabled(),
                        Forms\Components\TextInput::make('gender')
                            ->label(__('gender'))
                            ->disabled(),
                        Forms\Components\TextInput::make('city')
                            ->label(__('city'))
                            ->disabled(),
                    ])
                    ->columns(2),


                Forms\Components\Section::make('هوية المستفيد')
                    ->description('')
                    ->schema([


                        Forms\Components\TextInput::make('edu_qual')
                            ->label(__('edu_qual'))
                            ->disabled(),
                        Forms\Components\TextInput::make('national_card_id')
                            ->label(__('national_card_id'))
                            ->disabled(),

                        Forms\Components\TextInput::make('q_3')
                            ->label(__('q_3'))
                            ->disabled(),

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

                        Forms\Components\TextInput::make('q_1')
                            ->label(__('q_1'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_2')
                            ->label(__('q_2'))
                            ->disabled(),

                        Forms\Components\TextInput::make('q_4')
                            ->label(__('q_4'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_5')
                            ->label(__('q_5'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_6')
                            ->label(__('q_6'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_7')
                            ->label(__('q_7'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_8')
                            ->label(__('q_8'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_9')
                            ->label(__('q_9'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_10')
                            ->label(__('q_10'))
                            ->disabled(),
                        Forms\Components\TextInput::make('q_11')
                            ->label(__('q_11'))
                            ->disabled(),
                    ])
                    ->columns(1),


                Forms\Components\Section::make('التحقق')
                    ->description('حدد نوع البيانات المتواجدة في العقد او الارساليه مباشرة العمل')
                    ->schema([

                        Forms\Components\Select::make('val_name')
                            ->label(__('val_name'))
                            ->options([
                                __('yes') => __('yes'),
                                __('no') => __('no'),
                            ])
                            ->required(),
                        Forms\Components\Select::make('val_job_type')
                            ->label(__('val_job_type'))
                            ->options([
                                __('yes') => __('yes'),
                                __('no') => __('no'),
                            ])
                            ->required(),
                        Forms\Components\Select::make('val_school')
                            ->label(__('val_school'))
                            ->options([
                                __('yes') => __('yes'),
                                __('no') => __('no'),
                            ])
                            ->required(),
                        Forms\Components\Select::make('val_location')
                            ->label(__('val_location'))
                            ->options([
                                __('yes') => __('yes'),
                                __('no') => __('no'),
                            ])
                            ->required(),
                        Forms\Components\Select::make('val_hire_date')
                            ->label(__('val_hire_date'))
                            ->options([
                                __('yes') => __('yes'),
                                __('no') => __('no'),
                            ])
                            ->required(),
                        Forms\Components\Select::make('val_signature')
                            ->label(__('val_signature'))
                            ->options([
                                __('yes') => __('yes'),
                                __('no') => __('no'),
                            ])
                            ->required(),
                        Forms\Components\Select::make('val_Seal')
                            ->label(__('val_Seal'))
                            ->options([
                                __('yes') => __('yes'),
                                __('no') => __('no'),
                            ])
                            ->required(),
                    ])
                    ->columns(2),

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
                Tables\Columns\TextColumn::make('name')
                    ->label(__('name'))
                    ->searchable(),
                // Tables\Columns\TextColumn::make('national_card_id')
                //     ->label(__('national_card_id'))
                //     ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label(__('gender'))
                    ->searchable(),
                // Tables\Columns\TextColumn::make('city')
                //     ->label(__('city'))
                //     ->searchable(),
                Tables\Columns\TextColumn::make('researcher.name')
                    ->label(__('researcher_name'))
                    ->searchable(),
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
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
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
            'index' => Pages\ListTeacherInfos::route('/'),
            'create' => Pages\CreateTeacherInfo::route('/create'),
            // 'view' => Pages\ViewTeacherInfo::route('/{record}'),
            // 'edit' => Pages\EditTeacherInfo::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
