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
            $table->string('first_lastname', 20)->nullable()->comment('Primer Apellido');
            $table->string('second_lastname', 20)->nullable()->comment('Segundo Apellido');
            $table->foreignId('country_id')->default(140)->comment('Nacionalidad');
            $table->boolean('is_PEP')->nullable()->comment('Personas expuestas políticamente');
            $table->boolean('wife_is_PEP')->nullable()->comment('Esposa es PEP');
            $table->boolean('relative_is_PEP')->nullable()->comment('Parentezco con PEP');
            $table->enum('identity_document_status', [1, 2, 3, 4])->default(1)->comment('Estado de validación del documento de identidad');
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
