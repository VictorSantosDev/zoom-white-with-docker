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
        Schema::create('washing_vehicle_has_washing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('washing_vehicle_id');
            $table->unsignedBigInteger('washing_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('washing_vehicle_id')->references('id')->on('washing_vehicle');
            $table->foreign('washing_id')->references('id')->on('washing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('washing_vehicle_has_washing');
    }
};
