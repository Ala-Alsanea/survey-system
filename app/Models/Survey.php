<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    public $fillable = [

        // api
        'name',
        'phone',
        'gender',
        'gov',
        'district',
        'subdistrict',

        'edu_qual',
        'national_card_id',
        'school',

        'image_national_card_front',
        'image_national_card_back',
        'image_attend',
        'image_contract_direct_work',

        'oct_image_attend',
        'nov_image_attend',
        'dec_image_attend',
        'school_image',
        'eduqual_image',


        'q_1',
        // 'q_2',
        'q_3',
        'q_4',
        'q_5',
        'q_6',
        'q_7',
        'q_8',
        'q_9',
        'q_10',
        'q_11',

        'teaching_days_num_oct',
        'teaching_days_num_nov',
        'teaching_days_num_dec',
        'teacher_birth_date',
        'oct_teacher_sinature',
        'nov_teacher_sinature',
        'dec_teacher_sinature',
        'school_status',
        'Low_eduqual',
        'gain_money',
        'checked_teacher_name',
        'checked_job_type',
        'checked_school_name',
        'checked_location',
        'checked_hiring_date',
        'checked_management_signature',
        'checked_teacher_signature',
        'checked_stamp',
        'researcher_notes',


        // // old
        // 'name',
        // 'phone',
        // 'gender',

        // 'gov',
        // 'district',
        // 'subdistrict',
        // 'school',
        // 'edu_qual',
        // 'national_card_id',

        // 'image_national_card_front',
        // 'image_national_card_back',
        // 'image_attend',
        // 'image_contract_direct_work',

        // 'q_1',
        // // 'q_2',
        // 'q_3',
        // 'q_4',
        // 'q_5',
        // 'q_6',
        // 'q_7',
        // 'q_8',
        // 'q_9',
        // 'q_10',
        // 'q_11',
        // 'note',

        // not api
        'val_name',
        'val_job_type',
        'val_school',
        'val_location',
        'val_hire_date',
        'val_signature',
        'val_Seal',

        'researcher_id',
        'done',



        'gov_id',
        'district_id',
        'subdistrict_id',
        'school_id',

    ];

    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }
}
