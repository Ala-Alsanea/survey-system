<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ActivityResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ActivityResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return __('survey logs');
    }

    public static function getPluralLabel(): string
    {
        return __('survey logs');
    }

    public static function getModelLabel(): string
    {
        return __('survey logs');
    }

    public static function getNavigationGroup(): string
    {
        return __('system tools');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id'),
                TextColumn::make('log_name'),
                TextColumn::make('description'),
                TextColumn::make('event')
                    ->getStateUsing(fn ($record) => $record->event?? "null"),                TextColumn::make('causer_type'),
                TextColumn::make('causer_id'),
                TextColumn::make('created_at'),
                TextColumn::make('updated_at'),

                //
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
            'index' => Pages\ListActivities::route('/'),
            // 'create' => Pages\CreateActivity::route('/create'),
            // 'view' => Pages\ViewActivity::route('/{record}'),
            // 'edit' => Pages\EditActivity::route('/{record}/edit'),
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

    public static function canEdit(Model $model): bool
    {
        return false;
    }
}
