<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosFiscalesModelo extends Model
{
    use HasFactory;

    protected $table = 'datos_fiscales';
    protected $primaryKey = 'id_datos_fiscales';
    public $timestamps = true;

    protected $fillable = [
        'id_contrato',
        'rfc',
        'razon_social'
    ];

    public function contrato()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }
}
