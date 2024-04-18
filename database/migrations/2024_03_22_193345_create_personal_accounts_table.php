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
        Schema::create('personal_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('first_surname', 20)->nullable()->comment('Primer Apellido');
            $table->string('second_surname', 20)->nullable()->comment('Segundo Apellido');
            $table->string('nacionality')->nullable()->comment('Nacionalidad');
            $table->boolean('is_PEP')->nullable()->comment('Personas expuestas políticamente');
            $table->boolean('wife_is_PEP')->nullable()->comment('Esposa es PEP');
            $table->enum('identity_document', ['PENDIENTE', 'SUBIDA', 'VALIDADA', 'RECHAZADA']);
            $table->boolean('relative_is_PEP')->nullable()->comment('Parentezco con PEP');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_accounts');
    }
};
