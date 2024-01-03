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
        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->comment('Se estiver preenchido, é o acesso administrativo');
            $table->unsignedBigInteger('establishment_id');
            $table->string('registration', 8)->unique();
            $table->string('name');
            $table->string('email', 255)->nullable();
            $table->boolean('active')->default(1)->comment('1 - ativo | 0 - inativo');
            $table->boolean('admin')->default(0)->comment('1 - ativo | 0 - inativo');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletesTz();

            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
