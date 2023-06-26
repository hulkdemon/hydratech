<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CobrosModelo extends Model
{
    use HasFactory;

    protected $table = 'cobros';
    protected $primaryKey = 'id_cobro';
    public $timestamps = true;

    protected $fillable = [
        'id_contrato',
        'id_user',
        'id_autorizador',
        'id_uma',
        'fecha_cobro',
        'monto',
        'iva',
        'total',
        'recibo_formato',
        'estado'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function autorizador()
    {
        return $this->belongsTo(rolModelo::class, 'id_autorizador');
    }

    public function uma()
    {
        return $this->belongsTo(umaModelo::class, 'id_uma');
    }
}
