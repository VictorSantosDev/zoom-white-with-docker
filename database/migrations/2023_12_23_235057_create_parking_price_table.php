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
        Schema::create('parking_price', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_id');
            $table->integer('price_daily');
            $table->integer('price_by_hour');
            $table->integer('charge_every_hour');
            $table->integer('price_per_hour');
            $table->boolean('has_other_night_price')->default(false);
            $table->integer('price_by_hour_night')->nullable();
            $table->time('start_of_additional')->nullable();
            $table->time('end_of_additional')->nullable();
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('establishment_id')->references('id')->on('establishments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_price');
    }
};
