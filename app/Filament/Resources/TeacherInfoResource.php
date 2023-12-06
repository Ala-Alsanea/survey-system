<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TeacherInfo;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use pxlrbt\FilamentExcel\Columns\Column;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeacherInfoResource\Pages;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use App\Filament\Resources\TeacherInfoResource\RelationManagers;

class TeacherInfoResource extends Resource
{
    protected static ?string $model = TeacherInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Teacher info';

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
        return 'Teacher info';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([



                Forms\Components\Section::make('معلومات المستفيد')
                    ->description('')
                    ->schema([

                        Forms\Components\MarkdownEditor::make('name')
                            ->label(__('name'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('phone')
                            ->label(__('phone'))
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
                    ])
                    ->columns(2),


                Forms\Components\Section::make('هوية المستفيد')
                    ->description('')
                    ->schema([

                        Forms\Components\MarkdownEditor::make('national_card_id')
                            ->label(__('national_card_id'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('national_card_type')
                            ->label(__('national_card_type'))
                            ->disabled(),

                    ])
                    ->columns(1),

                Forms\Components\Section::make('المؤهل')
                    ->description('')
                    ->schema([

                        Forms\Components\MarkdownEditor::make('edu_qual')
                            ->label(__('edu_qual'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('school')
                            ->label(__('school'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('major')
                            ->label(__('major'))
                            ->disabled(),



                    ])
                    ->columns(1),


                Forms\Components\Section::make('التحقق من التكرار')
                    ->description('')
                    ->schema([
                        Forms\Components\MarkdownEditor::make('changed_phone')
                            // ->label(__('major'))
                            ->disabled(),
                        Forms\Components\MarkdownEditor::make('changed_national_card_id')
                            // ->label(__('major'))
                            ->disabled(),

                    ])
                    ->columns(2),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Ar_Name')
                    ->label(__('name'))
                    ->searchable(),
                // Tables\Columns\TextColumn::make('national_card_id')
                //     ->label(__('national_card_id'))
                //     ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('phone'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('gov')
                    ->label(__('gov'))
                    ->disabled(),
                Tables\Columns\TextColumn::make('district')
                    ->label(__('district'))
                    ->disabled(),
                Tables\Columns\TextColumn::make('subdistrict')
                    ->label(__('subdistrict'))
                    ->disabled(),
                Tables\Columns\TextColumn::make('school')
                    ->label(__('school'))
                    ->searchable(),



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
            ->headerActions([
                // ...
                ExportAction::make()->exports([
                    ExcelExport::make()->withColumns([
                        Column::make('name')->heading(__('name')),
                        Column::make('city'),
                        Column::make('created_at'),
                        Column::make('deleted_at'),
                    ]),
                ])

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

    public static function canDelete(Model $model): bool
    {
        return false;
    }
}
