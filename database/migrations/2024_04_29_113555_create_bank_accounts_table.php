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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('location_department_id')->constrained()->comment('Lugar de creación de la cuenta');
            $table->foreignId('bank_id')->constrained()->comment('Entidad bancaria');
            $table->enum('bank_account_type', [1, 2])->comment('Tipo de cuenta bancaria');
            $table->enum('currency_type', [1, 2])->comment('Tipo de moneda');
            $table->string('account_number');
            $table->string('name');
            $table->boolean('is_owner')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
