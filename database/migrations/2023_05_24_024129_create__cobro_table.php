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
        Schema::create('_cobro', function (Blueprint $table) {
            $table->id("CobroID");
            $table->unsignedBigInteger("ContratoID");
            $table->unsignedBigInteger("usersID");
            $table->unsignedBigInteger("AutorizadorID");
            $table->unsignedBigInteger("UMAID");
            $table->date("FechaCobro");
            $table->float("Monto");
            $table->float("IVA");
            $table->float("Total");
            $table->string("ReciboFormato");
            $table->string("Estado");
            $table->foreign("ContratoID")->references("ContratoID")->on("_contrato")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("usersID")->references("usersID")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("AutorizadorID")->references("usersID")->on("users")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("UMAID")->references("UMAID")->on("_u_m_a")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_cobro');
    }
};
