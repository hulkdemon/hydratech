<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobrosConceptoModelo extends Model
{
    use HasFactory;

    protected $table = 'cobros_conceptos';
    protected $primaryKey = 'id_cobro_concepto';
    public $timestamps = true;

    public function contratos()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }

    public function concepto()
    {
        return $this->belongsTo(ConceptosModelo::class, 'id_concepto');
    }
}
