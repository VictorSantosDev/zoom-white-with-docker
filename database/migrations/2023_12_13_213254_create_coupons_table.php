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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_id');
            $table->string('name_by_company', 20);
            $table->time('opening_hours_start');
            $table->time('opening_hours_end');
            $table->enum('days_of_the_week_start', [
                'MONDAY',
                'THIRD',
                'WEDNESDAY',
                'THURSDAY',
                'FRIDAY',
                'SATURDAY',
                'SUNDAY',
            ]);
            $table->enum('days_of_the_week_end', [
                'MONDAY',
                'THIRD',
                'WEDNESDAY',
                'THURSDAY',
                'FRIDAY',
                'SATURDAY',
                'SUNDAY',
            ]);
            $table->text('info')->nullable();
            $table->boolean('active')->default(1)->comment('1 - ativo | 0 - inativo');
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
        Schema::dropIfExists('coupons');
    }
};
