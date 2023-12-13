<?php

namespace App\Filament\Resources\PhoneRepeatResource\Pages;

use App\Filament\Resources\PhoneRepeatResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPhoneRepeat extends EditRecord
{
    protected static string $resource = PhoneRepeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
