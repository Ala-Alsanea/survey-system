<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherInfo extends Model
{
    use HasFactory;


    public $fillable = [
        'name',
        'phone',
        'gender',
        'city',
        'edu_qual',
        'national_card_id',

        'image_national_card_front',
        'image_national_card_back',
        'image_attend',
        'image_contract_direct_work',

        'q_1',
        'q_2',
        'q_3',
        'q_4',
        'q_5',
        'q_6',
        'q_7',
        'q_8',
        'q_9',
        'q_10',
        'q_11',

        'val_name',
        'val_job_type',
        'val_school',
        'val_location',
        'val_hire_date',
        'val_signature',
        'val_Seal',

        'done',
        'researcher_id',


    ];


    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }
}
