<?php

namespace App\Filament\Resources\TeacherInfoResource\Pages;

use App\Filament\Resources\TeacherInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTeacherInfo extends ViewRecord
{
    protected static string $resource = TeacherInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
