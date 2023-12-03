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
            // info
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('edu_qual')->nullable();

            // attach
            $table->string('national_cart_id')->nullable();
            $table->string('national_cart_id_image_front')->nullable();
            $table->string('national_cart_id_image_back')->nullable();
            $table->string('image_attend')->nullable();
            $table->string('image_contract_direct_work')->nullable();



            // answer
            $table->string('q_1')->nullable();
            $table->string('q_2')->nullable();
            $table->string('q_3')->nullable();
            $table->string('q_4')->nullable();
            $table->string('q_5')->nullable();
            $table->string('q_6')->nullable();
            $table->string('q_7')->nullable();
            $table->string('q_8')->nullable();
            $table->string('q_9')->nullable();
            $table->string('q_10')->nullable();
            $table->string('q_11')->nullable();

            // validation
            $table->string('val_name')->nullable();
            $table->string('val_job_type')->nullable();
            $table->string('val_school')->nullable();
            $table->string('val_location')->nullable();
            $table->string('val_hire_date')->nullable();
            $table->string('val_signature')->nullable();
            $table->string('val_Seal')->nullable();

            $table->boolean('done')->nullable();



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