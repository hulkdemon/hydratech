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
        Schema::create('_condonacion', function (Blueprint $table) {
            $table->id("CondoonID");
            $table->boolean("Descuento");
            $table->float("Porcentaje");
            $table->date("InicioVigencia");
            $table->date("FinVigencia");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_condonacion');
    }
};
