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
        Schema::create('cobros_conceptos', function (Blueprint $table) {
            $table->id('id_cobro_concepto');
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_concepto');
            $table->foreign('id_contrato')->references('id_contrato')->on('contratos');
            $table->foreign('id_concepto')->references('id_concepto')->on('conceptos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobros_conceptos');
    }
};
