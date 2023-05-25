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
        Schema::create('_credito', function (Blueprint $table) {
            $table->id("CreditoID");
            $table->unsignedBigInteger("ContratoID");
            $table->float("Monto");
            $table->integer("Activo");
            $table->foreign("ContratoID")->references("ContratoID")->on("_contrato")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_credito');
    }
};
