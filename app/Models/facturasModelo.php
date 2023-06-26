<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturasModelo extends Model
{
    use HasFactory;

    protected $table = 'facturas';
    protected $primaryKey = 'id_factura';
    public $timestamps = true;

    protected $fillable = [
        'id_contrato',
        'id_cobro',
        'xml',
        'ruta'
    ];

    public function contrato()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }

    public function cobro()
    {
        return $this->belongsTo(CobrosModelo::class, 'id_cobro');
    }
}
