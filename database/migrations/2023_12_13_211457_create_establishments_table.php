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
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name_by_company', 255);
            $table->string('document', 14);
            $table->enum('type', [
                'CAR_WASH',
                'PARKING',
                'CAR_WASH_AND_PARKING',
            ])->nullable()->comment('CAR_WASH - LAVA RAPIDO | PARKING - ESTACIONAMENTO | CAR_WASH_AND_PARKING - LAVA RAPIDO E ESTACIONAMENTO');
            $table->string('cor_system', 50);
            $table->boolean('active')->default(1)->comment('1 - ativo | 0 - inativo');
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishments');
    }
};
