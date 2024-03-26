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
        Schema::create('company', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_id');
            $table->string('company_name', 150);
            $table->string('fantasy_name', 150)->nullable();
            $table->string('document');
            $table->string('phone', 11);
            $table->string('email');
            $table->integer('closing_date')->comment("Dia do fechamento.");
            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
