<?php

namespace App\Livewire;

use App\Models\Survey;
use Livewire\Component;
use Filament\Tables\Table;
use Livewire\WithPagination;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Attributes\Computed;

class ListImage extends Component
// class ListImage extends Component implements HasForms, HasTable
{

    // use InteractsWithTable;
    // use InteractsWithForms;
    use WithPagination;

    public $images_selected = [
        'image_national_card_front',
        'image_national_card_back',
        'image_attend',
        'image_contract_direct_work',
        'oct_image_attend',
        'nov_image_attend',
        'dec_image_attend',
        'school_image',
        'eduqual_image',
    ];

    public $selected;
    public $quary;

    public function mount()
    {
        $this->selected = $this->images_selected;
        // $this->quary = Survey::select(
        //     'id',
        //     'name',
        // )->select(
        //     $this->selected
        // )->paginate(5);
    }

    // public function updated()
    // {
    //     // $this->quary = Survey::select(
    //     //     'id',
    //     //     'name',
    //     // )->select(
    //     //     $this->selected
    //     // )->paginate(5);
    //     $this->selected = $this->images_selected;
    // }


    public function getStorageName($name)
    {
        return asset('storage/' . $name);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Survey::query())
            ->columns([

                Split::make([

                    TextColumn::make('name')
                        ->label(__('name'))
                        ->toggleable(isToggledHiddenByDefault: false)
                        ->searchable(),

                    TextColumn::make('national_card_id')
                        ->label(__('national_card_id'))
                        ->toggleable(isToggledHiddenByDefault: false)
                        // ->searchable()
                        ->sortable(),

                    // old
                    ImageColumn::make('image_national_card_front')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),
                    ImageColumn::make('image_national_card_back')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),
                    ImageColumn::make('image_attend')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),
                    ImageColumn::make('image_contract_direct_work')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),

                    // new
                    ImageColumn::make('oct_image_attend')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),

                    ImageColumn::make('nov_image_attend')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),

                    ImageColumn::make('dec_image_attend')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),

                    ImageColumn::make('school_image')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),

                    ImageColumn::make('eduqual_image')
                        // ->size(200)
                        ->extraImgAttributes(['loading' => 'lazy'])
                        ->toggleable(isToggledHiddenByDefault: true),

                ]),

            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
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

    #[Computed()]
    public function images()
    {
        return Survey::select(
            'id',
            'name',
        )->select(
            $this->selected
        )->paginate(2);
    }

    public function render()
    {


        return view(
            'livewire.list-image',
            // [
            //     'images' => Survey::select(
            //         'id',
            //         'name',
            //     )->select(
            //         $this->selected
            //     )->paginate(5),
            // ]
        );
    }

    public function search()
    {
        $this->resetPage();
    }
}
