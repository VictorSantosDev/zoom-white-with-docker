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
        Schema::create('washing_vehicle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('plate', 10);
            $table->string('model', 20);
            $table->string('color', 20);
            $table->integer('price')->comment("Soma das 'washing' atrelada.");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->foreign('employee_id')->references('id')->on('employee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('washing_vehicle');
    }
};
