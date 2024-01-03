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

    public $_selected;
    public $quary;

    public function mount()
    {
        $this->reset_select();

    }

    public function reset_select()
    {
        $this->_selected = $this->images_selected;
        // array_push($this->_selected, 'select all');


        // dd($this->selected);

    }


    public function getStorageName($name)
    {
        return asset('storage/' . $name);
    }


    #[Computed()]
    public function images()
    {
        if($this->_selected == 'select all')
        {
            $this->reset_select();
        }


        $images = Survey::select(
            'id',
            'name',
        )->select(
            $this->_selected
        )->paginate(2);


        // array_push($this->_selected, 'select all');

        return $images;
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

//     public function search()
//     {
//         $this->resetPage();
//     }
}
