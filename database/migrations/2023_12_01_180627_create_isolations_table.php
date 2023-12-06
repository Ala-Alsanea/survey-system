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
        Schema::create('isolations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('siteCode')->nullable();
            $table->unsignedBigInteger('ParentCode')->nullable();

            // $table->foreignId('ParentCode')->nullable()->constrained('districts')->cascadeOnUpdate();
            $table->string('Ar_Name')->nullable();
            $table->string('En_Name')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isolations');
    }
};
