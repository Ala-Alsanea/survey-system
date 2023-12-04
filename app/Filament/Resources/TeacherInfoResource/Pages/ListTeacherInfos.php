<?php

namespace App\Filament\Resources\TeacherInfoResource\Pages;

use App\Filament\Resources\TeacherInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeacherInfos extends ListRecords
{
    protected static string $resource = TeacherInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
