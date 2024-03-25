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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->enum('account_type', [1, 2])->default(1);
            $table->boolean('is_admin')->default(false);
            $table->string('celphone', 20)->nullable()->comment('Celular');
            $table->enum('document_type', [1, 2, 3, 4])->nullable()->comment('Tipo de document: 1 => DNI, 2 => RUC, 3 => CE, 4 => PASSPORT');
            $table->string('document_number', 12)->nullable()->comment('Número de documento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
