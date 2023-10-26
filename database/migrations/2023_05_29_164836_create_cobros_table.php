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
        Schema::create('cobros', function (Blueprint $table) {
            $table->id('id_cobro');
            $table->unsignedBigInteger('id_contrato');
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_uma');
            $table->string('folio', 12)->unique();
            $table->date('fecha_cobro');
            $table->float('monto');
            $table->float('iva');
            $table->float('total');
            $table->string('estado');
            $table->foreign('id_contrato')->references('id_contrato')->on('contratos');
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_uma')->references('id_uma')->on('uma');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cobros');
    }
};
