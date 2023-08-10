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
        Schema::create('condonaciones', function (Blueprint $table) {
            $table->id('id_condonacion');
            $table->unsignedBigInteger('id_usuario');
            $table->boolean('descuento');
            $table->float('porcentaje');
            $table->string('estdo')->default('pendiente');
            $table->date('inicio_vigencia');
            $table->date('fin_vigencia');
            $table->foreign('id_usuario')->references('id')->on('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condonaciones');
    }
};
