<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposContratoModelo extends Model
{
    use HasFactory;

    protected $table = 'tipos_contratos';
    protected $primaryKey = 'id_tipo_contrato';
    public $timestamps = true;

    protected $fillable = [
        'nombre'
    ];
}
