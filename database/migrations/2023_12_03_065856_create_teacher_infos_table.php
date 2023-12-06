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
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('isolation')->nullable();
            $table->string('school')->nullable();
            $table->string('edu_qual')->nullable();
            $table->string('major')->nullable();
            $table->string('national_card_id')->nullable();
            $table->string('national_card_type')->nullable();
            $table->string('phone')->nullable();
            $table->string('name_manager_school')->nullable();
            $table->string('phone_manager_school')->nullable();



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
