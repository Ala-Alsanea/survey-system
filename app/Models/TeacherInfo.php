<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherInfo extends Model
{
    use HasFactory;


    public $fillable = [
        'Ar_Name',

        'phone',
        'gov',
        'gov_id',
        'district_id',
        'district',
        'subdistrict',
        'subdistrict_id',
        'school',
        'school_id',

        'edu_qual',
        'major',
        'national_card_id',
        'national_card_type',

        'name_manager_school',
        'phone_manager_school',

        'changed_phone',
        'changed_national_card_id',


    ];


    // public function researcher()
    // {
    //     return $this->belongsTo(Researcher::class);
    // }

    // public function district()
    // {
    //     return $this->belongsTo(District::class);
    // }
}
