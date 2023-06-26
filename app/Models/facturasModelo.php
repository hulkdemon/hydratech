<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class facturasModelo extends Model
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
        return $this->belongsTo(contratosModelo::class, 'id_contrato');
    }

    public function cobro()
    {
        return $this->belongsTo(cobrosModelo::class, 'id_cobro');
    }
}
