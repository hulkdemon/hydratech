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
        Schema::create('_u_m_a', function (Blueprint $table) {
            $table->id("UMAID");
            $table->float("Valor");
            $table->date("FechaAplicacion");
            $table->date("FechaVigencia");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_u_m_a');
    }
};