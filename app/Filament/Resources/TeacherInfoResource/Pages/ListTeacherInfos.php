<?php

namespace App\Filament\Resources\TeacherInfoResource\Pages;

use Filament\Actions;
use App\Filament\Widgets\StatsOverview;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TeacherInfoResource;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;

class ListTeacherInfos extends ListRecords
{
    protected static string $resource = TeacherInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         StatsOverview::class,
    //     ];
    // }
}
