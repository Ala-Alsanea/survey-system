<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surveys', function (Blueprint $table) {
            // there new 16 column added but added here.
            // contact your manager for more info.
            $table->id();
            // info
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();

            $table->string('gov')->nullable();
            $table->string('gov_id')->nullable();
            $table->string('district')->nullable();
            $table->string('district_id')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('subdistrict_id')->nullable();
            $table->string('edu_qual')->nullable();
            $table->string('school')->nullable();
            $table->string('school_id')->nullable();
            $table->string('national_card_id')->nullable();

            // attach
            $table->string('image_national_card_front')->nullable();
            $table->string('image_national_card_back')->nullable();
            $table->string('image_attend')->nullable();
            $table->string('image_contract_direct_work')->nullable();

            $table->string('oct_image_attend')->nullable();
            $table->string('nov_image_attend')->nullable();
            $table->string('dec_image_attend')->nullable();
            $table->string('school_image')->nullable();
            $table->string('eduqual_image')->nullable();




            // answer
            $table->string('q_1')->nullable();
            // $table->string('q_2')->nullable();
            $table->string('q_3')->nullable();
            $table->string('q_4')->nullable();
            $table->string('q_5')->nullable();
            $table->string('q_6')->nullable();
            $table->string('q_7')->nullable();
            $table->string('q_8')->nullable();
            $table->string('q_9')->nullable();
            $table->string('q_10')->nullable();
            $table->string('q_11')->nullable();

            $table->string('teaching_days_num_oct')->nullable();
            $table->string('teaching_days_num_nov')->nullable();
            $table->string('teaching_days_num_dec')->nullable();
            $table->string('teacher_birth_date')->nullable();
            $table->string('oct_teacher_sinature')->nullable();
            $table->string('nov_teacher_sinature')->nullable();
            $table->string('dec_teacher_sinature')->nullable();
            $table->string('school_status')->nullable();
            $table->string('Low_eduqual')->nullable();
            $table->string('gain_money')->nullable();
            $table->string('checked_teacher_name')->nullable();
            $table->string('checked_job_type')->nullable();
            $table->string('checked_school_name')->nullable();
            $table->string('checked_location')->nullable();
            $table->string('checked_hiring_date')->nullable();
            $table->string('checked_management_signature')->nullable();
            $table->string('checked_teacher_signature')->nullable();
            $table->string('checked_stamp')->nullable();

            $table->text('researcher_notes',1000)->nullable();
            $table->text('note', 1000)->nullable();

            // validation
            $table->string('val_name')->nullable();
            $table->string('val_job_type')->nullable();
            $table->string('val_school')->nullable();
            $table->string('val_location')->nullable();
            $table->string('val_hire_date')->nullable();
            $table->string('val_signature')->nullable();
            $table->string('val_Seal')->nullable();

            $table->string('long')->nullable();
            $table->string('lat')->nullable();

            // $table->string('name_manager_school')->nullable();
            // $table->string('phone_manager_school')->nullable();

            $table->string('village_name')->nullable();
            $table->string('school_name_as_on_user_contract_work')->nullable();
            $table->text('school_name_on_vistiting_and_contract_identical')->nullable();
            $table->string('check_school_location')->nullable();
            $table->string('teacher_name_as_on_real_life')->nullable();
            $table->string('exact_teacher_job_type')->nullable();

            $table->text('teacher_job_type')->nullable();
            $table->text('teacher_signature_comparison')->nullable();
            $table->text('teacher_cotract_type')->nullable();
            $table->text('contract_date')->nullable();


            $table->boolean('done')->default(0);
            $table->foreignId('researcher_id')->nullable()->constrained('researchers')->cascadeOnUpdate();
            // $table->foreignId('district_id')->nullable()->constrained('districts')->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
