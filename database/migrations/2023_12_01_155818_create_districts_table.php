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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siteCode');
            // $table->primary(['id', 'siteCode']);

            $table->string('Ar_Name')->nullable();
            $table->string('En_Name')->nullable();

            // $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnUpdate();
            $table->unsignedBigInteger('ParentCode')->nullable();
            // $table->foreign('ParentCode')->references('siteCode')->on('districts')->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
