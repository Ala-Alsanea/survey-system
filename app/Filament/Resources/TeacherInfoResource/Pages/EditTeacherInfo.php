<?php

namespace App\Filament\Resources\TeacherInfoResource\Pages;

use App\Filament\Resources\TeacherInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeacherInfo extends EditRecord
{
    protected static string $resource = TeacherInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
