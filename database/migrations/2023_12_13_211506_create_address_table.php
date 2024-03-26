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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('establishment_id')->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('neighborhood', 255)->nullable();
            $table->char('state', 2)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('number', 100)->nullable();
            $table->string('complement', 100)->nullable();
            $table->boolean('active')->default(1)->comment('1 - ativo | 0 - inativo');
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('establishment_id')->references('id')->on('establishments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
