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
        Schema::create('datos_fiscales', function (Blueprint $table) {
            $table->id("id_datos_fiscales");
            $table->unsignedBigInteger("id_contrato");
            $table->string("rfc");
            $table->string("razon_social");
            $table->foreign("id_contrato")->references("id_contrato")->on("contratos")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datos_fiscales');
    }
};
