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
        Schema::create('_contrato', function (Blueprint $table) {
            $table->id("ContratoID");
            $table->unsignedBigInteger("TipoContratoID");
            $table->integer("NumeroContrato")->unique();
            $table->string("Nombre");
            $table->string("Apellido");
            $table->string("Domicilio");
            $table->string("CorrreoElectronico");
            $table->date("FechaVigencia");
            $table->foreign("TipoContratoID")->references("TipoContratoID")->on("_tipo_contrato")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_contrato');
    }
};
