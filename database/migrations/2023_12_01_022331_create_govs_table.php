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
        Schema::create('govs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siteCode')->nullable();
            // $table->integer('ParentCode')->nullable();
            $table->string('Ar_Name')->nullable();
            $table->string('En_Name')->nullable();
            // $table->integer('countryID')->nullable()->default( 1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
