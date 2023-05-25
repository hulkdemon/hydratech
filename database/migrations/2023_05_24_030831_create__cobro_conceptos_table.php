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
        Schema::create('_cobro_conceptos', function (Blueprint $table) {
            $table->id("CobroConceptosID");
            $table->unsignedBigInteger("CobroID");
            $table->unsignedBigInteger("ConceptoID");
            $table->foreign("CobroID")->references("CobroID")->on("_cobro")->onDelete("cascade")->onUpdate("cascade");
            $table->foreign("ConceptoID")->references("ConceptoID")->on("_conceptos")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_cobro_conceptos');
    }
};
