<?php

namespace App\Filament\Resources\SurveyResource\Pages;

use App\Filament\Resources\SurveyResource;
use App\Models\Survey;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListSurveys extends ListRecords
{
    protected static string $resource = SurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'reviewed' => Tab::make('reviewed')
            ->badge(Survey::where('done',1)->count())
            ->modifyQueryUsing(function ($query){
               return $query->where('done',1);
            }),
            'not reviewed' => Tab::make('not reviewed')
                ->badge(Survey::where('done', 0)->count())

            ->modifyQueryUsing(function ($query) {
                return $query->where('done', 0);
            })
                ,
            'all' => Tab::make('all')
            ->badge(Survey::count()),
        ];
    }
}
