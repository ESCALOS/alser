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
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_book_id')->comment('Cabecera del libro de reclamaciones')->constrained()->onDelete('cascade');
            $table->enum('service', [1, 2])->comment('Servicio contratado');
            $table->enum('currency_type', [1, 2])->comment('Tipo de moneda');
            $table->string('operation_code', 10)->comment('Código de operación');
            $table->decimal('amount_to_claim', 10, 2)->comment('Cantidad a reclamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claims');
    }
};
