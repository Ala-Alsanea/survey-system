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
        Schema::create('teacher_infos', function (Blueprint $table) {
            $table->id();

            $table->string('Ar_Name')->nullable();

            $table->string('gov')->nullable();
            $table->string('gov_id')->nullable();
            $table->string('district')->nullable();
            $table->string('district_id')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('subdistrict_id')->nullable();
            $table->string('school')->nullable();
            $table->string('school_id')->nullable();

            $table->string('edu_qual')->nullable();
            $table->string('major')->nullable();
            $table->string('national_card_id')->nullable();
            $table->string('national_card_type')->nullable();
            $table->string('phone')->nullable();
            $table->string('name_manager_school')->nullable();
            $table->string('phone_manager_school')->nullable();

            $table->string('changed_phone')->nullable();
            $table->string('changed_national_card_id')->nullable();

            // $table->string('phone_repeated')->nullable();





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_infos');
    }
};
