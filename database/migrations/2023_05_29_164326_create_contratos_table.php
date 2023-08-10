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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id('id_contrato');
            $table->unsignedBigInteger('id_tipo_contrato');
            $table->integer('numero_contrato')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('domicilio');
            $table->string('correo_electronico')->nullable();
            $table->date('fecha_vigencia');
            $table->foreign('id_tipo_contrato')->references('id_tipo_contrato')->on('tipos_contratos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
