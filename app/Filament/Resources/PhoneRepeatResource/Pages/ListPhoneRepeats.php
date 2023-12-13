<?php

namespace App\Filament\Resources\PhoneRepeatResource\Pages;

use App\Filament\Resources\PhoneRepeatResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPhoneRepeats extends ListRecords
{
    protected static string $resource = PhoneRepeatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
