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
            $table->unsignedInteger('id_contrato');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_autorizador');
            $table->unsignedInteger('id_uma');
            $table->date('fecha_cobro');
            $table->float('monto');
            $table->float('iva');
            $table->float('total');
            $table->string('recibo_formato');
            $table->string('estado');
            $table->foreign('id_contrato')->references('id_contrato')->on('contratos')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_autorizador')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_uma')->references('id_uma')->on('uma')->onDelete('cascade');
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
