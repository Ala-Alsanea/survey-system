<?php

namespace App\Livewire;

use App\Models\Survey;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListImage extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(Survey::query())
            ->columns([
                ImageColumn::make('image_national_card_front')
                    ->size(200)
                     ->extraImgAttributes(['loading' => 'lazy']),
                ImageColumn::make('image_national_card_back')
                    ->size(200)
                     ->extraImgAttributes(['loading' => 'lazy']),
                ImageColumn::make('image_attend')
                    ->size(200)
                     ->extraImgAttributes(['loading' => 'lazy']),
                ImageColumn::make('image_contract_direct_work')
                    ->size(200)
                     ->extraImgAttributes(['loading' => 'lazy']),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.list-image');
    }
}
