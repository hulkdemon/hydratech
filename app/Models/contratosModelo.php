<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contratosModelo extends Model
{
    use HasFactory;

    protected $table = 'contratos';
    protected $primaryKey = 'id_contrato';
    public $timestamps = true;

    protected $fillable = [
        'id_tipo_contrato',
        'numero_contrato',
        'nombre',
        'apellido',
        'domicilio',
        'correo_electronico',
        'fecha_vigencia'
    ];

    public function tipoContrato()
    {
        return $this->belongsTo(tipoContratoModelo::class, 'id_tipo_contrato');
    }
}
