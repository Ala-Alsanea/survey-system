<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Survey extends Model
{
    use HasFactory;
    use LogsActivity;
    use CausesActivity;

    // protected static $recordEvents = ['deleted'];


    public $fillable = [

        // api
        'id',
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

        'village_name',
        'school_name_as_on_user_contract_work',
        'school_name_on_vistiting_and_contract_identical',
        'check_school_location',
        'teacher_name_as_on_real_life',
        'exact_teacher_job_type',
        'teacher_job_type',
        'teacher_signature_comparison',
        'teacher_cotract_type',
        'contract_date',


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
        'note',

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

        'long',
        'lat',

        'gov_id',
        'district_id',
        'subdistrict_id',
        'school_id',

        'name_manager_school',
        'phone_manager_school',


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
        'manager_name_as_on_real_life',
        'manager_Phone_num_as_on_real_life',
        'school_name_as_on_real_life',
        'amount_of_money_that_teacher_gained',
        'maneger_name',
        'maneger_phone',
        'is_deleted',



    ];

    // protected static $recordEvents = ['deleted','updated'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*'])
            // ->logFillable()
            ;
        // Chain fluent methods for configuration options
    }

    public function getDescriptionForEvent(string $eventName): string
    {
        return $eventName;
    }

    public function researcher()
    {
        return $this->belongsTo(Researcher::class);
    }
}
