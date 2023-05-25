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
        Schema::create('_factura', function (Blueprint $table) {
            $table->id("FacturaID");
            $table->unsignedBigInteger("ContratoID");
            $table->unsignedBigInteger("CobroID");
            $table->string("XML");
            $table->string("Ruta");
            $table->foreign("ContratoID")->references("ContratoID")->on("_contrato")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("CobroID")->references("CobroID")->on("_cobro")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_factura');
    }
};
