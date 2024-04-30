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
        Schema::create('complaint_books', function (Blueprint $table) {
            $table->id();
            $table->enum('document_type', [1, 2, 3, 4])->comment('El tipo de documento');
            $table->string('document_number')->comment('Número de documento');
            $table->string('last_name_father', 20)->comment('Apellido Paterno');
            $table->string('last_name_mother', 20)->comment('Apellido Materno');
            $table->string('name', 50)->comment('Nombres');
            $table->string('representative', 255)->nullable()->comment('Apoderado');
            $table->foreignId('location_district_id')->constrained()->onDelete('restrict')->comment('Distrito');
            $table->string('street', 255)->comment('Dirección');
            $table->string('street_number', 10)->comment('Nro/Mz');
            $table->string('street_lot', 100)->nullable()->comment('Lote');
            $table->string('street_dpto', 100)->nullable()->comment('Dpto');
            $table->string('urbanization', 100)->nullable()->comment('Urbanización');
            $table->string('reference', 100)->nullable()->comment('Referencia');
            $table->string('telephone', 12)->nullable()->comment('Telefono');
            $table->string('celphone', 9)->comment('Celular');
            $table->string('email', 255)->comment('Email');
            $table->enum('response_medium', [1, 2])->comment('Medio de Respuesta');
            $table->boolean('is_complaint')->comment('¿Es queja o  reclamo?');
            $table->text('reason_description')->nullable()->comment('Descripción de la queja o reclamo');
            $table->enum('status', ['P', 'IP', 'C'])->default('P')->comment('Current status of the claim: P: PENNDING, IP: IN_PROGRESS, C: COMPLETED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_books');
    }
};
