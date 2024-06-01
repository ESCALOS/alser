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
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->boolean('is_purchase');
            $table->double('amount_to_send', 10, 2);
            $table->double('amount_to_receive', 10, 2);
            $table->double('factor', 8, 4);
            $table->string('account_from_send', 30);
            $table->string('account_to_receive', 30);
            $table->unsignedBigInteger('origin_bank');
            $table->unsignedBigInteger('destination_bank');
            $table->enum('status', [1, 2, 3, 4, 5])->default(1);
            $table->timestamps();

            $table->foreign('origin_bank')->references('id')->on('banks')->onDelete('restrict');
            $table->foreign('destination_bank')->references('id')->on('banks')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operations');
    }
};
