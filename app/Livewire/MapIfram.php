<?php

namespace App\Livewire;

use App\Models\Survey;
use Livewire\Component;
use Livewire\Attributes\Computed;

class MapIfram extends Component
{
    // public  $locations = [
    //     ['Mumbai', 19.0760, 72.8777],
    //     ['Pune', 18.5204, 73.8567],
    //     ['Bhopal ', 23.2599, 77.4126],
    //     ['Agra', 27.1767, 78.0081],
    //     ['Delhi', 28.7041, 77.1025],
    //     ['Rajkot', 22.2734719, 70.7512559],
    // ];

    #[Computed]
    public  function locations()
    {

        $survey = array_values(Survey::get()->unique('school',)->where('is_deleted', 1)->all());

        $loc = array_map(function ($row) {


            $school_image = asset('/storage/' . $row->school_image);


            // dd($this->str2float('12.34456'));



            return [
                "
            <div class='relative flex flex-col content-center justify-center w-72'>
                     <h5  class='block mb-2 font-sans text-xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900'>
                    $row->school
                    </h5>
                      <p class='block font-sans text-base antialiased font-light leading-relaxed text-inherit'>
                            <span class='font-semibold'>" . __('school_status') . ":</span>
                        $row->school_status
                        </p>
                    <div class='relative mx-4 mt-6 bg-clip-border rounded-xl '>
                        <a href=" . $school_image . " target='_blank'>

                        <img style='object-fit: cover;' class='w-40 h-40 ' src='" . $school_image . "'
                            alt='card-image' />
                        </a>
                    </div>
             </div>
                  ",
                $this->str2float($row->lat),
                $this->str2float($row->long),
                // $row->lat,
                // $row->long,
                $row->school
            ];
        }, $survey);

        // dd($survey);
        // dd($loc);

        return $loc;
    }


    private function str2float($number)
    {
        if (is_string($number)) {
            // Check if the string represents a float
            if (strpos($number, '.')) {
                return (float)$number; // If it contains a decimal point, just convert it to float
            }

            // Extract the first two digits
            $firstTwoDigits = substr($number, 0, 2);

            // Keep the rest of the digits as a string
            $restOfTheDigits = substr($number, 2);

            // Combine the integer and decimal parts as a float
            $combinedFloatValue = (float)("$firstTwoDigits.$restOfTheDigits");

            return $combinedFloatValue;
        }

        // If $number is already a float, return it as is
        return $number;
    }


    public function render()
    {
        return view('livewire.map-ifram');
    }
}
