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
        Schema::create('legal_representatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('first_lastname', 20)->nullable()->comment('Primer Apellido');
            $table->string('second_lastname', 20)->nullable()->comment('Segundo Apellido');
            $table->enum('document_type', [1, 3, 4])->nullable()->comment('Tipo de document: 1 => DNI, 3 => CE, 4 => PASSPORT');
            $table->string('document_number', 12)->nullable()->comment('Número de documento');
            $table->string('nacionality')->nullable()->comment('Nacionalidad');
            $table->string('celphone', 20)->nullable()->comment('Celular');
            $table->boolean('is_PEP')->nullable()->comment('Personas expuestas políticamente');
            $table->boolean('wife_is_PEP')->nullable()->comment('Esposa es PEP');
            $table->boolean('relative_is_PEP')->nullable()->comment('Parentezco con PEP');
            $table->enum('representation_type', [1, 2, 3])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_representatives');
    }
};
