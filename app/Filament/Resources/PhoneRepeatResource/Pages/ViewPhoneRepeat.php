<?php

namespace App\Filament\Resources\PhoneRepeatResource\Pages;

use App\Filament\Resources\PhoneRepeatResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPhoneRepeat extends ViewRecord
{
    protected static string $resource = PhoneRepeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
