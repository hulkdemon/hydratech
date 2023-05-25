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
        Schema::create('_conceptos', function (Blueprint $table) {
            $table->id("ConceptoID");
            $table->string("Descripcion");
            $table->float("Precio");
            $table->integer("Activo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_conceptos');
    }
};
