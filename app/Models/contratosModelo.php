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

    public function tipoContrato()
    {
        return $this->belongsTo(TipoContratoModelo::class, 'id_tipo_contrato');
    }
}
