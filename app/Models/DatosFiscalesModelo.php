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

    public function contrato()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }
}
