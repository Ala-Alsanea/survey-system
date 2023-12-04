<?php

namespace App\Filament\Resources\ResearcherResource\Pages;

use App\Filament\Resources\ResearcherResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResearchers extends ListRecords
{
    protected static string $resource = ResearcherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
