<?php

namespace App\Filament\Resources\ResearcherResource\Pages;

use App\Filament\Resources\ResearcherResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResearcher extends EditRecord
{
    protected static string $resource = ResearcherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
