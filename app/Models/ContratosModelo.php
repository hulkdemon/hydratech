<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratosModelo extends Model
{
    use HasFactory;

    protected $table = 'contratos';
    protected $primaryKey = 'id_contrato';
    public $timestamps = true;

    public function tipos_contratos()
    {
        return $this->belongsTo(TiposContratoModelo::class, 'id_tipo_contrato');
    }
}
