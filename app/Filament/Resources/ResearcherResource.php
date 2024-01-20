<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Researcher;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ResearcherResource\Pages;
use App\Filament\Resources\ResearcherResource\RelationManagers;

class ResearcherResource extends Resource
{
    protected static ?string $model = Researcher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->step(9)
                    ->required()
                    ->unique(ignorable: fn ($record) => $record)
                    ->maxLength(9),
                // Forms\Components\TextInput::make('gender')
                //     ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    // ->disabled()
                    ->maxLength(255),
                Forms\Components\Toggle::make('valid')
                    ->onColor('success')
                    ->offColor('danger'),
                // Forms\Components\TextInput::make('device_id')
                // ->disabled()
                //     ->maxLength(255),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surveys_count')
                    ->counts('surveys'),
                Tables\Columns\ToggleColumn::make('valid')
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListResearchers::route('/'),
            // 'create' => Pages\CreateResearcher::route('/create'),
            // 'view' => Pages\ViewResearcher::route('/{record}'),
            // 'edit' => Pages\EditResearcher::route('/{record}/edit'),
        ];
    }


    // public static function canCreate(): bool
    // {
    //     return false;
    // }

    // public static function canDelete(Model $model): bool
    // {
    //     return false;
    // }
}
