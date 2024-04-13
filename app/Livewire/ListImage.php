<?php

namespace App\Livewire;

use App\Models\Survey;
use App\Models\TeacherInfo;
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

    public $allLable = 'select all';
    public $selectedLabel = '';
    public $quary;

    public $districtSelected = '';
    public $govSelected = '';


    public $labels = [
        'School',
        'Qualification',
        'Contract',
        'Attendance sheets',
        'National ID',
    ];


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
        'sep_second_week_image_attend',
        'sep_third_week_image_attend',
        'sep_four_week_image_attend',
        'oct_second_week_image_attend',
        'oct_third_week_image_attend',
        'oct_Fourth_week_image_attend',
        'nov_second_week_image_attend',
        'nov_third_week_image_attend',
        'nov_fourth_week_image_attend',
        'dec_second_week_image_attend',
        'dec_third_week_image_attend',
        'dec_fourth_week_image_attend',
    ];

    public function mount()
    {
        $this->reset_select();
    }

    public function reset_select()
    {
        // $this->selectedLabel = $this->images_selected;
        // array_push($this->_selected, 'select all');
        // dd($this->selected);
    }

    public function getStorageName($name)
    {
        return asset('storage/' . $name);
    }

    #[Computed()]
    public function gov()
    {
        return array_values(TeacherInfo::pluck('gov')->unique()->all());
    }


    #[Computed()]
    public function district()
    {
        if ($this->govSelected != '') {
            return array_values(TeacherInfo::where('gov', $this->govSelected)
                ->pluck('district',)
                ->unique()
                ->all());
        }

        return [];
    }


    #[Computed()]
    public function images()
    {
        if ($this->selectedLabel == $this->allLable) {
            $this->reset_select();
        }


        if (is_array($this->selectedLabel) && ($key = array_search($this->allLable, $this->selectedLabel)) !== false) {
            unset($this->selectedLabel[$key]);
        }


        $imageType = match ($this->selectedLabel) {
            'School' => ['school_image'],
            'Qualification' => ['eduqual_image'],
            'Contract' => ['image_contract_direct_work'],
            'National ID' => [
                'image_national_card_front',
                'image_national_card_back'
            ],
            'Attendance sheets' => [
                'image_attend',
                'oct_image_attend',
                'nov_image_attend',
                'dec_image_attend',
                'sep_second_week_image_attend',
                'sep_third_week_image_attend',
                'sep_four_week_image_attend',
                'oct_second_week_image_attend',
                'oct_third_week_image_attend',
                'oct_Fourth_week_image_attend',
                'nov_second_week_image_attend',
                'nov_third_week_image_attend',
                'nov_fourth_week_image_attend',
                'dec_second_week_image_attend',
                'dec_third_week_image_attend',
                'dec_fourth_week_image_attend',
            ],
            default => $this->images_selected
        };

        // img type is selected
        if ($this->govSelected != '') {
            if ($this->districtSelected != '') {
                $images = Survey::select($imageType)
                    ->where('is_deleted', 1)
                    ->where('gov', $this->govSelected)
                    ->where('district', $this->districtSelected)
                    ->paginate(20);
            } else {
                $images = Survey::select($imageType)
                    ->where('is_deleted', 1)
                    ->where('gov', $this->govSelected)
                    ->paginate(20);
            }
        } else {

            $images = Survey::select($imageType)
                ->where('is_deleted', 1)
                ->paginate(10);
        }
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
