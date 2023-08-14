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

    public function contratos()
    {
        return $this->belongsTo(ContratosModelo::class, 'id_contrato');
    }

    public function usuarios()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function uma()
    {
        return $this->belongsTo(UmaModelo::class, 'id_uma');
    }
}
