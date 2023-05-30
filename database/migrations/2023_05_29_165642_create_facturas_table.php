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
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_factura');
            $table->unsignedInteger('id_contrato');
            $table->unsignedInteger('ic_cobro');
            $table->string('xml');
            $table->string('ruta');
            $table->foreign('id_contrato')->references('id_Contrato')->on('contratos')->onDelete('cascade');
            $table->foreign('id_cobro')->references('id_cobro')->on('cobros')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturas');
    }
};
