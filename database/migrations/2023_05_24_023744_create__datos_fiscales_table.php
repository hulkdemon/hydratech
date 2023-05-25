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
        Schema::create('_datos_fiscales', function (Blueprint $table) {
            $table->id("DatosFiscalesID");
            $table->unsignedBigInteger("ContratoID");
            $table->string("RFC");
            $table->string("RazonSocial");
            $table->foreign("ContratoID")->references("ContratoID")->on("_contrato")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_datos_fiscales');
    }
};
